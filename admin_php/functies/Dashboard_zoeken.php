<?php 
include 'database.php';
$date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');

if (isset($_GET['zoekButton'])) {
    $zoek_query = $_GET['zoekquery'];
    if (!empty($zoek_query)) { // Controleer of de zoekopdracht niet leeg is
        $zoek_query = mysqli_real_escape_string($conn, $zoek_query);
        $zoek_resultaat = "SELECT u.email, u.uitleen_id, ei.exemplaar_item_id, i.merk, i.naam, u.inlever_datum
        FROM UITLENING u
        JOIN UITGELEEND_ITEM ui ON u.uitleen_id = ui.uitleen_id
        JOIN EXEMPLAAR_ITEM ei ON ui.exemplaar_item_id = ei.exemplaar_item_id
        JOIN ITEM i ON ei.item_id = i.item_id
        WHERE u.email LIKE '%$zoek_query%' OR ui.uitleen_id LIKE '%$zoek_query%' OR i.merk LIKE '%$zoek_query%' OR i.naam LIKE '%$zoek_query%'";
        $zoek_uitvoering_resultaat = mysqli_query($conn, $zoek_resultaat);

        if ($zoek_uitvoering_resultaat) {
            if (mysqli_num_rows($zoek_uitvoering_resultaat) > 0) {
                while ($result = mysqli_fetch_assoc($zoek_uitvoering_resultaat)) {
                    $uitleen_id = $result['uitleen_id'];
                    $inlever_datum = $result['inlever_datum'];
                    $isOpgehaald = isset($result['isOpgehaald']) ? ($result['isOpgehaald'] ? "Ja" : "Nee") : "N/A";
                    $email = $result['email'];
                    $naam = $result['naam'];
                    
                    if ($isOpgehaald == "Ja") {
                      $status = 'In te leveren';
                    } else {
                      $status = 'Op te halen';
                    }

                    echo "<div class='uitleningen_dashboard_details'>";
                    echo "<div class='naam_reservatieID'>";
                    echo "<h3>". htmlspecialchars($email) . "</h3>";
                    echo "<h3>Reservatie-ID: <span>$uitleen_id</span></h3>";
                    echo "</div>";
                    echo "<h3>Apparaat: ". htmlspecialchars($naam) ."</h3>";
                    echo "<p>$status</p>";
                    echo "<div class='iconen'>";
                    echo "<a href='DefectToevoegen.php'><img class='schroevendraaier' src='images/svg/screwdriver-wrench-solid.svg' alt=''></a>";
                    echo "<img class='check' src='images/svg/circle-check-solid.svg' alt=''>";
                    echo "<img class='verwijder_btn' src='images/svg/circle-xmark-solid.svg' alt=''>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "<style>.agenda_container { display: none; }</style>";
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
