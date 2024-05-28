<?php 
session_start();

// Dit is de email van de ingelogde gebruiker, evenals of het een docent, student of admin is. 
if (isset($_SESSION['gebruikersnaam'])) {
    $gebruikersnaam = $_SESSION['gebruikersnaam'];
    $userType = $_SESSION['userType'];
}
?>
