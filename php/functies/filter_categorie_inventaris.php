<?php
include 'database.php';

$categorie = "SELECT DISTINCT categorie FROM ITEM ORDER BY categorie ASC";

$categorie_result = mysqli_query($conn, $categorie);

while ($row = mysqli_fetch_assoc($categorie_result)) {
    echo '<option value="' . $row['categorie'] . '">' . $row['categorie'] . '</option>';
}
?>