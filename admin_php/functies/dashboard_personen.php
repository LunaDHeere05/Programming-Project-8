<?php
include '../database.php';

$date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');

// Check if the selected date is a Friday

$query = "SELECT ui.*, it.naam, it.merk
          FROM UITLENING ui
          INNER JOIN EXEMPLAAR_ITEM ei ON ui.exemplaar_item_id = ei.exemplaar_item_id
          INNER JOIN ITEM it ON ei.item_id = it.item_id
          WHERE (ui.uitleen_datum = '$date' OR ui.inlever_datum = '$date')
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
    WHERE uitleen_id=$uitleen_id";
    $queryWaarschuwing_result = mysqli_query($conn, $queryWaarschuwing);

    $zitInWaarschuwing=false;

    if(mysqli_num_rows($queryWaarschuwing_result)>0){
        $zitInWaarschuwing=true;
    $queryWaarschuwing_row=mysqli_fetch_assoc($queryWaarschuwing_result);
    $waarschuwingDatum=$queryWaarschuwing_row['waarschuwingDatum'];
    $geformatteerdeDatum = date("d-m-y", strtotime($waarschuwingDatum));
    }
    
if($zitInWaarschuwing==false){
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
}else if($zitInWaarschuwing==true && $isOpgehaald==1){ //uitlening nog steeds niet teruggebracht -> BELANGRIJK
    echo "<div style='background-color:#FFCCCB;color:red;' class='uitleningen_dashboard_details'>
    <div class='naam_reservatieID'>
        <h3 class'email'>$email</h3>
        <h3>Reservatie-ID: <span>$uitleen_id</span></h3>
    </div>
    <h3> $merk - $naam</h3>
    <p><strong> Uitlening niet ingeleverd sinds $geformatteerdeDatum</strong></p>
    <div class='iconen'>
    <a href='DefectToevoegen.php'><img class='schroevendraaier' src='images/svg/screwdriver-wrench-solid.svg' alt=''></a>
        <img class='check' src='images/svg/circle-check-solid.svg' alt=''>
    </div>
  </div>";


}
}
}else{
    $queryWaarschuwing= "SELECT * 
    FROM WAARSCHUWING w
    WHERE waarschuwingsType='te laat'";
    $queryWaarschuwing_result = mysqli_query($conn, $queryWaarschuwing); 

    if(mysqli_num_rows($queryWaarschuwing_result)>0){

       while($queryWaarschuwing_row=mysqli_fetch_assoc($queryWaarschuwing_result)){

        $waarschuwingDatum=$queryWaarschuwing_row['waarschuwingDatum'];
        $geformatteerdeDatum = date("d-m-y", strtotime($waarschuwingDatum));

        $uitleenId=$queryWaarschuwing_row['uitleen_id'];

        $waarschuwingen = "SELECT ui.*, it.naam, it.merk
        FROM UITLENING ui
        INNER JOIN EXEMPLAAR_ITEM ei ON ui.exemplaar_item_id = ei.exemplaar_item_id
        INNER JOIN ITEM it ON ei.item_id = it.item_id
        WHERE uitleen_id='$uitleenId'";

        $waarschuwingen_result = mysqli_query($conn, $waarschuwingen);  

        while($waarschuwingen_row=mysqli_fetch_assoc($waarschuwingen_result)){
            $uitleen_id = $waarschuwingen_row['uitleen_id'];
            $isOpgehaald = $waarschuwingen_row['isOpgehaald'];
            $email = $waarschuwingen_row['email'];
            $naam = $waarschuwingen_row['naam'];
            $merk = $waarschuwingen_row['merk'];

            echo "<div style='background-color:#FFCCCB;color:red;' class='uitleningen_dashboard_details'>
            <div class='naam_reservatieID'>
                <h3 class'email'>$email</h3>
                <h3>Reservatie-ID: <span>$uitleen_id</span></h3>
            </div>
            <h3> $merk - $naam</h3>
            <p><strong> Uitlening niet ingeleverd sinds $geformatteerdeDatum </strong></p>
            <div class='iconen'>
            <a href='DefectToevoegen.php'><img class='schroevendraaier' src='images/svg/screwdriver-wrench-solid.svg' alt=''></a>
                <img class='check' src='images/svg/circle-check-solid.svg' alt=''>
            </div>
          </div>";
        }
        }
   
    }else{
        echo "<h3> Er zijn vandaag geen uitleningen of inleveringen.";
    }

}
mysqli_close($conn);
?>


