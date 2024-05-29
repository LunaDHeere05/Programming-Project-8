<?php
include 'database.php';

if (isset($_GET['zoekButton'])) {
    $zoek_query = $_GET['zoekquery'];
    if (!empty($zoek_query)) { // Controleer of de zoekopdracht niet leeg is
        $zoek_query = mysqli_real_escape_string($conn, $zoek_query);
        $zoek_resultaat = "SELECT * FROM WAARSCHUWING WHERE (email = '$zoek_query' OR exemplaar_item_id = '$zoek_query') AND waarschuwingType = 'Te laat.'";
        $zoek_uitvoering_resultaat = mysqli_query($conn, $zoek_resultaat);

        if ($zoek_uitvoering_resultaat) {
            if (mysqli_num_rows($zoek_uitvoering_resultaat) > 0) {
                $result = mysqli_fetch_assoc($zoek_uitvoering_resultaat);
                echo "<div class='result_tabel'>";
                echo "<table>";
                echo " <th>E-mail</th>";
                echo "<th>Apparaat</th>";
                echo " <th>Dagen te laat</th>";
                echo " <th>Meer info</th>";
                echo "<tr>";
                echo "<td>" . htmlspecialchars($result['email']) . "</td>";
                echo "<td>" . htmlspecialchars($result['exemplaar_item_id']) . "</td>";
                echo "<td>" . htmlspecialchars($result['waarschuwingDatum']) . "</td>";
                echo "</tr>";
                echo "</table>";
                echo "</div>";
                echo "<style>";
                echo ".te_laat_tabel{
                    display: none;}";
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

<style>
   
    .result_tabel {
      width: 90%;
      text-align: center;
      margin: auto;
      margin-top: 2em;
    }

    .result_tabel table {
      border-collapse: collapse;
      margin: auto;
      width: 100%;
    }

    .result_tabel th,
    td {
      width: 30%;
      border-collapse: collapse;
      border-bottom: 2px solid rgb(193, 193, 193);
      border-left: 2px solid rgb(193, 193, 193);
    }

    .result_tabel tr:last-child td {
      border-bottom: none;
    }

    .result_tabel th:first-child,
    td:first-child {
      border-left: none;
    }

    .result_tabel .meer_info {
      width: 2em;
      height: auto;
      padding-top: 0.5em;
      filter: invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg);
    }
</style>