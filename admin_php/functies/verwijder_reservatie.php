<?php
// verwijder_reservatie.php

// Inclusie van databaseverbinding
include '../database.php';

// Ontvang de reservatie-ID en status van de AJAX-verzoek
$reservatieID = $_POST['reservatieID'];
$statusText = $_POST['statusText'];

echo "checkpoint 1";
mysqli_begin_transaction($conn);

try {
    if ($statusText === "Ophalen" || $statusText === "Opgehaald") {
        // Update isUitgeleend in EXEMPLAAR_ITEM to 1
        $updateQuery = "UPDATE UITGELEEND_ITEM SET isOpgehaald = 1 WHERE uitleen_id = '$reservatieID'";
        if (!mysqli_query($conn, $updateQuery)) {
            throw new Exception("Error updating isOpgehaald in UITGELEEND_ITEM: " . mysqli_error($conn));
        }
        $statusText = "Opgehaald";
        
    } else {
        // Insert records into WAARSCHUWING before deleting
        $selectQuery = "SELECT uit.exemplaar_item_id, uit.uitleen_id
                        FROM UITGELEEND_ITEM uit
                        WHERE uit.uitleen_id = '$reservatieID'";
        $result = mysqli_query($conn, $selectQuery);
        if (!$result) {
            throw new Exception("Error selecting from UITGELEEND_ITEM: " . mysqli_error($conn));
        }

        while ($row = mysqli_fetch_assoc($result)) {
            $exemplaar_item_id = $row['exemplaar_item_id'];
            $uitleen_id = $row['uitleen_id'];

            $insertQuery = "INSERT INTO WAARSCHUWING (exemplaar_item_id, uitleen_id, waarschuwing_datum)
                            VALUES ('$exemplaar_item_id', '$uitleen_id', NOW())";
            if (!mysqli_query($conn, $insertQuery)) {
                throw new Exception("Error inserting into WAARSCHUWING: " . mysqli_error($conn));
            }
        }

        // Delete related records from UITGELEEND_ITEM
        $deleteQuery1 = "DELETE FROM UITGELEEND_ITEM WHERE uitleen_id = '$reservatieID'";
        if (!mysqli_query($conn, $deleteQuery1)) {
            throw new Exception("Error deleting from UITGELEEND_ITEM: " . mysqli_error($conn));
        }

        // Delete the record from UITLENING
        $deleteQuery2 = "DELETE FROM UITLENING WHERE uitleen_id = '$reservatieID'";
        if (!mysqli_query($conn, $deleteQuery2)) {
            throw new Exception("Error deleting from UITLENING: " . mysqli_error($conn));
        }
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
