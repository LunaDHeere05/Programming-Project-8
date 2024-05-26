<?php

include("database.php");



if (isset($_GET['item_id']))
{
    // Get the item_id from the POST request
    $item_id = $_GET['item_id'];
    echo $item_id;
    // Add a new row to the EXEMPLAAR_ITEM table
    $addExemplaarItemQuery = "INSERT INTO EXEMPLAAR_ITEM (item_id, isUitgeleend, zichtbaarheid) VALUES ('$item_id', 0, 1)";
    if ($conn->query($addExemplaarItemQuery) === TRUE) {
        echo "Record added successfully";
    } else {
        echo "Error adding record: " . $conn->error;
    }

    // Get the last inserted exemplaar_item_id
    $exemplaar_item_id = $conn->insert_id;
    // Send exemplaar_id to InventarisExemplaars.php
    header("Location: InventarisExemplaars.php?exemplaar_id=$exemplaar_item_id&item_id=$item_id");
    exit;

}