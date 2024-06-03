<?php

include '../database.php';
include '../ftp_server.php';

// Check if the form is submitted
if (isset($_POST['submitForm'])) {
    $apparaat = $_POST['apparaat_naam'];
    $merk = $_POST['merk'];
    $categorie = $_POST['categorie'];
    $beschrijving = $_POST['beschrijving'];
    $image = $_FILES['image']['name'];
    $usermanual = $_FILES['handleiding'];
    $functionaliteit = $_POST['functionaliteit'];
    $in_doos = $_POST['in_doos'];

    // Check if there is already a row with the same apparaat_naam
    $checkQuery = $conn->prepare("SELECT * FROM ITEM WHERE naam = ? AND merk = ?");
    $checkQuery->bind_param("ss", $apparaat, $merk);
    $checkQuery->execute();
    $checkResult = $checkQuery->get_result();

    if ($checkResult->num_rows > 0) {
        // If a row already exists, add a new item in EXEMPLAAR_ITEM
        $getItemIdQuery = $conn->prepare("SELECT item_id FROM ITEM WHERE naam = ? AND merk = ?");
        $getItemIdQuery->bind_param("ss", $apparaat, $merk);
        $getItemIdQuery->execute();
        $item_id = $getItemIdQuery->get_result()->fetch_assoc()['item_id'];

        $exemplaarItemQuery = $conn->prepare("INSERT INTO EXEMPLAAR_ITEM (item_id) VALUES (?)");
        $exemplaarItemQuery->bind_param("s", $item_id);
        $exemplaarItemQuery->execute();
    } else {
        //Upload the image to the server
        $file = $_FILES['image'];
        $ftpDirectory = '/www/images/';
        ftp_pasv($ftpConnection, true);

        if (ftp_put($ftpConnection, $ftpDirectory . $file['name'], $file['tmp_name'], FTP_BINARY)) {
            $fileUrl = 'http://www.ppgroep8.be/images/' . $file['name'];
        }

        //Upload the usermanual to the server
        $file = $_FILES['handleiding'];
        $ftpDirectory = '/www/handleidingen/';
        ftp_pasv($ftpConnection, true);
        
        if (ftp_put($ftpConnection, $ftpDirectory . $file['name'], $file['tmp_name'], FTP_BINARY)) {
            $manualLink = 'http://www.ppgroep8.be/handleidingen/' . $file['name'];
        }

        $itemQuery = $conn->prepare("INSERT INTO ITEM (naam, merk, categorie, beschrijving, gebruiksaanwijzing, images) VALUES (?, ?, ?, ?, ?, ?)");
        $itemQuery->bind_param("ssssss", $apparaat, $merk, $categorie, $beschrijving, $manualLink, $fileUrl);
        if ($itemQuery->execute()) {
            $item_id = $conn->insert_id;

            // Get the auto-generated item_id from the newly created row
            $exemplaarItemQuery = $conn->prepare("INSERT INTO EXEMPLAAR_ITEM (item_id) VALUES (?)");
            $exemplaarItemQuery->bind_param("s", $item_id);
            $exemplaarItemQuery->execute();

            foreach ($functionaliteit as $func) {
                $functionaliteitQuery = $conn->prepare("INSERT INTO FUNCTIONALITEIT (item_id, functionaliteit) VALUES (?, ?)");
                $functionaliteitQuery->bind_param("ss", $item_id, $func);
                $functionaliteitQuery->execute();
            }

            foreach ($in_doos as $doos) {
                $inDoosQuery = $conn->prepare("INSERT INTO ITEMBUNDEL (item_id, accessoire) VALUES (?, ?)");
                $inDoosQuery->bind_param("ss", $item_id, $doos);
                $inDoosQuery->execute();
            }
        }

        // Close the FTP connection
        ftp_close($ftpConnection);
    }

    $conn->close();
    header('Location: ../Inventaris.php');
}
