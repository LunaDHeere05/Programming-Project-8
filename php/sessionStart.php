<?php 
session_start();

// Dit is de email van de ingelogde gebruiker, evenals of het een docent of student is. 
if (isset($_SESSION['gebruikersnaam'])) {
    $email = $_SESSION['gebruikersnaam'];
}

if (isset($_SESSION['user'])) {
    $user = strtoupper($_SESSION['user']); 
    if ($user == "DOCENT") {
        $userType = "emailDOCENT";
    } elseif ($user == "STUDENT") {
        $userType = "emailSTUDENT";
    } else {
        // Handle unexpected user type
        $userType = ""; // Set a default value or handle it based on your logic
    }

    $_SESSION['userType'] = $userType;
}
?>
