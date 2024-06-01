<?php
include 'database.php';


//zoeken
$zoek_query = isset($_GET['zoek_query']) ? $_GET['zoek_query'] : '';

if (!empty($zoek_query)) {

    //sql-injecties voorkomen
    $zoek_query = mysqli_real_escape_string($conn, $zoek_query);
    
    $zoek_resultaat = "SELECT * FROM ITEM 
                      WHERE LOWER(naam) LIKE LOWER('%$zoek_query%')
                      OR LOWER(merk) LIKE LOWER('%$zoek_query%')
                      OR LOWER(beschrijving) LIKE LOWER('%$zoek_query%')";

    $item_info_result = mysqli_query($conn, $zoek_resultaat);

}else if(isset($_GET['categorie'])){ //zoeken op categorie

    $categorie_query = $_GET['categorie'];
    //sql-injecties voorkomen
    $categorie_query = mysqli_real_escape_string($conn, $categorie_query);

    $zoek_resultaat = "SELECT * FROM ITEM 
    WHERE LOWER(categorie) LIKE LOWER('%$categorie_query%')";
    $item_info_result = mysqli_query($conn, $zoek_resultaat);

    echo '<script> 
    
    for(let option of document.getElementsByClassName("categorieOption")){
        if(option.value==' . json_encode($_GET['categorie']) . '){
            option.selected=true;
            break;
        }
    }
    
    </script>';
 
    
}else if(isset($_GET['merk'])){ //zoeken op merk

    $merk_query = $_GET['merk'];
    //sql-injecties voorkomen
    $merk_query = mysqli_real_escape_string($conn, $merk_query);

    $zoek_resultaat = "SELECT * FROM ITEM 
    WHERE LOWER(merk) LIKE LOWER('%$merk_query%')";
    $item_info_result = mysqli_query($conn, $zoek_resultaat);

    echo '<script> 
    
    for(let option of document.getElementsByClassName("merkOption")){
        if(option.value==' . json_encode($_GET['merk']) . '){
            option.selected=true;
            break;
        }
    }
    
    </script>';
}else if(isset($_GET['beschrijving'])){ //zoeken op beschrijving

    $beschrijving_query = $_GET['beschrijving'];
    //sql-injecties voorkomen
    $beschrijving_query = mysqli_real_escape_string($conn, $beschrijving_query);

    $zoek_resultaat = "SELECT * FROM ITEM 
    WHERE LOWER(beschrijving) LIKE LOWER('%$beschrijving_query%')";
    $item_info_result = mysqli_query($conn, $zoek_resultaat);

    echo '<script> 
    for(let option of document.getElementsByClassName("beschrijvingOption")){
        if(option.value==' . json_encode($_GET['beschrijving']) . '){
            option.selected=true;
            break;
        }
    }
    </script>';

}else if(isset($_GET['beschikbaarheid'])){ //zoeken op beschikbaarheid

    $beschikbaarheid_query = $_GET['beschikbaarheid'];
    //sql-injecties voorkomen
    $beschikbaarheid_query = mysqli_real_escape_string($conn, $beschikbaarheid_query);

      // controle of de datums valide zijn
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $beschikbaarheid_query) || !strtotime($beschikbaarheid_query)) {
        die('Ongeldig datumformaat. Gebruik het formaat YYYY-MM-DD.');
        }
        
    $beginWeekBeschikbaarheid = new DateTime($beschikbaarheid_query); //maandag


    // controle of ingegeven datum een maandag is. 
    if ($beginWeekBeschikbaarheid->format('N') != 1) {
        echo "<p>Ongeldig.</p>";
        echo "<script>
        window.location.href = 'Inventaris.php';
        </script>";
    }

    if($userType=="student"){
        if($_GET['beschikbaarheidEnd']!=''){
            die('Als student, kunt u geen einddatum kiezen.');
        }

    }

    if($_GET['beschikbaarheidEnd']!=''){

        $beschikbaarheidEnd_query = $_GET['beschikbaarheidEnd'];
        //sql-injecties voorkomen
        $beschikbaarheidEnd_query = mysqli_real_escape_string($conn, $beschikbaarheidEnd_query);

        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $beschikbaarheidEnd_query) || !strtotime($beschikbaarheidEnd_query)) {
            die('Ongeldig datumformaat. Gebruik het formaat YYYY-MM-DD.');
            }
       $eindeWeekBeschikbaarheid = new DateTime($beschikbaarheidEnd_query); //vrijdag
    }else{
        $eindeWeekBeschikbaarheid = (clone $beginWeekBeschikbaarheid)->modify('+4 days'); //vrijdag
    }

    $beschikbaarOp=true; 

    $zoek_resultaat = "SELECT DISTINCT i.*
    FROM ITEM i
    JOIN EXEMPLAAR_ITEM ei on ei.item_id=i.item_id
    WHERE NOT EXISTS (
        SELECT 1
        FROM UITGELEEND_ITEM ui
        JOIN UITLENING u ON ui.uitleen_id = u.uitleen_id
        WHERE ui.exemplaar_item_id = ei.exemplaar_item_id
        AND (
            (u.uitleen_datum <= '".$beginWeekBeschikbaarheid->format('Y-m-d')."' AND u.inlever_datum >= '" . $eindeWeekBeschikbaarheid->format('Y-m-d') ."')
            OR (u.uitleen_datum >= '".$beginWeekBeschikbaarheid->format('Y-m-d')."'  AND u.uitleen_datum < '" . $eindeWeekBeschikbaarheid->format('Y-m-d') ."')
            OR (u.inlever_datum <= '" . $eindeWeekBeschikbaarheid->format('Y-m-d') ."' AND u.inlever_datum > '".$beginWeekBeschikbaarheid->format('Y-m-d')."')
            )
        )
    AND zichtbaarheid=1
