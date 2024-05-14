<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verlengen</title>
    <link rel="stylesheet" href="/css/stylesheet.css">
    <style>
        
        </style>
</head>
<body>
    <?php include 'top_nav.php'?>

    <div class="annulerenEnTerug">
        <a href="<?php echo $_SERVER['HTTP_REFERER'];?>"><img src="images/svg/chevron-left-solid.svg" alt=""></a>
        <h1>Verlengen</h1> 
    </div>
    <p class="bevestig">1. Bekijk de ID-sticker op jouw apparaat. <br>
        2. Duid het apparaat aan dat je wilt verlengen. </p>

    <div class="item_info_en_selectiebol">
      <div id="selectie_bol">
          <img src="images/svg/circle-regular.svg" alt="check">
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
        </div>
    <div class="bevestig_btn">
        <a href="/html/FinalDefectMelden.html"><button>Bevestig</button></a>
    </div>

</body>
<?php include 'footer.php'?>
</html>