<?php
include '..\database.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $defect_id = $_POST['defect_id'];

    $query = "SELECT exemplaar_item_id FROM DEFECT WHERE defect_id = $defect_id";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $exemplaar_item_id = $row['exemplaar_item_id'];

        $deleteUitgeleendQuery = "DELETE FROM UITGELEEND_ITEM WHERE exemplaar_item_id = $exemplaar_item_id";
        $deleteUitgeleendResult = mysqli_query($conn, $deleteUitgeleendQuery);

        // Check if deletion from UITGELEEND_ITEM was successful
        if (!$deleteUitgeleendResult) {
            die('Error deleting from UITGELEEND_ITEM: ' . mysqli_error($conn));
        }
        $deleteDefectQuery = "DELETE FROM DEFECT WHERE defect_id = $defect_id";
        $deleteDefectResult = mysqli_query($conn, $deleteDefectQuery);

        // Check if deletion from DEFECT was successful
        if (!$deleteDefectResult) {
            die('Error deleting from DEFECT: ' . mysqli_error($conn));
        }

        $deleteApparaatQuery = "DELETE FROM EXEMPLAAR_ITEM WHERE exemplaar_item_id = $exemplaar_item_id";
        $deleteApparaatResult = mysqli_query($conn, $deleteApparaatQuery);
        
        if (!$deleteApparaatResult) {
            die('Error deleting from EXEMPLAAR_ITEM: ' . mysqli_error($conn));
        }

        header('Location: ../Defect.php');
        exit();
    }
}
mysqli_close($conn);
?>
