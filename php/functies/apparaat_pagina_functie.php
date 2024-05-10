<?php
include 'database.php';

if(isset($_GET['apparaat_id'])){
    $item_id = $_GET['apparaat_id'];
    $item = "SELECT naam, merk FROM ITEM WHERE item_id = $item_id";
    $item_result = mysqli_query($conn, $item);

    if($item_result){
        $item_row = mysqli_fetch_assoc($item_result);

        if($item_row){
            echo '<h2>'.$item_row['merk']. ' - ' .$item_row['naam'].'</h2>';
        }
    }
    else{
        echo 'Geen resultaten gevonden';
    }

}
mysqli_close($conn);
?>