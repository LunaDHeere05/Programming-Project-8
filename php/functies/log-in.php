<?php
include '../database.php'; // Neem database.php op om $conn te initialiseren

session_start(); // Start de sessie

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $user = $_POST['user'];
    $_SESSION['gebruikersnaam'] = $gebruikersnaam;
    

    //AN: checken of de user die wilt inloggen bestaat in de databank
    $query = '';
    if ($user == "docent") {
        $query = 'SELECT * FROM DOCENT WHERE email=? LIMIT 1';
        $_SESSION['user'] = $user;
    } else if ($user == "student") {
        $query = 'SELECT * FROM STUDENT WHERE email=? LIMIT 1';
        $_SESSION['user'] = $user;
    }

    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die('Er is een fout opgetreden:' . $conn->error);
    }

    // Bind de parameter aan de statement
    $stmt->bind_param('s', $gebruikersnaam);

    // Voer de statement uit
    $stmt->execute();

    // Haal de resultaten op
    $result = $stmt->get_result();

    // Controleer of er een rij is gevonden
    if ($result->num_rows > 0) {

        echo '<script type="text/javascript">
        // if (window.history.length >=2) {
        //     window.history.go(-2);
        // } else {
            window.location.href = "../Home.php";
        
      </script>';

    } else {
        $_SESSION['error_message'] = 'Ongeldig emailadres';
        header("Location: ../Profiel.php");
    }

    // Sluit de statement
    $stmt->close();
}

$conn->close();

exit;
?>
