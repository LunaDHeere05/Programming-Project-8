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
</head>
<body>
    <div class="rechter_grid">
    <?php include 'functies/Dashboard_zoeken.php' ?>
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

    <script>
        function updateDatesAndMonth(startDate) {
    var date = new Date(startDate);
    var monthNames = ["Januari", "Februari", "Maart", "April", "Mei", "Juni", "Juli", "Augustus", "September", "Oktober", "November", "December"];
    var startOfWeek = new Date(date.setDate(date.getDate() - date.getDay() + 1)); // Monday of the current week

    var datumsElement = document.querySelector('.datums');
    datumsElement.innerHTML = '';
    var prevWeekLi = document.createElement('li');
    prevWeekLi.id = 'prev-week';
    var prevWeekImg = document.createElement('img');
    prevWeekImg.src = 'images/svg/chevron-left-solid.svg';
    prevWeekImg.alt = 'links';
    prevWeekLi.appendChild(prevWeekImg);
    datumsElement.appendChild(prevWeekLi);

    for (let i = 0; i < 7; i++) {
        var currentDay = new Date(startOfWeek);
        currentDay.setDate(startOfWeek.getDate() + i);
        var displayDate = currentDay.getDate();
        var fullDate = currentDay.toISOString().split('T')[0];

        var li = document.createElement('li');
        li.setAttribute('data-date', fullDate);
        if (fullDate === new Date().toISOString().split('T')[0]) {
            li.classList.add('active');
        }

        var h3 = document.createElement('h3');
        h3.textContent = displayDate;
        li.appendChild(h3);

        datumsElement.appendChild(li);
    }

    var nextWeekLi = document.createElement('li');
    nextWeekLi.id = 'next-week';
    var nextWeekImg = document.createElement('img');
    nextWeekImg.src = 'images/svg/chevron-right-solid.svg';
    nextWeekImg.alt = 'rechts';
    nextWeekLi.appendChild(nextWeekImg);
    datumsElement.appendChild(nextWeekLi);

    var mondayDateInput = document.querySelector('#monday-date');
    if (mondayDateInput) {
        mondayDateInput.value = startOfWeek.toISOString().split('T')[0];
    }

    var agendaTitle = document.querySelector('.agenda_container h2');
    if (agendaTitle) {
        agendaTitle.textContent = monthNames[startOfWeek.getMonth()];
    }
}

    </script>
</body>
</html>
