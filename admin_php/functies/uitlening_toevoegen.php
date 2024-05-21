<?php 
// include 'php/database.php';
$servername = "dt5.ehb.be"; 
$username = "2324PROGPROJGR8"; 
$password = "P!j6WD5KL"; 
$database = "2324PROGPROJGR8"; 
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['bevestig_button'])) {
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $apparaat = filter_input(INPUT_POST, "apparaat", FILTER_SANITIZE_SPECIAL_CHARS);
    $inDatum = $_POST['datum'];
    $uitDatum = date("Y-m-d");

    if(empty($email) || empty($apparaat) || empty($inDatum)){
        echo "Vul alle velden in!";
    } else {
        $emailquery = "SELECT email FROM STUDENT WHERE email = ? UNION SELECT email FROM DOCENT WHERE email = ?";
        $emailstmt = $conn->prepare($emailquery);
        $emailstmt->bind_param("ss", $email, $email);
        $emailstmt->execute();
        $emailResult = $emailstmt->get_result();

        if ($emailResult->num_rows > 0) {
            $apparaatquery = "SELECT item_id FROM ITEM WHERE naam = ?";
            $apparaatstmt = $conn->prepare($apparaatquery);
            $apparaatstmt->bind_param("s", $apparaat);
            $apparaatstmt->execute();
            $apparaatresult = $apparaatstmt->get_result();

            if ($apparaatresult->num_rows > 0) {
                $apparaat_row = $apparaatresult->fetch_assoc();
                $apparaat_id = $apparaat_row['item_id'];

                if(isset($_POST['email_type'])){
                    $email_type = $_POST['email_type'];

                    $sql_lening = ($email_type == "student") ? 
                    "INSERT INTO `UITLENING` (`uitleen_datum`, `inlever_datum`, `isOpgehaald`, `isVerlengd`, `emailSTUDENT`) VALUES (?, ?, '0', '0', ?)" :
                    "INSERT INTO `UITLENING` (`uitleen_datum`, `inlever_datum`, `isOpgehaald`, `isVerlengd`, `emailDOCENT`) VALUES (?, ?, '0', '0', ?)";

                    $stmt_lening = $conn->prepare($sql_lening);
                    $stmt_lening->bind_param("sss", $uitDatum, $inDatum, $email);

                    if($stmt_lening->execute()){
                        $uitleen_id = $conn->insert_id;  

                        $exemplaarquery = "SELECT exemplaar_item_id FROM EXEMPLAAR_ITEM WHERE isUitgeleend = '0' AND item_id = ? LIMIT 1";
                        $exemplaarstmt = $conn->prepare($exemplaarquery);
                        $exemplaarstmt->bind_param("i", $apparaat_id);
                        $exemplaarstmt->execute();
                        $exemplaarresult = $exemplaarstmt->get_result();

                        if ($exemplaarresult->num_rows > 0) {
                            $exemplaar_row = $exemplaarresult->fetch_assoc();
                            $exemplaar_id = $exemplaar_row['exemplaar_item_id'];

                            $sql_uitgeleend_item = "INSERT INTO `UITGELEEND_ITEM` (`isVerlengd`, `exemplaar_item_id`, `uitleen_id`) VALUES ('0', ?, ?)";
                            $stmt_item = $conn->prepare($sql_uitgeleend_item);
                            $stmt_item->bind_param("ii", $exemplaar_id, $uitleen_id);

                            if($stmt_item->execute()){
                                // Update de EXEMPLAAR_ITEM isUitgeleend status
                                $update_query = "UPDATE `EXEMPLAAR_ITEM` SET `isUitgeleend` = '1' WHERE `exemplaar_item_id` = ?";
                                $update_stmt = $conn->prepare($update_query);
                                $update_stmt->bind_param("i", $exemplaar_id);
                                
                                if($update_stmt->execute()){
                                    echo "Uitlening toegevoegd!";
                                } else {
                                    echo "Uitlening toegevoegd, maar kon exemplaar niet bijwerken.";
                                }
                            } else {
                                echo "Uitlening niet toegevoegd!";
                            }
                        } else {
                            echo "Geen beschikbaar exemplaar gevonden!";
                        }
                    } else {
                        echo "Uitlening niet toegevoegd!";
                    }
                } 
            } else {
                echo "Apparaat niet gevonden!";
            }
        } else {
            echo "Email niet gevonden!";
        }
    }
    mysqli_close($conn);
} else {
    // echo "Bevestig button was not clicked! <br>";
}
?>
