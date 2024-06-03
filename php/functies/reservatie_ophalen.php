<?php
include 'database.php';


if (!isset($gebruikersnaam)) {
    echo '<p class="login"> <a href="Profiel.php"> Log in</a> om jouw reservaties te bekijken.</p>';
}else{
$query = "SELECT U.uitleen_id, U.uitleen_datum, U.inlever_datum,
                EI.exemplaar_item_id,
                I.naam, I.beschrijving,I.images, I.merk
                FROM UITLENING U 
                JOIN EXEMPLAAR_ITEM EI ON U.exemplaar_item_id = EI.exemplaar_item_id
                JOIN ITEM I ON EI.item_id = I.item_id
                WHERE U.email = '$gebruikersnaam' AND U.isOpgehaald = 0"; 

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0) {

    //checken of er items zijn
    echo '
    <div id=forms>
    <form action="ReservatieAnnuleren.php" method="POST" id="formAnnuleer">
    <input type="submit" value="Selectie annuleren" id="selectie_annuleren">
    <input type="hidden" id="hidden" name="ArrayAnnuleerItems">
    </form>
    <form action="ReservatieAnnuleren.php" method="POST" id="formAnnuleerAll">
    <input type="submit" value="Alles annuleren" id="alles_annuleren">
    <input type="hidden" id="hiddenAll" name="ArrayAnnuleerItems">
    </form>
    </div>
    ';

    while($row = mysqli_fetch_assoc($result)) {

        $vandaag = new DateTime();
        $vandaag->setTime(0, 0, 0);
        
        $vergelijkDatum = new DateTime($row['uitleen_datum']);
        $vergelijkDatum->setTime(0, 0, 0); 

        $interval = $vandaag->diff($vergelijkDatum);
        $dagen_tot_uitlenen= $interval->days;

        if ($vergelijkDatum < $vandaag) {
            $dagen_tot_uitlenen *= -1; 
        }
      

        if($dagen_tot_uitlenen < 0){
            $status = "TE LAAT";
            $kleur = "rgba(227,6,19, 0.5)";
       
        }else if($dagen_tot_uitlenen == 0){
            $status = "Vandaag op te halen";
            $kleur = "#edededcf";
        }
        else{
            $status = "Binnen " .$dagen_tot_uitlenen ." dag(en) op te halen";
            $kleur = "#edededcf;";
        }
            echo '  </div>
            <div class="ophalen_lijst_container">
                <div class="opgehaald_reservatie_container">
                ';

                if($dagen_tot_uitlenen>=0){
                echo '
                    <label>
                        <input class="annulerenCheck" type="checkbox" value='.$row['uitleen_id'].'>
                    </label>';
                }

                $startDate=new dateTime($row['uitleen_datum']);
                $startDateString=$startDate->format('d-m-Y');
        
                $endDate=new dateTime($row['inlever_datum']);
                $endDateString=$endDate->format('d-m-Y');

                echo '
                    <div class="reservatie_item">
                            <ul style="background-color: '.$kleur.';">
                                <li><img src="' . $row['images'] . '" alt=""></li>
                                <li class="reservatie_info">
                                    <h3>' . $row['merk'] . ' - ' . $row['naam'] . '</h3>
                                    <p>van ' .  $startDateString . '</p>
                                    <p>tot ' .  $endDateString . '</p>
                                    <h3>Aantal: <br><span>1</span></h3>
                                </li>
                                <li class="status">
                                    <h3>Status:</h3>
                                    <p><b style = "color: #E30613;">'.$status.'</b></p>
                                    <h3>Reservatie-ID: <br> <span>'.$row['uitleen_id'].'</span></h3>
                                </li>';

                if($dagen_tot_uitlenen>=0){
                    echo '        
                    <li  class="annuleer_btn" >
                    <button class="annuleer" value='.$row['uitleen_id'].'>
                        Annuleren
                        <img src="images/svg/circle-xmark-solid.svg" alt="xmark"/>
                    </button>
                    </li>';}
                    echo '
                    </ul>
                    </div>
            </div>
            ';
        }
    }
}

?>