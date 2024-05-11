<?php
include 'database.php';

//de query om de beschikbaarheid van het item op te halen: 
$beschikbaarheid = "SELECT UITGELEEND_ITEM.inlever_datum, UITLENING.uitleen_datum
                    FROM UITGELEEND_ITEM
                    LEFT JOIN UITLENING ON UITGELEEND_ITEM.uitleen_id = UITLENING.uitleen_id"; //dit gaat de twee kolommen samenvoegen allee zo naast mekaar zetten
$availability_result = mysqli_query($conn, $beschikbaarheid);

//dit is om de item id mee te geven aan de url als er op geklikt wordt (zo krijgen we de juiste informatie op de apparaatpagina)
$item_id_query = "SELECT item_id FROM ITEM";
$item_id_result = mysqli_query($conn, $item_id_query);
// de volgende query is gewoon om de info over het apparaat te halen uit de databank:
$item_info = "SELECT naam, merk, beschrijving FROM ITEM";
$item_info_result = mysqli_query($conn, $item_info);

    while ($row = mysqli_fetch_assoc($availability_result)) {
        if ($row['inlever_datum'] != null  ) { //deze conditie moet aangepast worden wnt nu checkt da gewoon of da inleverdatum null is
            $availability = "Niet beschikbaar tot " . $row['inlever_datum'];
            $availability_color = '#E30613';
            $availability_img = 'images/svg/circle-xmark-solid.svg';
            $availability_filter = 'invert(15%) sepia(88%) saturate(3706%) hue-rotate(347deg) brightness(94%) contrast(115%);';
        } else {
            $availability = "Beschikbaar";
            $availability_color = '#1BBCB6';
            $availability_img = 'images/svg/circle-check-solid.svg';
            $availability_filter = 'invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg)
            brightness(103%) contrast(79%)';
        }
        while ($row_item = mysqli_fetch_assoc($item_id_result)) {
        echo "<li class='apparaat'>";
        echo "<a href='ApparaatPagina.php?apparaat_id=".$row_item['item_id']."'>";

        echo '<img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="" class="apparaat_foto">';
        echo "<div class='korte_beschrijving'>";
        
        if ($item_info_result && $item_info_row = mysqli_fetch_assoc($item_info_result)) {
            echo "<h3>" . $item_info_row['naam'] . "</h3>";
            echo "<p>" . $item_info_row['merk'] . "</p>";
            echo "<p>" . $item_info_row['beschrijving'] . "</p>";
        }
        
        echo "</div>";
        echo "<div class='beschikbaarheid_apparaat'>";
        echo "<h3 style= 'color: $availability_color;'>$availability</h3>";
        echo "<img style= 'filter: $availability_filter;' src='$availability_img' alt='Availability Icon'>";
        echo "</div>";
        echo "<div class='toevoegen'>";
        echo "<img src='images/svg/heart-solid.svg' alt='Favorietenlijst'>";
        echo "<img src='images/svg/cart-shopping-solid.svg' alt='Winkelmandje'>";
        echo "</div>";
        echo "</a>";
        echo "</li>";
    }
}
mysqli_close($conn);
?>
