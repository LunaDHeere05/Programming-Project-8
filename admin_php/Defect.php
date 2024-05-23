<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defect</title>
    <?php include 'top_nav_admin.php'?>
    <style>
.defect_container{
  background-color: #D9D9D9;
  border: #D9D9D9;
  border-radius: 1em;
  padding: 1em;
  margin: 1.5em;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.defect_informatie span{
  color: #5B5B5B;
}

.defect_visueel_img img {
  background-color: #fff;
  padding: 1,5em;
  margin: 1em;
  height: auto;
width: 7em;
padding: 1em;
}

#defect_hersteld a{
  background-color: #1BBCB6;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border: #1BBCB6;
  border-radius: 2em;
  width: 8.5em;
  height: 1em;
  text-decoration: none;
  color: white;
  padding: 1em;
  margin: 1em;
}
.defect_verwijder a{
  background-color: #E30613;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border: #E30613;
  border-radius: 2em;
  width: 8.5em;
  height: 1em;
  text-decoration: none;
  color: white;
  padding: 1em;
  margin: 1em;
}

.defect_visueel{
  display: flex;
  align-items: center;
}
#defect_hersteld a img{
  width: 1em;
  height: auto;
  margin-left: 1em;
  filter: invert(100%) sepia(0%) saturate(5878%) hue-rotate(26deg) brightness(116%) contrast(115%);
}

.defect_verwijder img{
  width: 1em;
  height: auto;
  margin-left: 1em;
  filter: invert(100%) sepia(0%) saturate(5878%) hue-rotate(26deg) brightness(116%) contrast(115%);
}
.defect_acties{
text-decoration: none;
margin: 0em 1em 0em 1em;

}

.defect_add{
  background-color: #D9D9D9;
  margin: 1.5em;
  padding: 0.5em;
  border-radius: 2em;
  height: auto;
  width: 10em;
}

.defect_add a{
  color: #5B5B5B;
  text-decoration: none;
}
#bevestiging_hersteld, #bevestiging_verwijderen{
  width: 40%;
  background-color: blue;
  padding: 4em;
  text-align: center;
  border-radius: 2em;
  position: relative;
  padding-bottom: 2em;
}
.jaNee{
  display: flex;
  justify-content: space-evenly;
  margin: 2em 1em 1em 1em;
  width: 100%;
}
.ja{
  background-color: #1BBCB6;
  width: 30%;
  height: 3em;
  border-radius: 2em;
  color: white;
  text-decoration: none;
  display: flex;
  justify-content: center;
}
.ja p{
  margin: auto;
  font-weight: bold;
  font-size: 1.2em;

}
.neen{
  background-color: #E30613;
  width: 30%;
  height: 3em;
  border-radius: 2em;
  color: white;
  text-decoration: none;
  display: flex;
  justify-content: center;
}
.neen p{
  margin: auto;
  font-weight: bold;
  font-size: 1.2em;

}
#close_hersteld, #close_verwijder{
  width: 1.5em;
  height: auto;
  position: absolute;
  top: 1em;
  right: 2em;
}
.hidden{
    left: -99999px !important;
    display: none;
}
body.blur > *:not(#bevestiging_hersteld):not(#close_hersteld):not(#bevestiging_verwijderen):not(#close_verwijder) {
        filter: blur(50px);
        pointer-events: none;
}
</style>
</head>
<body>
        <?php include 'functies\defect_ophalen.php'?>
        <div class="defect_add">
            <a href="DefectToevoegen.php">Defect toevoegen</a>
        </div>

    <div id="bevestiging_hersteld" class="hidden">
      <h2>Bent u zeker dat u dit apparaat als 'hersteld' wilt aanduiden?</h2>
      <div class="jaNee">
      <a href="" class="ja"><p>Ja</p></a>
      <a href="" class= "neen"><p>Neen</p></a>
      </div>
      <img id="close_hersteld" src="images\svg\xmark-solid.svg" alt="">
    </div>
    <div id="bevestiging_verwijderen">
      <h2>Bent u zeker dat u dit apparaat wilt verwijderen?</h2>
      <div class="jaNee">
      <a class="ja" href=""><p>Ja</p></a>
      <a class="neen" href=""><p>Neen</p></a>
      </div>
      <img id="close_verwijder" src="images\svg\xmark-solid.svg" alt="">
    </div>

    <script>
      document.getElementById('close_hersteld').addEventListener('click', function(){
        document.getElementById('bevestiging_hersteld').classList.add('hidden');
        document.body.classList.remove('blur');
        document.getElementById('bevestiging_hersteld').classList.remove('no-blur');
      });
      document.getElementById('defect_hersteld').addEventListener('click', function(){
        document.getElementById('bevestiging_hersteld').classList.remove('hidden');
        document.body.classList.add('blur');
        document.getElementById('bevestiging_hersteld').classList.add('no-blur');
      });
    </script>
</body>
</html>
