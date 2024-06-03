<?php

include '..\database.php';
include '..\sessionStart.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (empty($_POST['startDate']) || empty($_POST['endDate']) || empty($_POST['itemId'])) {
        die('Alle velden moeten worden ingevuld.');
        }

    $start_date = $_POST['startDate'];
    $end_date = $_POST['endDate'];
    $itemId = $_POST['itemId'];

    $start_date = mysqli_real_escape_string($conn, $start_date);
    $end_date = mysqli_real_escape_string($conn, $end_date);
    $itemId = intval($itemId);

    
    // controle of de datums geldig zijn en in het juiste formaat (bijv. YYYY-MM-DD)
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $start_date) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $end_date)) {
    die('Ongeldig datumformaat. Gebruik het formaat YYYY-MM-DD.');
    }
    
    // controle of de datums valide zijn
    if (!strtotime($start_date) || !strtotime($end_date)) {
    die('Ongeldige datums opgegeven.');
    }
    
    // controle of $itemId een geldig getal is en groter dan 0
    if (!is_numeric($itemId) || intval($itemId) <= 0) {
    die('Item ID moet een positief getal zijn.');
  }

    //beschikbaarheid checken
    $vrijeExemplaren_query = "SELECT ei.exemplaar_item_id
    FROM EXEMPLAAR_ITEM ei
    WHERE ei.item_id = {$itemId}
    AND NOT EXISTS (
        SELECT 1
        FROM UITLENING u 
        WHERE u.exemplaar_item_id = ei.exemplaar_item_id
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