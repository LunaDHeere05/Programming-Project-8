<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apparaat</title>
    <?php include 'top_nav.php'?>
    <style>
.apparaat_info {
  background-color: rgb(193, 193, 193);
  width: 80%;
  margin: auto;
  margin-top: 2em;
  border-radius: 2em;
  padding-bottom: 2em;
}

.apparaat_info_container {
  list-style: none;
  display: flex;
  justify-content: space-evenly;
}
.download_handleiding {
  list-style: none;
}
.download_handleiding img {
  background-color: white;
  border-radius: 2em;
  width: 70%;
  margin: 2em 0em 0em 2em;
}
.download_handleiding a {
  background-color: #1bbcb6;
  text-decoration: none;
  color: white;
  padding: 1em;
  border-radius: 2em;
}
.download_handleiding li {
  margin: 3em 0em 0em 2em;
}

.apparaat_beschrijving {
  margin: 2em 0em 0em 0em;
  width: 60%;
}
.apparaat_beschrijving h2 {
  margin: 0em 0em 1em 0em;
}
.apparaat_beschrijving li {
  margin: 0.5em 0em;
}
.doos_kolom {
  display: block;
  justify-content: space-between;
  margin: 2em 0em 0em 0em;
  width: 50%;
}
.doos_kolom h2 {
  margin: 0em 0em 1em 0em;
}
.doos_kolom li {
  margin: 0.5em 0em;
}

.doos_kolom .defecten {
  margin: 2em 0em 0em 0em;
  color: #e30613;
}

.reservatie {
  margin: 3em 0em 1em 2em;
}
.reservatie_plaatsen {
  background-color: #1bbcb6;
  width: 80%;
  height: 6em;
  margin: auto;
  border-radius: 2em;
  display: flex;
  list-style: none;
}
.reservatie_plaatsen li {
  text-decoration: none;
  color: white;
  padding: 1em;
  display: flex;
}
.aantal{
  background-color: white;
  border-radius: 2em;
  margin: auto;
  width: 13%;
  height: 10%;
  align-items: center;
}
.aantal label{
  color: black;
  font-weight: bold;
}
.aantal input{
  border: none;
  width: 100%;
  height: 2em;
  text-align: center;
  font-size: 14px;
}
.reserveer_nu_btn{
  width: 18%;
  background-color: white;
  height: 10%;
  border-radius: 2em;
  margin: auto;
  align-items: center;
}
.reserveer_nu_btn a{
  color: black;
  text-decoration: none;
  font-weight: bold;
  text-align: center;
  margin: 0em auto;
}
.winkelmand_toevoegen_btn{
  background-color: white;
  height: 10%;
  margin-right: 1em;
  margin: auto;
  align-items: center;
  width: 15%;
  border-radius: 2em;
}
.winkelmand_toevoegen_btn button{
  border: none;
  background-color: white;
  font-weight: bold;
  font-size: 16px;
}
.winkelmand_toevoegen_btn img{
  width: 20%;
  margin: 0em 0em 0em 0.2em
}

.datum{
  display: flex;
  flex-direction: column;
}

/* kits */

.kits h1 {
  margin: 2em 0em 0em 2em;
}
.kits ul {
  display: flex;
  list-style: none;
  width: 90%;
  margin: 2em auto;
  justify-content: space-between;
}
#selectie_toevoegen {
  background-color: #1bbcb6;
  color: white;
  padding: 1em;
  border-radius: 2em;
  margin: auto 0em;
  height: 20%;
  width: 10%;
  text-align: center;
}
.kits ul li {
  background-color: rgb(193, 193, 193);
  border-radius: 2em;
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 20%;
  position: relative;
  padding: 1em 0em 0.5em 0em;
}
.kits ul li img {
  width: 70%;
  height: auto;
  margin: 0em 0em 1em 0em;
  background-color: white;
  border-radius: 1em;
}
#selectiebol {
  background: none;
  filter: invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg)
    brightness(103%) contrast(79%);
  position: absolute;
  width: 2em;
  right: 0.5em;
  top: 0.5em;
}

