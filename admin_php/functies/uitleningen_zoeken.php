<?php 
include 'database.php';

if (isset($_GET['zoekButton'])) {
    $zoek_query = $_GET['zoekquery'];
    if (!empty($zoek_query)) { // Controleer of de zoekopdracht niet leeg is
        $zoek_query = mysqli_real_escape_string($conn, $zoek_query);
        $zoek_resultaat = "SELECT u.email, ei.exemplaar_item_id, i.merk, i.naam, u.inlever_datum, u.uitleen_datum, u.uitleen_id
 FROM UITLENING u
 JOIN EXEMPLAAR_ITEM ei ON u.exemplaar_item_id = ei.exemplaar_item_id
 JOIN ITEM i ON ei.item_id = i.item_id
 WHERE u.email LIKE '%$zoek_query%' OR ei.exemplaar_item_id LIKE '%$zoek_query%' OR u.uitleen_id LIKE '%$zoek_query%' OR i.merk LIKE '%$zoek_query%' OR i.naam LIKE '%$zoek_query%'";
        $zoek_uitvoering_resultaat = mysqli_query($conn, $zoek_resultaat);

        if ($zoek_uitvoering_resultaat) {
          if (mysqli_num_rows($zoek_uitvoering_resultaat) > 0) {
              echo "<div class='result_tabel'>";
              echo "<table>";
              echo "<tr>";
              echo " <th>E-mail</th>";
              echo " <th>Apparaat</th>";
              echo " <th>Uitleen-id</th>";
              echo " <th>Uitleentermijn</th>";
              echo "</tr>";

              while ($result = mysqli_fetch_assoc($zoek_uitvoering_resultaat)) {
                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($result['email']) . "</td>";
                  echo "<td>" . htmlspecialchars($result['merk'] . ' - ' . $result['naam']) . "</td>";
                  echo "<td>" . htmlspecialchars($result['uitleen_id']) . "</td>";
                  echo "<td>" . htmlspecialchars(date("d/m", strtotime($result['uitleen_datum']))) . " - " . htmlspecialchars(date("d/m", strtotime($result['inlever_datum']))) . " </td>";
                  echo "</tr>";
              }
              echo "</table>";
              echo "</div>";
              echo "<style>";
              echo ".uitlening_tabel { display: none; }";
              echo "</style>";
          } else {
                die("Geen resultaten gevonden");
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