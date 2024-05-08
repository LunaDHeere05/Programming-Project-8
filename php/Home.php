<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/css/stylesheet.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

  .inhoud_body {
  margin-left: 0.5em;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  gap:2em
}

h1{
  margin-bottom:0.5em
}
/* Categorie */


.categorie_lijst {
  justify-content: space-around;
  gap: 1em;
  display: flex;
  margin:0.6em
}

.categorie_lijst a {
  font-weight: bold;
  letter-spacing: 5px;
  flex-basis: 20%;
  background-color: #1bbcb6;
  padding: 2em;
  border-radius: 1.5em;
  text-transform: uppercase;
  text-align: center;
}

.categorie_lijst a:hover {
  background-color: white;
  color: #1bbcb6;
  border: 0.01em solid #1bbcb6;
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

.recent_lijst {
  display: flex;
  width: 80%;
  list-style: none;
  margin: auto;
  justify-content: space-between;
}
.recent_lijst a{
  text-decoration: none;
}
.recent_lijst a h3{
  text-decoration: none;
  color: black;
}
.recent_lijst li {
  display: flex;
  justify-content: center;
  background-color: #edededcf;
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
.uitleen_uitleg ul li h3 {
  color: white;
}

.uitleen_uitleg h3{
  font-size:200%
}



.uitleen_uitleg ul {
  list-style: none;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin: auto;
  width: 80%;
}

.uitleen_uitleg li {
  width: 20%;
  height: 10em;
  display: flex;
  justify-content: center;
padding-top:2em;
  border-radius: 1em;
  text-align: center;
  background-color: #1bbcb6;
}

.meer_info {
  background-color: rgb(193, 193, 193);
  border-radius: 1em;
  width: 10%;
  text-align: center;
  margin: 0.5em 9em 1em auto;
}

.meer_info a {
  text-decoration: none;
  color: black;
  text-transform: uppercase;
  font-weight: bold;
}

.meer_info a:hover{
  color: white;

}

    </style>
</head>
<body>
    <?php include 'top_nav.php'; ?>
<div class="inhoud_body">
    <!-- categorielijst -->
    <div class="categorie">
      <h1>Categorieën</h1>
      <div class="categorie_lijst">
          <?php
          echo '<a href="#">Audio</a>';
          echo '<a href="#">Belichting</a>';
          echo '<a href="#">Tools</a>';
          echo '<a href="#">Varia</a>';
          echo '<a href="#">Video</a>';
          echo '<a href="#">XR</a>';
          ?>
      </div>
  </div>

  <!-- Recent bekeken lijst -->
  <div class="recent_container">
      <h1>Recent bekeken</h1>
      <div class="recent_lijst_container">
          <img src="images/svg/chevron-left-solid.svg" alt="">
          <ul class="recent_lijst">
              <!--in echo want info uit databank halen-->
              <?php echo
              '<li><a href="#">
                  <img src="/images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="">
                  <h3>Canon-M50</h3>
              </a></li>'?>
              <?php echo
              '<li><a href="#">
                  <img src="/images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="">
                  <h3>Canon-M50</h3>
              </a></li>'?>
              <?php echo
              '<li><a href="#">
                  <img src="/images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="">
                  <h3>Canon-M50</h3>
              </a></li>'?>
              <?php echo
             '<li><a href="#">
                  <img src="/images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="">
                  <h3>Canon-M50</h3>
              </a></li>'?>
          </ul>
          <img src="images/svg/chevron-right-solid.svg" alt="">
      </div>
  </div>

  <!-- Hoe leen je iets uit? -->
  <div class="uitleen_uitleg">
      <h1>Hoe leen je iets uit?</h1>
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
              <p>Meer info</p>
          </a>
      </div>
  </div>
</div>
    <?php include 'footer.php'; ?>
</body>
</html>