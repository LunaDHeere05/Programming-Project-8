<?php

include("../database.php");

if (isset($_GET['exemplaar_item_id']))
{
    
    $exemplaar_item_id = $_GET['exemplaar_item_id'];
    $item_id = $_GET['item_id'];
    $deleteExemplaarItemQuery = "DELETE FROM EXEMPLAAR_ITEM WHERE exemplaar_item_id='$exemplaar_item_id'";
    if ($conn->query($deleteExemplaarItemQuery) === TRUE) {
        echo "Record exemplaar deleted successfully";
    } else {
        echo "Error deleting exemplaar record: " . $conn->error;
    }

    

    // Check if there are any rows with the same item_id in EXEMPLAAR_ITEM
    $checkExemplaarItemQuery = "SELECT * FROM EXEMPLAAR_ITEM WHERE item_id='$item_id'";
    $result = $conn->query($checkExemplaarItemQuery);
    if ($result->num_rows == 0) {
        // Delete FUNCTIONALITEIT rows
        $deleteFunctionaliteitQuery = "DELETE FROM FUNCTIONALITEIT WHERE item_id='$item_id'";
        if ($conn->query($deleteFunctionaliteitQuery) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }

        // Delete Recent item row
        $deleteRecentItemQuery = "DELETE FROM RECENT_ITEMS WHERE item_id='$item_id'";
        if ($conn->query($deleteRecentItemQuery) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }

        // Delete ITEM row
        $deleteItemQuery = "DELETE FROM ITEM WHERE item_id='$item_id'";
        if ($conn->query($deleteItemQuery) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
        $conn->close();
        header('Location: ../Inventaris.php');
    }

    $conn->close();
    header("Location: ../InventarisExemplaars.php?item_id=$item_id");
}