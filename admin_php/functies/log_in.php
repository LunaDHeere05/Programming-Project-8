<?php
include '../database.php'; 

session_start(); 

// Define default passwords if they are not already set
$default_password_admin1 = password_hash('defaultPassword1', PASSWORD_BCRYPT);
$default_password_admin2 = password_hash('defaultPassword2', PASSWORD_BCRYPT);

// Update the database default passwords
$query_update = "UPDATE PERSOON SET wachtwoord = CASE
                WHEN email = 'admin1@example.com' THEN ?
                WHEN email = 'admin2@example.com' THEN ?
                END
                WHERE email IN ('admin1@example.com', 'admin2@example.com') AND wachtwoord = ''";

$stmt_update = $conn->prepare($query_update);
if (!$stmt_update) {
    die('An error occurred while preparing update statement: ' . $conn->error);
}
$stmt_update->bind_param('ss', $default_password_admin1, $default_password_admin2);
$stmt_update->execute();
$stmt_update->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $wachtwoord = $_POST['wachtwoord']; 

    // Check if the user exists in the database
    $query = 'SELECT * FROM PERSOON WHERE email=? LIMIT 1';
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die('An error occurred: ' . $conn->error);
    }

    $stmt->bind_param('s', $gebruikersnaam);

    $stmt->execute();

    $result = $stmt->get_result();

    // Check if a row is found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['wachtwoord']; 
        $rol = $row['rol']; 

        // Verify if entered password matches hashed password
        if (password_verify($wachtwoord, $hashed_password)) {
            $_SESSION['gebruikersnaam'] = $gebruikersnaam; 
            $_SESSION['userType'] = $rol;

            if ($rol === 'admin') {
                header("Location: ../../admin_php/Dashboard.php"); 
            } else {
                $_SESSION['error_message'] = 'Je hebt geen toestemming om in te loggen als admin.';
                header("Location: ../Profiel.php");
            }
        } else {
            $_SESSION['error_message'] = 'Ongeldig wachtwoord';
            header("Location: ../Profiel.php");
        }
    } else {
        $_SESSION['error_message'] = 'Ongeldig e-mail';
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
