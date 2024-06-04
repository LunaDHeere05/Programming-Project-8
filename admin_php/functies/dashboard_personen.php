<?php
include '../database.php';

$date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');

// Check if the selected date is a Friday

$query = "SELECT ui.*, it.naam, it.merk
          FROM UITLENING ui
          INNER JOIN EXEMPLAAR_ITEM ei ON ui.exemplaar_item_id = ei.exemplaar_item_id
          INNER JOIN ITEM it ON ei.item_id = it.item_id
          ORDER BY ui.email";

$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

if(mysqli_num_rows($result)>0){

while ($row = mysqli_fetch_assoc($result)) {
    $uitleen_id = $row['uitleen_id'];
    $uitleen_datum = $row['uitleen_datum'];
    $inlever_datum = $row['inlever_datum'];
    $isOpgehaald = $row['isOpgehaald'];
    $email = $row['email'];
    $naam = $row['naam'];
    $merk = $row['merk'];

    //checken of uitlening bij waarschuwingen staat - indien wel komt die bij elke dag te staan
    $queryWaarschuwing= "SELECT * 
    FROM WAARSCHUWING w
    WHERE uitleen_id=$uitleen_id AND waarschuwingsType='te laat'";
    $queryWaarschuwing_result = mysqli_query($conn, $queryWaarschuwing);

    $zitInWaarschuwing=false;

    if(mysqli_num_rows($queryWaarschuwing_result)>0){
        $zitInWaarschuwing=true;
    $queryWaarschuwing_row=mysqli_fetch_assoc($queryWaarschuwing_result);
    $waarschuwingDatum=$queryWaarschuwing_row['waarschuwingDatum'];
    $geformatteerdeDatum = date("d-m", strtotime($waarschuwingDatum));
    }

if($zitInWaarschuwing==true){ //uitlening nog steeds niet teruggebracht -> BELANGRIJK
        echo "<div style='background-color:#FFCCCB;color:red;' class='uitleningen_dashboard_details'>
        <div class='naam_reservatieID'>
            <h3 class'email'>$email</h3>
            <h3>Reservatie-ID: <span>$uitleen_id</span></h3>
        </div>
        <h3> $merk - $naam</h3>
        <p><strong> Uitlening niet ingeleverd ($geformatteerdeDatum)</strong></p>
        <div class='iconen'>
        <a href='DefectToevoegen.php'><img class='schroevendraaier' src='images/svg/screwdriver-wrench-solid.svg' alt=''></a>
            <img class='check' src='images/svg/circle-check-solid.svg' alt=''>
        </div>
      </div>";
    }else{
    if($uitleen_datum=="$date" && $isOpgehaald==0){
    echo "<div class='uitleningen_dashboard_details'>
            <div class='naam_reservatieID'>
                <h3 class'email'>$email</h3>
                <h3>Reservatie-ID: <span>$uitleen_id</span></h3>
            </div>
            <h3> $merk - $naam</h3>
            <p>Op te halen</p>
            <div class='iconen'>
            <a href='DefectToevoegen.php'><img class='schroevendraaier' src='images/svg/screwdriver-wrench-solid.svg' alt=''></a>
                <img class='check' src='images/svg/circle-check-solid.svg' alt=''>
                <img class='verwijder_btn' src='images/svg/circle-xmark-solid.svg' alt=''>
            </div>
          </div>";
    }else if($inlever_datum=="$date" && $isOpgehaald==1){
        echo "<div class='uitleningen_dashboard_details'>
        <div class='naam_reservatieID'>
            <h3 class'email'>$email</h3>
            <h3>Reservatie-ID: <span>$uitleen_id</span></h3>
        </div>
        <h3>$merk - $naam</h3>
        <p>In te leveren</p>
        <div class='iconen'>
            <a href='DefectToevoegen.php'><img class='schroevendraaier' src='images/svg/screwdriver-wrench-solid.svg'></a>
            <img class='check' src='images/svg/circle-check-solid.svg' alt=''>
            <img class='verwijder_btn' src='images/svg/circle-xmark-solid.svg' alt=''>
        </div>
      </div>";
    }
}
}
}

mysqli_close($conn);
?>


