<?php
//Nieuwe wachtwoorden voor nieuwe gebruikers instellen? 
//Gebruik deze code in log-in.php tijdelijk en set wachtwoord.
?>
<?php
include '../database.php'; // Include database connection
include '../sessionStart.php'; 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['gebruikersnaam'];
    $password = $_POST['wachtwoord'];
    $user_type = $_POST['user'];
    $_SESSION['gebruikersnaam'] = $gebruikersnaam;

    // Default redirect in case of an error
    $redirect_url = "../Profiel.php";

    if ($user_type == 'student') {
        $query = "SELECT wachtwoord FROM STUDENT WHERE email = ?";
    } elseif ($user_type == 'docent') {
        $query = "SELECT wachtwoord FROM DOCENT WHERE email = ?";
    } else {
        $_SESSION['error_message'] = "Invalid user type.";
        header("Location: $redirect_url");
        exit();
    }

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($db_password);
        $stmt->fetch();

        // If the database password is empty, set it to the email
        if (empty($db_password)) {
            $hashed_password = password_hash($email, PASSWORD_DEFAULT);
            $update_query = "UPDATE " . ($user_type == 'student' ? "STUDENT" : "DOCENT") . " SET wachtwoord = ? WHERE email = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("ss", $hashed_password, $email);
            $update_stmt->execute();
            $update_stmt->close();
        }

        // Verify the hashed password
        if (password_verify($password, $db_password)) {
            $_SESSION['user'] = $email;
            $_SESSION['user_type'] = $user_type;

            // Redirect to respective dashboard
            $redirect_url = $user_type == 'student' ? "../Home.php" : "../Home.php";
        } else {
            $_SESSION['error_message'] = "Invalid password.";
        }
    } else {
        $_SESSION['error_message'] = "User not found.";
    }

    $stmt->close();
    $conn->close();

    header("Location: $redirect_url");
    exit();
}
?>