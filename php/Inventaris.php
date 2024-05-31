<?php include 'sessionStart.php'; //AN: om te weten welke mail er gebruikt wordt om in te loggen
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris</title>
    <!-- <link
            rel="icon"
            href=
"https://media.geeksforgeeks.org/wp-content/cdn-uploads/gfg_200X200.png"
            type="image/x-icon"
        /> -->
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
  gap:1em;
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

#beschikbaarheidDate, #beschikbaarheidEnd {
            font-size: 14px;
            padding: 3px;
            border: 2px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            color: #333;
        }

        #beschikbaarheidDate:focus, #beschikbaarheidEnd:focus {
            border-color: #66afe9;
            outline: none;
            box-shadow: 0 0 5px #1BBCB6;
        }

        #beschikbaarheidDate::-webkit-calendar-picker-indicator, #beschikbaarheidEnd::-webkit-calendar-picker-indicator {
            background-color: #ccc;
            border-radius: 50%;
        }

  #dateDiv{
    display: flex;
    gap:0.5em;
    justify-content: center;
    align-items: center;
    margin:0 1em 0 0;
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
                <select id="beschikbaarheid">
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


  document.getElementById("formBeschikbaarheid").addEventListener("click", function() {
  document.getElementById("beschikbaarheid").parentElement.innerHTML="<div id='dateDiv'> <input id='beschikbaarheidDate' name='beschikbaarheid' step=7 type='date'><input id='beschikbaarheidEnd' name='beschikbaarheidEnd' step=7 type='date'> </div>" 

  let vandaag = new Date();
  let dayIndex = vandaag.getDay(); //maandag is index 1

  //uitlenen kan enkel op maandag - dus beschikbaarheid kan enkel worden gecheckt op maandagen
  let start_date = document.getElementById('beschikbaarheidDate');
  let end_date = document.getElementById('beschikbaarheidEnd');
  let datumUitlenen = new Date(vandaag)

  switch (dayIndex) {
    case 0:
      datumUitlenen.setDate(vandaag.getDate() + 1);
      break;
    case 1:
      datumUitlenen = vandaag;
      break;
    case 2:
      datumUitlenen.setDate(vandaag.getDate() + 6);
      break;
    case 3:
      datumUitlenen.setDate(vandaag.getDate() + 5);
      break;
    case 4:
      datumUitlenen.setDate(vandaag.getDate() + 4);
      break;
    case 5:
      datumUitlenen.setDate(vandaag.getDate() + 3);
      break;
    case 6:
      datumUitlenen.setDate(vandaag.getDate() + 2);
      break;
  };

  let minDateUitlenenString = datumUitlenen.toISOString().split('T')[0];
  start_date.setAttribute('min', minDateUitlenenString);

<?php 
if ($userType == 'student') {
  echo "
  document.getElementById('beschikbaarheidEnd').style.display='none';

  //student mag max. 2 weken vooraf reserveren:
  let maxDateUitlenen = new Date(datumUitlenen);
  maxDateUitlenen.setDate(datumUitlenen.getDate() + 7);
  let maxDateUitlenenString=maxDateUitlenen.toISOString().split('T')[0];
  start_date.setAttribute('max', maxDateUitlenenString);

  document.getElementById('beschikbaarheidDate').addEventListener('change',function(e){
    document.getElementById('formBeschikbaarheid').submit()       
  })";

} else if ($userType == "docent") {
  echo "
  let datumInleveren = new Date(vandaag); //op zoek naar volgende vrijdag
  switch (dayIndex) {
    case 0:
      datumInleveren.setDate(vandaag.getDate() + 5);
      break;
    case 1:
      datumInleveren.setDate(vandaag.getDate() + 4);
      break;
    case 2:
      datumInleveren.setDate(vandaag.getDate() + 3);
      break;
    case 3:
      datumInleveren.setDate(vandaag.getDate() + 2);
      break;
    case 4:
      datumInleveren.setDate(vandaag.getDate() + 1);
      break;
    case 5:
      datumInleveren = vandaag;
      break;
    case 6:
      datumInleveren.setDate(vandaag.getDate() + 6);
      break;
  };

  let minDateInleverenString = datumInleveren.toISOString().split('T')[0];
  end_date.setAttribute('min', minDateInleverenString);

start_date.addEventListener('change', function() {
  //student mag max 1 week reserveren dus van maandag tot vrijdag

  let new_date = new Date(start_date.value);
  new_date.setDate(new_date.getDate() + 4); 
  let endDate = new_date.toISOString().split('T')[0];
  end_date.value='';
  end_date.setAttribute('min', endDate);
})

document.getElementById('beschikbaarheidDate').addEventListener('change',function(e){
  document.getElementById('beschikbaarheidEnd').addEventListener('change',function(e){
  document.getElementById('formBeschikbaarheid').submit()      
  }) 
})";
     
    }

    ?>
  })

</script>

</body>
</html>



