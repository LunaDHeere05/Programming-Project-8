<?php 
include 'sessionStart.php' //AN: om te weten welke mail er gebruikt wordt om in te loggen
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservatie bevestiging</title>
    <link rel="stylesheet" href="/css/stylesheet.css">
    <style>
       .reserverenEnTerug{
    display: flex;
}
.reserverenEnTerug img{
    width: 1.5em;
    height: auto;
    margin: 1.5em;
}
.reserverenEnTerug h1{
    margin: 0.6em 0.5em 0em 0.5em;
}        .bevestig{
    margin: 0em 4em 2em 4em;
    font-size: 20px;
}
.item_info_container{
    background-color: rgb(193, 193, 193);
    width: 80%;
    margin: 1em auto;
    border-radius: 2em;
}
.item_info{
    display: flex;
    justify-content: space-around;
    align-items: center;
    position: relative;
}
.item_info img{
    width: 15%;
    height: 15%;
    margin: auto 1em;
}
.verwijder{
    position: absolute;
    right: 0;
    top: 0.5em;
    width: 2em !important;
}
.item_info_container img{
  width: 15%;
}
.bevestig_btn{
    background-color: #1bbcb6;
    padding: 1em;
    border-radius: 2em;
    margin: auto;
    width: 10em;
    text-align: center;
}
.bevestig_btn button{
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
    <?php include 'top_nav.php'?>
<div class="reserverenEnTerug">
    <a href="<?php echo $_SERVER['HTTP_REFERER'];?>"><img src="images/svg/chevron-left-solid.svg" alt=""></a>
    <h1>Reserveren</h1>
</div>
<p class="bevestig">Deze items werden <b>succesvol</b> gereserveerd. Check je inbox voor een bevestigingsmail.</p>
<div class="item_info_container">
    <div class="item_info">
        <img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="foto apparaat">
    <h2>Canon-M50</h2>
    <p class="data">van 29/12/2024 <br> tot 14/01/2025</p>
    <h2>Aantal:</h2>
    </div>
</div>
<?php include 'footer.php'?>
</body>
</html>