"; 

$item_info_result = mysqli_query($conn, $zoek_resultaat);

    echo "<script> 
        document.getElementById('beschikbaarheid').innerHTML= '<option disabled selected>" .$beginWeekBeschikbaarheid->format('d-m-Y'). " tot " .$eindeWeekBeschikbaarheid->format('d-m-Y'). "</option>';
    </script>";
    
}else{
// De volgende query is gewoon om de info over het apparaat te halen uit de databank
$item_info = "SELECT * FROM ITEM";
$item_info_result = mysqli_query($conn, $item_info);

if (!$item_info_result) {
    die('Query failed: ' . mysqli_error($conn));
}
}

if(mysqli_num_rows($item_info_result)==0){
    echo "<p class='noResult'> Geen resultaat gevonden <p>";
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


        if(isset($beschikbaarOp)){
            $beschikbaardatum=new DateTime($_GET['beschikbaarheid']);
            $beschikbaardatumString=$beschikbaardatum->format('d-m-Y');

            echo "<h3 class='beschikbaar'> Beschikbaar op gekozen termijn </h3>";
            $image = 'images/svg/circle-check-solid.svg';
            $availability_filter = "invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg);";
        }else if(mysqli_num_rows($vrijeExemplaren_result)>0){
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



        if(isset($gebruikersnaam)){
        $imageFav='images/svg/heart-regular.svg';

        $favorietenQuery="SELECT * FROM FAVORIETE_ITEMS fi
        JOIN FAVORIETENLIJST f on f.fav_id=fi.fav_id
        WHERE f.email='$gebruikersnaam' and fi.item_id=" . $row_item['item_id'] . "";

        $favorietenQuery_result=mysqli_query($conn,$favorietenQuery);

        if(mysqli_num_rows($favorietenQuery_result)>0){
            $imageFav='images/svg/heart-solid.svg';
        }

        echo "<div class='toevoegen'>";
        echo '<form action="functies/wijzigenFavorieten.php" method="POST">';
        echo '<input type="hidden" name="itemId" value='. $row_item['item_id'] .'>';
        echo "<button class='favoriet' type='submit'><img src='$imageFav' alt='Favorietenlijst'></button>";
        echo "</form>";
        echo "</div>";
        }            
                echo "</a>";
                echo "</li>";
            }
        }

mysqli_close($conn);
