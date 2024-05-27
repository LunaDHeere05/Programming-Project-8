<?php
include 'database.php';

if(isset($_GET['apparaat_id'])) {
    $apparaat_id = $_GET['apparaat_id'];

    // Get the category of the current item
    $query = "SELECT categorie FROM ITEM WHERE item_id = $apparaat_id";
    $result = mysqli_query($conn, $query);

    if($result && mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $categorie = $row['categorie'];

        // Select other items from the same category, excluding the current item
        $item_query = "SELECT naam, merk, item_id
                        FROM ITEM
                        WHERE categorie = '$categorie' AND item_id != $apparaat_id";

        $item_result = mysqli_query($conn, $item_query);

        if(mysqli_num_rows($item_result) > 0){
            echo '<ul class="lijst_apparaten">';
            while($item_row = mysqli_fetch_assoc($item_result)){
                echo '<li>';
                echo '<img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="foto apparaat">';
                echo '<h3>'.$item_row['merk']. '-' .$item_row['naam'].'</h3>';
                echo '</li>';
            }
            echo '</ul>';
        }else{
            echo '<p>Geen items gevonden van dezelfde categorie.</p>';
        }
    } else {
        echo '<p>Geen categorie gevonden voor dit item.</p>';
    }
}

mysqli_close($conn);
?>