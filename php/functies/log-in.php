<?php
include '../database.php'; // Include database.php to initialize $conn

session_start(); // Start session

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $wachtwoord = $_POST['wachtwoord']; // Get password from user input
    $user = $_POST[ 'user'];
    $_SESSION['gebruikersnaam'] = $gebruikersnaam; //  NA check ww
    // session rol = $row[type]
    
    // Check if the user exists in the database
    $query = '';
    $hashed_password = ''; // Initialize hashed password variable

    // Check if the user exists in the database
    $query = 'SELECT * FROM PERSOON WHERE email=? LIMIT 1';
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die('An error occurred: ' . $conn->error);
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
        $rol = $row['rol']; // Get role from database

        // Verify if entered password matches hashed password
        if (password_verify($wachtwoord, $hashed_password)) {
            $_SESSION['gebruikersnaam'] = $gebruikersnaam; 
            $_SESSION['userType'] = $rol;

            // Check if the user is admin1 or admin2 and assign role "admin"
            if ($gebruikersnaam == 'admin1@example.com' || $gebruikersnaam == 'admin2@example.com') {
                $_SESSION['userType'] = 'admin';
                header("Location: ../../admin_php/dashboard.php"); // Redirect admin to Dashboard.php
            } else {
                header("Location: ../Home.php"); // Redirect other users to Home.php
            }
            
        } else {
            $_SESSION['error_message'] = 'Ongeldig wachtwoord';
            header("Location: ../Profiel.php");
        }
    } else {
        $_SESSION['error_message'] = 'Ongeldig emailadres';
        header("Location: ../Profiel.php");
    }

    // Close statement
    $stmt->close();
} else {
    // Handle the case when the script is not accessed via POST
    echo "This page should be accessed via a POST request.";
}

$conn->close();
exit;
?>


