
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/css/stylesheet.css">
    <style>
.categorie a h2{
  margin: 1em;
  text-decoration: none;
  display: block;
  color: black;
}
.categorie a{
  text-decoration: none;
}
.categorie_lijst {
  list-style: none;
  display: flex;
  justify-content: center;
  margin-top: 1em;
  height: 8em;
  align-items: center;
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
  margin: 1em 0em 1em 1em;
}
.recent_lijst {
  display: flex;
  margin-top: 1em;
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
</head>
<body>
    <?php include 'top_nav.php'; ?>
<div class="inhoud_body">
    <!-- categorielijst -->
    <div class="categorie">
      <?php
      echo '<a href="Categorie.php"><h2>Categorieën</h2></a>'
      ?>
      <ul class="categorie_lijst">
          <?php
          echo '<li><a href="#">Audio</a></li>';
          echo '<li><a href="#">Belichting</a></li>';
          echo '<li><a href="#">Tools</a></li>';
          echo '<li><a href="#">Varia</a></li>';
          echo '<li><a href="#">Video</a></li>';
          echo '<li><a href="#">XR</a></li>';
          ?>
      </ul>
  </div>

  <!-- Recent bekeken lijst -->
  <?php include 'functies\recent_bekeken.php'; ?>

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
    <?php include 'footer.php'; ?>
</body>
</html>