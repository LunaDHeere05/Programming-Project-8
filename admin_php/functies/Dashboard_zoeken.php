<?php 
include 'database.php';
$date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');

if (isset($_GET['zoekButton'])) {
    $zoek_query = $_GET['zoekquery'];
    if (!empty($zoek_query)) { // Controleer of de zoekopdracht niet leeg is
        $zoek_query = mysqli_real_escape_string($conn, $zoek_query);
        $zoek_resultaat = "SELECT u.email, u.*, ei.exemplaar_item_id, i.merk, i.naam
                            FROM UITLENING u
                            JOIN EXEMPLAAR_ITEM ei ON u.exemplaar_item_id = ei.exemplaar_item_id
                            JOIN ITEM i ON ei.item_id = i.item_id
                            WHERE u.email LIKE '%$zoek_query%' OR u.uitleen_id LIKE '%$zoek_query%' OR i.merk LIKE '%$zoek_query%' OR i.naam LIKE '%$zoek_query%'";

        $zoek_uitvoering_resultaat = mysqli_query($conn, $zoek_resultaat);

        if ($zoek_uitvoering_resultaat) {
            if (mysqli_num_rows($zoek_uitvoering_resultaat) > 0) {
        while ($row = mysqli_fetch_assoc($zoek_uitvoering_resultaat)) {
    $uitleen_id = $row['uitleen_id'];
    $uitleen_datum = $row['uitleen_datum'];
    $inlever_datum = $row['inlever_datum'];
    $isOpgehaald = $row['isOpgehaald'];
    $email = $row['email'];
    $naam = $row['naam'];
    $merk = $row['merk'];
   
    $geformatteerdeUitleenDatum = date("d-m", strtotime($uitleen_datum));
    $geformatteerdeInleverDatum = date("d-m", strtotime($inlever_datum));

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
    if($isOpgehaald==0){
    echo "<div class='uitleningen_dashboard_details'>
            <div class='naam_reservatieID'>
                <h3 class'email'>$email</h3>
                <h3>Reservatie-ID: <span>$uitleen_id</span></h3>
            </div>
            <h3> $merk - $naam</h3>
            <p>Op te halen ($geformatteerdeUitleenDatum)</p>
            <div class='iconen'>
            <a href='DefectToevoegen.php'><img class='schroevendraaier' src='images/svg/screwdriver-wrench-solid.svg' alt=''></a>
                <img class='check' src='images/svg/circle-check-solid.svg' alt=''>
                <img class='verwijder_btn' src='images/svg/circle-xmark-solid.svg' alt=''>
            </div>
          </div>";
    }else if($isOpgehaald==1){
        echo "<div class='uitleningen_dashboard_details'>
        <div class='naam_reservatieID'>
            <h3 class'email'>$email</h3>
            <h3>Reservatie-ID: <span>$uitleen_id</span></h3>
        </div>
        <h3>$merk - $naam</h3>
        <p>In te leveren ($geformatteerdeInleverDatum)</p>
        <div class='iconen'>
            <a href='DefectToevoegen.php'><img class='schroevendraaier' src='images/svg/screwdriver-wrench-solid.svg'></a>
            <img class='check' src='images/svg/circle-check-solid.svg' alt=''>
            <img class='verwijder_btn' src='images/svg/circle-xmark-solid.svg' alt=''>
        </div>
      </div>";
    }
}
                }
                echo "<style>.agenda_container { display: none; }</style>";
            } else {
                echo "Geen resultaten gevonden";
            }
        } else {
            echo "Query failed: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
