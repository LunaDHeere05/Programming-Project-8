<?php
include 'database.php';
include 'top_nav.php';
echo "<p>connection done</p>";
$zoek_query = isset($_GET['zoek_query']) ? $_GET['zoek_query'] : '';

if(!empty($zoek_query)) {
    //voor injecties te voorkomen
    $zoek_query = mysqli_real_escape_string($conn, $zoek_query);
    
    $zoek_resultaat = "SELECT * FROM ITEM WHERE naam LIKE '%$zoek_query%'
                        OR merk LIKE '%$zoek_query%'
                        OR beschrijving LIKE '%$zoek_query%'";
    $zoek_uitvoering_resultaat = mysqli_query($conn, $zoek_resultaat);

    if($zoek_uitvoering_resultaat) {
        if(mysqli_num_rows($zoek_uitvoering_resultaat) > 0) {
            while($resultaat = mysqli_fetch_assoc($zoek_uitvoering_resultaat)) {
                echo "<li class='apparaat'>";
                echo "<a href='ApparaatPagina.php?apparaat_id=".$resultaat['item_id']."'>";
                echo '<img src="../images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="" class="apparaat_foto">';
                echo "<div class='korte_beschrijving'>";
                echo "<h3>" . $resultaat['naam'] . "</h3>";
                echo "<p>" . $resultaat['merk'] . "</p>";
                echo "<p>" . $resultaat['beschrijving'] . "</p>";
                echo "</div>";
                echo "<div class='beschikbaarheid_apparaat'>";
                echo "<h3 style= 'color: $availability_color;'>$availability</h3>";
                echo "<img style= 'filter: $availability_filter;' src='$availability_img' alt='Availability Icon'>";
                echo "</div>";
                echo "<div class='toevoegen'>";
                echo "<button class='favoriet'><img src='../images/svg/heart-regular.svg' alt='Favorietenlijst'></button>";
                echo "<button class='winkelmand'><img src='../images/svg/shopping-cart-regular.svg' alt='Winkelmandje'></button>";
                echo "</div>";
                echo "</a>";
                echo "</li>";
            }
        } else {
            echo "Geen resultaten gevonden";
        }
    } else {
        echo "Query failed: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
