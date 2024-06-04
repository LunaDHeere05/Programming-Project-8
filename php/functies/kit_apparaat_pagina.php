<?php
include 'database.php';

$zitInBlackilst=false;

if(isset($gebruikersnaam)){
      //check om te zien of een user in de blacklist staat
      $queryCheck="SELECT W.* FROM WAARSCHUWING W
      JOIN PERSOON P on P.email=W.email
      WHERE W.email='$gebruikersnaam' AND P.rol='student'";

      $queryCheck_result=mysqli_query($conn,$queryCheck);

      if(mysqli_num_rows($queryCheck_result)>=2){
        $zitInBlackilst=true;
      }
    }
   


if($zitInBlackilst==true){
echo '<h2 style="text-align:center"> Je kan geen items reserveren omdat je in de blacklist zit.</h2>';

}else{
if(isset($_GET['apparaat_id'])) {
    $apparaat_id = $_GET['apparaat_id'];

    $kit_query = "SELECT DISTINCT KIT.kit_id, KIT.naam FROM KIT 
                    INNER JOIN ITEM_KIT ON KIT.kit_id = ITEM_KIT.kit_id 
                    WHERE ITEM_KIT.item_id = $apparaat_id";

    $kit_result = mysqli_query($conn, $kit_query);
}

if(isset($kit_result) && mysqli_num_rows($kit_result) > 0) {
    while($kit_row = mysqli_fetch_assoc($kit_result)) {
        $kit_id = $kit_row['kit_id'];
        
        // Hier is de overbodige query voor kitgegevens verwijderd

        $item_query = "SELECT ITEM.naam, ITEM.merk, ITEM.beschrijving, ITEM.images, ITEM.item_id, KIT.naam as kitNaam FROM ITEM 
                        INNER JOIN ITEM_KIT ON ITEM.item_id = ITEM_KIT.item_id 
                        INNER JOIN KIT ON KIT.kit_id = ITEM_KIT.kit_id 
                        WHERE ITEM_KIT.kit_id = $kit_id";
        $item_result = mysqli_query($conn, $item_query);

        if(mysqli_num_rows($item_result) > 0) {
            echo '<ul class="kit">';
            echo '<div class = "kits_naam animated-word"><h1>' . $kit_row['naam'] . '</h1> </div><div class = "kits_inhoud ">';

            while($item_row = mysqli_fetch_assoc($item_result)) {
                echo '<li>
                <img id="selectiebol" class="kitBol" src="images/svg/plus-circle.svg" alt="">
                <input id="id" type="hidden" value=' . $item_row['item_id'] . '>
                <a href="ApparaatPagina.php?apparaat_id=' . $item_row['item_id'] . '">
                <img src="' . $item_row['images'] . '" alt="foto apparaat">
                <h3>' . $item_row['merk'] . '-'.$item_row['naam']. '</h3>            
                </a></li>';
            }

            if(isset($gebruikersnaam)){
            echo "<div id='selectie_toevoegen'>";
            echo "<p>Voeg selectie toe aan winkelmand</p>";
            echo "</div></div>";
            }
            echo "</ul>" ;
        
         
        } else {
            echo "<p>Er zijn geen apparaten in deze kit.</p>";
        }
    }
}else{
    echo '<p>Geen kits gevonden voor dit apparaat.</p>';
}
}

?>
