<?php
// waarschuwing_dashboard.php

// Inclusie van databaseverbinding
include '../database.php';

// Ontvang de reservatie-ID en status van de AJAX-verzoek
$reservatieID = $_POST['reservatieID'];
$statusText = $_POST['statusText'];

mysqli_begin_transaction($conn);

try {
    // Select exemplaar_item_id based on uitleen_id
    $selectQuery = "SELECT uit.exemplaar_item_id, uit.uitleen_id
                    FROM UITGELEEND_ITEM uit
                    WHERE uit.uitleen_id = '$reservatieID'";
    $result = mysqli_query($conn, $selectQuery);

    if (!$result) {
        throw new Exception("Error selecting from UITGELEEND_ITEM: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
    $exemplaar_item_id = $row['exemplaar_item_id'];
    $uitleen_id = $row['uitleen_id'];

    // Insert record into WAARSCHUWING
    $insertQuery = "INSERT INTO WAARSCHUWING (exemplaar_item_id, uitleen_id, waarschuwing_datum)
                    VALUES ('$exemplaar_item_id', '$uitleen_id', NOW())";
    if (!mysqli_query($conn, $insertQuery)) {
        throw new Exception("Error inserting into WAARSCHUWING: " . mysqli_error($conn));
    }

    if ($statusText === "Op te halen") {
        // Update isUitgeleend in EXEMPLAAR_ITEM to 0
        $updateQuery = "UPDATE EXEMPLAAR_ITEM SET isUitgeleend = 0 WHERE exemplaar_item_id = '$exemplaar_item_id'";
        if (!mysqli_query($conn, $updateQuery)) {
            throw new Exception("Error updating isUitgeleend in EXEMPLAAR_ITEM: " . mysqli_error($conn));
        }

        // Delete related records from UITGELEEND_ITEM
        $deleteQuery = "DELETE FROM UITGELEEND_ITEM WHERE uitleen_id = '$reservatieID'";
        if (!mysqli_query($conn, $deleteQuery)) {
            throw new Exception("Error deleting from UITGELEEND_ITEM: " . mysqli_error($conn));
        }

        echo "Product komt weer vrij en student is toegevoegd aan WAARSCHUWING-table.";
    } elseif ($statusText === "In te leveren") {
        echo "Student is toegevoegd aan WAARSCHUWING-table.";
    }

    // Commit the transaction
    mysqli_commit($conn);
} catch (Exception $e) {
    // Rollback the transaction in case of error
    mysqli_rollback($conn);

    echo "Er is een fout opgetreden bij het bijwerken van de waarschuwing: " . $e->getMessage();
}

// Sluit de databaseverbinding
mysqli_close($conn);
?>
