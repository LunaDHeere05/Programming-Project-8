<?php
include '../database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $exemplaar_id = $_POST['exemplaar_id'];
    $beschrijving = $_POST['beschrijving'];
    $eye_state = $_POST['eye_state']; // Assuming you have a hidden input to store the eye state

    // niet zeker wat dit doet met de ?1 :0;
    $bruikbaarheid = ($eye_state == 'solid') ? 1 : 0;

    // Check if the exemplaar_item_id exists in the EXEMPLAAR_ITEM table
    $check_exemplaar_query = "SELECT exemplaar_item_id FROM EXEMPLAAR_ITEM WHERE exemplaar_item_id = '$exemplaar_id'";
    $result = $conn->query($check_exemplaar_query);

    if ($result->num_rows > 0) {
        // The exemplaar_item_id exists, proceed with the insertion
        $sql = "INSERT INTO DEFECT (beschrijving, datum, exemplaar_item_id)
                VALUES ('$beschrijving', NOW(), '$exemplaar_id')";
        $sql_defect = "UPDATE EXEMPLAAR_ITEM SET zichtbaarheid = '$bruikbaarheid' WHERE exemplaar_item_id = '$exemplaar_id'";

        if ($conn->query($sql) === TRUE && $conn->query($sql_defect) === TRUE) {
            // Redirect to the previous page or any other page as needed
            header("Location: ../Defect.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // The exemplaar_item_id does not exist in the EXEMPLAAR_ITEM table
        echo "<script>alert('Exemplaar item bestaat niet.');</script>";
    }
}
?>
