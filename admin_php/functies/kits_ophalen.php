<?php
include 'database.php';

if (isset($_GET['zoekButton'])) {
    $zoek_query = $_GET['zoekquery'];
    if (!empty($zoek_query)) { 
        $zoek_query = mysqli_real_escape_string($conn, $zoek_query);
        $zoek_resultaat = "SELECT KIT.kit_id, KIT.naam AS kit_naam, I.naam AS item_naam, I.item_id, I.images
                        FROM KIT
                        JOIN ITEM_KIT KI ON KI.kit_id = KIT.kit_id
                        JOIN ITEM I ON I.item_id = KI.item_id
                        WHERE LOWER(KIT.naam) LIKE LOWER('%$zoek_query%')
                        OR LOWER(KIT.kit_id) LIKE LOWER('%$zoek_query%')
                        ORDER BY KIT.kit_id, I.item_id";

        $zoek_uitvoering_resultaat = mysqli_query($conn, $zoek_resultaat);

        if ($zoek_uitvoering_resultaat) {
            if (mysqli_num_rows($zoek_uitvoering_resultaat) > 0) {
                $kits = []; // Initialize an array to store kits
                while ($result = mysqli_fetch_assoc($zoek_uitvoering_resultaat)) {
                    $kit_id = $result['kit_id'];
                    if (!isset($kits[$kit_id])) {
                        $kits[$kit_id] = [
                            'naam' => $result['kit_naam'],
                            'items' => []
                        ];
                    }
                    $kits[$kit_id]['items'][] = [
                        'item_naam' => $result['item_naam'],
                        'item_id' => $result['item_id'],
                        'image_path' => $result['images']
                    ];
                }
                // Display search results
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
                        echo '<div class="kit_visueel_img" style="display:' . ($index < 3 ? 'flex' : 'none') . ';">';
                        echo '<img src="'.$item['image_path'].'" alt="' . $item['item_naam'] . '" />';
                        echo '</div>';
                    }
                    echo '</div>';
                    echo '<div class="kit_visueel_small" onclick="slideRight(\'' . $kit_id . '\')">';
                    echo '<img src="images/svg/chevron-right-solid.svg" alt="right" />';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="kit_acties">';
                    echo '<div class="kit_verwijder_kit">';
                    echo "<a href='functies\kit_verwijderen.php?kit_id=" . $kit_id . "'>Verwijder kit<img src='images/svg/circle-xmark-solid.svg' alt='xmark' /></a>";
                    echo '</div>';
                    echo '<div class="kit_wijzig_kit">';
                    echo '<a href="">Wijzig kit <img src="images/svg/pen-to-square-regular.svg" alt="" /></a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                exit(); // Exit the script after displaying search results
            } else {
                echo "Geen resultaten gevonden";
            }
        } else {
            echo "Query failed: " . mysqli_error($conn);
        }
    }
}

// Fetch all kits and their items from the database
$query = "SELECT KIT.kit_id, KIT.naam AS kit_naam, I.naam AS item_naam, I.item_id, I.images
          FROM KIT
          JOIN ITEM_KIT KI ON KI.kit_id = KIT.kit_id
          JOIN ITEM I ON I.item_id = KI.item_id
          ORDER BY KIT.kit_id, I.item_id";

$result = mysqli_query($conn, $query);

$kits = [];


if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
    $kit_id = $row['kit_id'];
    if (!isset($kits[$kit_id])) {
    $kits[$kit_id] = [
    'naam' => $row['kit_naam'],
    'items' => []
    ];
    }
    $kits[$kit_id]['items'][] = [
    'item_naam' => $row['item_naam'],
    'item_id' => $row['item_id'],
    'image_path' => $row['images']
    ];
    }
    } else {
    echo "Er staan momenteel geen kits in de database.";
    }
    
    // Display all kits and their items
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
    echo '<div class="kit_visueel_img" style="display:' . ($index < 3 ? 'flex' : 'none') . ';">';
    echo '<img src="'.$item['image_path'].'" alt="' . $item['item_naam'] . '" />';
    echo '</div>';
    }
    echo '</div>';
    echo '<div class="kit_visueel_small" onclick="slideRight(\'' . $kit_id . '\')">';
    echo '<img src="images/svg/chevron-right-solid.svg" alt="right" />';
    echo '</div>';
    echo '</div>';
    echo '<div class="kit_acties">';
    echo '<div class="kit_verwijder_kit">';
    echo "<a href='functies\kit_verwijderen.php?kit_id=" . $kit_id . "'>Verwijder kit<img src='images/svg/circle-xmark-solid.svg' alt='xmark' /></a>";
    echo '</div>';
    echo '<div class="kit_wijzig_kit">';
    echo '<a href="">Wijzig kit <img src="images/svg/pen-to-square-regular.svg" alt="" /></a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    }
    ?>