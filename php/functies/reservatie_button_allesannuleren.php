<?php
include 'database.php';


if (!isset($gebruikersnaam)) {
    echo '<p class="login"> <a href="Profiel.php"> Log in</a> om jouw reservaties te bekijken.</p>';
}else{
$query = "SELECT U.uitleen_id, U.uitleen_datum, U.inlever_datum, U.isVerlengd,
                EI.exemplaar_item_id,
                I.naam, I.beschrijving,I.images
                FROM UITGELEEND_ITEM UI
                JOIN EXEMPLAAR_ITEM EI ON UI.exemplaar_item_id = EI.exemplaar_item_id
                JOIN ITEM I ON EI.item_id = I.item_id
                JOIN UITLENING U ON UI.uitleen_id = U.uitleen_id AND UI.isOpgehaald = 0
                WHERE U.email = '$gebruikersnaam'"; 

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $inlever_datum_timestamp = strtotime($row['uitleen_datum']);
        $vandaag = time();
        $seconden_tot_inleveren = round(($inlever_datum_timestamp - $vandaag));
        $dagen_tot_inleveren = round($seconden_tot_inleveren / (60 * 60 * 24));

        if($dagen_tot_inleveren < 0){
            $allesannuleren = "0%";
            break;

        }else{
            $allesannuleren = "100%";
           
        }
            echo '
            <div style="opacity: '.$allesannuleren.';" class="alles_annuleren">
            <a href="ReservatieAnnuleren.php">
              <p>Alles annuleren</p>
              <img src="images/svg/circle-xmark-solid.svg" alt="xmark" />
            </a>
          </div>
            ';
        }
    }
}

?>