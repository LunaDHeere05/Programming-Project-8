<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/css/stylesheet.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        </style>
</head>
<body>
    <?php include 'components/top_nav.php'; ?>
    <!-- bovenste navigatie -->
    <nav>
        <a href="Home.html"><img class="ehb_logo" src="/images/jpg/horizontaal EhB-logo (transparante achtergrond).png" alt="EhB-logo"></a>
        <ul>
            <li><a href="/html/Info.html"><h1>Info</h1></a></li>
            <li><a href="/html/Inventaris.html"><h1>Inventaris</h1></a></li>
            <li><a href="/html/Kalender.html"><h1>Kalender</h1></a></li>
            <li><a href="/html/Reservaties.html"><h1>Reservaties</h1></a></li>
        </ul>
        <div class="rechter_navigatie">
            <a href="#"><img src="/images/svg/heart-solid.svg" alt="favorietenlijst"></a>
            <a href="#"><img src="/images/svg/cart-shopping-solid.svg" alt="winkelmandje"></a>
            <a href="#"><img src="/images/svg/user-solid.svg" alt="profiel - logout"></a>
        </div>
    </nav>

    <!-- zoekbalk -->
    <div class="zoekbalk_container">
        <div class="zoekbalk">
            <select name="categorie" id="" >
                <option value="alles"></option>
                <option value="audio">Audio</option>
                <option value="belichting">Belichting</option>
                <option value="tools">Tools</option>
                <option value="varia">Varia</option>
                <option value="video">Video</option>
                <option value="xr">XR</option>
            </select>
            <input id="zoek_input" type="text" placeholder="Geef een zoekterm in ...">
            <button id="zoek_btn"><img src="/images/svg/magnifying-glass-solid.svg" alt="magnifying glass"></button>
        </div>
    </div>
<div class="inhoud_body">
    <!-- categorielijst -->
    <div class="categorie">
      <a href="#"><h2>Categorieën</h2></a>
      <ul class="categorie_lijst">
          <li><a href="#">Audio</a></li>
          <li><a href="#">Belichting</a></li>
          <li><a href="#">Tools</a></li>
          <li><a href="#">Varia</a></li>
          <li><a href="#">Video</a></li>
          <li><a href="#">XR</a></li>
      </ul>
  </div>

  <!-- Recent bekeken lijst -->
  <div class="recent_container">
      <h2>Recent bekeken</h2>
      </div>
      <div class="recent_lijst_container">
          <img src="/images/svg/chevron-left-solid.svg" alt="">
          <ul class="recent_lijst">
              <li><a href="#">
                  <img src="/images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="">
                  <h3>Canon-M50</h3>
              </a></li>
              <li><a href="#">
                  <img src="/images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="">
                  <h3>Canon-M50</h3>
              </a></li>
              <li><a href="#">
                  <img src="/images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="">
                  <h3>Canon-M50</h3>
              </a></li>
              <li><a href="#">
                  <img src="/images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="">
                  <h3>Canon-M50</h3>
              </a></li>
          </ul>
          <img src="/images/svg/chevron-right-solid.svg" alt="">
      </div>
  </div>

  <!-- Hoe leen je iets uit? -->
  <div class="uitleen_uitleg">
      <h2>Hoe leen je iets uit?</h2>
      <ul>
          <li><a href="Info.html">
              <h3>Stap 1</h3>
              <p>Kies een apparaat</p>
          </a></li>
          <li><a href="Info.html">
              <h3>Stap 2</h3>
              <p>Bepaal je uitleenperiode</p>
          </a></li>
          <li><a href="Info.html">
              <h3>Stap 3</h3>
              <p>Plaats je reservatie</p>
          </a></li>
          <li><a href="Info.html">
              <h3>Stap 4</h3>
              <p>Haal het apparaat op in het medialab</p>
          </a></li>
      </ul>
      <div class="meer_info">
          <a href="Info.html">
              <h3>Meer info</h3>
          </a>
      </div>
  </div>
</div>
    <?php include 'components/footer.php'; ?>
</body>
</html>

<style>
    .categorie a {
  margin-top: 1em;
  text-decoration: none;
  display: block;
}
.categorie_lijst {
  list-style: none;
  display: flex;
  justify-content: center;
  margin-top: 1em;
}
.categorie_lijst a {
  text-decoration: none;
  color: white;
  font-weight: bold;
  letter-spacing: 1px;
  background-color: #1bbcb6;
  padding: 3em;
  border-radius: 2em;
  margin-right: 3em;
  width: 5em;
  text-align: center;
}

/* Recent bekeken */

.recent_lijst_container {
  display: flex;
  justify-content: space-between;
}
.recent_lijst_container img {
  width: 2em;
  margin: 1em;
}
.recent_container {
  display: block;
}
.recent_container h2 {
  margin: 1em 0em;
}
.recent_lijst {
  display: flex;
  margin-top: 1em;
  width: 80%;
  list-style: none;
  margin: auto;
  justify-content: space-between;
}
.recent_lijst a {
  text-decoration: none;
}
.recent_lijst li {
  margin: auto;
  background-color: #edededcf;
  margin-right: 1em;
  height: 80%;
  width: 20%;
  text-align: center;
  border-radius: 1em;
}
.recent_lijst li img {
  width: 70%;
  height: 50%;
  background-color: white;
  margin-top: 1em;
}

/* Hoe leen je iets uit? */
.uitleen_uitleg h2 {
  padding-left: 1em;
}
.uitleen_uitleg ul li h3 {
  color: white;
}
.uitleen_uitleg ul li p {
  font-size: 85%;
  padding: 1em;
}

.uitleen_uitleg ul {
  list-style: none;
  display: flex;
  margin-top: 1em;
  justify-content: space-between;
  margin: auto;
  width: 80%;
}
.uitleen_uitleg h2 {
  margin: 1em 0em;
}
.uitleen_uitleg ul li {
  width: 15%;
  height: 8em;
  border-radius: 1em;
  text-align: center;
  background-color: #1bbcb6;
}
.uitleen_uitleg ul li a {
  text-decoration: none;
  padding: 1em;
  color: white;
}
.meer_info {
  background-color: rgb(193, 193, 193);
  border-radius: 1em;
  width: 10%;
  text-align: center;
  margin: 1.5em 9em 1em auto;
}
.meer_info a {
  text-decoration: none;
  color: white;
}
</style>