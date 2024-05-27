<?php
include '../database.php';

$date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');

// Updated query to join UITLENING, UITGELEEND_ITEM, and ITEM tables
$query = "SELECT ui.uitleen_id, ui.uitleen_datum, ui.inlever_datum, ui.isOpgehaald, ui.emailSTUDENT, ui.emailDOCENT, it.naam
          FROM UITLENING ui
          INNER JOIN UITGELEEND_ITEM uit ON ui.uitleen_id = uit.uitleen_id
          INNER JOIN ITEM it ON it.item_id = it.item_id
          WHERE ui.uitleen_datum = '$date'
          ORDER BY ui.emailSTUDENT";
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
    $naam = $row['naam']; // Fetching the naam from the ITEM table
    $status = displayStatus($isOpgehaald);

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

function displayStatus($status) {
    return $status === 'Nee' ? 'Inleveren' : 'Ophalen';
}
?>
