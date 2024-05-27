<?php
include 'database.php';


if (!isset($userType) || !isset($email)) {
    echo '<p class="login"> <a href="Profiel.php"> Log in</a> om jouw favorietenlijst te bekijken.</p>';
} else {
    $query = "SELECT UI.fav_id, UI.item_id, I.naam, I.beschrijving, I.merk, I.images
    FROM FAVORIETE_ITEMS UI 
    JOIN ITEM I ON UI.item_id = I.item_id 
    JOIN FAVORIETENLIJST on FAVORIETENLIJST.Fav_id = UI.fav_id 
    WHERE FAVORIETENLIJST.{$userType} = '$email'"; 
    $result = mysqli_query($conn, $query);
    while ($exemplaren_row = mysqli_fetch_assoc($result)) {
       echo '
       <div class="favoriet_apparaat">
       <img class="mijnFavorieteApparaat_foto" src="' . $exemplaren_row['images'] . '" alt="apparaat foto">
       <div class="text_apparaat">
           <h3>'.$exemplaren_row['merk'].' - '.$exemplaren_row['naam'].'</h3>
           <img src="images/svg/circle-check-solid.svg" alt="beschikbaar">
       </div>
       <img class="verwijder_btn" src="images/svg/xmark-solid.svg" alt="verwijder">
   </div> ';
    }
}

?>