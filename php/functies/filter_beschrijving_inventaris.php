<?php
include 'database.php';

$beschrijving = "SELECT DISTINCT beschrijving FROM ITEM";
$beschrijving_result = mysqli_query($conn, $beschrijving);

while ($row = mysqli_fetch_assoc($beschrijving_result)) {
    echo '<option value="' . $row['beschrijving'] . '">' . $row['beschrijving'] . '</option>';
}
?>