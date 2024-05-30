<?php

include '../database.php';

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$dagen = $_POST['dagen'];
$begin_uren = $_POST['begin_uren'];
$eind_uren = $_POST['eind_uren'];

$sql = "UPDATE OPENINGSTIJDEN SET begin_uren='$begin_uren', eind_uren='$eind_uren' WHERE dagen='$dagen'";

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
?>