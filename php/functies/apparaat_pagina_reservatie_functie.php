<?php

include '../database.php';

// Example data
$uitleen_datum = $_POST['start_date'];
$inlever_datum = $_POST['end_date'];
$isOpgehaald = 0;
$isVerlengd = 0;
$item_id = $_POST['item_id']; // Assuming only one item_id is provided
$quantity = $_POST['quantity']; // Assuming quantity is provided

// Insert a new row into UITLENING
$sql = "INSERT INTO UITLENING (uitleen_datum, inlever_datum, isOpgehaald, isVerlengd) VALUES ('$uitleen_datum', '$inlever_datum', '$isOpgehaald', '$isVerlengd')";
if (mysqli_query($conn, $sql)) {
    // Get the ID of the newly inserted row
    $uitleen_id = mysqli_insert_id($conn);

    // Fetch distinct exemplaar_item_ids corresponding to the provided item_id
    $exemplaar_item_ids = fetchExemplaarItemIds($conn, $item_id, $quantity);

    // Insert items into the UITGELEEND_ITEM table
    foreach ($exemplaar_item_ids as $exemplaar_item_id) {
        // Insert a row into UITGELEEND_ITEM for each exemplaar_item_id
        $sql = "INSERT INTO UITGELEEND_ITEM (exemplaar_item_id, uitleen_id) VALUES ('$exemplaar_item_id', '$uitleen_id')";
        if (!mysqli_query($conn, $sql)) {
            echo "Error inserting UITGELEEND_ITEM: " . mysqli_error($conn);
            // Rollback transaction or handle error accordingly
        }
    }

    echo "UITLENING row inserted successfully!";
} else {
    echo "Error inserting UITLENING: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);

// Function to fetch distinct exemplaar_item_ids based on item_id and quantity
function fetchExemplaarItemIds($conn, $item_id, $quantity) {
    $exemplaar_item_ids = array();
    $sql = "SELECT DISTINCT exemplaar_item_id FROM EXEMPLAAR_ITEM WHERE item_id = '$item_id' AND isUitgeleend = 0 LIMIT $quantity";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $exemplaar_item_ids[] = $row['exemplaar_item_id'];
        }
    }
    return $exemplaar_item_ids;
}
?>
