<?php
include 'database.php';

$beschrijving = "SELECT DISTINCT beschrijving FROM ITEM ORDER BY beschrijving ASC";
$beschrijving_result = mysqli_query($conn, $beschrijving);

while ($row = mysqli_fetch_assoc($beschrijving_result)) {
    echo '<option value="' . $row['beschrijving'] . '">' . $row['beschrijving'] . '</option>';
}
?>