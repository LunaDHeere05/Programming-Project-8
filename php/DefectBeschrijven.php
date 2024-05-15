<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defect beschrijving</title>
    <link rel="stylesheet" href="/css/stylesheet.css">
    <style>
        </style>
</head>
<body>
    <?php include 'top_nav.php' ?>    
    <div class="annulerenEnTerug">
        <a href="<?php echo $_SERVER['HTTP_REFERER'];?>"><img src="images/svg/chevron-left-solid.svg" alt=""></a>
        <h1>Defect melden</h1> 
    </div>

          <div class="item_info_container">
              <div class="item_info">
                  <img  src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="foto apparaat">
              <h2>Canon-M50</h2>
              <div class="apparaat_id">
                  <h3>Apparaat ID:</h3>
                  <p>123456</p>
              </div>
              <img class="verwijder" src="images/svg/xmark-solid.svg" alt="klik weg">
              </div>
          </div>
        </div>

    <p class="beschrijf">Beschrijf het defect zo precies mogelijk</p>
    <input class="beschrijving_defect" type="text" size="50" maxlength="5000" placeholder="Voorbeeld: Mijn camera heeft een rare zwarte vlek in de rechterbovenhoek van elke foto, zelfs na het schoonmaken van de lens. Het begon nadat ik het apparaat per ongeluk liet vallen tijdens een wandeling in het park gisteren">
    
<div class="bevestig_btn">
    <a href="/html/FinalDefectMelden.html"><button>Bevestig</button></a>
</div>
    <?php include 'footer.php'?>
</body>
</html>