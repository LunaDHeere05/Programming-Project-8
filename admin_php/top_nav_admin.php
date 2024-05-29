<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    * {
    margin: 0;
    padding: 0;
    font-family: "Poppins", sans-serif;
}
h1,
h2,
h3 {
    color: #000000;
    font-weight: bold;
}
.inhoud_body{
  display: grid;
  grid-template-columns: [first] 20% [second] 80%;
  grid-template-rows: auto;
}

/* homepage */

/* bovenste navigatie */

nav {
  display: flex;
  justify-content: space-between;
  height: 100%;
  
}

.ehb_logo {
  width: auto;
  height: 54px;
  margin-left: 10px;
}
.rechter_navigatie{
    display: flex;
    align-items: center;
    margin-right: 10px;  
}
.rechter_navigatie a{
    width: 3em;
}
.rechter_navigatie img {
    width: 100%;
    height: 100%;
}
.rechter_navigatie a:hover {
  filter: invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg)
    brightness(103%) contrast(79%);
}

/*  zoekbalk */

.zoekbalk_container {
  background: url(images/jpg/jj-ying-7JX0-bfiuxQ-unsplash.jpg) no-repeat center center/cover;
  height: 6em;
  display: flex;
}

/* linker navigatie */

.linker_nav{
  height: 100%;
  grid-column-start: 1;
  grid-column-end: 1;
  border-right: 2px solid rgb(193,193,193);
  margin-top: 1em;
}
.linker_nav ul{
  list-style: none; 
  height: 50vh;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  margin-left: 2em;
}
.linker_nav ul li a{
  text-decoration: none;
  color: #5B5B5B;
  font-weight: bold;
  font-size: 1.3em;
}

.linker_nav ul a:hover{
  color: #1BBCB6;
}
/* keer terug + zoeken container binnen pagina zelf */
.keer_terug{
  display: flex;
  margin: 0.5em 1.5em 1.5em 1.5em;
}
.keer_terug img{
  width: 1.5em;
  height: 3.2em;
}
.keer_terug h1{
  margin-left: 0.5em;
}

.zoeken_container{
  width: 90%;
  height: 3rem;
  margin:auto 10px;
}
.zoeken form{
  display: flex;
  width: 100%;
  margin: auto;
  height: 100%;
  border-radius: 2em;
  border: 2px solid rgb(193,193,193);
}
.zoeken form input {
  width: 90%;
  height: 100%;
  border: none;
  margin: auto;
}
.zoeken form button{
  width: 2em;
  height: auto;
  background: none;
  border: none;
  margin:5px;
  margin-right: 1.5em;
}

</style>
<body>
<nav>
        <a href="Dashboard.php"><img class="ehb_logo" src="images/jpg/horizontaal EhB-logo (transparante achtergrond).png" alt="EhB-logo"></a>
        <div class="rechter_navigatie">
            <a href="#"><img src="images/svg/user-solid.svg" alt="profiel - logout"></a>
        </div>
    </nav>
    
    <!-- zoekbalk -->
    <div class="zoekbalk_container">
    </div>
<div class="keer_terug">
<a href="<?php echo $_SERVER['HTTP_REFERER'];?>"><img src="images/svg/chevron-left-solid.svg" alt=""></a>
        <h1>Dashboard</h1>
</div>
<div class="inhoud_body">
    <div class="linker_nav">
        <ul>
            <li><h3><a href="Dashboard.php">Dashboard</a></h3></li>
            <li><h3><a href="TeLaat.php">Te laat</a></h3></li>
            <li><h3><a href="Blacklist.php">Blacklist</a></h3></li>
            <li><h3><a href="Uitleningen.php">Uitleningen</a></h3></li>
            <li><h3><a href="Verlengingen.php">Verlengingen</a></h3></li>
            <li><h3><a href="Inventaris.php">Inventaris</a></h3></li>
            <li><h3><a href="Kits.php">Kits</a></h3></li>
            <li><h3><a href="Info.php">Info</a></h3></li>
            <li><h3><a href="Defect.php">Defect</a></h3></li>
        </ul>
    </div>
    <div class="rechter_grid">
        <div class="zoeken_container">
            <div class="zoeken">
              <form method="GET" id="zoekform">
                <input type="text" id="zoekbalk" name="zoekquery" placeholder="Voer een naam of ID in...">
                <button type="submit" name="zoekButton"><img src="images/svg/magnifying-glass-solid.svg" alt="zoek icoon"></button>
                </form>
            </div>
        </div>

</body>