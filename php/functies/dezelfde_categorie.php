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
        $item_query = "SELECT naam, merk, item_id, images
                        FROM ITEM
                        WHERE categorie = '$categorie' AND item_id != $apparaat_id
                        LIMIT 5";

        $item_result = mysqli_query($conn, $item_query);

        if(mysqli_num_rows($item_result) > 0){
            while($item_row = mysqli_fetch_assoc($item_result)){
                echo '<li><a href="ApparaatPagina.php?apparaat_id=' . $item_row['item_id'] . '">';
                echo '<img src="' . $item_row['images'] . '" alt="foto apparaat">';
                echo '<h3>'.$item_row['merk']. '-' .$item_row['naam'].'</h3>';
                echo '</li>';
            }
   
        }else{
            echo '<p>Geen items gevonden van dezelfde categorie.</p>';
        }
    } else {
        echo '<p>Geen categorie gevonden voor dit item.</p>';
    }
}


?>