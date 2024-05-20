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
        SELECT ei.exemplaar_item_id, ei.isUitgeleend, u.uitleen_datum, u.inlever_datum 
        FROM EXEMPLAAR_ITEM ei
        LEFT JOIN UITGELEEND_ITEM ui ON ui.exemplaar_item_id = ei.exemplaar_item_id 
        LEFT JOIN UITLENING u ON u.uitleen_id = ui.uitleen_id 
        WHERE ei.item_id = {$row_item['item_id']}
        ORDER BY ei.isUitgeleend ASC, u.uitleen_datum ASC";
        
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
                $inlever_datum = new DateTime($status_row['inlever_datum']);
                 $uitleen_datum->format("d-m");
                $dagenTotUitlening = $vandaag->diff($uitleen_datum)->days;

                $uitleen_datum_str = $uitleen_datum->format('Y-m-d');
                $inlever_datum_str = $inlever_datum->format('Y-m-d');
                $inlever_datum_str = $inlever_datum->format('Y-m-d');
                
                
                $onbeschikbareExemplaren = "SELECT ei.exemplaar_item_id
                    FROM UITGELEEND_ITEM ui
                    JOIN UITLENING u ON ui.uitleen_id = u.uitleen_id
                    JOIN EXEMPLAAR_ITEM ei ON ui.exemplaar_item_id = ei.exemplaar_item_id
                    WHERE ei.exemplaar_item_id = ".$status_row['exemplaar_item_id']."
                    AND (u.uitleen_datum <= '".$vandaag->format('Y-m-d')."' AND u.inlever_datum <= '".$uitleen_datum_str."')";

                $onbeschikbareExemplaren_result = mysqli_query($conn, $onbeschikbareExemplaren);

                //dagen tot uitlening moet meer dan één week zijn, want je kan enkel lenen op maandag
               
                //checken dat er in die week geen uitleningen zijn

                if ( $vandaag < $uitleen_datum && mysqli_num_rows($onbeschikbareExemplaren_result) == 0 ) {
                    echo "<h3 class='beschikbaar'>Beschikbaar tot " .  $uitleen_datum->modify('-3 days')->format("d-m") . "</h3>";
                    echo "<p class='beschikbaar'> Uitleenbaar voor " . $dagenTotUitlening . " dag(en)</p>";
                    $image = 'images/svg/circle-check-solid.svg';
                    $availability_filter = "invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg);";
                    $is_available = true;
                  break;
                }else{             
                    $inlever_datum = new dateTime($status_row['inlever_datum']);

                    $inlever_datum_plus_3 = $inlever_datum->modify('+3 days')->format('Y-m-d');

                    $extraControle = "SELECT ei.exemplaar_item_id
                                     FROM UITGELEEND_ITEM ui
                                     JOIN UITLENING u ON ui.uitleen_id = u.uitleen_id
                                     JOIN EXEMPLAAR_ITEM ei ON ui.exemplaar_item_id = ei.exemplaar_item_id
                                     WHERE ei.exemplaar_item_id = {$status_row['exemplaar_item_id']}
                                     AND u.inlever_datum >= '$inlever_datum_plus_3'";
    
                    $extraControle_result = mysqli_query($conn, $extraControle);
    
                    if(mysqli_num_rows($extraControle_result) == 0 ){
                    //checken dat er de daaropvolgende week geen uitlening is
                    $onbeschikbaarTot = $vandaag->diff($inlever_datum)->days;
                    if ($onbeschikbaarTot < $dagenTotInleveren) {
                        $earliestInleverDatum = $inlever_datum;
                        $dagenTotInleveren = $onbeschikbaarTot;
                    }
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
