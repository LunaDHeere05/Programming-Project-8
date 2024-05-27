<?php
include 'database.php';
include 'sessionStart.php'; // To get the logged-in user's email

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = intval($_POST['item_id']);
    $email = $_SESSION['email'];

    // Check if the item is already in the favorites list
    $check_query = "SELECT * FROM FAVORIETE_ITEMS WHERE email = ? AND item_id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param('si', $email, $item_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // If not, insert the item into the favorites list
        $insert_query = "INSERT INTO FAVORIETE_ITEMS (email, item_id) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param('si', $email, $item_id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add to favorites']);
        }
    } else {
        echo json_encode(['success' => true, 'message' => 'Already in favorites']);
    }

    $stmt->close();
}

$conn->close();
?>
