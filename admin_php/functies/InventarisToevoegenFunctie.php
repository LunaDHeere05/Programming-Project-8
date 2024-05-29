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
    $checkQuery = "SELECT * FROM ITEM WHERE naam = '$apparaat' AND merk = '$merk'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // If a row already exists, add a new item in EXEMPLAAR_ITEM
        $getItemIdQuery = "SELECT item_id FROM ITEM WHERE naam = '$apparaat' AND merk = '$merk'";
        $item_id = $conn->query($getItemIdQuery)->fetch_assoc()['item_id'];

        $exemplaarItemQuery = "INSERT INTO EXEMPLAAR_ITEM (item_id) VALUES ('$item_id')";
        $conn->query($exemplaarItemQuery);
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
        
        

            $itemQuery = "INSERT INTO ITEM (naam, merk, categorie, beschrijving, gebruiksaanwijzing, images) VALUES ('$apparaat','$merk','$categorie','$beschrijving', '$manualLink', '$fileUrl')";
            if ($conn->query($itemQuery) === TRUE) {
                $item_id = $conn->insert_id;

                // Get the auto-generated item_id from the newly created row
                $exemplaarItemQuery = "INSERT INTO EXEMPLAAR_ITEM (item_id) VALUES ('$item_id')";
                $conn->query($exemplaarItemQuery);

                foreach ($functionaliteit as $func) {
                    $functionaliteitQuery = "INSERT INTO FUNCTIONALITEIT (item_id, functionaliteit) VALUES ('$item_id', '$func')";
                    $conn->query($functionaliteitQuery);
                }

                foreach ($in_doos as $doos) {
                    $inDoosQuery = "INSERT INTO ITEMBUNDEL (item_id, accessoire) VALUES ('$item_id', '$doos')";
                    $conn->query($inDoosQuery);
                }
            }

            // Close the FTP connection
            ftp_close($ftpConnection);
        }

    $conn->close();
    header('Location: ../Inventaris.php');
}
