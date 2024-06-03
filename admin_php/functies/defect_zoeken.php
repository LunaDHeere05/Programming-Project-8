<?php 
include 'database.php';

if (isset($_GET['zoekButton'])) {
    $zoek_query = $_GET['zoekquery'];
    if (!empty($zoek_query)) { // Controleer of de zoekopdracht niet leeg is
        $zoek_query = mysqli_real_escape_string($conn, $zoek_query);
        $zoek_resultaat = "SELECT defect_id, DEFECT.beschrijving, DEFECT.datum, bruikbaarheid, DEFECT.exemplaar_item_id, ITEM.naam, ITEM.item_id, ITEM.images
        FROM DEFECT
        JOIN EXEMPLAAR_ITEM ON DEFECT.exemplaar_item_id = EXEMPLAAR_ITEM.exemplaar_item_id
        JOIN ITEM ON EXEMPLAAR_ITEM.item_id = ITEM.item_id
        WHERE DEFECT.beschrijving LIKE '%$zoek_query%' OR DEFECT.exemplaar_item_id LIKE '%$zoek_query%' OR ITEM.naam LIKE '%$zoek_query%'";
        $zoek_uitvoering_resultaat = mysqli_query($conn, $zoek_resultaat);

        if ($zoek_uitvoering_resultaat) {
            if (mysqli_num_rows($zoek_uitvoering_resultaat) > 0) {

                while ($result = mysqli_fetch_assoc($zoek_uitvoering_resultaat)) {
                    echo '<div class="defect_container">
                    <div class="defect_visueel_img">
                        <img src="'.$result['images'].'" alt=""/>
                    </div>
                    <div class="defect_informatie"><h3>Naam: <span>' . $result['naam'] . '</span></h3>';
                    echo '<h3>Apparaat-ID: <span>' . $result['item_id'] . '</span></h3>';
                    echo '<h3>Exemplaar-ID: <span>' . $result['exemplaar_item_id'] . '</span></h3>';
                    echo '<h3>Defect: <span>' . $result['beschrijving'] . '</span></h3>';
                    echo '</div>
                    <!-- images  -->
                    <div class="defect_visueel">
                        <!-- verwijderen wijzigen  -->
                        <div class="defect_acties">
                            <div class="defect_hersteld">
                                <a href="#" defect_id="' . $result['defect_id'] . '">
                                    Hersteld
                                    <img src="images/svg/screwdriver-wrench-solid.svg" alt="xmark" />
                                </a>
                            </div>
                            <div class="defect_verwijder">
                                <a href="#" defect_id="' . $result['defect_id'] . '">
                                    Verwijder
                                    <img src="images/svg/circle-xmark-solid.svg" alt=""/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>';
                }
                echo "<style>";
                echo ".defect_ophalen_container { display: none; }";
                echo "</style>";
            } else {
                echo "Geen resultaten gevonden";
            }
        } else {
            echo "Query failed: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
