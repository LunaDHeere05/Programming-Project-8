<?php


//indien geen user is ingelogd;
if(!isset($userType) || !isset($email)){
  echo '<h2 class="login"> <a href="Profiel.php"> Log in</a> om een reservatie te plaatsen.</h2>';
}else{
    //html
    echo '<div class="datum">
    <label for="start_date">Begindatum:</label>
    <input type="date" id="start_date" name="start_date" step="7" required>
  </div>
  <div class="datum" div="einddatumDiv">
    <label for="end_date">Einddatum:</label>
    <input type="date" id="end_date" name="end_date" step="7" required>
  </div>
  <div id="hoeveelheid">
    <input type="hidden" id="item_id" name="item_id">
    <input type="hidden" id="hiddenEndDate" name="hiddenEndDate">
    <div class="aantal">
      <label for="quantity">Aantal:</label>
      <input type="number" id="quantity" name="quantity" min="1" value="1" required>
    </div>
  </div>
  <p id="onbeschikbaarDiv"></p>
  <button type="submit" class="reserveer_nu_btn" id="submit">Reserveer nu</button>
  <button class="winkelmand_toevoegen_btn" id="submitWinkelmand">
    <p>Voeg toe</p>
    <img src="images/svg/cart-shopping-solid.svg" alt="winkelmandje">
  </button>';
  }


?>