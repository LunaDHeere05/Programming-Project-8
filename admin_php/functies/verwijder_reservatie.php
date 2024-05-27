<?php
// verwijder_reservatie.php

// Inclusie van databaseverbinding
include '../database.php';

// Ontvang de reservatie-ID van de AJAX-verzoek
$reservatieID = $_POST['reservatieID'];

echo "checkpoint 1";
mysqli_begin_transaction($conn);

try {
    // Update isUitgeleend in EXEMPLAAR_ITEM to 0
    $updateQuery = "UPDATE EXEMPLAAR_ITEM SET isUitgeleend = 0 WHERE uitleen_id = '$reservatieID'";
    if (!mysqli_query($conn, $updateQuery)) {
        throw new Exception("Error updating isUitgeleend in EXEMPLAAR_ITEM: " . mysqli_error($conn));
    }

    // Delete related records from UITGELEEND_ITEM first
    $deleteQuery1 = "DELETE FROM UITGELEEND_ITEM WHERE uitleen_id = '$reservatieID'";
    if (!mysqli_query($conn, $deleteQuery1)) {
        throw new Exception("Error deleting from UITGELEEND_ITEM: " . mysqli_error($conn));
    }

    // Commit the transaction
    mysqli_commit($conn);

    echo "Reservatie succesvol verwijderd.";
} catch (Exception $e) {
    // Rollback the transaction in case of error
    mysqli_rollback($conn);

    echo "Er is een fout opgetreden bij het verwijderen van de reservatie: " . $e->getMessage();
}

// Sluit de databaseverbinding
mysqli_close($conn);
?>
