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
        }
        .verwijder_btn {
            filter: invert(13%) sepia(91%) saturate(6506%) hue-rotate(353deg) brightness(88%) contrast(103%);
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

            // Fetch reservations for today's date on page load
            fetchReservations(new Date().toISOString().split('T')[0]);

            $('.datums li').click(function() {
                let selectedDate = $(this).data('date');
                $('.datums li').removeClass('active');
                $(this).addClass('active');
                fetchReservations(selectedDate);
            });

            $('#prev-week').click(function() {
                let currentMonday = new Date($('#monday-date').val());
                currentMonday.setDate(currentMonday.getDate() - 7);
                loadWeek(currentMonday);
            });

            $('#next-week').click(function() {
                let currentMonday = new Date($('#monday-date').val());
                currentMonday.setDate(currentMonday.getDate() + 7);
                loadWeek(currentMonday);
            });

            function loadWeek(mondayDate) {
                let datesHtml = '';
                for (let i = 0; i < 7; i++) {
                    let date = new Date(mondayDate);
                    date.setDate(date.getDate() + i);
                    let dateString = date.toISOString().split('T')[0];
                    let isToday = (new Date().toDateString() === date.toDateString());
                    let activeClass = isToday ? 'class="active"' : '';
                    datesHtml += `<li data-date="${dateString}" ${activeClass}><h3>${date.getDate()}</h3></li>`;
                }
                $('#monday-date').val(mondayDate.toISOString().split('T')[0]);
                $('.datums').html(`<li id="prev-week"><img src="images/svg/chevron-left-solid.svg" alt="links"></li>${datesHtml}<li id="next-week"><img src="images/svg/chevron-right-solid.svg" alt="rechts"></li>`);
                fetchReservations(new Date().toISOString().split('T')[0]);
            }
        });
    </script>
</head>
<body>
    <div class="rechter_grid">
        <div class="agenda_container">
            <?php
                setlocale(LC_TIME, 'nl_NL.UTF-8');
                echo '<h2>' . strftime('%B') . '</h2>';
            ?>
            <ul class="datums">
                <li id="prev-week"><img src="images/svg/chevron-left-solid.svg" alt="links"></li>
                <?php
                    $currentDayOfWeek = date('N');
                    $currentDay = date('j');
                    $currentMonth = date('n');
                    $currentYear = date('Y');

                    // Calculate the date of Monday of the current week
                    $mondayDate = strtotime('monday this week');
                    
                    // Generate the dates for the current week
                    for ($i = 0; $i < 7; $i++) {
                        $date = date('Y-m-d', strtotime("+$i days", $mondayDate));
                        $displayDate = date('j', strtotime($date));
                        $isToday = (date('Y-m-d') == $date);
                        $activeClass = $isToday ? 'class="active"' : '';
                        echo "<li data-date='$date' $activeClass><h3>$displayDate</h3></li>";
                    }
                ?>
                <li id="next-week"><img src="images/svg/chevron-right-solid.svg" alt="rechts"></li>
            </ul>
            <input type="hidden" id="monday-date" value="<?= date('Y-m-d', $mondayDate) ?>">
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
