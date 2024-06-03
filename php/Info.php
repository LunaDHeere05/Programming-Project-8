<?php include 'sessionStart.php'; //AN: om te weten welke mail er gebruikt wordt om in te loggen
//AN: om de database connectie te maken
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Info</title>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

    .infoEnTerug {
      display: flex;
      cursor: pointer;
    }

    .infoEnTerug img {
      width: 1.5em;
      height: auto;
      margin: 1.5em;
    }

    .infoEnTerug h1 {
      margin: 0.6em 0.5em 0em 0.5em;
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

    .info_uitleen_uitleg {
      padding-bottom: 2em;
    }

    .info_titel {
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
    .info-opening-hours h1 {
      padding: 0.5em;
      text-align: left;
      font-size: 1.5em;
      margin: 0em 0em 0.5em 2em;
    }

    .info-opening-hours {
      padding: 0em 1em 0em 0em;
      margin-bottom: 1em;
    }

    .info-opening-hours table {
      margin: auto;
      width: 80%;
      height: 40em;
      border-collapse: collapse;
      text-align: center;
      align-items: center;
      justify-content: center;
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
  }

  .info-opening-hours table tr:last-child th, .info-opening-hours table tr:last-child td{
    height: 2em;
    border-bottom: none;
  }

  .info-opening-hours td {
    border: 0.1em solid black;
  }

  .info-opening-hours th {
    border: 0.1em solid black;
  }

  .info-opening-hours .enkel{
    color:#E30613;
  
 

  }
    /* sancties/defect  */

    .info-sancties {
      margin: 1em 0em 1em 3em;
    }

    .info-sancties h2 p {
      margin: 2em 0em 1em 0em;
    }

    .info-sancties p b {
      color: #E30613;
    }

    .info-sancties p,
    .info-defect p {
      width: 95%;
    }

    .info-defect {
      margin: 2em 0em 1em 3em;
    }

    /* veel gestelde vragen  */

    .info-veel-vragen {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      text-align: left;
    }

    .veel_vragen {
      align-self: left;
      margin-left: 2em;
      margin-top: 2em;
    }

    .info-box {
      position: relative;
      padding: 1.5em;
      border: 0.5em solid transparent;
      border-bottom-color: #1bbcb6;
      background-color: transparent;
      width: 70%;
      height: 2.5em;
      cursor: pointer;
      transition: all 0.4s ease;
    }

    .info-box h2 {
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

    .info-button i {
      display: none;
    }

    .info-angle-down {
      display: block;
    }


    .info-box.active {
      height: 10em;
    }

    .info-box.active p {
      opacity: 1;
    }

    .info-box.active .info-button .info-angle-down {
      display: none;
    }

    .info-box.active .info-button .info-angle-up {
      display: none;
    }

    /* form  */
    .info-form-h2 {
      margin: 3em 0em 1em 2em;
      color: #1bbcb6;
    }

    .info-form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .info-text {
      width: 100%;
      display: flex;
    }

    .info-text input[type=text] {
      width: 90%;
      height: 20em;
      border-radius: 2em;
      background-color: #D9D9D9;
      border: none;
      color: #fff;
      margin: auto;
      padding: 2em;
    }

    .info-text input[type=text]:focus {
      outline: none;

    }

    .info-submit {
      width: 100%;
      height: 5em;
      display: flex;
      justify-content: center;
    }

    .info-submit button[type=submit] {
      background-color: #1bbcb6;
      border-radius: 2em;
      width: 15%;
      height: 70%;
      ;
      margin: auto;
      border: 0;
      color: white;
      font-weight: bold;
    }

    .info-submit button[type=submit]::-ms-value {
      font-size: 15px;
    }


  .activeiteit-info{
    margin:3em 0em 1em 3em
  }
  .activiteit{
  display: flex;
  align-items: center;
}
.activiteit img{
  width: 25%;
  margin: 1em 3em 0em 5em;
}
.info_activiteit{
  width: 40%;
}
.info_activiteit p{
  margin: 1.5em 0em;
}
.info_activiteit h4{
  color:#1bbcb6;
}

  </style>
</head>

<body>
  <?php include "top_nav.php"; ?>
  <div class="infoEnTerug">
    <a onclick="window.history.back();"><img src="images/svg/chevron-left-solid.svg" alt=""></a>
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
    <h1>Openingsuren</h1>
    <?php
    include 'database.php';
    $query = "SELECT * FROM OPENINGSTIJDEN ORDER BY FIELD(dagen, 'Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag')";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      echo "<table>";
      while ($row = $result->fetch_assoc()) {
        if($row["dagen"] =="Maandag"){
          echo "<tr><td >" . $row["dagen"] . " <span class='enkel'> - enkel ophalen</span></td><td>" . $row["begin_uren"] . "</td><td>" . $row["eind_uren"] . "</td></tr>";
        }else if($row["dagen"] =="Vrijdag"){
          echo "<tr><td >" . $row["dagen"] . " <span class='enkel'> - enkel inleveren</span></td><td>" . $row["begin_uren"] . "</td><td>" . $row["eind_uren"] . "</td></tr>";
        }
        else{
        echo "<tr><td>" . $row["dagen"] . "</td><td>" . $row["begin_uren"] . "</td><td>" . $row["eind_uren"] . "</td></tr>";
        }
      }
      echo "</table>";
    } else {
      echo "0 results";
    }
    $conn->close();
    ?>
  </div>
</body>
<!-- sancties/defect  -->
<div class="info-sancties">
  <h2>Sancties</h2>
  <p>Indien je het apparaat niet komt ophalen op de uitleendatum dat je hebt gekozen of je het apparaat te laat inlevert, wordt er een <b>waarschuwing</b> bij je account toegevoegd.
    Eens je aan 2 waarschuwingen hebt kom je voor 3 maanden op een <b>blacklist</b> waarbij je geen apparaten meer kan uitlenen tijdens die periode.</p>
</div>

<div class="info-defect">
<h2>Verlengen & annuleren <a href=""><img src="../images/svg/pen-to-square-regular.svg" alt=""></a> </h2>
    <p>
      Studenten kunnen reservaties eenmalig voor één week verlengen. Indien ze het een tweede keer willen verlengen, moeten zij het Medialab contacteren. Voor docenten geldt er hierop geen beperking. <br> Zowel docenten als studenten kunnen reservaties tot en met de uitleendatum annuleren indien ze dit wensen. 
    </p>
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
    <p>In dit geval is het belangrijk dat je je reservatie zo snel mogelijk annuleert. Indien je dit niet doen krijg je een sanctie. Na twee sancties beland je op de blacklist en kan je apparaten voor de komende 3 maanden niet meer uitlenen.</p>
  </div>
  <div class="info-box">
    <button class="info-button">
      <i class="info-angle-down"></i>
      <i class="info-angle-up"></i>
    </button>
    <h2>Wat moet ik doen indien ik een apparaat beschadig?</h2>
    <p>Als je een apparaat beschadigd hebt, meld je dit bij het inleveren van het apparaat aan de medewerker van het MediaLab. Afhankelijk van het defect zal de medewerker beslissen of er een sanctie volgt.</p>
  </div>
  <div class="info-box">
    <button class="info-button">
      <i class="info-angle-down"></i>
      <i class="info-angle-up"></i>
    </button>
    <h2>Hoe lang van tevoren kan ik een reservering maken?</h2>
    <p>Studenten kunnen 2 weken op voorhand een apparaat reserveren. Voor docenten is hier geen limiet op. </p>
  </div>
  <div class="info-box">
    <button class="info-button">
      <i class="info-angle-down"></i>
      <i class="info-angle-up"></i>
    </button>
    <h2>Hoe ontvang ik een bevestiging van mijn reservering?</h2>
    <p>Eens je gereserveerd hebt wordt er een automatische bevestigingsmail verstuurd naar het emailadres waarmee je hebt ingelogd. In deze mail kan je de details
      van je reservatie nog eens extra terugvinden. Je reservatie is ook automatisch te zien op de website op de "reservatie" pagina in de navigatiebalk.
    </p>
  </div>
</div>

<div class="activeiteit-info">
<h2>Activiteiten</h2>
<div class="activiteit">
  <?php
   include 'functies/activiteit.php';
  ?>
</div>
</div>

<!-- form  -->
<h2 class="info-form-h2">Geen antwoord gevonden op je vraag? Vul dit formulier dan in. </h1>
  <form class="info-form" method="POST">
    <div class="info-text">
      <input type="text" name="vraagInput" required>
    </div>
    <div class="info-submit">
      <button type="submit" name="Verstuur">Verstuur</button>
    </div>
    <?php
    if (isset($_SESSION['gebruikersnaam'])) {
      if (isset($_POST['Verstuur'])) {
        $zender = 'AdminMedialab@example.com';
        $ontvanger = $gebruikersnaam;
        $mail_onderwerp = "Vraag Student: $gebruikersnaam";
        $vraagInput = htmlspecialchars($_POST['vraagInput'], ENT_QUOTES, 'UTF-8');
        $mail_body = "Beste $gebruikersnaam,\n\n $vraagInput ";
        include 'functies/mail.php';
        echo "Je vraag is verstuurd!";
      }
    }else{
      echo "Je moet ingelogd zijn om een vraag te kunnen stellen.";
    }
    ?>
  </form>

  <?php include("footer.php"); ?>

  <script>
    let boxes = document.querySelectorAll(".info-box");
    let removeClassess = () => {
      boxes.forEach((box) => {
        box.classList.remove("active");
      });
    };

    boxes.forEach((box) => {
      box.addEventListener("click", () => {
        removeClassess();
        box.classList.toggle("active");
      });
    });
  </script>