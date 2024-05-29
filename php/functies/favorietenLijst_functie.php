<?php
include 'database.php';


if (!isset($gebruikersnaam)) {
    echo '<p class="login"> <a href="Profiel.php"> Log in</a> om jouw favorietenlijst te bekijken.</p>';
} else {
    $query = "SELECT FI.fav_id, FI.item_id, I.naam, I.beschrijving, I.merk, I.images
    FROM FAVORIETE_ITEMS FI 
    JOIN ITEM I ON FI.item_id = I.item_id 
    JOIN FAVORIETENLIJST on FAVORIETENLIJST.Fav_id = FI.fav_id 
    WHERE FAVORIETENLIJST.email = '$gebruikersnaam'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0){
    while ($exemplaren_row = mysqli_fetch_assoc($result)) {
        echo '
       <div class="favoriet_apparaat"><a href="ApparaatPagina.php?apparaat_id=' . $exemplaren_row['item_id'] . '">
       <img class="mijnFavorieteApparaat_foto" src="' . $exemplaren_row['images'] . '" alt="apparaat foto">
       <div class="text_apparaat">
           <h3>' . $exemplaren_row['merk'] . ' - ' . $exemplaren_row['naam'] . '</h3>';

        //beschikbaarheid (volgend uitleentermijn) checken

        $beginWeek = new DateTime();
        if ($beginWeek->format('N') != 1) {
            $beginWeek->modify('next Monday');
        }

        $eindeWeek = (clone $beginWeek)->modify('+4 days');

        $vrijeExemplaren = "SELECT ei.exemplaar_item_id
           FROM EXEMPLAAR_ITEM ei
           WHERE ei.item_id = " . $exemplaren_row['item_id'] . "
           AND NOT EXISTS (
               SELECT 1
               FROM UITGELEEND_ITEM ui
               JOIN UITLENING u ON ui.uitleen_id = u.uitleen_id
               WHERE ui.exemplaar_item_id = ei.exemplaar_item_id
               AND (
                   (u.uitleen_datum <= '" . $beginWeek->format('Y-m-d') . "' AND u.inlever_datum >= '" . $eindeWeek->format('Y-m-d') . "')
                   OR (u.uitleen_datum >= '" . $beginWeek->format('Y-m-d') . "'  AND u.uitleen_datum < '" . $eindeWeek->format('Y-m-d') . "')
                   OR (u.inlever_datum <= '" . $eindeWeek->format('Y-m-d') . "' AND u.inlever_datum > '" . $beginWeek->format('Y-m-d') . "')
                   )
               )
           AND zichtbaarheid=1
       ";

        $vrijeExemplaren_result = mysqli_query($conn, $vrijeExemplaren);

        if (mysqli_num_rows($vrijeExemplaren_result) > 0) {
            $image = 'images/svg/circle-check-solid.svg';
            $availability_filter = "invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg);";
        } else {
            $image = 'images/svg/circle-xmark-solid.svg';
            $availability_filter = "invert(15%) sepia(88%) saturate(3706%) hue-rotate(347deg) brightness(94%) contrast(115%);";
        }
        echo "
           <img style='filter: $availability_filter;' src='$image' alt='beschikbaar'>
       </div>
       <a>
       <img class='fav_kruis' id=" . $exemplaren_row['item_id'] . " src='images/svg/xmark-solid.svg' alt='verwijder'>
  </div> ";
    }
}else{
    echo "<div class='emptyCart'>";
    echo '<h2>Oops ...</h2>';
    echo '<p>Jouw favorietenlijst is momenteel leeg.</p>';
    echo '<img src="images/svg/empty-wishlist.svg">';
    echo "</div>";
   
}
}
