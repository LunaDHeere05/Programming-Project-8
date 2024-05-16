<?php
include 'database.php';

// de volgende query is gewoon om de info over het apparaat te halen uit de databank:
$item_info = "SELECT item_id, naam, merk, beschrijving FROM ITEM";
$item_info_result = mysqli_query($conn, $item_info);

while ($row_item = mysqli_fetch_assoc($item_info_result)) { //loopen over elk item

    echo "<li class='apparaat'>";
    echo "<a href='ApparaatPagina.php?apparaat_id=" . $row_item['item_id'] . "'>";
    echo '<img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="" class="apparaat_foto">';
    echo "<div class='korte_beschrijving'>";
    echo "<h3>" . $row_item['naam'] . "</h3>";
    echo "<p>" . $row_item['merk'] . "</p>";
    echo "<p>" . $row_item['beschrijving'] . "</p>";
    echo "</div>";

    echo "<div class='beschikbaarheid_apparaat'>";
    //beschikbaarheid halen uit databank
    $status = "SELECT EXEMPLAAR_ITEM.zichtbaarheid,EXEMPLAAR_ITEM.isUitgeleend,UITLENING.inlever_datum FROM `EXEMPLAAR_ITEM` LEFT JOIN UITGELEEND_ITEM on UITGELEEND_ITEM.exemplaar_item_id=EXEMPLAAR_ITEM.exemplaar_item_id LEFT JOIN UITLENING on UITLENING.uitleen_id=UITGELEEND_ITEM.uitleen_id WHERE ITEM_ID={$row_item['item_id']}";
    $status_result = mysqli_query($conn, $status);

    while ($status_row = mysqli_fetch_assoc($status_result)) { //item bestaat uit verschillende exemplaren, we gaan hier lopen over de status van elk van die exemplaren 
        $is_available = false;
        $inleveren;
        $beschikbaar = 100000;
        $vandaag = new dateTime(date("Y-m-d"));
        if ($status_row['isUitgeleend'] == 0) { //indien er minstens één exemplaar beschikbaar is, komt er "Beschikbaar" te staan
            echo "<h3 class='beschikbaar'>Beschikbaar</h3>";
            $is_available = true;
            $image='images/svg/circle-check-solid.svg';
            $availability_filter = "invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg);";
            break;
        } else { //indien alles uitgeleend is, gaan we kijken naar het exemplaar dat het vroegst weer beschikbaar is
            $inlever_datum = new dateTime($status_row['inlever_datum']);
            $interval = $vandaag->diff($inlever_datum);
            $onbeschikbaarTot = $interval->days;

            if ($beschikbaar > $onbeschikbaarTot) {
                $inleveren = $inlever_datum->format("d-m-Y");
                $beschikbaar = $onbeschikbaarTot;
            }
        }
    }
    
    if (!$is_available) {
        $image='images/svg/circle-xmark-solid.svg';
        $availability_filter = "invert(15%) sepia(88%) saturate(3706%) hue-rotate(347deg) brightness(94%) contrast(115%);";

        echo "<h3> Onbeschikbaar tot " . $inleveren . "</h3>";
        echo "<p> Binnen " . $onbeschikbaarTot . " dagen</p>";
    }

    echo "<img style='filter: $availability_filter;' src=$image alt='Availability Icon'>";
    echo "</div>";

    echo "<div class='toevoegen'>";
    echo "<button class='favoriet'><img src='images/svg/heart-regular.svg' alt='Favorietenlijst'></button>";
    echo "<button class='winkelmand'><img src='images/svg/shopping-cart-regular.svg' alt='Winkelmandje'></button>";
    echo "</div>";
    echo "</a>";
    echo "</li>";
}

mysqli_close($conn);
