<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defect bevestiging</title>
    <link rel="stylesheet" href="/css/stylesheet.css">
    <style>
.terugInfo{
    color: #E30613;
    cursor: pointer;

}
.reserverenEnTerug{
    display: flex;
}
.reserverenEnTerug h1{
    margin: 0.8em 0.5em 0em 0.5em;
}
.reserverenEnTerug a img{
    width: 1.5em;
    height: auto;
    margin: 1.5em;
}
.bevestig{
    margin: 0em 4em 2em 4em;
    font-size: 20px;
}
.item_info_container{
    background-color: rgb(193, 193, 193);
    width: 80%;
    margin: 1em auto;
    border-radius: 2em;
}
.item_info_container img{
  width: 15%;
}
.item_info{
    display: flex;
    justify-content: space-around;
    align-items: center;
    position: relative;
}
.item_info img{
    width: 15%;
    height: 15%;
    margin: auto 1em;
}
.melding h2{
  margin: 2em 0em 0em 2em;
}
.melding p{
  width: 85%;
  margin: auto;
  background-color: rgb(193, 193, 193);
  padding: 4em;
  border-radius: 1em;
  margin-top: 2em;
}
        </style>
</head>
<body>
<?php include 'top_nav.php'?>

<div class="reserverenEnTerug">
    <a href="#"><img src="images/svg/chevron-left-solid.svg" alt=""></a>
    <h1>Defect bevestiging</h1>
</div>
<p class="bevestig">Deze items werden <b>succesvol</b> defect gemeld. Check je inbox voor een bevestigingsmail.
Klik <i class="terugInfo">hier</i> voor meer informatie omtrent defecten</p>
<div class="item_info_container">
    <div class="item_info">
        <img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="foto apparaat">
    <h2>Canon-M50</h2>
    <p class="data">van 29/12/2024 <br> tot 14/01/2025</p>
    <h2>Aantal:</h2>
    </div>
</div>

<div class="melding">
    <h2><i>Jouw melding:</i></h2>
    <p>Voorbeeld: Mijn camera heeft een rare zwarte vlek in de rechterbovenhoek van elke foto, zelfs na het schoonmaken van de lens. Het begon nadat ik het apparaat per ongeluk liet vallen tijdens een wandeling in het park gisteren</p>
</div>
<?php include 'footer.php'?>
<script>
    document.querySelector('.terugInfo').addEventListener('click', function(){
        window.location.href = 'Info.php';
    });
</script>
</body>
</html>