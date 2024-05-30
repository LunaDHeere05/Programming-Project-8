<?php
include '../database.php';

// Get the item IDs from the POST data
$itemIdsJson = $_POST['item_ids'];
$itemIds = json_decode($itemIdsJson, true);

// Get the kit_naam from the POST data
$kitNaam = $_POST['kit_naam'];

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create a new row in the KIT table and get the auto-incremented ID
$conn->query("INSERT INTO KIT (naam) VALUES ('$kitNaam')");
$kitId = $conn->insert_id;

// Execute the SQL statement for each item ID
foreach ($itemIds as $itemId) {
  // Add a new row to the ITEM_KIT table with the kit_id and item_id
  $sql = "INSERT INTO ITEM_KIT (kit_id, item_id) VALUES ($kitId, $itemId)";
  $conn->query($sql);
}

$conn->close();
?>