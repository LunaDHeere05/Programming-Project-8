<?php

include("../database.php");
include("../ftp_server.php");

$item_id = $_POST['item_id'];
$apparaat = $_POST['apparaat_naam'];
$merk = $_POST['merk'];
$categorie = $_POST['categorie'];
$beschrijving = $_POST['beschrijving'];
$image = $_FILES['image']['name'];
$functionaliteit = $_POST['functionaliteit'];

echo $item_id;
echo $apparaat;
echo $merk;
echo $categorie;
echo $beschrijving;
echo $image;

if (isset($_POST['submitForm'])) {
    // Check if the item is currently on loan
    $checkLoanQuery = "SELECT COUNT(*) AS loan_count FROM UITLENING WHERE exemplaar_item_id IN (SELECT exemplaar_item_id FROM EXEMPLAAR_ITEM WHERE item_id='$item_id')";
    $result = $conn->query($checkLoanQuery);
    $row = $result->fetch_assoc();
    
    if ($row['loan_count'] > 0) {
        echo "<script>alert('U kan geen item verwijderen als deze uitgeleend is!');</script>";
        echo "<script>window.location.href='../Inventaris.php';</script>";
        exit();
    }

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

    // Delete ITEMBUNDEL rows
    $deleteItembundelQuery = "DELETE FROM ITEMBUNDEL WHERE item_id='$item_id'";
    if ($conn->query($deleteItembundelQuery) !== TRUE) {
        die("Error deleting record from ITEMBUNDEL: " . $conn->error);
    }

    // Delete image from FTP server
    // Get the file link from the database
    $fileLinkQuery = "SELECT images FROM ITEM WHERE item_id='$item_id'";
    $result = $conn->query($fileLinkQuery);

    if ($result->num_rows > 0) {
        // Fetch the result
        $row = $result->fetch_assoc();
        // Define the file link
        $fileLink = $row['images'];
        // Parse the URL
        $parsedUrl = parse_url($fileLink);
        // Get the path
        $filePath = $parsedUrl['path'];
        // Prepend the directory to the file path
        $filePath = '/www' . $filePath;

        // Now you can use the ftp_delete() function to delete the file
        if (ftp_delete($ftpConnection, $filePath)) {
            echo "$filePath has been deleted";
        } else {
            echo "could not delete $filePath";
        }
    }

    // Delete user manual from FTP server
    $usermanualLinkQuery = "SELECT gebruiksaanwijzing FROM ITEM WHERE item_id='$item_id'";
    $result = $conn->query($usermanualLinkQuery);
    if ($result->num_rows > 0) {
        // Fetch the result
        $row = $result->fetch_assoc();
        // Define the file link
        $usermanualLink = $row['gebruiksaanwijzing'];
        // Parse the URL
        $parsedUrl = parse_url($usermanualLink);
        // Get the path
        $filePath = $parsedUrl['path'];
        // Prepend the directory to the file path
        $filePath = '/www' . $filePath;

        // Delete file in file server
        if (ftp_delete($ftpConnection, $filePath)) {
            echo "$filePath has been deleted";
        } else {
            echo "could not delete $filePath";
        }
    }

    // Delete ITEM row
    $deleteItemQuery = "DELETE FROM ITEM WHERE item_id='$item_id'";
    if ($conn->query($deleteItemQuery) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
    // Close the FTP connection
    ftp_close($ftpConnection);
    header('Location: ../Inventaris.php');
}
?>
