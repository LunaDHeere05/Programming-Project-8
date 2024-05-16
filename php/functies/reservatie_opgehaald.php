<?php
include 'database.php';

$query = "SELECT U.uitleen_id, U.uitleen_datum, U.inlever_datum, U.isOpgehaald, U.isVerlengd,
                EI.exemplaar_item_id,
                I.naam, I.beschrijving
        FROM UITGELEEND_ITEM UI
        JOIN EXEMPLAAR_ITEM EI ON UI.exemplaar_item_id = EI.exemplaar_item_id
        JOIN ITEM I ON EI.item_id = I.item_id
        JOIN UITLENING U ON UI.uitleen_id = U.uitleen_id
        WHERE U.isOpgehaald = 1 AND U.emailStudent = 'student2@example.com'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $inlever_datum_timestamp = strtotime($row['inlever_datum']);
        $vandaag = time();
        $seconden_tot_inleveren = round(($inlever_datum_timestamp - $vandaag));
        $dagen_tot_inleveren = round($seconden_tot_inleveren / (60 * 60 * 24));
            echo '
            <div class="opgehaald_lijst_container">
                <div class="opgehaald_reservatie_container">
                    <label for="#">
                        <input type="checkbox">
                    </label>
                    <div class="reservatie_item">
                        <a href="#" class="reservatie_item_a">
                            <ul>
                                <li><img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt=""></li>
                                <li class="reservatie_info">
                                    <h3>' . $row['naam'] . '</h3>
                                    <p>van ' . $row['uitleen_datum'] . '</p>
                                    <p>tot ' . $row['inlever_datum'] . '</p>
                                    <h3>Aantal: <br><span>1</span></h3>
                                </li>
                                <li class="status">
                                    <h3>Status:</h3>
                                    <p><b>Binnen ' .$dagen_tot_inleveren .' dagen inleveren</b></p>
                                    <h3>Reservatie-ID: <br> <span>04125</span></h3>
                                </li>
                                <li>
                                    <div class="defect_btn">
                                        <button class="defect_button">
                                            <p>Defect melden</p>
                                            <img src="images/svg/screwdriver-wrench-solid.svg" alt="defect"/>
                                        </button>
                                    </div>
                                    <div class="verleng_btn">
                                        <button>
                                            <p>Verleng</p>
                                            <img src="images/svg/calendar-regular.svg" alt="verleng">
                                        </button>
                                    </div>
                                </li>
                            </ul>
                        </a>
                    </div>
                </div>
            </div>';
        }
}
?>