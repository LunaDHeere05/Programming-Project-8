<?php
// verwijder_reservatie.php

// Inclusie van databaseverbinding
include '../database.php';

// Ontvang de reservatie-ID en status van de AJAX-verzoek
$reservatieID = $_POST['reservatieID'];
$statusText = $_POST['statusText'];

mysqli_begin_transaction($conn);

try {
    if ($statusText === "Op te halen") {
        // Update isOpgehaald in UITGELEEND_ITEM to 1
        $updateQuery = "UPDATE UITGELEEND_ITEM SET isOpgehaald = 1 WHERE uitleen_id = '$reservatieID'";
        if (!mysqli_query($conn, $updateQuery)) {
            throw new Exception("Error updating isOpgehaald in UITGELEEND_ITEM: " . mysqli_error($conn));
        }
        echo "Reservatie is opgehaald.";
        
    } elseif ($statusText === "In te leveren") {
        // Update isOpgehaald in UITGELEEND_ITEM and isUitgeleend in EXEMPLAAR_ITEM to 0
        $updateQuery1 = "UPDATE UITGELEEND_ITEM SET isOpgehaald = 0 WHERE uitleen_id = '$reservatieID'";
        if (!mysqli_query($conn, $updateQuery1)) {
            throw new Exception("Error updating isOpgehaald in UITGELEEND_ITEM: " . mysqli_error($conn));
        }
        
        // Get exemplaar_item_id from UITGELEEND_ITEM
        $selectQuery = "SELECT exemplaar_item_id FROM UITGELEEND_ITEM WHERE uitleen_id = '$reservatieID'";
        $result = mysqli_query($conn, $selectQuery);
        if (!$result) {
            throw new Exception("Error selecting exemplaar_item_id from UITGELEEND_ITEM: " . mysqli_error($conn));
        }
        
        $row = mysqli_fetch_assoc($result);
        $exemplaar_item_id = $row['exemplaar_item_id'];
        
        $updateQuery2 = "UPDATE EXEMPLAAR_ITEM SET isUitgeleend = 0 WHERE exemplaar_item_id = '$exemplaar_item_id'";
        if (!mysqli_query($conn, $updateQuery2)) {
            throw new Exception("Error updating isUitgeleend in EXEMPLAAR_ITEM: " . mysqli_error($conn));
        }
        echo "Reservatie is ingeleverd.";
    }

    // Commit the transaction
    mysqli_commit($conn);

    echo "Reservatie succesvol bijgewerkt.";
} catch (Exception $e) {
    // Rollback the transaction in case of error
    mysqli_rollback($conn);

    echo "Er is een fout opgetreden bij het bijwerken van de reservatie: " . $e->getMessage();
}

// Sluit de databaseverbinding
mysqli_close($conn);
?>
