<?php
include '../database.php'; // Include database.php to initialize $conn

session_start(); // Start session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $wachtwoord = $_POST['wachtwoord']; // Get password from user input
    $user = $_POST['user'];
    $_SESSION['gebruikersnaam'] = $gebruikersnaam;
    
    // Check if the user exists in the database
    $query = '';
    $hashed_password = ''; // Initialize hashed password variable
    
    if ($user == "docent") {
        $query = 'SELECT * FROM DOCENT WHERE email=? LIMIT 1';
        $_SESSION['user'] = $user;
    } else if ($user == "student") {
        $query = 'SELECT * FROM STUDENT WHERE email=? LIMIT 1';
        $_SESSION['user'] = $user;
    }

    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die('An error occurred:' . $conn->error);
    }

    // Bind parameter to statement
    $stmt->bind_param('s', $gebruikersnaam);

    // Execute statement
    $stmt->execute();

    // Get results
    $result = $stmt->get_result();

    // Check if a row is found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['wachtwoord']; // Get hashed password from database
        // Verify if entered password matches hashed password
        if (password_verify($wachtwoord, $hashed_password)) {
            // Redirect user to Home.php if login is successful
            header("Location: ../Home.php");
            exit;
        } else {
            $_SESSION['error_message'] = 'Ongeldig wachtwoord';
            header("Location: ../Profiel.php");
            exit;
        }
    } else {
        $_SESSION['error_message'] = 'Ongeldig emailadres';
        header("Location: ../Profiel.php");
        exit;
    }

    // Close statement
    //$stmt->close();
}

$conn->close();
exit;
?>
