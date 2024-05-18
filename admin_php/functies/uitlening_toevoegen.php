<?php 
// include 'php/database.php';
$servername = "dt5.ehb.be"; // Change this to your database server
$username = "2324PROGPROJGR8"; // Change this to your database username
$password = "P!j6WD5KL"; // Change this to your database password
$database = "2324PROGPROJGR8"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


    if (isset($_POST['bevestig_button'])) {
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $email = filter_input(INPUT_POST, "apparaat", FILTER_SANITIZE_SPECIAL_CHARS);
        $datum = $_POST['datum'];

        // Query om te checken of de email bestaat in de database
        $emailquery = "SELECT email FROM STUDENT WHERE email = '$email'
        UNION 
        SELECT email FROM DOCENT WHERE email = '$email'";
        // Query om te checken of het apparaat bestaat in de database
        $apparaatquery = "SELECT naam FROM ITEM WHERE naam = '$apparaat'";

        // check om te kijken of de velden zijn ingevuld
        if(empty($email||$apparaat||$datum)){
            echo "vul alle velden in!";
        } else {
            $emailResult = mysqli_query($conn, $emailquery);
            if ($emailResult){
                $apparaatresult = mysqli_query($conn, $apparaatquery);
                if($apparaatresult){

                }
            } else {
                echo "Email niet gevonden!";
            }
     
        }
                
    } else {
        // echo "Bevestig button was not clicked! <br>";
    }
    mysqli_close($conn);
?>