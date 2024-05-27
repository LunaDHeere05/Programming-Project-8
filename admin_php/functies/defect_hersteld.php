<?php
include '..\database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['defect_id']) && !empty($_POST['defect_id'])) {
        $defect_id = (int)$_POST['defect_id'];  // Cast to integer to ensure it's an integer

        $query = "SELECT exemplaar_item_id FROM DEFECT WHERE defect_id = $defect_id";
        echo "Query: $query<br>";  // Debugging output
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die('Invalid query: ' . mysqli_error($conn));  // Debugging output
        }
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $exemplaar_item_id = (int)$row['exemplaar_item_id'];  // Cast to integer to ensure it's an integer

    $deleteDefectQuery = "DELETE FROM DEFECT WHERE defect_id = $defect_id";
    echo "Delete Query: $deleteDefectQuery<br>";  // Debugging output
    $deleteDefectResult = mysqli_query($conn, $deleteDefectQuery);

    if (!$deleteDefectResult) {
        die('Invalid query: ' . mysqli_error($conn));  // Debugging output
    }

    $updateExemplaarItemQuery = "UPDATE EXEMPLAAR_ITEM SET zichtbaarheid = 1 WHERE exemplaar_item_id = $exemplaar_item_id";
    echo "Update Query: $updateExemplaarItemQuery<br>";  // Debugging output
    $updateExemplaarItemResult = mysqli_query($conn, $updateExemplaarItemQuery);

    if (!$updateExemplaarItemResult) {
        die('Invalid query: ' . mysqli_error($conn));  // Debugging output
    }

    header('Location: ../Defect.php');
    exit();
} else {
    echo "No rows found for defect_id: $defect_id";  // Debugging output
}
} else {
echo "defect_id is not set or is empty";  // Debugging output
}
}
mysqli_close($conn);
?>