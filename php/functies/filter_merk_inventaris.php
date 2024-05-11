<?php
include 'database.php';

$merk = "SELECT DISTINCT merk FROM ITEM";
$merk_result = mysqli_query($conn, $merk);

while ($row = mysqli_fetch_assoc($merk_result)) {
    echo '<option value="' . $row['merk'] . '">' . $row['merk'] . '</option>';
}
mysqli_close($conn);
?>