/* van dezelfde categorie */
.dezelfde_categorie{
    width: 100%;
}
.dezelfde_categorie_container{
    display: flex;
}
.dezelfde_categorie h1{
    margin: 2em 0em 0em 2em;
}
.dezelfde_categorie ul {
  display: flex;
  list-style: none;
  width: 90%;
  margin: 2em auto;
  justify-content: space-evenly;
}
.slider{
    width: 2em;
    height: auto;
    margin: 1em;
}
.lijst_apparaten li{
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 20%;
    background-color: rgb(193, 193, 193);
    padding: 1em 1em 0.5em 1em;
    border-radius: 2em;
    margin: 0.7em;
}
.lijst_apparaten li img{
    width: 80%;
    background-color: white;
    border-radius: 1em;
}
.lijst_apparaten li h3{
    padding-top: 1em;
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
.verwijder{
    position: absolute;
    right: 0;
    top: 0.5em;
    width: 2em !important;
}
.item_info_container img{
  width: 15%;
}
.bevestig_btn{
    background-color: #1bbcb6;
    padding: 1em;
    border-radius: 2em;
    margin: auto;
    width: 10em;
    text-align: center;
}
.bevestig_btn button{
  background: none;
  border: none;
  color: white;
  font-weight: bold;
  font-size: 20px;
  letter-spacing: 1px;
}
</style>
</head>
<body>
  <?php
  if(isset($_GET['item_id_result'])){
    $item_id = $_GET['device_id_result'];
  }
  ?>
    <div class="apparaat_info">
        <ul class="apparaat_info_container">
            <li>
                <ul class="download_handleiding">
                    <?php
                    echo '<img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="Foto apparaat">';
                    echo '<li><a href="#" download> Download de gebruikershandleiding</a></li>';
                    ?>
                </ul>
            </li>
            <li class="apparaat_beschrijving">
                <?php include 'functies\apparaat_pagina_functie.php'?>
                <ul>
                    <li>24.1 megapixel APS-C CMOS sensor</li>
                    <li>4K video-opname</li>
                    <li>kantelbaar touchscreen</li>
                    <li>ingebouwde Wi-Fi en bluetooth-connectiviteit</li>
                </ul>
            </li>
            <li class="doos_kolom">
                <h2>In de doos:</h2>
                <ul>
                    <li>Het fototoestel</li>
                    <li>De gebruikershandleiding</li>
                    <li>Kabel</li>
                    <li>Extra batterij</li>
                </ul>
                <h2 class="defecten"><span>Defecten</span></h2>
                <ul>
                    <li>Kras op de lens</li>
                </ul>
            </li>
        </ul>
        <h2 class="reservatie">Plaats je reservatie</h2>
            </li>
        <form action="apparaat_pagina_reservatie.php" method="POST"></form>
          <label for="start_date">Start Date:</label>
          <input type="date" id="start_date" name="start_date" required>
          
          <label for="end_date">End Date:</label>
          <input type="date" id="end_date" name="end_date" required>
          
          <button type="submit">Submit</button>
        </form>
    </div>

    <div class="kits">
      <h1>Kits</h1>
      <ul>
        <li>
          <img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="foto apparaat">
          <h3>Canon-M50</h3>
          <img id="selectiebol" src="images/svg/plus-circle.svg" alt="">
        </li>
        <li>
          <img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="foto apparaat">
          <h3>Canon-M50</h3>
          <img id="selectiebol" src="images/svg/plus-circle.svg" alt="">
        </li>
        <li>
          <img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="foto apparaat">
          <h3>Canon-M50</h3>
          <img id="selectiebol" src="images/svg/plus-circle.svg" alt="">
        </li>
        <li id="selectie_toevoegen">
          <p>Voeg selectie toe aan reservatie</p>
        </li>
      </ul>
    </div>

    <div class="dezelfde_categorie">
      <h1>Van dezelfde categorie</h1>
      <div class="dezelfde_categorie_container">
        <img class="slider" src="images/svg/chevron-left-solid.svg" alt="links" class="verander">
        <ul class="lijst_apparaten">
          <li>
            <img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="foto apparaat">
            <h3>Canon-M50</h3>
          </li>
          <li>
            <img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="foto apparaat">
            <h3>Canon-M50</h3>
          </li>
          <li>
            <img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="foto apparaat">
            <h3>Canon-M50</h3>
          </li>
          <li>
            <img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="foto apparaat">
            <h3>Canon-M50</h3>
          </li>
        </ul>
        <img class="slider" src="images/svg/chevron-right-solid.svg" alt="rechts">
      </div>
    </div>
<?php include 'footer.php'?>