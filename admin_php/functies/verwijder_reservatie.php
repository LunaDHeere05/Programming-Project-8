<?php
// verwijder_reservatie.php

// Inclusie van databaseverbinding
include 'database.php';

// Ontvang de reservatie-ID van de AJAX-verzoek
$reservatieID = $_POST['reservatieID'];

// Query om de reservatie uit de database te verwijderen
$query = "DELETE FROM UITLENING WHERE uitleen_id = '$reservatieID'";

// Uitvoeren van de query
if (mysqli_query($conn, $query)) {
    echo "Reservatie succesvol verwijderd.";
} else {
    echo "Er is een fout opgetreden bij het verwijderen van de reservatie: " . mysqli_error($conn);
}

// Sluit de databaseverbinding
mysqli_close($conn);
?>
