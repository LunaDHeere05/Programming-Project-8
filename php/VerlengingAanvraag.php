<?php include 'sessionStart.php'; //AN: om te weten welke mail er gebruikt wordt om in te loggen
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verlengen</title>
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
        <h1>Verlengen</h1> 
    </div>
    <p class="bevestig">Bevestig dat je deze items wilt <b>verlengen</b>.</p>

    <?php
    include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    if (empty($_POST['ArrayVerlengItems'])) {
        die('Er is een fout opgetreden. Gelieve opnieuw te proberen.');
        }

    $jsonString= $_POST['ArrayVerlengItems'];

    echo "<script>var verlengItems = JSON.parse('$jsonString');</script>";


    $Ids = json_decode($jsonString, true);

    foreach ($Ids as $Id) {
        $exemplaarId = intval($Id['exemplaarId']);
        $uitleenId = intval($Id['uitleenId']);
  
       $query = "SELECT U.uitleen_id, U.uitleen_datum, U.inlever_datum, U.isVerlengd,
        EI.exemplaar_item_id,
        I.*
        FROM UITGELEEND_ITEM UI
        JOIN EXEMPLAAR_ITEM EI ON UI.exemplaar_item_id = EI.exemplaar_item_id
        JOIN ITEM I ON EI.item_id = I.item_id
        JOIN UITLENING U ON UI.uitleen_id = U.uitleen_id 
        WHERE U.email = '$gebruikersnaam' AND UI.isOpgehaald = 1 AND EI.exemplaar_item_id={$exemplaarId} AND U.uitleen_id={$uitleenId}"; 
                
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {

        $vergelijkDatum = new DateTime($row['inlever_datum']);
        $vergelijkDatum->setTime(0, 0, 0); 

        //query om te checken of item verlengbaar is 
        $volgendeMaandag = clone $vergelijkDatum; 
        $volgendeMaandag->modify('next Monday');
        $volgendeMaandagString=$volgendeMaandag->format('Y-m-d');

        $volgendeVrijdag = clone $volgendeMaandag;  
        $volgendeVrijdag->add(new DateInterval('P4D'));
        $volgendeVrijdagString=$volgendeVrijdag->format('Y-m-d');

        $queryCheck="SELECT ei.exemplaar_item_id
        FROM EXEMPLAAR_ITEM ei
        WHERE ei.exemplaar_item_id = $exemplaarId
        AND NOT EXISTS (
            SELECT 1
            FROM UITGELEEND_ITEM ui
            JOIN UITLENING u ON ui.uitleen_id = u.uitleen_id
            WHERE ui.exemplaar_item_id = ei.exemplaar_item_id
            AND (
                (u.uitleen_datum <= '{$volgendeMaandagString}' AND u.inlever_datum >= '{$volgendeVrijdagString}')
                OR (u.uitleen_datum >= '{$volgendeMaandagString}' AND u.uitleen_datum < '{$volgendeVrijdagString}')
                OR (u.inlever_datum <= '{$volgendeVrijdagString}' AND u.inlever_datum > '{$volgendeMaandagString}')
                )
            )
        AND zichtbaarheid=1 
       ";
        
        $queryCheck_result=mysqli_query($conn, $queryCheck);

        $reserveringMogelijk=false;

        if(mysqli_num_rows($queryCheck_result)){
            $reserveringMogelijk=true;
        }

        if($reserveringMogelijk==true){

          $vrijdag=$volgendeVrijdag->format('d-m-Y');

          $startDate=new dateTime($row['uitleen_datum']);
          $startDateString=$startDate->format('d-m-Y');

          $endDate=new dateTime($row['inlever_datum']);
          $endDateString=$endDate->format('d-m-Y');

        echo'<div class="item_info_container">
        <div class="item_info">
            <img src="'.$row['images'].'" alt="foto apparaat">
            <h2>'.$row['merk'].' - '.$row['naam'].' </h2>
            <p class="data">van '.$startDateString.'<br> <s> tot '. $endDateString.' </s> <br> tot <em> <strong> '.$vrijdag.' </strong></em></p>
            <h2>Aantal: 1</h2>
            <img class="verwijder"  src="images/svg/xmark-solid.svg" alt="klik weg">
        </div>
    </div> ';
        }else{
          die('Er is een fout opgetreden. Gelieve opnieuw te proberen.');
        }
    }
    }else{
        die('Er is een fout opgetreden. Gelieve opnieuw te proberen.');
    }
    }
}

?>

<div class="bevestig_btn">
            <form action="functies/reservatie_verlengen.php" method="POST">
            <input type="hidden" id="hidden" name="ArrayVerlengItems">
            <button id="bevestig">Bevestig</button>
        </form>

<?php include 'footer.php'?>
<script>
document.getElementById('hidden').value = JSON.stringify(verlengItems);
</script>
</body>

</html>
