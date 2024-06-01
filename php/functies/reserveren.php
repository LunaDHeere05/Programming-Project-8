<?php
include '../sessionStart.php'; //AN: om te weten welke mail er gebruikt wordt om in te loggen

include '../database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    if (empty($_POST['start_date']) || empty($_POST['end_date']) || empty($_POST['itemId']) || empty($_POST['aantal'])) {
        die('Alle velden moeten worden ingevuld.');
        }

$start_date= $_POST['start_date'];
$end_date= $_POST['end_date'];
$itemId= $_POST['itemId'];
$aantal= $_POST['aantal'];

    // Beveilig de waarden tegen SQL-injecties
    $start_date = mysqli_real_escape_string($conn, $start_date);
    $end_date = mysqli_real_escape_string($conn, $end_date);
    $itemId = intval($itemId);
    $aantal = intval($aantal);
    
    // controle of de datums geldig zijn en in het juiste formaat (bijv. YYYY-MM-DD)
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $start_date) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $end_date)) {
    die('Ongeldig datumformaat. Gebruik het formaat YYYY-MM-DD.');
    }
    
    // controle of de datums valide zijn
    if (!strtotime($start_date) || !strtotime($end_date)) {
    die('Ongeldige datums opgegeven.');
    }
    
    // controle of $aantal een geldig getal is en groter dan 0
    if (!is_numeric($aantal) || intval($aantal) <= 0) {
    die('Aantal moet een positief getal zijn.');
    }
           
    // controle of $itemId een geldig getal is en groter dan 0
    if (!is_numeric($itemId) || intval($itemId) <= 0) {
    die('Item ID moet een positief getal zijn.');
  }

$uitlening = "INSERT INTO UITLENING (uitleen_datum, inlever_datum, email) VALUES ('$start_date', '$end_date','$gebruikersnaam')";

if (mysqli_query($conn, $uitlening)) {
    // Get the ID of the newly inserted row
    $uitleen_id = mysqli_insert_id($conn);

        $vrijeExemplaren = "SELECT ei.exemplaar_item_id
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
        AND zichtbaarheid=1
        LIMIT {$aantal};
    "; 

        $vrijeExemplaren_result = mysqli_query($conn, $vrijeExemplaren);

        if(mysqli_num_rows($vrijeExemplaren_result)>=$aantal){
         while ($exemplaren_row = mysqli_fetch_assoc($vrijeExemplaren_result)) {

        $uitgeleendItem = "INSERT INTO UITGELEEND_ITEM (exemplaar_item_id, uitleen_id) 
                            VALUES ('" . $exemplaren_row['exemplaar_item_id'] . "', '" . $uitleen_id . "')";

        //zonder dit werkt het niet - waarom??
        if (!mysqli_query($conn, $uitgeleendItem)) {
                    echo "Error inserting row into UITGELEEND_ITEM: " . mysqli_error($conn);
                };
            
                $updateSql = "UPDATE EXEMPLAAR_ITEM 
                              SET isUitgeleend = 1 
                              WHERE exemplaar_item_id = '" . $exemplaren_row['exemplaar_item_id'] . "'";

                //zonder dit werkt het niet - waarom??
                if (!mysqli_query($conn, $updateSql)) {
                    echo "Error updating EXEMPLAAR_ITEM: " . mysqli_error($conn);
                };       
            }
        }else{
                echo 'Dit item is intussen al uitgeleend, sorry.';
            }
  
//informatie in een session steken om die te kunnen gebruiken in volgende page
$_SESSION['reservering_info'] = []; 
$_SESSION['reservering_info'][] = [
    'uitleen_id' => $uitleen_id,
];


    header("Location: ../FinalBevestigingReservatie.php");

} else {
    echo "Error inserting UITLENING: " . mysqli_error($conn);
}

}

