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
    margin: 0.5em 1em;
    gap:0.35em;
    align-items: center;
}

.info-chevron-left a img{
    width: 1.5em;
}

/*Info Hoe leen je iets uit? */
h2{
  padding-left: 2em;
  padding-bottom:0.3em  
}

.info_uitleen_uitleg ul li h3 {
  color: white;
}

.info_uitleen_uitleg p {
  font-size: 85%;
}

.info_uitleen_uitleg{
padding-bottom: 1em;
}


.info_uitleen_uitleg ul {
  list-style: none;
  display: flex;
  margin: auto;
  width: 90%;
}

.info_uitleen_uitleg ul li {
  display:flex;
  flex-direction: column;
  justify-content: center;
  margin:auto;
  width: 15em;
  height: 10em;
  border-radius: 1em;
  text-align: center;
  background-color: #1bbcb6;
  text-decoration: none;
  padding: 0.5em;
  color: white;
}

.info_uitleen_uitleg h3{
  text-align: center;
  font-size:200%
}

.info_uitleen_uitleg p{
  padding:0;
  margin:auto
}

/* openings uren  */

.info-opening-hours {
    padding: 0em 1em 0em 0em;
    margin-bottom: 1em;
  }

.info-opening-hours table {
  margin: auto;
  width: 80%;
  border-collapse: collapse;
  }
  
  .info-opening-hours table th{
    letter-spacing: 2px;
    text-transform: uppercase;
  }
.info-opening-hours table,th,td {
    text-align: center;
    padding: 1.5em;
}
.info-opening-hours table th {
    text-align: center;
    border: none;
    border-bottom: 2px solid rgb(193, 193, 193);
  }
  .info-opening-hours table td{
    border: none;
    border-bottom: 2px solid rgb(193, 193, 193);
  }

  .info-opening-hours table tr:last-child th, .info-opening-hours table tr:last-child td{
    height: 2em;
    border-bottom: none;
  }

  .info-opening-hours .only{
    border-top: 3px dotted #1bbcb6;
    color:#1bbcb6
  }



/* sancties/defect  */

.info-sancties p b{
    color: #E30613;
}

p{
    margin: 0 0em 1em 3em;
}

/* veel gestelde vragen  */

.info-veel-vragen{
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

.info-box{
  display: flex;
  justify-content: center;
  width:55em;
  padding-bottom: 1em;
  border: 0.5em solid transparent;
  border-bottom-color: #1bbcb6;
  cursor: pointer;
}

.info-box p {
  font-size: 1em;
  line-height: 1.3;
  color:grey;
  margin:0;
  padding:0.5em 0;
}


/* form  */
.vraag-box{
  display: flex;
  justify-content: center;
  align-items: center;
  gap:1em;
}

.info-form-h2 {
  color: #1bbcb6;
  margin-top:1em;
}

.info-text{
  width: 80%;
  border-radius: 0em 3em;
  background-color: rgb(193, 193, 193);
  border: none;
  color: #fff;
  padding: 2em;
}

.info-text:focus{
  outline: none;
}

.info-submit{
  padding:0.5em 2em;
  background-color: rgba(27, 188, 182);
  border-radius: 3em;
  border: none;
  color: white;
  font-weight: bold;
  box-sizing: border-box;
  letter-spacing: 2px;
  font-size:90%;
  cursor:pointer;
} 

    </style>
  </head>
  <body>
    <?php include "top_nav.php"; ?>
    <div class="info-chevron-left">
    <a href="#"><img src="images\svg\chevron-left-solid.svg" alt="chevron left"></a>;
    <h1>Info</h1>
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
      <h2>Openingsuren</h2>
      <table>
        <tr>
          <th >Maandag</th>
          <td rowspan="2">10:00 - 12:00</td>
          <td rowspan="2">12:30 - 17:00</td>
        </tr>
        <tr>
        <td class=only>Enkel ophalen</td>
        </tr>
        <tr>
          <th>Dinsdag</th>
          <td colspan=2>Gesloten</td>
        </tr>
        <tr>
          <th>Woensdag</th>
          <td colspan=2>Gesloten</td>
        </tr>
        <tr>
          <th>Donderdag</th>
          <td>10:00 - 12:00</td>
          <td>12:30 - 17:00</td>
        </tr>
        <tr>
          <th>Vrijdag</th>
          <td rowspan="2">10:00 - 12:00</td>
          <td rowspan="2">12:30 - 17:00</td>
        </tr>
        <tr>
        <td class=only >Enkel terugbrengen</td>
        </tr>
        <tr>
        <tr>
          <th>Weekend</th>
          <td colspan=2>Gesloten</td>
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
<!--Anissa; Ik zal dit doen met js-->
<h2>Veelgestelde vragen</h2>
<div class="info-veel-vragen">
<div class="info-box">
  <h3>Wat moet ik doen indien ik mijn reservatie niet op tijd kan komen ophalen?</h3>
</div>
<div class="info-box">
  <h3>Wat moet ik doen indien ik een apparaat beschadig?</h3>
</div>
<div class="info-box">
  <h3>Hoe lang van tevoren kan ik een reservering maken?</h3>
</div>
<div class="info-box">
  <h3>Hoe ontvang ik een bevestiging van mijn reservering?</h3>
</div>
</div>
<!-- form  -->
<!--moet direct per mail gestuurd worden aan admin-->
<h2 class="info-form-h2">Geen antwoord gevonden op je vraag? Vul dit formulier dan in. </h2>
<form class="vraag-box">
  <input type="text" class="info-text">
  <input type="submit" value="Verstuur" class="info-submit">
</form>
<?php include("footer.php"); ?>