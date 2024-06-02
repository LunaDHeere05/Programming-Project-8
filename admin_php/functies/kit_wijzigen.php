<?php
include '../database.php';

if(isset($_POST['kit_naam'], $_POST['kit_id'], $_POST['item_id'])){
    $kit_naam = $_POST['kit_naam'];
    $kit_id = $_POST['kit_id'];
    $item_id = $_POST['item_id'];

    //query to update the kit name
    $query = "UPDATE KIT SET naam = '$kit_naam' WHERE kit_id = $kit_id";
    $result = mysqli_query($conn, $query);

    //query to delete all rows from ITEM_KIT table with the kit_id
    $query = "DELETE FROM ITEM_KIT WHERE kit_id = $kit_id";
    $result = mysqli_query($conn, $query);

    // insert a new row for each item_id in the ITEM_KIT table with the kit_id
    foreach($item_id as $id){
        $query = "INSERT INTO ITEM_KIT (kit_id, item_id) VALUES ($kit_id, $id)";
        $result = mysqli_query($conn, $query);
    }
}

$conn->close();
header('Location: ../Kits.php');