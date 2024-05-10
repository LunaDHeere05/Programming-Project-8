<?php
include 'database.php';

$beschikbaarheid = "SELECT EXEMPLAAR_ITEM.*, UITGELEEND_ITEM.inlever_datum
                    FROM EXEMPLAAR_ITEM
                    LEFT JOIN UITGELEEND_ITEM ON EXEMPLAAR_ITEM.exemplaar_item_id = UITGELEEND_ITEM.exemplaar_item_id
                    ORDER BY EXEMPLAAR_ITEM.exemplaar_item_id";
$availability_result = mysqli_query($conn, $beschikbaarheid);

$item_info = "SELECT naam, merk, beschrijving FROM ITEM";
$item_info_result = mysqli_query($conn, $item_info);

if ($availability_result && $item_info_result) {
    while ($row = mysqli_fetch_assoc($availability_result)) {
        if ($row['inlever_datum'] != null) {
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
        echo "<li class='apparaat'>";
        echo "<a href='ApparaatPagina.php'>";
        echo '<img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="" class="apparaat_foto">';
        echo "<div class='korte_beschrijving'>";
        
        if ($item_info_result && $item_info_row = mysqli_fetch_assoc($item_info_result)) {
            echo "<h3>" . $item_info_row['naam'] . "</h3>";
            echo "<p>" . $item_info_row['merk'] . "</p>";
            echo "<p>" . $item_info_row['beschrijving'] . "</p>";
        } else {
            echo "Geen item informatie gevonden.";
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
} else {
    echo "Geen apparaten gevonden.";
};
mysqli_close($conn);
?>
