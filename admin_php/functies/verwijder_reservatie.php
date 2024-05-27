<?php
// verwijder_reservatie.php

// Inclusie van databaseverbinding
include '../database.php';

// Ontvang de reservatie-ID van de AJAX-verzoek
$reservatieID = $_POST['reservatieID'];

echo "checkpoint 1";
mysqli_begin_transaction($conn);

try {
    // Delete related records from UITGELEEND_ITEM first
    $query1 = "DELETE FROM UITGELEEND_ITEM WHERE uitleen_id = '$reservatieID'";
    if (!mysqli_query($conn, $query1)) {
        throw new Exception("Error deleting from UITGELEEND_ITEM: " . mysqli_error($conn));
    }

    // Delete the record from UITLENING
    $query2 = "DELETE FROM UITLENING WHERE uitleen_id = '$reservatieID'";
    if (!mysqli_query($conn, $query2)) {
        throw new Exception("Error deleting from UITLENING: " . mysqli_error($conn));
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