<?php

include 'database.php';

if (isset($gebruikersnaam)) {
    $query = "SELECT ITEM.item_id, naam, merk,images
              FROM ITEM
              JOIN RECENT_ITEMS ON RECENT_ITEMS.item_id = ITEM.item_id
              JOIN RECENT_BEKEKEN ON RECENT_ITEMS.recent_id = RECENT_BEKEKEN.recent_id
              WHERE RECENT_BEKEKEN.email = '$gebruikersnaam' 
              ORDER BY `wanneerBekeken` ASC 
              ";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result)>0) {
        echo '<h2>Recent bekeken</h2>';
        echo '<ul class="recent_lijst">';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li><a href="ApparaatPagina.php?apparaat_id=' . $row['item_id'] . '">';
            echo '<img src="' . $row['images'] . '" alt="">';
            echo '<h3>' . $row['merk'] . ' - ' . $row['naam'] . '</h3>';
            echo '</a></li>';
        }

        echo '</ul>';
    }
}

//indien user niet is ingelogd, of geen recent bekeken items heeft (bv. bezoekt de site voor de eerste keer) wordt dit getoond ipv recent bekeken



    $typingText="SELECT naam, merk FROM ITEM LIMIT 10;";
    $typingText_result=mysqli_query($conn,$typingText);

    //initialisatie array
    echo '<script>let arrayOfItems=[];';

    //array vullen
    while($typingText_row = mysqli_fetch_assoc($typingText_result)){
        echo 'arrayOfItems.push("'.$typingText_row['merk'].' - '.$typingText_row['naam'].'");';
    }
    echo "</script>"; 


?> 
