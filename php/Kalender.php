<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender</title>
</head>
<body>
<?php include 'top_nav.php'; ?>
<div class="agendaEnTerug">
  <?php
  echo '<a href="#"><img src="/images/svg/chevron-left-solid.svg" alt=""></a>';
  ?>
        <h1>Kalender</h1>
</div>

<div class="jaarkalender">
      <h2>Jaarkalender</h2>
    <p>Op deze dagen zal het medialab <b>gesloten</b> zijn voor het uitlenen of inleveren van apparaten. Meeste van deze data kunnen jullie ook in jullie lessenrooster terugvinden.</p>
    <table>
        <tr>
            <td width="70%">28/10/2024 - 03/11/2024</td>
            <td class="uitleg">Allerheiligen</td>
        </tr>
        <tr>
            <td>01/11/2024 (vrijdag)</td>
            <td class="uitleg">Wapenstilstand</td>
        </tr>
        <tr>
            <td>11/11/2024 (maandag)</td>
            <td class="uitleg">Herfstvakantie</td>
        </tr>
        <tr>
            <td><b>27/11/2024 (maandag)</b></td>
            <td class="uitleg"><b>Uitzonderlijk gesloten</b></td>
        </tr>
        <tr>
            <td>23/12/2024 - 05/01/2025</td>
            <td class="uitleg">Kerstvakantie</td>
        </tr>
        <tr>
            <td>01/04/2025 (maandag)</td>
            <td class="uitleg">Paasmaandag</td>
        </tr>
        <tr class="empty">
          <td  class="empty"> </td>
          <td  class="empty"></td>
        </tr>
    </table>

</div>
  
    <h2 class="subtitel">Activiteiten</h2>

<div class="activiteit">
  <?php
  echo '<img src="images/png/workshop.png" alt="workshop flyer">';
  ?>
      <div class="info_activiteit">
        <h3>Workshop 3D printing</h3>
        <p>Deze workshop dient als een introductie tot het gebruik van 3D-printers, waarmee je later je eigen ontwerpen kunt leren printen. We willen benadrukken dat de workshop laagdrempelig is en geschikt is voor alle studenten, ongeacht hun ervaringsniveau. Maak je geen zorgen als je nog nooit met 3D-printers hebt gewerkt - we zullen je stap voor stap begeleiden. </p>
        <h4>Wanneer?</h4>
      </div>
</div>
</body>
<?php include 'footer.php'; ?>
</html>


<style>
    
.agendaEnTerug{
    display: flex;
}
.agendaEnTerug img{
    width: 1.5em;
    height: auto;
    margin: 1.5em;
}
.agendaEnTerug h1{
    margin: 0.6em 0.5em 0em 0.5em;
}
.subtitel, .jaarkalender h2{
    color: #5B5B5B;
    margin: 0.5em 4em;
}
.jaarkalender p{
    margin: 0em 6em;
}
.jaarkalender p b{
    color: #E30613;
}
.jaarkalender table{
  width: 80%;
  margin: 3em auto;
  border-collapse: collapse;
}
.jaarkalender table b{
  color:#E30613;
}
.jaarkalender table .uitleg{
  text-align: right;
  padding-left: 0em;
  border-bottom: 2px solid rgb(193, 193, 193);
}
.jaarkalender table tr td{
  padding: 1em;
  border-bottom: 2px solid rgb(193, 193, 193);
}
.jaarkalender table tr td:first-child{
  border-right: 2px solid rgb(193, 193, 193);
}
.jaarkalender table tr:last-child td{
  border-bottom: none;
  padding: 1em;
}

.empty{
  padding:5em;
}

.activiteit{
  display: flex;
  align-items: center;
  margin-left: 2em;
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