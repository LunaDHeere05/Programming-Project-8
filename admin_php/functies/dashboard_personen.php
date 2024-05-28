<?php
include '../database.php';

$date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');

// Updated query to join UITLENING, UITGELEEND_ITEM, EXEMPLAAR_ITEM, and ITEM tables
$query = "SELECT ui.uitleen_id, ui.uitleen_datum, ui.inlever_datum, uit.isOpgehaald, ui.email, it.naam
          FROM UITLENING ui
          INNER JOIN UITGELEEND_ITEM uit ON ui.uitleen_id = uit.uitleen_id
          INNER JOIN EXEMPLAAR_ITEM ei ON uit.exemplaar_item_id = ei.exemplaar_item_id
          INNER JOIN ITEM it ON ei.item_id = it.item_id
          WHERE ui.uitleen_datum = '$date' OR ui.inlever_datum = '$date'
          ORDER BY ui.email";

$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

while ($row = mysqli_fetch_assoc($result)) {
    $uitleen_id = $row['uitleen_id'];
    $uitleen_datum = $row['uitleen_datum'];
    $inlever_datum = $row['inlever_datum'];
    $isOpgehaald = $row['isOpgehaald'] ? "Ja" : "Nee";
    $email = $row['email'];
    $naam = $row['naam']; // Fetching the naam from the ITEM table
    $status;
    
    if ($row['isOpgehaald'] == 1) {
        $status = 'In te leveren';
    } else {
        $status = 'Op te halen';
    }

    echo "<div class='uitleningen_dashboard_details'>
            <div class='naam_reservatieID'>
                <h3>$email</h3>
                <h3>Reservatie-ID: <span>$uitleen_id</span></h3>
            </div>
            <h3>Apparaat: $naam</h3>
            <p>$status</p>
            <div class='iconen'>
                <img class='schroevendraaier' src='images/svg/screwdriver-wrench-solid.svg' alt=''>
                <img class='check' src='images/svg/circle-check-solid.svg' alt=''>
                <img class='verwijder_btn' src='images/svg/circle-xmark-solid.svg' alt=''>
            </div>
          </div>";
}

mysqli_close($conn);
?>
