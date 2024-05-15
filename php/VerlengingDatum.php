<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verlengen</title>
</head>
<body> 
    <?php include 'top_nav.php' ?>
    <div class="agendaEnTerug">
        <a href="<?php echo $_SERVER['HTTP_REFERER'];?>"><img src="images/svg/chevron-left-solid.svg" alt=""></a>
        <h1>Verlengen</h1>
    </div> 
    <p>Duid een nieuwe datum aan. De inleverdatum kan je <span>éénmalig met 1 week</span> verlengen.</p> 

    <div class="apparaat_verlengen_container">
        <div class="apparaat_verlengen">
            <img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="foto apparaat">
            <h2>Canon-M50</h2>
            <div class="apparaat_id">
                <h3>Apparaat ID:</h3>
                <p>123456</p>
            </div>
            <div class="verlengen_datum">
                <h3>Verlengen tot:</h3>
                <input type="date" id="verlengen_datum" name="verlengen_datum">
            </div>
            <button id="verlengen_btn">Verlengen</button>
        </div>
    </div>
    <?php include 'footer.php'?>
</body>
</html>