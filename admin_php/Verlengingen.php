<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verlengingen</title>
    <?php include 'top_nav_admin.php'?>
    <style>
.verlengingen_dashboard_container{
  width: 100%;
  margin-top: 1.5em;
}
.verlengingen_dashboard_details{
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
.inlever_uitleen span{
    font-weight: normal;
}
        </style>
</head>
<body>
    <div class="rechter_grid">
        <div class="verlengingen_dashboard_container">
            <div class="verlengingen_dashboard_details">
                <div class="naam_reservatieID">
                    <h3>Luna D'Heere</h3>
                    <h3>Reservatie-ID: <span>04536</span></h3>
                </div>
                <h3>Apparaat: USB-C</h3>
                <div class="inlever_uitleen">
                    <h3>Inleverdatum: <span>22/03/2024</span></h3>
                    <h3>Nieuwe Inleverdatum: <span>29/03/2024</span></h3>
                </div>
                <div class="iconen">
                    <img class="check" src="images/svg/circle-check-solid.svg" alt="">
                    <img class="verwijder_btn" src="images/svg/circle-xmark-solid.svg" alt="">
                </div>
            </div>
        </div>
    
</body>
</html>