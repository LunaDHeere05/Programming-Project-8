<?php
include '../database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $exemplaar_id = $_POST['exemplaar_id'];
    $beschrijving = $_POST['beschrijving'];
    $eye_state = $_POST['eye_state']; // Assuming you have a hidden input to store the eye state

    // niet zeker wat dit doet met de ?1 :0;
    $bruikbaarheid = ($eye_state == 'solid') ? 1 : 0;

    $sql = "INSERT INTO DEFECT (beschrijving, datum, bruikbaarheid, exemplaar_item_id)
            VALUES ('$beschrijving', NOW(), '$bruikbaarheid', '$exemplaar_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Defect successfully added!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>