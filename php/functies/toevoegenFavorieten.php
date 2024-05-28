<?php
include 'database.php';

$email='student1@example.com';

$sql="INSERT INTO `FAVORIETENLIJST` (`Fav_id`, `email`) VALUES (NULL, $gebruikersnaam)";

$stmt = $conn->prepare($sql);

// Binden van de parameters - om sqlinjecties te vermijden
$stmt->bind_param("i", $email);

if ($stmt->execute()) {
    echo "Nieuwe rij succesvol toegevoegd aan favorieten.";
} else {
    echo "Fout bij het toevoegen van rij: " . $stmt->error;
}

// Sluit de statement en de verbinding
$stmt->close();
$conn->close();