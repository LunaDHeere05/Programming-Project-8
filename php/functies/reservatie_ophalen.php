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
            $status = "TE LAAT";
            $kleur = "rgba(227,6,19, 0.5)";
            $annuleren = "0%";
            $allesanuleren = "0%";
        }else if($dagen_tot_inleveren == 0){
            $status = "Vandaag op te halen";
            $kleur = "rgb(193, 193, 193)";
            $annuleren = "100%";
        }
        else{
            $status = "Binnen " .$dagen_tot_inleveren ." dagen op te halen";
            $kleur = "rgb(193, 193, 193)";
            $annuleren = "100%";
        }
            echo '
            <div class="opgehaald_lijst_container">
                <div class="opgehaald_reservatie_container">
                    <label style="opacity: '.$annuleren.';" for="#">
                        <input type="checkbox">
                    </label>
                    <div class="reservatie_item">
                        <a href="#" class="reservatie_item_a">
                            <ul style="background-color: '.$kleur.';">
                                <li><img src="' . $row['images'] . '" alt=""></li>
                                <li class="reservatie_info">
                                    <h3>' . $row['naam'] . '</h3>
                                    <p>van ' . $row['uitleen_datum'] . '</p>
                                    <p>tot ' . $row['inlever_datum'] . '</p>
                                    <h3>Aantal: <br><span>1</span></h3>
                                </li>
                                <li class="status">
                                    <h3>Status:</h3>
                                    <p><b style = "color: #E30613;">'.$status.'</b></p>
                                    <h3>Reservatie-ID: <br> <span>'.$row['uitleen_id'].'</span></h3>
                                </li>
                                <li style="opacity: '.$annuleren.';" class="annuleer_btn" >
                                <button value="'.$row['exemplaar_item_id'].'">
                                    <p>Annuleren</p>
                                    <img src="images/svg/circle-xmark-solid.svg" alt="xmark"/>
                                </button>
                                </li>
                            </ul>
                        </a>
                    </div>
                </div>
            </div>';
        }
    }
}

?>