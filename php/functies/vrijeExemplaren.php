<?php

include '..\database.php';
include '..\sessionStart.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $itemId = $_POST['itemId'];


    //beschikbaarheid checken

    $query="SELECT COUNT(exemplaar_item_id) as count FROM EXEMPLAAR_ITEM WHERE item_id={$itemId}";
    $result = mysqli_query($conn, $query);
    $result_row=mysqli_fetch_assoc($result);
    
    //we gaan er eerst van uit dat alle exemplaren van een item beschikbaar zijn
    $aantalExemplaren = $result_row['count'];
 
    //dan gaan we checken hoeveel uitleningen van het item er deze week zijn en die aftrekken van $aantalExemplaren;
    $uitgeleendeExemplaren_query = "SELECT ei.exemplaar_item_id,u.uitleen_datum,u.inlever_datum
    FROM UITGELEEND_ITEM ui
    LEFT JOIN UITLENING u ON ui.uitleen_id = u.uitleen_id
    LEFT JOIN EXEMPLAAR_ITEM ei ON ui.exemplaar_item_id = ei.exemplaar_item_id
    WHERE ei.item_id = {$itemId}
    AND (u.uitleen_datum <= '{$startDate}' AND u.inlever_datum >= '{$endDate}') OR((u.uitleen_datum > '{$startDate}' AND u.uitleen_datum <'{$endDate}') AND u.inlever_datum >= '{$endDate}')";

    $uitgeleendeExemplaren_result = mysqli_query($conn, $uitgeleendeExemplaren_query);
    $aantalExemplaren -= mysqli_num_rows($uitgeleendeExemplaren_result);

    //we gaan ook checken of er exemplaren van het item onzichtbaar zijn. Indien dit het geval is, trekken we ze ook af van $aantalExemplaren

    $onzichtbareExemplaren_query = "SELECT zichtbaarheid FROM EXEMPLAAR_ITEM WHERE zichtbaarheid=0;";

    $onzichtbareExemplaren_result = mysqli_query($conn, $onzichtbareExemplaren_query);
    $aantalExemplaren -= mysqli_num_rows($onzichtbareExemplaren_result); 

    echo $aantalExemplaren;

    $_SESSION['aantalExemplaren']=$aantalExemplaren;

    $aantal=$_SESSION['aantalExemplaren'];

    
}
?>