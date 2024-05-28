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

if(isset($_POST['submitForm'])){

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

    // Delete ITEM row
    $deleteItemQuery = "DELETE FROM ITEM WHERE item_id='$item_id'";
    if ($conn->query($deleteItemQuery) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    /* Delete IMAGE row
    $deleteImageQuery = "DELETE FROM Images WHERE image_id='$image_id'";
    if ($conn->query($deleteImageQuery) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }*/
    $conn->close();
    header('Location: ../Inventaris.php');

}
