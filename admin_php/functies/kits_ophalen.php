<?php
include 'database.php';

// Fetch kits and their items from the database
$query = "SELECT KIT.kit_id, KIT.naam AS kit_naam, I.naam AS item_naam, I.item_id, Images.image AS image_path
          FROM KIT
          JOIN ITEM_KIT KI ON KI.kit_id = KIT.kit_id
          JOIN ITEM I ON I.item_id = KI.item_id
          JOIN Images ON I.image_id = Images.image_id
          ORDER BY KIT.kit_id, I.item_id";

$result = mysqli_query($conn, $query);

$kits = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        if (!isset($kits[$row['kit_id']])) {
            $kits[$row['kit_id']] = [
                'naam' => $row['kit_naam'],
                'items' => []
            ];
        }
        $kits[$row['kit_id']]['items'][] = [
            'item_naam' => $row['item_naam'],
            'item_id' => $row['item_id'],
            'image_path' => $row['image_path']
        ];
    }
} else {
    echo "Er staan momenteel geen kits in de database.";
}

mysqli_close($conn);

foreach ($kits as $kit_id => $kit) {
    echo '<div class="kit_container">';
    echo '<div class="kit_informatie">';
    echo '<h3>Naam: <span>' . $kit['naam'] . '</span></h3>';
    echo '<h3>Kit-ID: <span>' . $kit_id . '</span></h3>';
    echo '</div>';
    echo '<div class="kit_visueel_container">';
    echo '<div class="kit_visueel">';
    echo '<div class="kit_visueel_small" onclick="slideLeft(\'' . $kit_id . '\')">';
    echo '<img src="images/svg/chevron-left-solid.svg" alt="left" />';
    echo '</div>';
    echo '<div class="kit_visueel_img_container" id="kit_' . $kit_id . '">';
    foreach ($kit['items'] as $index => $item) {
        echo '<div class="kit_visueel_img" style="display: ' . ($index < 3 ? 'flex' : 'row') . ';">';
        echo '<img src="images\webp\eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="' . $item['item_naam'] . '" />';
        echo '</div>';
    }
    echo '</div>';
    echo '<div class="kit_visueel_small" onclick="slideRight(\'' . $kit_id . '\')">';
    echo '<img src="images/svg/chevron-right-solid.svg" alt="right" />';
    echo '</div>';
    echo '</div>';
    echo '<div class="kit_acties">';
    echo '<div class="kit_verwijder_kit">';
    echo "<a href='kit_verwijderen.php?kit_id=" . $kit['kit_id'] . "'>Verwijder kit<img src='images/svg/circle-xmark-solid.svg' alt='xmark' /></a>";
    echo '</div>';
    echo '<div class="kit_wijzig_kit">';
    echo '<a href="">Wijzig kit <img src="images/svg/pen-to-square-regular.svg" alt="" /></a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
?>
