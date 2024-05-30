<?php include 'sessionStart.php'; //AN: om te weten welke mail er gebruikt wordt om in te loggen
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apparaat</title>
  <?php include 'top_nav.php' ?>
  <style>
    .apparaat_info {
      background-color: #edededcf;
      width: 85%;
      margin: auto;
      margin-top: 2em;
      border-radius: 1em;
      padding: 3em;
      display: flex;
      gap: 5em;
      justify-content: center;
      align-items: center;
    }

    .download_handleiding {
      list-style: none;
      display: flex;
      width:50%;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .download_handleiding img {
      background-color: white;
      border-radius: 2em;
      width:20em;
      height:20em;
      margin: auto 0em 0em 2em;
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
      color: #1bbcb6;
      margin-top: 0.5em;
    }

    .apparaat_beschrijving h1 {
      color: grey;

    }

    .beschrijving {
      padding: 0;
      margin: 0;
      font-weight: 300;
      margin-bottom: 1em;
      color: grey;
    }

    .apparaat_beschrijving li {
      margin: 0.25em 0em;
    }

    .doos_kolom {
      display: flex;
      flex-direction: column;
      justify-content: end;
      margin: 2em 0em 0em 0em;
      width: 50%;
    }

    .apparaat_info_container h2 {
      color: #1bbcb6
    }

    .doos_kolom li {
      margin: 0.5em 0em;
    }

    .doos_kolom .defecten {
      margin: 2em 0em 0em 0em;
      color: #e30613;
    }

    .reservatie {
      margin: 1em 0em 0.5em 2em;
      padding: 10px;
    }

    .reservatie_plaatsen {
      background-color: #1bbcb6;
      width: 80%;
      height: 8em;
      margin: auto;
      border-radius: 2em;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 3em;
      color: white;
      padding: 1em;
    }



    .reservatie_plaatsen input[type="date"] {
      border-radius: 0.2em;
      border: 2px solid #b1b1b1cf;
    }

    .dateMessage {
      font-size: 12px;
      color: black;
      text-align: center;
      font-weight: 400;
    }

    .onbeschikbaarmelding {
      font-size: 12px;
      font-weight: bold;
    }

    #quantity {
      display: none;
    }

    .aantal {
      display: flex;
      background-color: transparent;
      border-radius: 19em;
      width: 100%;
      gap: 0.5em;
      align-items: center;
      color: white;
    }

    .aantal label {
      font-weight: bold;
    }

    .aantal input {
      border-radius: 0.4em;
      text-align: right;
      border: 2px solid #b1b1b1cf;
    }

    .reservatie_plaatsen button {
      border: 2px solid #b1b1b1cf;
      border-radius: 2em;
      cursor: pointer;
      font-weight: bold;
      width: 100%;
      font-size: 100%;
      background-color: white;
    }

    .winkelmand_toevoegen_btn {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 0.5em;
    }

    .winkelmand_toevoegen_btn img {
      width: 10%;
    }

    .uitleentermijn {
      display: flex;
      flex-direction: column;
      gap: 0.5em;
      width: 110%;
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
      filter: invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg) brightness(103%) contrast(79%);
      position: absolute;
      width: 2em;
      right: 0.5em;
      top: 0.5em;
    }

    /* van dezelfde categorie */
    .dezelfde_categorie {
      width: 100%;
    }

    .dezelfde_categorie_container {
      display: flex;
    }

    .dezelfde_categorie h1 {
      margin: 2em 0em 0em 2em;
    }

    .dezelfde_categorie ul {
      display: flex;
      list-style: none;
      width: 90%;
      margin: 2em auto;
      justify-content: space-evenly;
    }

    .slider {
      width: 2em;
      height: auto;
      margin: 1em;
    }

    .lijst_apparaten li {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 20%;
      background-color: rgb(193, 193, 193);
      padding: 1em 1em 0.5em 1em;
      border-radius: 2em;
      margin: 0.7em;
    }

    .lijst_apparaten li img {
      width: 80%;
      background-color: white;
      border-radius: 1em;
    }

    .lijst_apparaten li h3 {
      padding-top: 1em;
    }

    .hoeveelheid {
      display: flex;
    }

    .hoeveelheid h1 {
      margin: 0.8em 0.5em 0em 0.5em;
    }

    .hoeveelheid a img {
      width: 1.5em;
      height: auto;
      margin: 1.5em;
    }

    .bevestig {
      margin: 0em 4em 2em 4em;
      font-size: 20px;
    }

    .item_info_container {
      background-color: rgb(193, 193, 193);
      width: 80%;
      margin: 1em auto;
      border-radius: 2em;
    }

    .item_info {
      display: flex;
      justify-content: space-around;
      align-items: center;
      position: relative;
    }

    .item_info img {
      width: 15%;
      height: 15%;
      margin: auto 1em;
    }

    .verwijder {
      position: absolute;
      right: 0;
      top: 0.5em;
      width: 2em !important;
    }

    .item_info_container img {
      width: 15%;
    }

    .bevestig_btn {
      background-color: #1bbcb6;
      padding: 1em;
      border-radius: 2em;
      margin: auto;
      width: 10em;
      text-align: center;
    }

    .bevestig_btn button {
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
  if (isset($_GET['item_id_result'])) {
    $item_id = intval($_GET['device_id_result']);
  }
  ?>

  <div class="apparaat_info">
      <?php include 'functies\apparaat_pagina_functie.php' ?>
  </div>

  <h2 class="reservatie">Plaats je reservatie</h2>
  <form id="form" action="ReservatieBevestigen.php" method="POST">
    <div class="reservatie_plaatsen">
    <?php include 'functies\reservatiePlaatsen.php' ?>
    </div>
  </form>

  <div class="kits">
    <h1>Kits</h1>
    <ul>
      <?php include 'functies\kit_apparaat_pagina.php'?>
    </ul>
  </div>

  <div class="dezelfde_categorie">
    <h1>Van dezelfde categorie</h1>
    <div class="dezelfde_categorie_container">
      <img class="slider" src="images/svg/chevron-left-solid.svg" alt="links" class="verander">
      <ul class="lijst_apparaten">
        <?php include 'functies\dezelfde_categorie.php'?>
      </ul>
      <img class="slider" src="images/svg/chevron-right-solid.svg" alt="rechts">
    </div>
  </div>
  <?php include 'footer.php' ?>

  <script>
       
       <?php include 'functies/recentItemsToevoegen.php' ?>


  let vandaag = new Date();
  let dayIndex = vandaag.getDay(); //maandag is index 1, vrijdag index 5

  //uitlenen kan enkel op maandag
  let start_date = document.getElementById('start_date');
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

  let dateMessage = document.createElement('p');
  dateMessage.classList = 'dateMessage';
  let end_date = document.getElementById('end_date')

  start_date.addEventListener('focus', function() {
    start_date.before(dateMessage);
    dateMessage.textContent = 'Uitlenen kan enkel op maandag.'
  })

  start_date.addEventListener('blur', function() {
    dateMessage.textContent = ''
  })

  //zolang geen datum is aangeduid, zijn de reserveer- en winkelmandbutton disabled
  if(!start_date.value || !end_date.value){
    document.getElementById('submit').disabled=true;
    document.getElementById('submitWinkelmand').disabled=true;
  }

  //vanaf het moment dat de user (student) een begindatum aanduidt, gaat er een query worden uitgevoerd om te kijken hoeveel exemplaren van het item beschikbaar zijn.
  
  function aantalUitDatabank(startDate, endDate) {
  let itemId = <?php echo json_encode($item_id)?>;
    // Controle
    console.log('Item ID:', itemId);

    let formData = new FormData();
    formData.append('startDate', startDate);
    formData.append('endDate', endDate);
    formData.append('itemId', itemId);

    document.getElementById('hiddenEndDate').value=endDate;
    document.getElementById('item_id').value=itemId;
    // console.log(start_dateValue); 

    // Startdatum sturen naar de PHP-file om  te checken hoeveel exemplaren van het item beschikbaar zijn
    fetch('functies/vrijeExemplaren.php', {
        method: 'POST',
        body: formData
      }).then(response => response.text())
      .then(data => {
        if (data > 0) {
          // Reset aantal-value elke keer dat de user een andere datum kiest
          document.getElementById('quantity').value = '1';
          document.getElementById('quantity').disabled = false;
          document.getElementById('submit').disabled=false;
          document.getElementById('submitWinkelmand').disabled=false;
          document.getElementById('onbeschikbaarDiv').style.display = 'none';
          document.getElementById('quantity').setAttribute('max', data);
          document.getElementById('quantity').style.display = 'flex';
        
        } else if (data <=0) {
          document.getElementById('onbeschikbaarDiv').style.display = 'flex';
          document.getElementById('quantity').value = '0';
          document.getElementById('quantity').disabled = true;
          document.getElementById('onbeschikbaarDiv').innerHTML = '<p class=\"onbeschikbaarmelding\">Dit artikel is onbeschikbaar. Kies een ander uitleentermijn.</p>';
          document.getElementById('submit').disabled=true;
          document.getElementById('submitWinkelmand').disabled=true;
        }
        console.log(data);
      })
      .catch(error => {
        console.error('Error:', error);
      })

    }

   

    <?php
  
      if ($userType == 'student') {
        echo "
        //student mag max. 2 weken vooraf reserveren:
        let maxDateUitlenen = new Date(datumUitlenen);
        maxDateUitlenen.setDate(datumUitlenen.getDate() + 7);
        let maxDateUitlenenString=maxDateUitlenen.toISOString().split('T')[0];
        start_date.setAttribute('max', maxDateUitlenenString);   

        end_date.disabled=true;

        start_date.addEventListener('change', function() {
            
            console.log('startdate: '+start_date.value);          

            //student mag max 1 week reserveren dus van maandag tot vrijdag
            let new_date = new Date(start_date.value);
            new_date.setDate(new_date.getDate() + 4); 
            let endDate = new_date.toISOString().split('T')[0];
            end_date.disabled=false;
            console.log('enddate: '+endDate); 

            aantalUitDatabank(start_date.value,endDate)

            end_date.value=endDate;
            end_date.setAttribute('min', endDate);
            end_date.setAttribute('max', endDate);

          })";
      } else if ($userType == "docent") {
        echo "
  let datumInleveren = new Date(vandaag);
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

  end_date.addEventListener('focus', function() {
    end_date.before(dateMessage);
    dateMessage.textContent = 'Inleveren kan enkel op vrijdag.'
  })

  end_date.addEventListener('blur', function() {
    dateMessage.textContent = ''
  })

start_date.addEventListener('change', function() {
  //student mag max 1 week reserveren dus van maandag tot vrijdag
  quantity.disabled=true;
  let new_date = new Date(start_date.value);
  new_date.setDate(new_date.getDate() + 4); 
  let endDate = new_date.toISOString().split('T')[0];
  end_date.value='';
  end_date.setAttribute('min', endDate);
 
  end_date.addEventListener('change', function(){
    quantity.disabled=false;
    if(start_date.value<end_date.value){
    aantalUitDatabank(start_date.value,end_date.value)
    }else{
      alert('Startdatum moet kleiner zijn dan einddatum.');
    }
  })
})";
      };   

    ?>


//WINKELMAND
document.getElementById('submitWinkelmand').addEventListener('click',function(e){
  e.preventDefault()

  let itemId = <?php echo json_encode($item_id)?>;

  let formData = new FormData();
    formData.append('startDate', document.getElementById('start_date').value);
    formData.append('endDate', document.getElementById('end_date').value);
    formData.append('itemId', itemId);
    formData.append('aantal', document.getElementById('quantity').value);
  console.log(formData)
  fetch('functies/winkelmand.php', {
        method: 'POST',
        body: formData
      }).then(response => response.text())
      .then(data => {
        window.location.reload();
      })

      
    
  });



 



   
  </script>
</body>

</html>