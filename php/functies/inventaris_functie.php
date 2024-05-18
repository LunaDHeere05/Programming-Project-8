<?php
include 'database.php';

// De volgende query is gewoon om de info over het apparaat te halen uit de databank
$item_info = "SELECT item_id, naam, merk, beschrijving FROM ITEM";
$item_info_result = mysqli_query($conn, $item_info);

if (!$item_info_result) {
    die('Query failed: ' . mysqli_error($conn));
}

while ($row_item = mysqli_fetch_assoc($item_info_result)) { // Loopen over elk item
    // Eerst checken of exemplaren van het item zichtbaar zijn (en dus niet defect)
    $zichtbaarheid_query = "SELECT zichtbaarheid FROM EXEMPLAAR_ITEM WHERE zichtbaarheid = 1 AND item_id = {$row_item['item_id']}";
    $zichtbaarheid_result = mysqli_query($conn, $zichtbaarheid_query);

    if ($zichtbaarheid_result && $zichtbaarheid_result->num_rows > 0) {

        echo "<li class='apparaat'>";
        echo "<a href='ApparaatPagina.php?apparaat_id=" . $row_item['item_id'] . "'>";
        echo '<img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="" class="apparaat_foto">';
        echo "<div class='korte_beschrijving'>";
        echo "<h3>" . $row_item['naam'] . "</h3>";
        echo "<p>" . $row_item['merk'] . "</p>";
        echo "<p>" . $row_item['beschrijving'] . "</p>";
        echo "</div>";

        echo "<div class='beschikbaarheid_apparaat'>";

        // Beschikbaarheid halen uit databank
        $status_query = "
            SELECT EXEMPLAAR_ITEM.isUitgeleend, UITLENING.uitleen_datum, UITLENING.inlever_datum 
            FROM EXEMPLAAR_ITEM 
            LEFT JOIN UITGELEEND_ITEM ON UITGELEEND_ITEM.exemplaar_item_id = EXEMPLAAR_ITEM.exemplaar_item_id 
            LEFT JOIN UITLENING ON UITLENING.uitleen_id = UITGELEEND_ITEM.uitleen_id 
            WHERE EXEMPLAAR_ITEM.item_id = {$row_item['item_id']}
            ORDER BY EXEMPLAAR_ITEM.isUitgeleend ASC";
        
        $status_result = mysqli_query($conn, $status_query);

        if (!$status_result) {
            die('Query failed: ' . mysqli_error($conn));
        }

        // Initialiseer variabelen voor de vroegste inleverdatum en de bijbehorende dagen tot inleveren
        $earliestInleverDatum = null;
        $dagenTotInleveren = PHP_INT_MAX;

        while ($status_row = mysqli_fetch_assoc($status_result)) { // Loopen over exemplaren

            $is_available = false;
            $inleveren;
            $vandaag = new DateTime(date("Y-m-d"));

            if ($status_row['isUitgeleend'] == 0) {
                // Minstens één exemplaar beschikbaar
                echo "<h3 class='beschikbaar'>Beschikbaar</h3>";
                $image = 'images/svg/circle-check-solid.svg';
                $availability_filter = "invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg);";
                $is_available = true;
                break;
            } else {
                $uitleen_datum = new DateTime($status_row['uitleen_datum']);
                $uitleen_datumString = $uitleen_datum->format("d-m");
                $dagenTotUitlening = $vandaag->diff($uitleen_datum)->days;

                //dagen tot uitlening moet meer dan één week zijn, want je kan enkel lenen op maandag
                if ($dagenTotUitlening >= 7 && $vandaag < $uitleen_datum) {
                    echo "<h3 class='beschikbaar'>Beschikbaar tot " . $uitleen_datumString . "</h3>";
                    echo "<p class='beschikbaar'> Uitleenbaar voor " . $dagenTotUitlening . " dag(en)</p>";
                    $image = 'images/svg/circle-check-solid.svg';
                    $availability_filter = "invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg);";
                    $is_available = true;
                    break;
                } else {
                    $inlever_datum = new dateTime($status_row['inlever_datum']);
                    $onbeschikbaarTot = $vandaag->diff($inlever_datum)->days;
        
                    if ($onbeschikbaarTot < $dagenTotInleveren) {
                        $earliestInleverDatum = $inlever_datum;
                        $dagenTotInleveren = $onbeschikbaarTot;
                    }
                }
            }
        }

        if (!$is_available) {
            $image = 'images/svg/circle-xmark-solid.svg';
            $availability_filter = "invert(15%) sepia(88%) saturate(3706%) hue-rotate(347deg) brightness(94%) contrast(115%);";
            $inleveren = $earliestInleverDatum->format("d-m");
            echo "<h3> Onbeschikbaar tot " . $inleveren. "</h3>";
            echo "<p> Binnen " . $dagenTotInleveren . " dag(en) uitleenbaar </p>";
            
        }

        echo "<img style='filter: $availability_filter;' src='$image' alt='Availability Icon'>";
        echo "</div>";

        echo "<div class='toevoegen'>";
        echo "<button class='favoriet'><img src='images/svg/heart-regular.svg' alt='Favorietenlijst'></button>";
        echo "<button class='winkelmand'><img src='images/svg/shopping-cart-regular.svg' alt='Winkelmandje'></button>";
        echo "</div>";
        echo "</a>";
        echo "</li>";
    }
}

mysqli_close($conn);
?>
