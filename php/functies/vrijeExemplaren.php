<?php

include '..\database.php';
include '..\sessionStart.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start_date = $_POST['startDate'];
    $end_date = $_POST['endDate'];
    $itemId = $_POST['itemId'];


    //beschikbaarheid checken
    $vrijeExemplaren_query = "SELECT ei.exemplaar_item_id
    FROM EXEMPLAAR_ITEM ei
    WHERE ei.item_id = {$itemId}
    AND NOT EXISTS (
        SELECT 1
        FROM UITGELEEND_ITEM ui
        JOIN UITLENING u ON ui.uitleen_id = u.uitleen_id
        WHERE ui.exemplaar_item_id = ei.exemplaar_item_id
        AND (
            (u.uitleen_datum <= '{$start_date}' AND u.inlever_datum >= '{$end_date}')
            OR (u.uitleen_datum >= '{$start_date}' AND u.uitleen_datum < '{$end_date}')
            OR (u.inlever_datum <= '{$end_date}' AND u.inlever_datum > '{$start_date}')
            )
        )
    AND zichtbaarheid=1;
    ";

$vrijeExemplaren_result = mysqli_query($conn, $vrijeExemplaren_query);
//eerste datum-conditie: controleert of een uitlening start op of vóór de beginperiode  en eindigt op of na de eindperiode
//tweede datum-conditie:  controleert of een uitlening begint binnen de periode, dus na de startdatum maar vóór de einddatum.
//derde datum-conditie: controleert of een uitlening eindigt op of vóór de eindatum en eindigt binnen de periode, dus na de startdatum

$aantalExemplaren = mysqli_num_rows($vrijeExemplaren_result);
echo $aantalExemplaren;

$_SESSION['aantalExemplaren']=$aantalExemplaren;

$aantal=$_SESSION['aantalExemplaren'];

    
}
?>