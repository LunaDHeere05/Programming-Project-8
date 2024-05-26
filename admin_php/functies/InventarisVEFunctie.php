<?php

include("../database.php");

if (isset($_GET['exemplaar_item_id']))
{
    
    $exemplaar_item_id = $_GET['exemplaar_item_id'];
    $item_id = $_GET['item_id'];
    $deleteExemplaarItemQuery = "DELETE FROM EXEMPLAAR_ITEM WHERE exemplaar_item_id='$exemplaar_item_id'";
    if ($conn->query($deleteExemplaarItemQuery) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    header("Location: ../InventarisExemplaars.php?item_id=$item_id");
}