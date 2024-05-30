<?php include 'sessionStart.php'; //AN: om te weten welke mail er gebruikt wordt om in te loggen
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris</title>
    <style>
    
.zoekresultaat_container {
  margin-top: 1em;
  display: flex;
}
.zoekresultaat_container h3 {
  margin: 0em 2em;
}
.filters {
  display: flex;
  flex:1 0 basis;
  list-style: none;
  gap:2em;
  height: 2em;
  justify-content: space-between;
}
.filters select {
  border-radius: 1em;
  border: none;
  background-color: rgb(193, 193, 193);
  padding: 0em 1em;
  margin:0 10px 10px 10px;
  font-size: 100%;
  text-align: left;
  background-color: #edededcf;
}

/* apparaat */
.apparatenlijst {
  display: inline-block;
  width: 97%;
  list-style: none;
  margin: auto;
}
.apparaat {
  width: 100%;
  height: 100%;
  border-radius: 2em;
  background-color: #edededcf;
  margin: 1em 0em 0em 1em;
  display: flex;
}

.apparaat:hover{
  background-color: #b1b1b1cf;
  transition-duration: 0.5s;
}

.apparaat a {
  width: 100%;
  display: flex;
  justify-content: space-around;
  text-decoration: none;
  gap:5em;
  color: #000000;
  align-items: center;
}

.apparaat_foto {
  height: 10em;
  width: 10em;
  margin:1em;
  background: white;
  border-radius: 2em;
}

.toevoegen button {
  width: 4em;
  margin: 1em 1em 1em auto;
  background-color: transparent;
  border: none;
}

.beschikbaar{
  color:#1BBCB6;
}

.noResult{
  margin:1em;
}
.beschikbaarheid_apparaat {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 30%;
  color: #E30613;
  font-weight: bold;
}

.beschikbaarheid_apparaat h3{
  font-size: 120%;
}
.beschikbaarheid_apparaat img {
  width: 4em;
  margin: 0.5em 2em;
  padding:10px;

}</style>

</head>
<body>
<?php include 'top_nav.php'; ?>
 <!--zoekresultaat container  -->
<div class="zoekresultaat_container">
        <h3>Verfijn je resultaat: </h3>
        <ul class="filters">
            <li>    
        <form action="Inventaris.php" method="GET" id='formCategorie'>
                <select name="categorie" id="categorie">
                    <option value="categorie" disabled selected>Categorie</option>
                    <?php include 'functies\filter_categorie_inventaris.php'; ?> 
                </select>
        </form>
            </li>
            <li>
        <form action="Inventaris.php" method="GET" id='formMerk'>
                <select name="merk" id="merk">
                    <option value="merk" disabled selected>Merk</option>
                    <?php include 'functies\filter_merk_inventaris.php'; ?>
                </select>
            </li>
        </form>
            <li>
        <form action="Inventaris.php" method="GET" id='formBeschrijving'>
                <select name="beschrijving" id="beschrijving">
                    <option value="beschrijving" disabled selected>Beschrijving</option>
                    <?php include 'functies\filter_beschrijving_inventaris.php'; ?>
                </select>
            </li>
            </form>
            <li>
        <form action="Inventaris.php" method="GET" id='formBeschikbaarheid'>
                <select name="Beschikbaarheid" id="beschikbaarheid">
                <option disabled selected>Beschikbaarheid</option>
                </select>    
            </li>
            </form>
        </ul>
    </div>

 

    <!-- apparatenlijst -->
        <ul class="apparatenlijst">
        <?php include 'functies\inventaris_functie.php'; ?>
        </ul>
        <?php include("footer.php"); ?>


<script>

//gebruik van filters
document.getElementById('categorie').addEventListener('change',function(e){
  document.getElementById('formCategorie').submit()       
})

document.getElementById('merk').addEventListener('change',function(e){
  document.getElementById('formMerk').submit()       
})

document.getElementById('beschrijving').addEventListener('change',function(e){
  document.getElementById('formBeschrijving').submit()       
})


  document.getElementById("beschikbaarheid").addEventListener("click", function() {
  document.getElementById("beschikbaarheid").parentElement.innerHTML="<input id='beschikbaarheid' type='date'>" 

  document.getElementById("beschikbaarheid").addEventListener('change',function(e){
  document.getElementById('formBeschikbaarheid').submit()       
  })
           
  });

</script>

</body>
</html>



