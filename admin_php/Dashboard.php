<?php
include 'database.php';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include 'top_nav_admin.php'?>
    <style>
        .agenda_container {
            display: flex;
            flex-direction: column;
            width: 100%;
            align-items: center;
            margin-top: 2em;
        }
        .datums {
            display: flex;
            list-style: none;
            margin-top: 2em;
            align-items: center;
        }
        .datums li {
            background-color: rgb(193,193,193);
            width: 5em;
            height: 5em;
            margin: 1em;
            border-radius: 50%;
            text-align: center;
            display: flex;
            cursor: pointer;
        }
        .datums li h3 {
            margin: auto;
        }
        .datums li:first-child, .datums li:last-child {
            width: 2em;
            height: 2em;
            background: none;
        }
        .datums .active {
            background-color: #E30613;
        }
        .uitleningen_dashboard_container {
            width: 100%;
            margin-top: 1.5em;
        }
        .uitleningen_dashboard_details {
            display: flex;
            width: 90%;
            background-color: #D9D9D9;
            margin: auto;
            border-radius: 2em;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1em;
            padding: 0.5em;
        }
        .naam_reservatieID {
            margin-left: 2em;
        }
        .naam_reservatieID span {
            font-weight: normal;
        }
        .iconen {
            display: flex;
            margin-right: 2em;
        }
        .iconen img {
            width: 2em;
            height: 2em;
            margin: 0.5em;
        }
        .check {
            filter: invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg) brightness(103%) contrast(79%);
            cursor: pointer;
        }
        .verwijder_btn {
            filter: invert(13%) sepia(91%) saturate(6506%) hue-rotate(353deg) brightness(88%) contrast(103%);
            cursor: pointer;
        }
        .uitlening_toevoegen {
            background-color: #1BBCB6;
            text-align: center;
            width: 23%;
            border-radius: 2em;
            margin-left: 4em;
            margin-top: 2em;
        }
        .uitlening_toevoegen a {
            text-decoration: none;
            color: white;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function(){
        function fetchReservations(date) {
            $.ajax({
                url: 'functies/dashboard_personen.php',
                type: 'POST',
                data: {date: date},
                success: function(response) {
                    $('.uitleningen_dashboard_container').html(response);
                }
            });
        }
        //functie voor maanden en dagen
        function updateDatesAndMonth(startDate) {
            var date = new Date(startDate);
            var monthNames = ["Januari", "Februari", "Maart", "April", "Mei", "Juni", "Juli", "Augustus", "September", "Oktober", "November", "December"];
            var startOfWeek = new Date(date.setDate(date.getDate() - date.getDay() + 1)); // Monday of the current week
            $('.datums').empty();
            $('.datums').append('<li id="prev-week"><img src="images/svg/chevron-left-solid.svg" alt="links"></li>');

            for (let i = 0; i < 7; i++) {
                var currentDay = new Date(startOfWeek);
                currentDay.setDate(startOfWeek.getDate() + i);
                var displayDate = currentDay.getDate();
                var fullDate = currentDay.toISOString().split('T')[0];
                var activeClass = fullDate === new Date().toISOString().split('T')[0] ? 'class="active"' : '';
                $('.datums').append(`<li data-date='${fullDate}' ${activeClass}><h3>${displayDate}</h3></li>`);
            }

            $('.datums').append('<li id="next-week"><img src="images/svg/chevron-right-solid.svg" alt="rechts"></li>');
            $('#monday-date').val(startOfWeek.toISOString().split('T')[0]);
            $('.agenda_container h2').text(monthNames[startOfWeek.getMonth()]);
        }

        // Fetch reservations for today's date on page load
        var currentDate = new Date();
        updateDatesAndMonth(currentDate);
        fetchReservations(currentDate.toISOString().split('T')[0]);

        $('.datums').on('click', 'li', function() {
            let selectedDate = $(this).data('date');
            $('.datums li').removeClass('active');
            $(this).addClass('active');
            fetchReservations(selectedDate);
        });

        $('.datums').on('click', '#prev-week', function() {
            let currentMonday = new Date($('#monday-date').val());
            currentMonday.setDate(currentMonday.getDate() - 7);
            updateDatesAndMonth(currentMonday);
            fetchReservations($('#monday-date').val());
        });

        $('.datums').on('click', '#next-week', function() {
            let currentMonday = new Date($('#monday-date').val());
            currentMonday.setDate(currentMonday.getDate() + 7);
            updateDatesAndMonth(currentMonday);
            fetchReservations($('#monday-date').val());
        });

        //CLick functies voor de iconen
        //DEFECT:
        $(document).on('click', '.iconen .schroevendraaier', function() {
            var reservatieID = $(this).closest('.uitleningen_dashboard_details').find('.naam_reservatieID span').text();
            $.ajax({
                url: 'functies/markeer_als_defect.php',
                type: 'POST',
                data: {reservatieID: reservatieID},
                success: function(response) {
                    alert('Reservatie gemarkeerd als defect.');
                }
            });
        });
        //CHECK:
        $(document).on('click', '.iconen .check', function() {
            var $details = $(this).closest('.uitleningen_dashboard_details');
            var reservatieID = $(this).closest('.uitleningen_dashboard_details').find('.naam_reservatieID span').text();
            var statusText = $details.find('p').text();

            $.ajax({
                url: 'functies/verwijder_reservatie.php',
                type: 'POST',
                data: {
                    reservatieID: reservatieID,
                    statusText: statusText.trim() // Voeg statusText toe aan de data
                },
                success: function(response) {
                    console.log(response);
                    if (statusText.trim() === "Op te halen") {
                        alert('Reservatie opgehaald.');
                    } else {
                        alert('Reservatie ingeleverd.');
                    }
                    fetchReservations(new Date().toISOString().split('T')[0]); // Reservaties opnieuw laden na verwijdering
                }
            });
        });
        //VERWIJDER:
        $(document).on('click', '.iconen .verwijder_btn', function() {
            var $details = $(this).closest('.uitleningen_dashboard_details');
            var reservatieID = $(this).closest('.uitleningen_dashboard_details').find('.naam_reservatieID span').text();
            var statusText = $details.find('p').text();

            $.ajax({
                url: 'functies/waarschuwing_dashboard.php',
                type: 'POST',
                data: {reservatieID: reservatieID},
                success: function(response) {
                    console.log(response);
                    if (statusText.trim() === "Op te halen") {
                        alert('Ophaling verwijderd.');
                    } else {
                        alert('Inlevering verwijderd.');
                    }
                    fetchReservations(new Date().toISOString().split('T')[0]); // Reservaties opnieuw laden na verwijdering
                }
            });
        });
    });
    </script>
</head>
<body>
    <div class="rechter_grid">
        <div class="agenda_container">
            <h2>Mei</h2> <!-- De maand wordt hier geüpdatet door JavaScript -->
            <ul class="datums">
                <!-- Datumknoppen worden hier dynamisch gegenereerd -->
            </ul>
            <input type="hidden" id="monday-date" value="">
        </div>
        <div class="uitleningen_dashboard_container">
            <!-- Content will be loaded here via AJAX -->
        </div>
        <div class="uitlening_toevoegen">
            <h3><a href="UitleningToevoegen.php">Uitlening toevoegen</a></h3>
        </div>
    </div>
</body>
</html>
