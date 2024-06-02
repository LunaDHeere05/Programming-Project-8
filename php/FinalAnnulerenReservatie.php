<?php include 'sessionStart.php'; //AN: om te weten welke mail er gebruikt wordt om in te loggen
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bevestiging annulatie</title>
    <link rel="stylesheet" href="/css/stylesheet.css">
    <style>
.bevestig {
            margin: 0em 4em 2em 4em;
            font-size: 20px;
        }
        .item_info_container {
            width: 90%;
            margin: 1em auto;
            border-radius: 2em;
            display: flex;
            flex-direction: column;
            gap:1em;
            justify-content: center;
            align-items: center;
        }
        .item_info {
            background-color: #edededcf;
            display: flex;
            justify-content: space-around;
            align-items: center;
            position: relative;
            width:60em;
            height:10em;
            padding: 2em;
            border-radius: 2em;
            transition: transform 0.5s ease; 
        }

        .item_info img {
            width: 8em;
            height: 8em;
               
        }
        .verwijder {
            position: absolute;
            right: 2%;
            top: 0;
            width: 1.5em !important;
            cursor:pointer;
        }
    
        #formBevestiging{
            display: flex;
            flex-direction: column;
            gap:1em;
            justify-content: center;
            align-items: center;
        }
        #formBevestiging .aantal{
            width:55%;
            text-align: center;
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
        <h1>Annulatie</h1>
    </div>
    <p class="bevestig">Deze items werden <b>succesvol</b> geannuleerd. Check je inbox voor een bevestigingsmail.</p>
    <div class="item_info_container">
        <?php 
    if (isset($_SESSION['annuleer_info']) && isset($gebruikersnaam)){    
    foreach ($_SESSION['annuleer_info'] as $annulatie) {

        $itemId = intval($annulatie['item_id']);

        $startDate=new dateTime($annulatie['uitleen_datum']);
        $startDateString=$startDate->format('d-m-Y');

        $endDate=new dateTime($annulatie['inlever_datum']);
        $endDateString=$endDate->format('d-m-Y');

        $query="SELECT * from ITEM WHERE item_id={$itemId}";
        $query_result=mysqli_query($conn,$query);

        $row=mysqli_fetch_assoc($query_result);

        echo '<div class="item_info">
        <img src="'.$row['images'].'" alt="foto apparaat">
        <h2>'.$row['merk'].' - '.$row['naam'].'</h2>
        <p class="data"> van '.$startDateString.' <br> tot '.$endDateString.'</p>
        <h2>Aantal: 1</h2>
        </div>';
    }

        unset($_SESSION['annuleer_info']);
}
        ?>
    </div>
    <?php include 'footer.php'?>
    </body>
    </html>