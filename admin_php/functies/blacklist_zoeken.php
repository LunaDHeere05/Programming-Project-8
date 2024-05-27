<?php
include 'database.php';

if (isset($_GET['zoekButton'])) {
    $zoek_query = $_GET['zoekquery'];
    if (!empty($zoek_query)) { // Controleer of de zoekopdracht niet leeg is
        $zoek_query = mysqli_real_escape_string($conn, $zoek_query);
        $zoek_resultaat = "SELECT * FROM WAARSCHUWING WHERE emailSTUDENT = '$zoek_query'";
        $zoek_uitvoering_resultaat = mysqli_query($conn, $zoek_resultaat);

        if ($zoek_uitvoering_resultaat) {
            if (mysqli_num_rows($zoek_uitvoering_resultaat) > 0) {
                $result = mysqli_fetch_assoc($zoek_uitvoering_resultaat);
                echo "<div class='result_tabel'>";
                echo "<table>";
                echo " <th>E-mail</th>";
                echo "<th>Reden</th>";
                echo " <th>Dagen op blacklist</th>";
                echo " <th>Verwijder</th>";
                echo "<tr>";
                echo "<td>" . htmlspecialchars($result['emailSTUDENT']) . "</td>";
                echo "<td>" . htmlspecialchars($result['waarschuwingType']) . "</td>";
                echo "<td>" . htmlspecialchars($result['waarschuwingDatum']) . "</td>";
                echo "<td><a href='#' class='verwijder_link' data-email='" . htmlspecialchars($result['emailSTUDENT']) . "'><img class='verwijder' src='images/svg/circle-xmark-solid.svg' alt='verwijder van blacklist'></a></td>";
                echo "</tr>";
                echo "</table>";
                echo "</div>";
                echo "<style>";
                echo ".blacklist_tabel{
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