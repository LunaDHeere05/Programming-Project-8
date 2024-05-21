<?php
include '../sessionStart.php'; //AN: om te weten welke mail er gebruikt wordt om in te loggen

include '../database.php';

$naam= $_POST['naam'];
$merk= $_POST['merk'];
$start_date= $_POST['start_date'];
$end_date= $_POST['end_date'];
$itemId= $_POST['itemId'];
$aantal= $_POST['aantal'];

$uitlening = "INSERT INTO UITLENING (uitleen_datum, inlever_datum,$userType) VALUES ('$start_date', '$end_date','$email')";

if (mysqli_query($conn, $uitlening)) {
    // Get the ID of the newly inserted row
    $uitleen_id = mysqli_insert_id($conn);
    $found = false;

    // Insert items into the UITGELEEND_ITEM table
    for ($i=1; $i<=$aantal; $i++) {
        $exemplaren = "SELECT exemplaar_item_id 
                       FROM EXEMPLAAR_ITEM ei 
                       WHERE ei.item_id = {$itemId}";

        $exemplaren_result = mysqli_query($conn, $exemplaren);

         while ($exemplaren_row = mysqli_fetch_assoc($exemplaren_result)) {
        
            //extra controle om zeker te zijn dat er niet al een uitlening is
            $onbeschikbareExemplaren = "SELECT ei.exemplaar_item_id
                                         FROM UITGELEEND_ITEM ui
                                         JOIN UITLENING u ON ui.uitleen_id = u.uitleen_id
                                         JOIN EXEMPLAAR_ITEM ei ON ui.exemplaar_item_id = ei.exemplaar_item_id
                                         WHERE ei.exemplaar_item_id = {$exemplaren_row['exemplaar_item_id']}
                                         AND (u.uitleen_datum <= '$start_date' AND u.inlever_datum >= '$end_date')";

            $onbeschikbareExemplaren_result = mysqli_query($conn, $onbeschikbareExemplaren);

            if (mysqli_num_rows($onbeschikbareExemplaren_result) == 0) {
              
                $uitgeleendItem = "INSERT INTO UITGELEEND_ITEM (exemplaar_item_id, uitleen_id) 
                                   VALUES ('" . $exemplaren_row['exemplaar_item_id'] . "', '" . $uitleen_id . "')";

            //zonder dit werkt het niet - waarom??
             if (!mysqli_query($conn, $uitgeleendItem)) {
                    echo "Error inserting row into UITGELEEND_ITEM: " . mysqli_error($conn);
                } 
            
                $updateSql = "UPDATE EXEMPLAAR_ITEM 
                              SET isUitgeleend = 1 
                              WHERE exemplaar_item_id = '" . $exemplaren_row['exemplaar_item_id'] . "'";

                //zonder dit werkt het niet - waarom??
                if (!mysqli_query($conn, $updateSql)) {
                    echo "Error updating EXEMPLAAR_ITEM: " . mysqli_error($conn);
                }           
            
                // Verlaat de while-lus nadat een exemplaar is gevonden dat beschikbaar is voor uitlening
                break;
            }
        }
    }


    $start_dateObject=new DateTime($start_date);
    $end_dateObject=new DateTime($end_date);
  
    
//informatie in een session steken om die te kunnen gebruiken in volgende page
$_SESSION['reservering_info'] = [
    'start_date' => $start_dateObject,
    'end_date' => $end_dateObject,
    'itemId' => $itemId,
    'aantal' => $aantal
];

    header("Location: ../FinalBevestigingReservatie.php");
} else {
    echo "Error inserting UITLENING: " . mysqli_error($conn);
}


// Close the connection
mysqli_close($conn);