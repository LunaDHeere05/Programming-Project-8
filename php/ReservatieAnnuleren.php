<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 minimal-scale=1.0" >
    <title>Reservatie annuleren</title>
    <style>
.bevestig{
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
.annulerenEnTerug{
  display: flex;
}
.annulerenEnTerug img{
  width: 1.5em;
  height: auto;
  margin: 1.5em;
}
.annulerenEnTerug h1{
  margin: 0.6em 0.5em 0em 0.5em;
}
</style>
</head>
<body>
    <?php include 'top_nav.php'?>
    <div class="annulerenEnTerug">
        <a href="#"><img src="images/svg/chevron-left-solid.svg" alt=""></a>
        <h1>Annuleren</h1> 
    </div>
    <p class="bevestig">Bevestig dat je deze items wilt <b>annuleren</b>.</p>
    <div class="item_info_container">
        <div class="item_info">
            <img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="foto apparaat">
            <h2>Canon-M50</h2>
            <p class="data">van 29/12/2024 <br> tot 14/01/2025</p>
            <h2>Aantal:</h2>
            <img class="verwijder"  src="images/svg/xmark-solid.svg" alt="klik weg">
        </div>
    </div>
    <div class="bevestig_btn">
        <button id="bevestig">Bevestig</button>
    </div>
    <?php include 'footer.php'?>

    <script>
          document.getElementById('bevestig').addEventListener('click', function() {
            window.location.href = 'FinalAnnulerenReservatie.php';
            });
    </script>
</body>
</html>