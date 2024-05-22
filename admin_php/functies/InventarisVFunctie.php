<?php

include("../database.php");

$item_id = $_POST['item_id'];
$apparaat = $_POST['apparaat_naam'];
$merk = $_POST['merk'];
$categorie = $_POST['categorie'];
$beschrijving = $_POST['beschrijving'];
$image = $_FILES['image']['name'];
$link = $_POST['link'];
$functionaliteit = $_POST['functionaliteit'];

echo $item_id;
echo $apparaat;
echo $merk;
echo $categorie;
echo $beschrijving;
echo $image;
echo $link;

// Delete EXEMPLAAR_ITEM rows
$deleteExemplaarItemQuery = "DELETE FROM EXEMPLAAR_ITEM WHERE item_id='$item_id'";

if ($conn->query($deleteExemplaarItemQuery) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

// Delete FUNCTIONALITEIT rows
$deleteFunctionaliteitQuery = "DELETE FROM FUNCTIONALITEIT WHERE item_id='$item_id'";
if ($conn->query($deleteFunctionaliteitQuery) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

// Get image_id from ITEM table
$imageIdQuery = "SELECT image_id FROM ITEM WHERE item_id='$item_id'";
$result = $conn->query($imageIdQuery);
$row = $result->fetch_assoc();
$image_id = $row['image_id'];

// Delete ITEM row
$deleteItemQuery = "DELETE FROM ITEM WHERE item_id='$item_id'";
if ($conn->query($deleteItemQuery) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

// Delete IMAGE row
$deleteImageQuery = "DELETE FROM Images WHERE image_id='$image_id'";
if ($conn->query($deleteImageQuery) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}