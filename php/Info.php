<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Info</title>
    <link rel="stylesheet" href="/css/stylesheet.css" />
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

.info-chevron-left{
    width: 100%;
    align-items: center;
    display: flex;
}
.info-chevron-left a img{
    width: 1.5em;
}
.info_titel{
    height: 100%;
    text-align: center;
    margin: auto;
}
.info_uitleen_uitleg h2 {
  padding-left: 2em;
  margin: auto;
}
.info_uitleen_uitleg ul li h3 {
  color: white;
}
.info_uitleen_uitleg ul li p {
  font-size: 85%;
  padding: 1em;
}
.info_uitleen_uitleg{
padding-bottom: 4em;
}
.info_titel{
  margin: 0.3em 0em 0em 0.5em;
}

.info_uitleen_uitleg ul {
  list-style: none;
  display: flex;
  margin-top: 1em;
  justify-content: space-between;
  margin: auto;
  width: 90%;

}
.info_uitleen_uitleg h2 {
  margin: 1em 0em;
}
.info_uitleen_uitleg ul li {
  width: 15em;
  height: 10em;
  border-radius: 1em;
  text-align: center;
  background-color: #1bbcb6;
  text-decoration: none;
  padding: 1em;
  color: white;
}

/* openings uren  */
.info-opening-hours h1{
  padding: 0.5em;
  text-align: center;
  font-size: 1.5em;
}

.info-opening-hours {
    padding: 0em 1em 0em 0em;
    margin-bottom: 1em;
  }
.info-opening-hours table {
  margin: auto;
  width: 80%;
  border-collapse: collapse;
  }
  
.info-opening-hours h1 {
    padding: 0em 0em 0.5em 0em;
    text-align: left;
    margin: 0em 0em 1em 2em;
  }

.info-opening-hours table,th,td {
    text-align: center;
    padding: 1.5em;
}
.info-opening-hours table th {
    text-align: start;
    border: none;
    border-bottom: 2px solid rgb(193, 193, 193);
  }
  .info-opening-hours table td{
    border: none;
    border-bottom: 2px solid rgb(193, 193, 193);
    border-left: 2px solid rgb(193, 193, 193);
  }
  .info-opening-hours table tr:last-child th, .info-opening-hours table tr:last-child td{
    height: 2em;
    border-bottom: none;
  }

  .info-opening-hours td  {
    border: 0.1em solid black;
  }

  .info-opening-hours th {
    border: 0.1em solid black;
  }

/* sancties/defect  */

.info-sancties{
    margin: 1em 0em 1em 3em;
}
.info-sancties h2 p{
  margin: 2em  0em 1em 0em;
}
.info-sancties p b{
    color: #E30613;
}
.info-sancties p, .info-defect p{
  width: 95%;
}

.info-defect{
    margin: 2em 0em 1em 3em;
}

/* veel gestelde vragen  */

.info-veel-vragen{
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  text-align: left;
}
.veel_vragen{
  align-self: left;
  margin-left: 2em;
  margin-top: 2em;
}
.info-box{
  position: relative;
  padding: 1em;
  border: 0.5em solid transparent;
  border-bottom-color: #1bbcb6;
  background-color: transparent;
  width: 50%;
  height: 2.5em;
  cursor: pointer;
  transition: all 0.4s ease;
}
.info-box h2{
  font-size: 1em;
  margin-bottom: 1em;
}
.info-box p {
  font-size: 1em;
  line-height: 1.3;
  opacity: 0;
  transition: all 0.2s;
}
.info-button {
position: absolute;
right: 2em;
font-size: 1em;
background-color: transparent;
border: none;
outline: none;
color: #000000;
}
.info-button i{
  display: none;
}
.info-angle-down{
  display: block;
}


.info-box.active {
  height: 6em;
}

.info-box.active p{
opacity: 1;
}

.info-box.active .info-button .info-angle-down{
  display: none;
}
.info-box.active .info-button .info-angle-up{
  display: none;
}

/* form  */
.info-form-h2 {
  margin: 3em 0em 1em 2em;
  color: #1bbcb6;
}

.info-form{
  display: flex;
  flex-direction: column;
  align-items: center;
}

