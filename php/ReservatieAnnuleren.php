<?php 
include 'sessionStart.php' //AN: om te weten welke mail er gebruikt wordt om in te loggen
?>
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
        <a href="<?php echo $_SERVER['HTTP_REFERER'];?>"><img src="images/svg/chevron-left-solid.svg" alt=""></a>
        <h1>Annuleren</h1> 
    </div>
    <p class="bevestig">Bevestig dat je deze items wilt <b>annuleren</b>.</p>
    <?php
    include 'database.php';
    $query = "SELECT U.uitleen_id, U.uitleen_datum, U.inlever_datum, UI.isVerlengd,
                EI.exemplaar_item_id,
                I.naam, I.beschrijving
                FROM UITGELEEND_ITEM UI
                JOIN EXEMPLAAR_ITEM EI ON UI.exemplaar_item_id = EI.exemplaar_item_id
                JOIN ITEM I ON EI.item_id = I.item_id
                JOIN UITLENING U ON UI.uitleen_id = U.uitleen_id AND UI.isOpgehaald = 0
                WHERE U.{$userType} = '$email'"; 
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {

        echo'<div class="item_info_container">
        <div class="item_info">
            <img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="foto apparaat">
            <h2>'.$row['naam'].'</h2>
            <p class="data">van '.$row['uitleen_datum'].'<br> tot '.$row['inlever_datum'].'</p>
            <h2>Aantal:</h2>
            <img class="verwijder"  src="images/svg/xmark-solid.svg" alt="klik weg">
        </div>
    </div> ';
    }
    }
?>
    <div class="bevestig_btn">
        <a href="functies\reservatie_annuleren.php">
            <button id="bevestig">Bevestig</button>
        </a>
    </div>
    <?php include 'footer.php'?>

    <script>
          document.getElementById('bevestig').addEventListener('click', function() {
            window.location.href = 'FinalAnnulerenReservatie.php';
            });
        
    </script>
</body>
</html>