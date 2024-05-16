<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include 'top_nav_admin.php'?>
    <style>
.agenda_container{
  display: flex;
  flex-direction: column;
  width: 100%;
  align-items: center;
  margin-top: 2em;
}
.datums{
  display: flex;
  list-style: none;
  margin-top: 2em;
  align-items: center;
}
.datums li{
  background-color: rgb(193,193,193);
  width: 5em;
  height: 5em;
  margin: 1em;
  border-radius: 50%;
  text-align: center;
  display: flex;
}
.datums li h3{
  margin: auto;
}
.datums li:first-child , .datums li:last-child{
  width: 2em;
  height: 2em;
  background: none;
}
.datums .active{
  background-color: #E30613;
}
.uitleningen_dashboard_container{
  width: 100%;
  margin-top: 1.5em;
}
.uitleningen_dashboard_details{
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
.naam_reservatieID{
  margin-left: 2em;
}
.naam_reservatieID span{
  font-weight: normal;
}
.iconen{
  display: flex;
  margin-right: 2em;
}
.iconen img{
  width: 2em;
  height: 2em;
  margin: 0.5em;
}
.check{
  filter: invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg)
  brightness(103%) contrast(79%);
}
.verwijder_btn{
  filter: invert(13%) sepia(91%) saturate(6506%) hue-rotate(353deg) brightness(88%) contrast(103%);
}

.uitlening_toevoegen{
  background-color: #1BBCB6;
  text-align: center;
  width: 23%;
  border-radius: 2em;
  margin-left: 4em;
  margin-top: 2em;
}
.uitlening_toevoegen a{
  text-decoration: none;
  color: white;
}
        </style>
</head>
<body>
    <div class="rechter_grid">
        <div class="agenda_container">
            <h2>Maart</h2>
            <ul class="datums">
                <li><img src="images/svg/chevron-left-solid.svg" alt="links"></li>
                <?php
                    $currentMonth = date('n');
                    $currentYear = date('Y');

                    // Set Monday as the first day of the week
                    $firstDayOfWeek = 1; // Monday
                    $dagenIndeMaand = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
                    for($day=1; $day <= $dagenIndeMaand; $day++){
                        $dayOfWeek = date('N', strtotime("$currentYear-$currentMonth-$day"));
                        if ($dayOfWeek == $firstDayOfWeek || $dayOfWeek == 4 || $dayOfWeek == 5) {
                            echo "<li><h3>$day</h3></li>";
                        }
                    }
                ?>
                <li><img src="images/svg/chevron-right-solid.svg" alt=""></li>
            </ul>
        </div>
        <div class="uitleningen_dashboard_container">
            <div class="uitleningen_dashboard_details">
                <div class="naam_reservatieID">
                    <h3>Luna D'Heere</h3>
                    <h3>Reservatie-ID: <span>04536</span></h3>
                </div>
                <h3>Apparaat: USB-C</h3>
                <p>Ophalen</p>
                <div class="iconen">
                    <img src="images/svg/screwdriver-wrench-solid.svg" alt="">
                    <img class="check" src="images/svg/circle-check-solid.svg" alt="">
                    <img class="verwijder_btn" src="images/svg/circle-xmark-solid.svg" alt="">
                </div>
            </div>
        </div>
        <div class="uitlening_toevoegen">
            <h3><a href="">Uitlening toevoegen</a></h3>
        </div>
    </div>
</div>
</body>
</html>