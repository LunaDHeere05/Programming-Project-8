<?php

include("../database.php");
include("../ftp_server.php");

if (isset($_POST["submitForm"])) {

    $item_id = $_POST['item_id'];

    // Delete RECENT_ITEMS rows
    $deleteRecentItemsQuery = "DELETE FROM RECENT_ITEMS WHERE item_id='$item_id'";
    if ($conn->query($deleteRecentItemsQuery) !== TRUE) {
        die("Error deleting record from RECENT_ITEMS: " . $conn->error);
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
    
    // Delete EXEMPLAAR_ITEM rows
    $deleteExemplaarItemQuery = "DELETE FROM EXEMPLAAR_ITEM WHERE item_id='$item_id'";
    if ($conn->query($deleteExemplaarItemQuery) !== TRUE) {
        die("Error deleting record from EXEMPLAAR_ITEM: " . $conn->error);
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
    
    header("Location: ../Inventaris.php");
    exit();
}