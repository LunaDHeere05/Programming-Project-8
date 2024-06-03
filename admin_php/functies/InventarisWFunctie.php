<?php

include("../database.php");
include("../ftp_server.php");

if (isset($_POST["submitForm"])) {

    $item_id = $_POST['item_id'];
    $apparaat = $_POST['apparaat_naam'];
    $merk = $_POST['merk'];
    $categorie = $_POST['categorie'];
    $beschrijving = $_POST['beschrijving'];
    $image = $_FILES['image']['name'];
    $usermanual = $_FILES['usermanual'];
    $functionaliteit = $_POST['functionaliteit'];
    $in_doos = $_POST['in_doos'];

    $valueUpdateQuery = $conn->prepare("UPDATE ITEM SET naam=?, merk=?, categorie=?, beschrijving=?, gebruiksaanwijzing=? WHERE item_id=?");
    $valueUpdateQuery->bind_param("sssssi", $apparaat, $merk, $categorie, $beschrijving, $link, $item_id);
    $valueUpdateQuery->execute();
    // Remove trailing comma and space
    $query = rtrim($query, ', ');

    // Get func_ids for this item_id
    $funcIdsQuery = "SELECT functionaliteit_id FROM FUNCTIONALITEIT WHERE item_id='$item_id'";
    $result = $conn->query($funcIdsQuery);
    $func_ids = array();
    while ($row = $result->fetch_assoc()) {
        $func_ids[] = $row['functionaliteit_id'];
    }

    //Uploading image
    $file = $_FILES['image'];
    $ftpDirectory = '/www/images/';
    ftp_pasv($ftpConnection, true);
    
    // Check if the file was uploaded successfully
    if ($file['error'] !== UPLOAD_ERR_OK) {
        // Handle upload error
        echo "Error uploading image file: " . $file['error'];
    } else {
        // File uploaded successfully, check the temporary file location
        $tmpFile = $file['tmp_name'];
        if (!is_uploaded_file($tmpFile)) {
            // Handle case where temporary file is not found
            echo "Temporary image file not found!";
        } else {
            // Temporary file found, proceed with FTP upload
            if (ftp_put($ftpConnection, $ftpDirectory . $file["name"], $tmpFile, FTP_BINARY)) {        
                $fileUrl = 'http://www.ppgroep8.be/images/' . $_FILES["image"]["name"];
            } else {
                // Handle FTP upload error
                echo "Error uploading image via FTP.";
            }
        }
    }

    //Upload the usermanual to the server
    $file = $_FILES['usermanual'];
    $ftpDirectory = '/www/handleidingen/';
    ftp_pasv($ftpConnection, true);
    
    // Check if the usermanual file was uploaded successfully
    if ($file['error'] !== UPLOAD_ERR_OK) {
        // Handle upload error
        echo "Error uploading usermanual file: " . $file['error'];
    } else {
        // File uploaded successfully, check the temporary file location
        $tmpFile = $file['tmp_name'];
        if (!is_uploaded_file($tmpFile)) {
            // Handle case where temporary file is not found
            echo "Temporary usermanual file not found!";
        } else {
            // Temporary file found, proceed with FTP upload
            if (ftp_put($ftpConnection, $ftpDirectory . $file["name"], $tmpFile, FTP_BINARY)) {
                $manualLink = 'http://www.ppgroep8.be/handleidingen/' . $_FILES["handleiding"]["name"];
            } else {
                // Handle FTP upload error
                echo "Error uploading usermanual via FTP.";
            }
        }
    }

    // Update each functionaliteit
    foreach ($functionaliteit as $index => $func) {
        if (isset($func_ids[$index])) {
        // Update existing row
        $func_id = $func_ids[$index];
        if (!empty($func)) {
            // Only update if new value is not empty
            $functionaliteitQuery = "UPDATE FUNCTIONALITEIT SET functionaliteit='$func' WHERE functionaliteit_id='$func_id'";
            $conn->query($functionaliteitQuery);
        }
        } else if (!empty($func)) {
        // Insert new row
            $functionaliteitQuery = "INSERT INTO FUNCTIONALITEIT (item_id, functionaliteit) VALUES ('$item_id', '$func')";
            $conn->query($functionaliteitQuery);
        }
    }

    // Get doos_ids for this item_id
    $doosIdsQuery = "SELECT bundel_id FROM ITEMBUNDEL WHERE item_id='$item_id'";
    $result = $conn->query($doosIdsQuery);
    $doos_ids = array();
    while ($row = $result->fetch_assoc()) {
        $doos_ids[] = $row['bundel_id'];
    }

    // Update each in_doos
    foreach ($in_doos as $index => $doos) {
        if (isset($doos_ids[$index])) {
            // Update existing row
            $doos_id = $doos_ids[$index];
            if (!empty($doos)) {
                // Only update if new value is not empty
                $doosQuery = "UPDATE ITEMBUNDEL SET accessoire='$doos' WHERE bundel_id='$doos_id'";
                $conn->query($doosQuery);
            }
        } else if (!empty($doos)) {
            // Insert new row
            $doosQuery = "INSERT INTO ITEMBUNDEL (item_id, accessoire) VALUES ('$item_id', '$doos')";
            $conn->query($doosQuery);
        }
    }
    // Close the database connection
    $conn->close();

    // Close the FTP connection
    ftp_close($ftpConnection);
    
    header("Location: ../Inventaris.php");
    exit();
}
?>
