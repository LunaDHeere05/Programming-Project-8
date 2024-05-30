<?php
include 'database.php';

if(isset($_GET['apparaat_id'])) {
    $apparaat_id = $_GET['apparaat_id'];

    $kit_query = "SELECT DISTINCT KIT.kit_id, KIT.naam FROM KIT 
                    INNER JOIN ITEM_KIT ON KIT.kit_id = ITEM_KIT.kit_id 
                    WHERE ITEM_KIT.item_id = $apparaat_id";

    $kit_result = mysqli_query($conn, $kit_query);
}

if(isset($kit_result) && mysqli_num_rows($kit_result) > 0) {
    while($kit_row = mysqli_fetch_assoc($kit_result)) {
        $kit_id = $kit_row['kit_id'];
        
        // Hier is de overbodige query voor kitgegevens verwijderd

        $item_query = "SELECT ITEM.naam, ITEM.merk, ITEM.beschrijving, ITEM.images, KIT.naam as kitNaam FROM ITEM 
                        INNER JOIN ITEM_KIT ON ITEM.item_id = ITEM_KIT.item_id 
                        INNER JOIN KIT ON KIT.kit_id = ITEM_KIT.kit_id 
                        WHERE ITEM_KIT.kit_id = $kit_id";
        $item_result = mysqli_query($conn, $item_query);

        if(mysqli_num_rows($item_result) > 0) {
            echo '<ul>';
            echo '<div class = "kits_naam"><h1>' . $kit_row['naam'] . '</h1> </div><div class = "kits_inhoud">';

            while($item_row = mysqli_fetch_assoc($item_result)) {
                echo '<li>
                <img src="' . $item_row['images'] . '" alt="foto apparaat">
                <h3>' . $item_row['merk'] . '-'.$item_row['naam']. '</h3>
                <img id="selectiebol" src="images/svg/plus-circle.svg" alt="">
                </li>';
            }
            echo "<li id='selectie_toevoegen'>";
            echo "<p>Voeg selectie toe aan reservatie</p>";
            echo "</li></div>";
            echo "</ul>" ;
        
         
        } else {
            echo "<p>Er zijn geen apparaten in deze kit.</p>";
        }
    }
} 
else{
    echo '<p>Geen kits gevonden voor dit apparaat.</p>';
}


?>
