<?php
include 'datbase.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $defect_id = $_POST['defect_id'];

    $query = "SELECT exemplaar_item_id FROM DEFECT WHERE defect_id = $defect_id";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $exemplaar_item_id = $row['exemplaar_item_id'];

        $deleteDefectQuery = "DELETE FROM DEFECT WHERE defect_id = $defect_id";
        $deleteDefectResult = mysqli_query($conn, $deleteDefectQuery);

        $deleteApparaatQuery = "DELETE FROM EXEMPLAAR_ITEM WHERE exemplaar_item_id = $exemplaar_item_id";
        $deleteApparaatResult = mysqli_query($conn, $deleteApparaatQuery);

        header('Location: ../defect_page.php');
        exit();
    }
}
mysqli_close($conn);
?>