<?php 
// Database credentials
include 'database.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['bevestig_button'])) {
        // Sanitize and validate inputs
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $apparaat = filter_input(INPUT_POST, "apparaat", FILTER_SANITIZE_SPECIAL_CHARS);
        $uitDatum = date("Y-m-d");
        
        if (empty($email) || empty($apparaat)) {
            echo "Vul alle velden in!";
        } else {
            // Check if the email exists
            $emailquery = "SELECT email FROM PERSOON WHERE email = :email";
            $emailstmt = $conn->prepare($emailquery);
            $emailstmt->execute(['email' => $email]);
            $emailResult = $emailstmt->fetch();
        
            if ($emailResult) {
                $inDatum = $_POST['datum'];
        
                // Check if the device is an item or kit and get its ID
                $itemquery = "SELECT 'item' AS type, item_id AS id FROM ITEM WHERE naam = :apparaat UNION SELECT 'kit' AS type, kit_id AS id FROM KIT WHERE naam = :apparaat";
                $itemstmt = $conn->prepare($itemquery);
                $itemstmt->execute(['apparaat' => $apparaat]);
                $itemresult = $itemstmt->fetch();
        
                if ($itemresult) {
                    $apparaat_id = $itemresult['id'];
                    $apparaat_type = $itemresult['type'];
                
                    // Get the correct exemplaar_item_id from EXEMPLAAR_ITEM table
                    $exemplaarquery = "SELECT exemplaar_item_id FROM EXEMPLAAR_ITEM WHERE item_id = :apparaat_id";
                    $exemplaarstmt = $conn->prepare($exemplaarquery);
                    $exemplaarstmt->execute(['apparaat_id' => $apparaat_id]);
                    $exemplaarresult = $exemplaarstmt->fetch();
                
                    if ($exemplaarresult) {
                        $exemplaar_item_id = $exemplaarresult['exemplaar_item_id'];
                
                        // exemplaar_item_id exists, proceed with the insertion
                        $sql_lening = "INSERT INTO `UITLENING` (`uitleen_datum`, `inlever_datum`, `isVerlengd`, `email`, `exemplaar_item_id`) VALUES (:uitDatum, :inDatum, '0', :email, :exemplaar_item_id)";
                        $stmt_lening = $conn->prepare($sql_lening);
                        if ($stmt_lening->execute(['uitDatum' => $uitDatum, 'inDatum' => $inDatum, 'email' => $email, 'exemplaar_item_id' => $exemplaar_item_id])) {
                            $uitleen_id = $conn->lastInsertId();
                            echo "Uitlening successvol toegevoegd met ID: " . $uitleen_id;
                        } else {
                            echo "Uitlening toevoegen ging fout.";
                        }
                    } else {
                        // exemplaar_item_id doesn't exist, handle this case
                        echo "Dit exemplaar bestaat niet, check op spellingsfouten !";
                    }
                }
            }
        }
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
