<?php
include 'database.php';

$merk = "SELECT DISTINCT merk FROM ITEM ORDER BY merk ASC";
$merk_result = mysqli_query($conn, $merk);

while ($row = mysqli_fetch_assoc($merk_result)) {
    echo '<option value="' . $row['merk'] . '">' . $row['merk'] . '</option>';
}
?>