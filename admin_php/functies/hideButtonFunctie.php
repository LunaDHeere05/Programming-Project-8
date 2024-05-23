<?php

include '../database.php';

$value = $_GET['value'];
$item_id = $_GET['item_id'];

if(isset($value) && isset($item_id)){
    $query = "SELECT * FROM EXEMPLAAR_ITEM WHERE item_id = $item_id";
    $result = $conn->query($query);
    if($result->num_rows > 0){
        if($value == 1){ // item is hidden
            $query = "UPDATE EXEMPLAAR_ITEM SET zichtbaarheid = 0 WHERE item_id = $item_id";
            mysqli_query($conn, $query);
        }
        else if($value == 2){ // item is not hidden
            $query = "UPDATE EXEMPLAAR_ITEM SET zichtbaarheid = 1 WHERE item_id = $item_id";
            mysqli_query($conn, $query);
        }
    }
    $conn->close();
    header('Location: ../Inventaris.php');
}