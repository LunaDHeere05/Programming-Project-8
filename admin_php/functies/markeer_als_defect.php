<?php
// Inclusie van databaseverbinding
include 'database.php';

// Ontvang de reservatie-ID van het AJAX-verzoek
$reservatieID = $_POST['reservatieID'];

// Query om de reservatie als defect te markeren in de database
$query = "UPDATE UITLENING SET isDefect = 1 WHERE uitleen_id = '$reservatieID'";

// Uitvoeren van de query
if (mysqli_query($conn, $query)) {
    echo "Reservatie succesvol gemarkeerd als defect.";
} else {
    echo "Er is een fout opgetreden bij het markeren van de reservatie als defect: " . mysqli_error($conn);
}

// Sluit de databaseverbinding
mysqli_close($conn);
?>
