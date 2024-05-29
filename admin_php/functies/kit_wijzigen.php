<?php
include 'database.php';
if(isset($_GET['kit_id'])){
    $kit_id = $_GET['kit_id'];
    $kit_query = "SELECT naam, kit_id FROM KIT WHERE kit_id = $kit_id";
    $kit_result = mysqli_query($conn, $kit_query);
    $items = "SELECT I.naam, I.merk, I.item_id, I.images 
    FROM ITEM I 
    JOIN ITEM_KIT KI ON I.item_id = KI.item_id 
    WHERE KI.kit_id = $kit_id";
    $items_result = mysqli_query($conn, $items);
    if($items_result && mysqli_num_rows($items_result) > 0){
        $kit_row = mysqli_fetch_assoc($kit_result);
        echo '<div class="kit_wijzig_toe">
              <h3>Naam van de kit:</h3>
              <input type="text" placeholder="'.$kit_row['naam'].'">';
        echo '</div>';
        $url = '';
        while($item_row = mysqli_fetch_assoc($items_result)){
            $url = 'functies/kit_wijzigen_verwijder.php?kit_id=' . urlencode($kit_id) . '&item_id=' . urlencode($item_row['item_id']);
            echo '<div class="kit_wijzig_container">';
            echo '<div class="kit_wijzig_visueel_img">';
            echo '<img src="'.$item_row['images'].'" alt="'.$item_row['naam'].'">';
            echo '</div>';
            echo '<div class="kit_wijzig_informatie">';
            echo '<h3>Naam: <span>'.$item_row['merk']. '-'.$item_row['naam'].'</span></h3>';
            echo '<h3>Apparaat-ID: <span>'.$item_row['item_id'].'</span></h3>';
            echo '</div>';
            echo '<div class="kit_wijzig_verwijder">';
            echo '<a href="'.$url.'">';
            echo '<p>Verwijder</p>';
            echo '<img src="images\svg\circle-xmark-solid.svg" alt="verwijder">';
            echo '</a>';
            echo '</div>';
            echo '</div>';
        }
    }
}