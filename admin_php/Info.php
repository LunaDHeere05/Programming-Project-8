<?php
include 'database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Info</title>
  <?php include 'top_nav_admin.php' ?>
  <style>
    /* Info page  */
    .info_body {
      display: flex;
    }



    .info_uitleen_uitleg img {
      height: auto;
      width: 1em;
      filter: invert(100%) sepia(0%) saturate(5878%) hue-rotate(26deg) brightness(116%) contrast(115%);
    }

    .info-opening-hours img {
      height: auto;
      width: 1em;
    }

    .info-sancties img {
      height: auto;
      width: 1em;
    }

    .info-defect img {
      height: auto;
      width: 1em;
    }

    .info_uitleen_uitleg h2 {
      padding-left: 1em;
    }

    .info_uitleen_uitleg ul li h3 {
      color: white;
    }

    .info_uitleen_uitleg ul li p {
      font-size: 0.8em;
      padding: 1em;
    }

    .info_uitleen_uitleg {
      padding-bottom: 4em;
    }

    .info_uitleen_uitleg ul {
      list-style: none;
      display: flex;
      margin-top: 1em;
      justify-content: space-between;
      margin: auto;
      width: auto;
      margin: 0em 1em 0em 1em;

    }

    .info_uitleen_uitleg h2 {
      margin: 1em 0em;
    }

    .info_uitleen_uitleg ul li {
      width: 11.5em;
      height: 10em;
      border-radius: 1em;
      text-align: center;
      background-color: #1bbcb6;
      text-decoration: none;
      padding: 1em;
      color: white;
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
      background-color: rgb(193, 193, 193);
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

    .info-submit button {
      cursor: pointer;
    }

    .info-submit input[type=submit]::-ms-value {
      font-size: 15px;
    }

    /* openings uren  */
    .info-opening-hours h1 {
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

    .info-opening-hours table,
    th,
    td {
      text-align: center;
      padding: 1.5em;
    }

    .info-opening-hours table th {
      text-align: start;
      border: none;
      border-bottom: 2px solid rgb(193, 193, 193);
    }

    .info-opening-hours table td {
      border: none;
      border-bottom: 2px solid rgb(193, 193, 193);
      border-left: 2px solid rgb(193, 193, 193);
    }

    .info-opening-hours table tr:last-child th,
    .info-opening-hours table tr:last-child td {
      height: 2em;
      border-bottom: none;
    }

    .info-opening-hours td {
      border: 0.1em solid black;
    }

    .info-opening-hours th {
      border: 0.1em solid black;
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

    #editableTable td,
    #editableTable th {
      text-align: center;
    }

    .info-opening-hours {
      margin: 1em 0em 1em 3em;
      display: flex;
      flex-direction: column;
      align-items: center;
      border: rgb(193, 193, 193) 4px solid;
      border-radius: 1em;
      padding-top: 2em;
      padding-bottom: 2em;
    }

    .info-opening-hours table {
      margin: auto;
      width: 80%;
      border-collapse: collapse;
    }

    #save-button {
      margin-top: 1em;
      padding: 0.5em 1em;
      background-color: #1bbcb6;
      color: white;
      border: none;
      border-radius: 0.5em;
      cursor: pointer;
      font-size: 1em;
      margin-left: 2em;
      margin-bottom: 1em;
    }

    .Activiteiten {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin: 1em 0em 1em 3em;
      border: rgb(193, 193, 193) 4px solid;
      border-radius: 1em;
      padding: 2em;
    }

    .Activiteiten button {
      background-color: #1bbcb6;
      color: white;
      border: none;
      border-radius: 0.5em;
      cursor: pointer;
      font-size: 1em;
      margin-left: 2em;
      margin-bottom: 1em;
      padding: 0.5em 1em;
    }

    .nieuwe_activiteit {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .nieuwe_activiteit input {
      margin: 1em 0em;
      padding: 0.5em;
      border-radius: 0.5em;
      border: 1px solid rgb(193, 193, 193);
      text-align: center;
    }

    .activiteit_form {
      display: flex;
      flex-direction: column;
      align-items: center;

    }

    #ActTitle {
      width: 20em;
    }

    #ActInfo {

      width: 100%;
      height: 20em;
      overflow-x: scroll;

    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
  <script>
    document.addEventListener('DOMContentLoaded', (event) => {
      var table = document.querySelector('#editableTable');
      var changes = [];

      table.addEventListener('blur', function(e) {
        var target = e.target;
        if (target.contentEditable === 'true') {
          var row = target.parentElement;
          var data = {
            dagen: row.children[0].textContent,
            begin_uren: row.children[1].textContent,
            eind_uren: row.children[2].textContent
          };
          changes.push(data);
        }
      }, true);

      document.getElementById('save-button').addEventListener('click', function() {
        changes.forEach(function(data) {
          $.post('functies/InfoUrenUpdate.php', data);
        });
        changes = []; // Clear the changes
      });
    });
  </script>
  <div class="info_uitleen_uitleg">
    <h2>Hoe leen je iets uit?</h2>
    <ul>
      <li>
        <h3>Stap 1 <a href=""><img src="../images/svg/pen-to-square-regular.svg" alt=""></a></h3>
        <p>
          Kies een apparaat op basis van de categorieën op de thuispagina of
          zoek een apparaat met de zoekbalk.
        </p>
      </li>
      <li>
        <h3>Stap 2 <a href=""><img src="../images/svg/pen-to-square-regular.svg" alt=""></a></h3>
        <p>
          Bepaal de uitleenperiode door middel van het resultaat te filteren
          of bepaal het bij het reserveringsproces.
        </p>
      </li>
      <li>
        <h3>Stap 3 <a href=""><img src="../images/svg/pen-to-square-regular.svg" alt=""></a></h3>
        <p>
          Vul de nodige informatie aan en voeg de reservatie toen aan het
          winkelmandje, of reserveer direct.
        </p>
      </li>
      <li>
        <h3>Stap 4 <a href=""><img src="../images/svg/pen-to-square-regular.svg" alt=""></a></h3>
        <p>Haal het gereserveerde apparaat op in het medialab!</p>
      </li>
      l>
  </div>

  <!-- openings hours  -->
  <div class="info-opening-hours">
    <h1>Openingsuren <a href=""><img src="../images/svg/pen-to-square-regular.svg" alt=""></a></h1>
    <?php
    $sql = "SELECT * FROM OPENINGSTIJDEN ORDER BY FIELD(dagen, 'Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag')";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      echo "<table id='editableTable'><tr><th>DAG</th><th>OPENINGSUUR</th><th>SLUITINGSUUR</th></tr>";
      while ($row = $result->fetch_assoc()) {
        $begin_uren = $row["begin_uren"] === NULL ? 'Gesloten' : $row["begin_uren"];
        $eind_uren = $row["eind_uren"] === NULL ? 'Gesloten' : $row["eind_uren"];
        echo "<tr><td>" . $row["dagen"] . "</td><td contenteditable='true'>" . $begin_uren . "</td><td contenteditable='true'>" . $eind_uren . "</td></tr>";
      }
      echo "</table>";
      echo "<button id='save-button'>Save Changes</button>";
    } else {
      echo "0 results";
    }
    ?>
  </div>

  <!-- sancties/defect  -->
  <div class="info-sancties">
    <h2>Sancties <a href=""><img src="../images/svg/pen-to-square-regular.svg" alt=""></a></h2>
    <p>
      Indien je het apparaat niet komt ophalen op de uitleendatum dat je hebt
      gekozen of je het apparaat te laat inlevert, wordt er een
      <b>waarschuwing</b> bij je account toegevoegd. Eens je aan 2
      waarschuwingen hebt kom je voor 3 maanden op een
      <b>blacklist</b> waarbij je geen apparaten meer kan uitlenen tijdens die
      periode.
    </p>
  </div>

  <div class="info-defect">
    <h2>Defect melden <a href=""><img src="../images/svg/pen-to-square-regular.svg" alt=""></a> </h2>
    <p>
      Indien je een defect of schade heeft dan meld je dit zelf aan via de
      reservaties pagina. Je klikt op de bijhorende knop en volgt de
      instructies op de pagina. Zorg dat je het juiste apparaat aanklikt met
      de bijhorende apparaat ID. Deze ID-sticker vind je terug als een sticker
      op het apparaat.
    </p>
  </div>

  <div class="Activiteiten">
    <h2>Activiteiten</h2>
    <div class="nieuwe_activiteit">
      <form class="activiteit_form" action="functies/InfoActiviteitUpdate.php" method="POST" enctype="multipart/form-data">
        <input id="ActTitle" name="ActTitle" type="text" placeholder="Activiteit Title">
        <input id="ActInfo" name="ActInfo" type="text" placeholder="Nieuwe Activiteit">
        <input id="form_input" name="ActDate" type="date" placeholder="Activiteit Datum">
        <input id="form_input" name="flyer" type="file">
        <button name="submit" type="submit">Verstuur</button>
      </form>
    </div>

  </div>
  <!-- form  -->
  <h2 class="info-form-h2">Nieuwe aankondigingen</h1>
    <form class="info-form" method="POST">
      <div class="info-text"><input type="text" name="AankondigingsInput" required></div>
      <div class="info-submit"><button type="submit" value="Verstuur" name="AankodigingsButton">Verstuur</button></div>
      <?php

      if (isset($_POST['AankodigingsButton'])) {
        if(!empty($_POST['AankondigingsInput'])){
        $zender = 'AdminMedialab@example.com';
        $AankondigingsInput = htmlspecialchars($_POST['AankondigingsInput'], ENT_QUOTES, 'UTF-8');
        $mail_body = $AankondigingsInput;
        $mail_onderwerp = 'Nieuwe Aankondiging';
        $emailquery = "SELECT * FROM PERSOON WHERE rol = 'student'";
        $result = $conn->query($emailquery);

        if ($result){
          $ontvanger = array();

          while ($row = $result->fetch_assoc()) {
            $ontvanger[] = $row['email'];
          }
          include '../php/functies/mail.php';
          echo "Aankondiging is verstuurd!";
        }
      }
    }
      ?>
    </form>
</body>

</html>