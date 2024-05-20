<?php
include 'database.php';

echo '<form id="form" action="ReservatieBevestigen.php" method="POST">
    <div class="reservatie_plaatsen">';

if (!isset($userType) || !isset($email)) {
    echo '<h2><a href="Profiel.php">Log in</a> om een reservatie te plaatsen.</h2>';
} else if ($userType == "emailSTUDENT") {


// Huidige datum
$vandaag = new DateTime();


// uitlenen kan enkel op maandag + reserveren kan max 2 weken vooraf
$eersteWeekUitlenen = clone $vandaag;
if ($vandaag->format('N') != 1) { 
  $eersteWeekUitlenen->modify('next Monday');
}
$eersteWeekUitlenenFormatted = $eersteWeekUitlenen->format('Y-m-d');

$tweedeWeekUitlenen = clone $eersteWeekUitlenen;
$tweedeWeekUitlenen->modify('+1 week');
$tweedeWeekUitlenenFormatted = $tweedeWeekUitlenen->format('Y-m-d');

// inleveren kan enkel op vrijdag
$eersteWeekInleveren = clone $vandaag;

if ($vandaag->format('N') != 5) { 
$eersteWeekInleveren->modify('next Friday');
}

$eersteWeekInleverenFormatted = $eersteWeekInleveren->format('Y-m-d');

$tweedeWeekInleveren = clone $eersteWeekInleveren;
$tweedeWeekInleveren->modify('+1 week');
$tweedeWeekInleverenFormatted = $tweedeWeekInleveren->format('Y-m-d');


  $item_id = $_GET['apparaat_id'];

    //eerst gaan we kijken naar hoeveel exemplaren van een item er zijn.
    $query="SELECT COUNT(exemplaar_item_id) as count FROM EXEMPLAAR_ITEM WHERE item_id={$item_id}";
    $result = mysqli_query($conn, $query);
    $aantalExemplaren=mysqli_fetch_assoc($result);

    //we gaan er eerst van uit dat alle exemplaren van een item beschikbaar zijn
    $aantalEersteWeek = $aantalExemplaren['count'];
    $aantalTweedeWeek = $aantalExemplaren['count'];

      
    if($aantalExemplaren){

      //beschikbaarheden checken voor week 1, als de query rijen oplevert, gaan we die aftrekken van aantalEersteWeek;
      $week1_query = "
      SELECT ei.exemplaar_item_id,u.uitleen_datum,u.inlever_datum
      FROM UITGELEEND_ITEM ui
      JOIN UITLENING u ON ui.uitleen_id = u.uitleen_id
      JOIN EXEMPLAAR_ITEM ei ON ui.exemplaar_item_id = ei.exemplaar_item_id
      WHERE ei.item_id = {$item_id}
      AND (u.uitleen_datum <= '{$eersteWeekUitlenenFormatted}' AND u.inlever_datum >= '{$eersteWeekInleverenFormatted}');";

     
      

      $week1_result = mysqli_query($conn, $week1_query);
      $aantalEersteWeek -= mysqli_num_rows($week1_result);

      //beschikbaarheden checken voor week 2;
         $week2_query = "
         SELECT ei.exemplaar_item_id,u.uitleen_datum,u.inlever_datum
         FROM UITGELEEND_ITEM ui
         JOIN UITLENING u ON ui.uitleen_id = u.uitleen_id
         JOIN EXEMPLAAR_ITEM ei ON ui.exemplaar_item_id = ei.exemplaar_item_id
         WHERE ei.item_id = {$item_id}
         AND (u.uitleen_datum <= '{$tweedeWeekUitlenenFormatted}' AND u.inlever_datum >= '{$tweedeWeekInleverenFormatted}');";
   
         $week2_result = mysqli_query($conn, $week2_query);
        $aantalTweedeWeek -= mysqli_num_rows($week2_result);
    }

    if ($aantalEersteWeek > 0 && $aantalTweedeWeek > 0) {
        echo '<div class="datum">
            <label for="start_date">Begindatum:</label>
            <input type="date" id="start_date" name="start_date" min="'.$eersteWeekUitlenenFormatted.'" max="'.$tweedeWeekUitlenenFormatted.'" step="7" required>
        </div>';  
    } else if ($aantalEersteWeek > 0) {
  
        echo '<div class="datum">
            <label for="start_date">Begindatum:</label>
            <input type="date" id="start_date" name="start_date" min="'.$eersteWeekUitlenenFormatted.'" max="'.$eersteWeekUitlenenFormatted.'" value="'.$eersteWeekUitlenenFormatted.'" required>
        </div>';  
    } else if ($aantalTweedeWeek > 0) {
        echo '<div class="datum">
            <label for="start_date">Begindatum:</label>
            <input type="date" id="start_date" name="start_date" min="'.$tweedeWeekUitlenenFormatted.'" max="'.$tweedeWeekUitlenenFormatted.'" value="'.$tweedeWeekUitlenenFormatted.'" required>
        </div>';  
    }

    if ($aantalEersteWeek > 0 || $aantalTweedeWeek > 0) {

        echo '<input type="hidden" name="aantal1" value="' . $aantalEersteWeek . '">';
        echo '<input type="hidden"  name="aantal2" value="' . $aantalTweedeWeek . '">';
        echo '
            <input type="hidden" id="item_id" name="item_id" value="' . $item_id . '">
    
        <button type="submit" class="reserveer_nu_btn">Reserveer nu</button>
        <button class="winkelmand_toevoegen_btn">
            <p>Voeg toe</p>
            <img src="images/svg/cart-shopping-solid.svg" alt="winkelmandje">
        </button>';
    } else if ($aantalEersteWeek == 0 && $aantalTweedeWeek == 0) {
        echo '<h2>Dit artikel is de tweevolgende weken al uitgeleend, sorry.</h2>';
    }

} else if ($userType == "emailDOCENT") {

    echo '<div class="datum">
        <label for="start_date">Begindatum:</label>
        <input type="date" id="start_date" name="start_date" step="7" required>
    </div>
    <div class="datum">
        <label for="end_date">Einddatum:</label>
        <input type="date" id="end_date" name="end_date" step="7" required>
    </div>
    <div class="hoeveelheid">
        <input type="hidden" id="item_id" name="item_id" value="' . $item_id . '">
        <div class="aantal">
            <label for="quantity">Aantal:</label>
            <input type="number" id="quantity" name="quantity" value="1" min="1" required>
        </div>
    </div>
    <button type="submit" class="reserveer_nu_btn">Reserveer nu</button>
    <button class="winkelmand_toevoegen_btn">
        <p>Voeg toe</p>
        <img src="images/svg/cart-shopping-solid.svg" alt="winkelmandje">
    </button>'; 
}

echo '</div></form>';
?>
