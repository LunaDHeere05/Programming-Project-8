<?php
include 'database.php';

$zoek_query = isset($_GET['zoek_query']) ? $_GET['zoek_query'] : '';

if (!empty($zoek_query)) {

    //sql-injecties voorkomen
    $zoek_query = mysqli_real_escape_string($conn, $zoek_query);
    
    $zoek_resultaat = "SELECT * FROM ITEM 
                      WHERE LOWER(naam) LIKE LOWER('%$zoek_query%')
                      OR LOWER(merk) LIKE LOWER('%$zoek_query%')
                      OR LOWER(beschrijving) LIKE LOWER('%$zoek_query%')";

    $item_info_result = mysqli_query($conn, $zoek_resultaat);
}else{
// De volgende query is gewoon om de info over het apparaat te halen uit de databank
$item_info = "SELECT * FROM ITEM";
$item_info_result = mysqli_query($conn, $item_info);

if (!$item_info_result) {
    die('Query failed: ' . mysqli_error($conn));
}
}

while ($row_item = mysqli_fetch_assoc($item_info_result)) { // Loopen over elk item
    // Eerst checken of exemplaren van het item zichtbaar zijn (en dus niet defect)
    $zichtbaarheid_query = "SELECT zichtbaarheid FROM EXEMPLAAR_ITEM WHERE zichtbaarheid = 1 AND item_id = {$row_item['item_id']}";
    $zichtbaarheid_result = mysqli_query($conn, $zichtbaarheid_query);

    if ($zichtbaarheid_result && $zichtbaarheid_result->num_rows > 0) {
        echo "<li class='apparaat'>";
        echo "<a href='ApparaatPagina.php?apparaat_id=" . $row_item['item_id'] . "'>";
        echo '<img src="' . $row_item['images'] . '" alt="" class="apparaat_foto">';
        echo "<div class='korte_beschrijving'>";
        echo "<h3>" . $row_item['naam'] . "</h3>";
        echo "<p>" . $row_item['merk'] . "</p>";
        echo "<p>" . $row_item['beschrijving'] . "</p>";
        echo "</div>";

        echo "<div class='beschikbaarheid_apparaat'>";
        //hier gaan we checken of het apparaat deze week (of dus de eerstvolgende uitleenttermijn) beschikbaar is 
        $beginWeek = new DateTime();
        if ($beginWeek->format('N') != 1) {
            $beginWeek->modify('next Monday');
        }

        $eindeWeek = (clone $beginWeek)->modify('+4 days');

        $vrijeExemplaren = "SELECT ei.exemplaar_item_id
        FROM EXEMPLAAR_ITEM ei
        WHERE ei.item_id = " . $row_item['item_id'] . "
        AND NOT EXISTS (
            SELECT 1
            FROM UITGELEEND_ITEM ui
            JOIN UITLENING u ON ui.uitleen_id = u.uitleen_id
            WHERE ui.exemplaar_item_id = ei.exemplaar_item_id
            AND (
                (u.uitleen_datum <= '".$beginWeek->format('Y-m-d')."' AND u.inlever_datum >= '" . $eindeWeek->format('Y-m-d') ."')
                OR (u.uitleen_datum >= '".$beginWeek->format('Y-m-d')."'  AND u.uitleen_datum < '" . $eindeWeek->format('Y-m-d') ."')
                OR (u.inlever_datum <= '" . $eindeWeek->format('Y-m-d') ."' AND u.inlever_datum > '".$beginWeek->format('Y-m-d')."')
                )
            )
        AND zichtbaarheid=1
    "; 

        $vrijeExemplaren_result = mysqli_query($conn, $vrijeExemplaren);
     
        if(mysqli_num_rows($vrijeExemplaren_result)>0){
                    echo "<h3 class='beschikbaar'> Beschikbaar </h3>";
                    $image = 'images/svg/circle-check-solid.svg';
                    $availability_filter = "invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg);";
        }else{
                    echo "<h3> Uitgeleend </h3>";
                    $image = 'images/svg/circle-xmark-solid.svg';
                    $availability_filter = "invert(15%) sepia(88%) saturate(3706%) hue-rotate(347deg) brightness(94%) contrast(115%);";
                }

                echo "<img style='filter: $availability_filter;' src='$image' alt='Availability Icon'>";
                echo "</div>";
        
                echo "<div class='toevoegen'>";
                echo '<form action="/Favorietenlijst.php"method="post"> <input type="hidden" name=" " id=" " value=""> <button class="favoriet"><img src="images/svg/heart-regular.svg" alt="Favorietenlijst"></button></form>';
                echo "</div>";
                echo "</a>";
                echo "</li>";
            }
        }

mysqli_close($conn);
