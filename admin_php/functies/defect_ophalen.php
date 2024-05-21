<?php
include 'database.php';

$query = "SELECT defect_id, DEFECT.beschrijving, DEFECT.datum, bruikbaarheid, DEFECT.exemplaar_item_id, ITEM.naam, ITEM.item_id
          FROM DEFECT
          JOIN EXEMPLAAR_ITEM ON DEFECT.exemplaar_item_id = EXEMPLAAR_ITEM.exemplaar_item_id
          JOIN ITEM ON EXEMPLAAR_ITEM.item_id = ITEM.item_id
          ORDER BY defect_id";
$result = mysqli_query($conn, $query);
?>