.info-text{
  width: 100%;
  display: flex;
}
.info-text input[type=text]{
  width: 90%;
  height: 20em;
  border-radius: 2em;
  background-color: rgb(193, 193, 193);
  border: none;
  color: #fff;
  margin: auto;
  padding: 2em;
}
.info-text input[type=text]:focus{
  outline: none;

}
.info-submit{
  width: 100%;
  height: 5em;
  display: flex;
  justify-content: center;
}
.info-submit input[type=submit]{
  background-color: #1bbcb6;
  border-radius: 2em;
  width: 15%;
  height: 70%;;
  margin: auto;
  border: 0;
  color: white;
  font-weight: bold;
}
.info-submit input[type=submit]::-ms-value{
  font-size: 15px;
}
    </style>
  </head>
  <body>
    <?php include "top_nav.php"; ?>
    <div class="info-chevron-left">
    <?php
        echo '<a href="#"><img src="images\svg\chevron-left-solid.svg" alt="chevron left"></a>';
    ?>
    <h1 class="info_titel">Info</h1>
    </div>
      <!-- Hoe leen je iets uit? -->
      <div class="info_uitleen_uitleg">
        <h2>Hoe leen je iets uit?</h2>
        <ul>
          <li>
              <h3>Stap 1</h3>
              <p>Kies een apparaat op basis van de categorieën op de thuispagina of zoek een apparaat met de zoekbalk.</p>
          </li>
          <li>
              <h3>Stap 2</h3>
              <p>Bepaal de uitleenperiode door middel van het resultaat te filteren of bepaal het bij het reserveringsproces.</p>
          </li>
          <li>
              <h3>Stap 3</h3>
              <p>Vul de nodige informatie aan en voeg de reservatie toen aan het winkelmandje, of reserveer direct.</p>
          </li>
          <li>
              <h3>Stap 4</h3>
              <p>Haal het gereserveerde apparaat op in het medialab!</p>
          </li>
        </ul>
      </div>

    <!-- openings hours  -->
    <div class="info-opening-hours">
      <h1>Openingsuren</h1>
      <table>
        <tr>
          <th>Maandag</th>
          <td>10:00 - 12:00</td>
          <td>12:30 - 17:00</td>
        </tr>
        <tr>
          <th>Dinsdag</th>
          <td>/</td>
          <td>/</td>
        </tr>
        <tr>
          <th>Woensdag</th>
          <td>/</td>
          <td>/</td>
        </tr>
        <tr>
          <th>Donderdag</th>
          <td>10:00 - 12:00</td>
          <td>12:30 - 17:00</td>
        </tr>
        <tr>
          <th>Vrijdag</th>
          <td>10:00 - 12:00</td>
          <td>12:30 - 17:00</td>
        </tr>
        <tr>
          <th>Weekend</th>
          <td>/</td>
          <td>/</td>
        </tr>
      </table>
    </div>
  </body>
<!-- sancties/defect  -->
<div class="info-sancties"><h2>Sancties</h2>
<p>Indien je het apparaat niet komt ophalen op de uitleendatum dat je hebt gekozen of je het apparaat te laat inlevert, wordt er een <b>waarschuwing</b> bij je account toegevoegd.
  Eens je aan 2 waarschuwingen hebt kom je voor 3 maanden op een <b>blacklist</b> waarbij je geen apparaten meer kan uitlenen tijdens die periode.</p>
</div>

<div class="info-defect">
<h2>Defect melden</h2>
<p>Indien je een defect of schade heeft dan meld je dit zelf aan via de reservaties pagina. Je klikt op de bijhorende knop en volgt de instructies op de pagina. Zorg dat je het juiste apparaat aanklikt met de bijhorende apparaat ID. Deze ID-sticker vind je terug als een sticker op het apparaat.</p>
</div>

<!-- veel gestelde vragen  -->
<!-- antwoorden nog bijzetten  -->
<h2 class="veel_vragen">Veelgestelde vragen</h2>
<div class="info-veel-vragen">
<div class="info-box">
  <button class="info-button">
    <i class="info-angle-down"></i>
    <i class="info-angle-up"></i>
  </button>
  <h2>Wat moet ik doen indien ik mijn reservatie niet op tijd kan komen ophalen?</h2>
  <p>antwoord vraag 1</p>
</div>
<div class="info-box">
  <button class="info-button">
    <i class="info-angle-down"></i>
    <i class="info-angle-up"></i>
  </button>
  <h2>Wat moet ik doen indien ik een apparaat beschadig?</h2>
  <p>antwoord vraag 2</p>
</div>
<div class="info-box">
  <button class="info-button">
    <i class="info-angle-down"></i>
    <i class="info-angle-up"></i>
  </button>
  <h2>Hoe lang van tevoren kan ik een reservering maken?</h2>
  <p>antwoord vraag 3</p>
</div>
<div class="info-box">
  <button class="info-button">
    <i class="info-angle-down"></i>
    <i class="info-angle-up"></i>
  </button>
  <h2>Hoe ontvang ik een bevestiging van mijn reservering?</h2>
  <p>antwoord vraag 4</p>
</div>
</div>
<!-- form  -->
<h2 class="info-form-h2">Geen antwoord gevonden op je vraag? Vul dit formulier dan in. </h1>
<form class="info-form">
  <div class="info-text"><input type="text"></div>
  <div class="info-submit"><input type="submit" value="Verstuur"></div>
</form>
<?php include("footer.php"); ?>