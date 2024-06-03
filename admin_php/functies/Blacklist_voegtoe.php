<?php 
include 'database.php';

if(isset($_POST['voegToeButton'])){
if(isset($_POST['email'])&&isset($_POST['reden'])){
    $email = htmlspecialchars($_POST['email']);
    $reden = htmlspecialchars($_POST['reden']);
    $huidigeDatum = date("Y-m-d");
    
    // $query = "INSERT INTO WAARSCHUWING (`waarschuwing_id`, `waarschuwingDatum`, `waarschuwingsType`, `email`, `exemplaar_item_id`) 
    // VALUES (NULL, $huidigeDatum, $reden, $email, NULL)";

    $query = "INSERT INTO WAARSCHUWING (`waarschuwing_id`, `waarschuwingDatum`, `waarschuwingsType`, `email`, `exemplaar_item_id`) 
              VALUES (NULL, ?, ?, ?, NULL)";
    
    if ($stmt = $conn->prepare($query)) {
        for ($i = 0; $i < 2; $i++) {
            $stmt->bind_param("sss", $huidigeDatum, $reden, $email);
            if ($stmt->execute()) {
                echo "Rij $i: Student is toegevoegd aan de blacklist<br>";
            } else {
                echo "Rij $i: Er is iets fout gegaan: " . $stmt->error . "<br>";
            }
        }
        $stmt->close();
    } else {
        echo "Er is iets fout gegaan bij het voorbereiden van de query: " . $conn->error;
    }

    echo "$email is toegevoegd aan de blacklist.";
}
$conn->close();
}
?>