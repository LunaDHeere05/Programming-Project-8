<?php
include 'database.php';

$query = "SELECT KIT.kit_id, KIT.naam AS kit_naam, ITEM.naam AS item_naam, ITEM.item_id, Images.image_path
          FROM KIT
          JOIN ITEM_KIT KI ON KI.kit_id = KIT.kit_id
          JOIN ITEM I ON I.item_id = KI.item_id
          JOIN Images ON I.image_id = Images.image_id
          ORDER BY KIT.kit_id, ITEM.item_id";

$result = mysqli_query($conn, $query);

$kits = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $kits[$row['kit_id']]['naam'] = $row['kit_naam'];
        $kits[$row['kit_id']]['items'][] = [
            'item_naam' => $row['item_naam'],
            'item_id' => $row['item_id'],
            'image_path' => $row['image_path']
        ];
    }
} else {
    echo "Er staan momenteel geen kits in de database.";
}
?>