<?php
include 'database.php';

if(isset($_GET['apparaat_id'])){
    $item_id = $_GET['apparaat_id'];
    $item_query = "SELECT item_id, naam, merk, beschrijving FROM ITEM WHERE item_id = $item_id";
    $item_result = mysqli_query($conn, $item_query);

    if($item_result && mysqli_num_rows($item_result) > 0){
        $item_row = mysqli_fetch_assoc($item_result);

        echo '<h2>'.$item_row['merk']. ' - ' .$item_row['naam'].'</h2>';
        echo '<p class="beschrijving">' . $item_row['beschrijving'] . '</p> ';
      
    }
    else{
        echo 'Geen informatie gevonden voor dit item.';
    }

    // // Code toevoegen om de beschikbaarheid van het item op te halen en weer te geven

    $status = "SELECT EXEMPLAAR_ITEM.zichtbaarheid,EXEMPLAAR_ITEM.isUitgeleend,UITLENING.inlever_datum FROM `EXEMPLAAR_ITEM` LEFT JOIN UITGELEEND_ITEM on UITGELEEND_ITEM.exemplaar_item_id=EXEMPLAAR_ITEM.exemplaar_item_id LEFT JOIN UITLENING on UITLENING.uitleen_id=UITGELEEND_ITEM.uitleen_id WHERE ITEM_ID=$item_id";
    $status_result = mysqli_query($conn, $status);

    while ($status_row = mysqli_fetch_assoc($status_result)) { //item bestaat uit verschillende exemplaren, we gaan hier lopen over de status van elk van die exemplaren 
        $is_available = false;
        $inleveren;
        $beschikbaar = 100000;
        $vandaag = new dateTime(date("Y-m-d"));
        if ($status_row['isUitgeleend'] == 0) { //indien er minstens één exemplaar beschikbaar is, komt er "Beschikbaar" te staan
            echo "<h3 class='beschikbaar'>Beschikbaar</h3>";
            $is_available = true;
            break;
        } else { //indien alles uitgeleend is, gaan we kijken naar het exemplaar dat het vroegst weer beschikbaar is
            $inlever_datum = new dateTime($status_row['inlever_datum']);
            $interval = $vandaag->diff($inlever_datum);
            $onbeschikbaarTot = $interval->days;

            if ($beschikbaar > $onbeschikbaarTot) {
                $inleveren = $inlever_datum->format("d-m-Y");
                $beschikbaar = $onbeschikbaarTot;
            }
        }
    }
    
    if (!$is_available) {
        echo "<h3> Onbeschikbaar tot " . $inleveren . "</h3>";
        echo "<p> Binnen " . $onbeschikbaarTot . " dagen</p>";
    }

}else{
    echo "Geen item-id meegegeven in de URL.";
}

mysqli_close($conn);
?>
