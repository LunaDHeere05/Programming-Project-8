<?php

include '../database.php';

// Check if the form is submitted
if (isset($_POST['submitForm'])) {
    $apparaat = $_POST['apparaat_naam'];
    $merk = $_POST['merk'];
    $categorie = $_POST['categorie'];
    $beschrijving = $_POST['beschrijving'];
    $image = $_FILES['image']['name'];
    $link = $_POST['link'];
    $functionaliteit = $_POST['functionaliteit'];

    // Check if there is already a row with the same apparaat_naam
    $checkQuery = "SELECT * FROM ITEM WHERE naam = '$apparaat' AND merk = '$merk'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // If a row already exists, add a new item in EXEMPLAAR_ITEM
        $getItemIdQuery = "SELECT item_id FROM ITEM WHERE naam = '$apparaat' AND merk = '$merk'";
        $item_id = $conn->query($getItemIdQuery)->fetch_assoc()['item_id'];

        $exemplaarItemQuery = "INSERT INTO EXEMPLAAR_ITEM (item_id) VALUES ('$item_id')";
        $conn->query($exemplaarItemQuery);
    } else {
        // If no row exists, make a new row in ITEM and a new row in EXEMPLAAR_ITEM
        $imagequery = "INSERT INTO Images (image) VALUES ('$image')";
        $conn->query($imagequery);
        $image_id = $conn->insert_id;

        $itemQuery = "INSERT INTO ITEM (naam, merk, categorie, beschrijving, gebruiksaanwijzing, image_id) VALUES ('$apparaat','$merk','$categorie','$beschrijving', '$link', '$image_id')";
        if ($conn->query($itemQuery) === TRUE) {
            $item_id = $conn->insert_id;

            // Get the auto-generated item_id from the newly created row
            $exemplaarItemQuery = "INSERT INTO EXEMPLAAR_ITEM (item_id) VALUES ('$item_id')";
            $conn->query($exemplaarItemQuery);

            foreach ($functionaliteit as $func) {
                $functionaliteitQuery = "INSERT INTO FUNCTIONALITEIT (item_id, functionaliteit) VALUES ('$item_id', '$func')";
                $conn->query($functionaliteitQuery);
            }
        }
    }

    $conn->close();
    header('Location: ../Inventaris.php');
}
