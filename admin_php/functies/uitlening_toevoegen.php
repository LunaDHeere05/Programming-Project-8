<?php 
// Database credentials
$servername = "dt5.ehb.be"; 
$username = "2324PROGPROJGR8"; 
$password = "P!j6WD5KL"; 
$database = "2324PROGPROJGR8";

try {
    
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['bevestig_button'])) {
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $apparaat = filter_input(INPUT_POST, "apparaat", FILTER_SANITIZE_SPECIAL_CHARS);
        $inDatum = $_POST['datum'];
        $uitDatum = date("Y-m-d");

        if(empty($email) || empty($apparaat) || empty($inDatum)){
            echo "Vul alle velden in!";
        } else {
            // Check of email bestaat in STUDENT or DOCENT
            $emailquery = "SELECT email FROM STUDENT WHERE email = :email UNION SELECT email FROM DOCENT WHERE email = :email";
            $emailstmt = $conn->prepare($emailquery);
            $emailstmt->execute(['email' => $email]);
            $emailResult = $emailstmt->fetchAll();

            if (count($emailResult) > 0) {
                // Check of apparaat bestaat in ITEM
                $apparaatquery = "SELECT item_id FROM ITEM WHERE naam = :apparaat";
                $apparaatstmt = $conn->prepare($apparaatquery);
                $apparaatstmt->execute(['apparaat' => $apparaat]);
                $apparaatresult = $apparaatstmt->fetch();

                if ($apparaatresult) {
                    $apparaat_id = $apparaatresult['item_id'];

                    if(isset($_POST['email_type'])){
                        $email_type = $_POST['email_type'];

                        $sql_lening = ($email_type == "student") ? 
                        "INSERT INTO `UITLENING` (`uitleen_datum`, `inlever_datum`, `isOpgehaald`, `isVerlengd`, `emailSTUDENT`) VALUES (:uitDatum, :inDatum, '0', '0', :email)" :
                        "INSERT INTO `UITLENING` (`uitleen_datum`, `inlever_datum`, `isOpgehaald`, `isVerlengd`, `emailDOCENT`) VALUES (:uitDatum, :inDatum, '0', '0', :email)";

                        $stmt_lening = $conn->prepare($sql_lening);
                        if($stmt_lening->execute(['uitDatum' => $uitDatum, 'inDatum' => $inDatum, 'email' => $email])){
                            $uitleen_id = $conn->lastInsertId();

                            // Check of exemplaar beschikbaar is
                            $exemplaarquery = "SELECT exemplaar_item_id FROM EXEMPLAAR_ITEM WHERE isUitgeleend = '0' AND item_id = :apparaat_id LIMIT 1";
                            $exemplaarstmt = $conn->prepare($exemplaarquery);
                            $exemplaarstmt->execute(['apparaat_id' => $apparaat_id]);
                            $exemplaarresult = $exemplaarstmt->fetch();

                            if ($exemplaarresult) {
                                $exemplaar_id = $exemplaarresult['exemplaar_item_id'];

                                // voeg toe aan UITGELEEND_ITEM
                                $sql_uitgeleend_item = "INSERT INTO `UITGELEEND_ITEM` (`isVerlengd`, `exemplaar_item_id`, `uitleen_id`) VALUES ('0', :exemplaar_id, :uitleen_id)";
                                $stmt_item = $conn->prepare($sql_uitgeleend_item);

                                if($stmt_item->execute(['exemplaar_id' => $exemplaar_id, 'uitleen_id' => $uitleen_id])){
                                    // Update EXEMPLAAR_ITEM isUitgeleend status
                                    $update_query = "UPDATE `EXEMPLAAR_ITEM` SET `isUitgeleend` = '1' WHERE `exemplaar_item_id` = :exemplaar_id";
                                    $update_stmt = $conn->prepare($update_query);
                                    
                                    if($update_stmt->execute(['exemplaar_id' => $exemplaar_id])){
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
    } 
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
