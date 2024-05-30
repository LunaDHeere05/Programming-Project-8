<?php
// verwijder_reservatie.php

include '../database.php';

$reservatieID = $_POST['reservatieID'];
$statusText = $_POST['statusText'];

mysqli_begin_transaction($conn);
try {
    if ($statusText === "Op te halen" || $statusText === "Opgehaald") {
        // Update isOpgehaald in UITGELEEND_ITEM to 1
        $updateQuery = "UPDATE UITGELEEND_ITEM SET isOpgehaald = 1 WHERE uitleen_id = '$reservatieID'";
        if (!mysqli_query($conn, $updateQuery)) {
            throw new Exception("Error updating isOpgehaald in UITGELEEND_ITEM: " . mysqli_error($conn));
        }
    } else {
        // Update isOpgehaald and isUitgeleend in EXEMPLAAR_ITEM and UITGELEEND_ITEM
        $selectQuery = "SELECT uit.exemplaar_item_id FROM UITGELEEND_ITEM uit WHERE uit.uitleen_id = '$reservatieID'";
        $result = mysqli_query($conn, $selectQuery);
        if (!$result) {
            throw new Exception("Error selecting exemplaar_item_id from UITGELEEND_ITEM: " . mysqli_error($conn));
        }
        
        $row = mysqli_fetch_assoc($result);
        $exemplaar_item_id = $row['exemplaar_item_id'];
        
        $updateQuery1 = "UPDATE UITGELEEND_ITEM SET isOpgehaald = 0 WHERE uitleen_id = '$reservatieID'";
        $updateQuery2 = "UPDATE EXEMPLAAR_ITEM SET isUitgeleend = 0 WHERE exemplaar_item_id = '$exemplaar_item_id'";
        if (!mysqli_query($conn, $updateQuery1) || !mysqli_query($conn, $updateQuery2)) {
            throw new Exception("Error updating records: " . mysqli_error($conn));
        }
        
        $statusText = "Ingeleverd";
    }

    mysqli_commit($conn);
    echo "Reservatie succesvol bijgewerkt.";
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo "Er is een fout opgetreden bij het bijwerken van de reservatie: " . $e->getMessage();
}

mysqli_close($conn);
?>
