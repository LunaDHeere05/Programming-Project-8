<?php
include 'database.php';


if (!isset($gebruikersnaam)) {
    echo '<p class="login"> <a href="Profiel.php"> Log in</a> om jouw reservaties te bekijken.</p>';
}else{
$query = "SELECT U.uitleen_id, U.uitleen_datum, U.inlever_datum,
                EI.exemplaar_item_id,
                I.*
                FROM UITLENING U
                JOIN EXEMPLAAR_ITEM EI ON U.exemplaar_item_id = EI.exemplaar_item_id
                JOIN ITEM I ON EI.item_id = I.item_id
                WHERE U.email = '$gebruikersnaam' AND U.isOpgehaald = 1"; 

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0) {

    //checken of er items zijn
    echo '
    <div id=forms>
    <form action="VerlengingAanvraag.php" method="POST" id="formVerleng">
    <input type="submit" value="Selectie verlengen" id="selectie_verlengen">
    <input type="hidden" id="hiddenV" name="ArrayVerlengItems">
    </form>
    <form action="VerlengingAanvraag.php" method="POST" id="formVerlengAll">
    <input type="submit" value="Alles verlengen" id="alles_verlengen">
    <input type="hidden" id="hiddenVAll" name="ArrayVerlengItems">
    </form>
    </div>
    ';

    while($row = mysqli_fetch_assoc($result)) {
      
        $vandaag = new DateTime();
        $vandaag->setTime(0, 0, 0);
        
        $vergelijkDatum = new DateTime($row['inlever_datum']);
        $vergelijkDatum->setTime(0, 0, 0); 

        $interval = $vandaag->diff($vergelijkDatum);
        $dagen_tot_inleveren= $interval->days;

        if ($vergelijkDatum < $vandaag) {
            $dagen_tot_inleveren *= -1; // Maak het verschil negatief als de uitleendatum in de toekomst ligt
        }

        if($dagen_tot_inleveren < 0){
            $status = "TE LAAT";
            $kleur = "rgba(227,6,19, 0.5)";
            $annuleren = "none";
        }else if($dagen_tot_inleveren == 0){
            $status = "Vandaag inleveren";
            $kleur = "#edededcf";
            $annuleren = "flex";
        }else{
            $status = "Binnen " .$dagen_tot_inleveren ." dag(en) in te leveren";
            $kleur = "#edededcf";
            $annuleren = "flex";
        }

        //query om te checken of item verlengbaar is 
        $volgendeMaandag = clone $vergelijkDatum; 
        $volgendeMaandag->modify('next Monday');
        $volgendeMaandagString=$volgendeMaandag->format('Y-m-d');

        $volgendeVrijdag = clone $volgendeMaandag;  
        $volgendeVrijdag->add(new DateInterval('P4D'));
        $volgendeVrijdagString=$volgendeVrijdag->format('Y-m-d');

        $queryCheck="SELECT ei.exemplaar_item_id
        FROM EXEMPLAAR_ITEM ei
        WHERE ei.exemplaar_item_id= {$row['exemplaar_item_id']}
        AND NOT EXISTS (
            SELECT 1
            FROM UITLENING u 
            WHERE u.exemplaar_item_id = ei.exemplaar_item_id
            AND (
                (u.uitleen_datum <= '{$volgendeMaandagString}' AND u.inlever_datum >= '{$volgendeVrijdagString}')
                OR (u.uitleen_datum >= '{$volgendeMaandagString}' AND u.uitleen_datum < '{$volgendeVrijdagString}')
                OR (u.inlever_datum <= '{$volgendeVrijdagString}' AND u.inlever_datum > '{$volgendeMaandagString}')
                )
            )
        AND zichtbaarheid=1 
       ";
        
        $queryCheck_result=mysqli_query($conn, $queryCheck);

        $reserveringMogelijk=false;

        if(mysqli_num_rows($queryCheck_result)){
            $reserveringMogelijk=true;
        }


        echo '  </div>
        <div class="ophalen_lijst_container">
            <div class="opgehaald_reservatie_container">
            ';

            if($dagen_tot_inleveren>=0 && $reserveringMogelijk==true){
            echo '
                <label>
                    <input class="verlengenCheck" type="checkbox" value='.$row['uitleen_id'].'>
                </label>';
            }
            echo '
                    <div class="reservatie_item">
                            <ul style="background-color:'.$kleur.';">
                                <li><img src="' . $row['images'] . '" alt=""></li>
                                <li class="reservatie_info">
                                    <h3>' . $row['naam'] . '</h3>
                                    <p>van ' . $row['uitleen_datum'] . '</p>
                                    <p>tot ' . $row['inlever_datum'] . '</p>
                                    <h3>Aantal: <br><span>1</span></h3>
                                </li>
                                <li class="status">
                                    <h3>Status:</h3>
                                    <p><b>'.$status.'</b></p>
                                    <h3>Reservatie-ID: <br> <span>'.$row['uitleen_id'].' </span></h3>
                                </li>';

                                if($dagen_tot_inleveren>=0 && $reserveringMogelijk==true){
                                    echo '        
                                    <li  class="verleng_btn" >
                                    <button class="verleng" value='.$row['uitleen_id'].'>
                                        Verlengen
                                        <img src="images/svg/calendar-regular.svg" alt="xmark"/>
                                    </button>
                                    </li>';
                                }
                                    echo '
                                    </ul>
                                    </div>
                            </div>
                            ';

        }
}
}
?>