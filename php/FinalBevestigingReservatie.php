<?php 
include 'database.php';
include 'sessionStart.php'; //AN: om te weten welke mail er gebruikt wordt om in te loggen
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservatie bevestiging</title>
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
    <a href="Home.php"><img src="images/svg/chevron-left-solid.svg" alt=""></a>
    <h1>Reserveren</h1>
</div>
<p class="bevestig">Deze items werden <b>succesvol</b> gereserveerd. Check je inbox voor een bevestigingsmail.</p>
<div class="item_info_container">
    <div class="item_info">
        <img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="foto apparaat">
        <?php 

 
    $reservering_info = $_SESSION['reservering_info'];

    $query = "SELECT naam, merk FROM ITEM WHERE item_id={$reservering_info['itemId']}";
    
    $query_result = mysqli_query($conn, $query);

    if ($query_result) {
        $item_row = mysqli_fetch_assoc($query_result);
        $item_naam = $item_row['naam'];
        $item_merk = $item_row['merk'];
        $start_datum = $reservering_info['start_date'];
        $eind_datum = $reservering_info['end_date'];
        $aantal = $reservering_info['aantal'];

        echo "<h2>" . $item_merk. ' - ' . $item_naam . "</h2>";
        echo '<p class="data"> Van ' . $start_datum->format('d-m-Y')  . ' tot ' . $eind_datum->format('d-m-Y') . ' </p>';

        echo '<h3>Aantal: '.$aantal .'</h3>';


        $mail_onderwerp = "Bevestiging reservatie";
        $mail_body = "Beste,\n\nUw reservering is succesvol geplaatst.\n\nDetails van uw reservering:\n\n Item: $item_merk - $item_naam\n Aantal: $aantal\n Startdatum: " . $start_datum->format('d-m-Y') . "\n Einddatum: " . $eind_datum->format('d-m-Y') . "\n\nBedankt voor uw reservering.";
        include 'functies/mail.php';
    }
        ?>
 
    </div>
</div>
<?php include 'footer.php'?>
</body>
</html>