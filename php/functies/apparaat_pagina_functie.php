<?php
include 'database.php';

if(isset($_GET['apparaat_id'])){
    $item_id = $_GET['apparaat_id'];
    $item_query = "SELECT item_id naam, merk, beschrijving FROM ITEM WHERE item_id = $item_id";
    $item_result = mysqli_query($conn, $item_query);

    if($item_result && mysqli_num_rows($item_result) > 0){
        $item_row = mysqli_fetch_assoc($item_result);

        echo '<h2>'.$item_row['merk']. ' - ' .$item_row['naam'].'</h2>';
        echo '<p>' . $item_row['beschrijving'] . '</p>';
    }
    else{
        echo 'Geen informatie gevonden voor dit item.';
    }

    // Code toevoegen om de beschikbaarheid van het item op te halen en weer te geven
    $availability_query = "SELECT UITGELEEND_ITEM.inlever_datum, UITLENING.uitleen_datum
                    FROM UITGELEEND_ITEM
                    LEFT JOIN UITLENING ON UITGELEEND_ITEM.uitleen_id = UITLENING.uitleen_id
                    WHERE UITGELEEND_ITEM.item_id = $item_id";
    $availability_result = mysqli_query($conn, $availability_query);

    if($availability_result && mysqli_num_rows($availability_result) > 0){
        $availability_row = mysqli_fetch_assoc($availability_result);

        if ($availability_row['inlever_datum'] != null) {
            echo '<p>Dit item is niet beschikbaar tot ' . $availability_row['inlever_datum'] . '</p>';
        } else {
            echo '<p>Dit item is beschikbaar</p>';
        }
    }
    else{
        echo 'Geen informatie over beschikbaarheid gevonden voor dit item.';
    }
}
else{
    echo "Geen item-id meegegeven in de URL.";
}

mysqli_close($conn);
?>
