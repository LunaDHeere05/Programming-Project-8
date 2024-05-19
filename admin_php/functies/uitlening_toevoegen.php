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
        $apparaat = filter_input(INPUT_POST, "apparaat", FILTER_SANITIZE_SPECIAL_CHARS);
        $inDatum = $_POST['datum'];

        // Query om te checken of de email bestaat in de database
        $emailquery = "SELECT email FROM STUDENT WHERE email = '$email'
        UNION 
        SELECT email FROM DOCENT WHERE email = '$email'";
        // Query om te checken of het apparaat bestaat in de database
        $apparaatquery = "SELECT naam, item_id FROM ITEM WHERE naam = '$apparaat'";
        // variabele voor de huidige datum
        $uitDatum = date("Y-m-d");

     
        // check om te kijken of de velden zijn ingevuld
        if(empty($email||$apparaat||$inDatum)){
            echo "vul alle velden in!";
        } else {
            $emailResult = mysqli_query($conn, $emailquery);
            if ($emailResult){
                $apparaatresult = mysqli_query($conn, $apparaatquery);
                if($apparaatresult){
                    $email_row = mysqli_fetch_assoc($emailResult);
                    $apparaat_row = mysqli_fetch_assoc($apparaatresult);
                    // echo "$email_row[email] <br>";
                    // echo "$apparaat_row[naam] <br>";    
                    

                    // Query om de uitlening toe te voegen aan de database
                    // eerst wordt er een nieuwe uitlening toegevoegd
                    
                    // dan voeg ik een nieuw uitgeleend_item toe aan de uitlening(via uitleen_id)
                    if(isset($_POST['email_type'])){
                        $email_type = $_POST['email_type'];
                        if($email_type == "student"){
                           $sql_lening = "INSERT INTO `UITLENING` (`uitleen_id`, `uitleen_datum`, `inlever_datum`, `isOpgehaald`, `isVerlengd`, `emailSTUDENT`, `emailDOCENT`) VALUES (NULL, '$uitDatum', '$inDatum', '0', '0', '$email',  NULL)" ;
                           $stmt = $conn->prepare($sql_lening);
                            if($stmt->execute()){
                                echo "Uitlening toegevoegd!";
                            } else {
                                echo "Uitlening niet toegevoegd!";
                            }
                        } else {
                           $sql_lening= "INSERT INTO `UITLENING` (`uitleen_id`, `uitleen_datum`, `inlever_datum`, `isOpgehaald`, `isVerlengd`, `emailSTUDENT`, `emailDOCENT`) VALUES (NULL, '$uitDatum', '$inDatum', '0', '0', NULL, '$email')"; 
                            $stmt = $conn->prepare($sql_lening); 
                            if($stmt->execute()){
                                echo "Uitlening toegevoegd!";
                            } else {
                                echo "Uitlening niet toegevoegd!";
                            }
                        }
                    } 
            
                } else {
                    echo "Apparaat niet gevonden!";
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