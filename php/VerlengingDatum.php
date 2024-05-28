<?php include 'sessionStart.php'; //AN: om te weten welke mail er gebruikt wordt om in te loggen
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verlengen</title>
    <style>
    .agendaEnTerug{
    display: flex;
}
.agendaEnTerug img{
    width: 1.5em;
    height: auto;
    margin: 1.5em;
}
.agendaEnTerug h1{
    margin: 0.6em 0.5em 0em 0.5em;
}
.apparaat_verlengen_container{
    background-color: rgb(193, 193, 193);
    width: 80%;
    margin: 1em auto;
    border-radius: 2em;
}
.apparaat_verlengen_container img{
  width: 15%;
}
.apparaat_verlengen{
    display: flex;
    justify-content: space-around;
    align-items: center;
    position: relative;
}
.apparaat_verlengen img{
    width: 15%;
    height: 15%;
    margin: auto 1em;
}
.verlengen_btn{
    background-color: #1bbcb6;
    padding: 0.5em;
    border-radius: 2em;
    margin: 2em;
    width: 10em;
    height: auto;
    text-align: center;
}
.verlengen_btn button{
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
            <div class="verlengen_btn">
            <button id="verlengen_btn">Verlengen</button>
            </div>
        </div>
    </div>
    <?php include 'footer.php'?>
</body>
</html>