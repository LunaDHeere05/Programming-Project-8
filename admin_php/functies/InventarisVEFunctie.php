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

        // Delete ITEMBUNDEL rows
        $deleteItembundelQuery = "DELETE FROM ITEMBUNDEL WHERE item_id='$item_id'";
        if ($conn->query($deleteItembundelQuery) !== TRUE) {
            die("Error deleting record from ITEMBUNDEL: " . $conn->error);
        }

        // Delete Recent item row
        $deleteRecentItemQuery = "DELETE FROM RECENT_ITEMS WHERE item_id='$item_id'";
        if ($conn->query($deleteRecentItemQuery) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
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

            // Delete file in file server
            if (ftp_delete($ftpConnection, $filePath)) {
                echo "$filePath has been deleted";
            } else {
                echo "could not delete $filePath";
            }
        }

        //Delete usermanual from FTP server
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

            // Deleta file in file server
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

    $conn->close();
    header("Location: ../InventarisExemplaars.php?item_id=$item_id");
}