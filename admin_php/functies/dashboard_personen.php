<?php
include '../database.php';

$date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');

$query = "SELECT uitleen_id, uitleen_datum, inlever_datum, isOpgehaald, emailSTUDENT, emailDOCENT FROM UITLENING WHERE uitleen_datum = '$date'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

while ($row = mysqli_fetch_assoc($result)) {
    $uitleen_id = $row['uitleen_id'];
    $uitleen_datum = $row['uitleen_datum'];
    $inlever_datum = $row['inlever_datum'];
    $isOpgehaald = $row['isOpgehaald'] ? "Ja" : "Nee";
    $email = $row['emailSTUDENT'] ?: $row['emailDOCENT'];
    $apparaat = "Placeholder Apparaat"; // Replace this with the actual device name if available from another table
    
    echo "<div class='uitleningen_dashboard_details'>
            <div class='naam_reservatieID'>
                <h3>$email</h3>
                <h3>Reservatie-ID: <span>$uitleen_id</span></h3>
            </div>
            <h3>Apparaat: $apparaat</h3>
            <p>Ophalen: $isOpgehaald</p>
            <div class='iconen'>
            <img class='schroevendraaier' src='images/svg/screwdriver-wrench-solid.svg' alt=''>
            <img class='check' src='images/svg/circle-check-solid.svg' alt=''>
            <img class='verwijder_btn' src='images/svg/circle-xmark-solid.svg' alt=''>
            </div>
          </div>";
}
?>
