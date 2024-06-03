<?php
include 'database.php';

if (isset($_GET['zoekButton'])) {
  $zoek_query = $_GET['zoekquery'];
  if (!empty($zoek_query)) { // Controleer of de zoekopdracht niet leeg is
    $zoek_query = mysqli_real_escape_string($conn, $zoek_query);
    $zoek_resultaat = "SELECT s.email, 
        GROUP_CONCAT(w.waarschuwingsType SEPARATOR ' - ') AS blacklistReasons, 
        DATEDIFF(CURDATE(), MAX(w.waarschuwingDatum)) AS daysOnBlacklist,
        COUNT(w.waarschuwing_id) AS warningCount
 FROM PERSOON s
 JOIN WAARSCHUWING w ON s.email = w.email
 WHERE LOWER(w.email) LIKE LOWER('%$zoek_query%')
 GROUP BY s.email
 HAVING warningCount > 1 AND daysOnBlacklist <= 90
 ORDER BY daysOnBlacklist DESC;
 ";
    $zoek_uitvoering_resultaat = mysqli_query($conn, $zoek_resultaat);

    if (mysqli_num_rows($zoek_uitvoering_resultaat) > 0) {
      echo "    <tr>
              <th>E-mail</th>
              <th>Reden</th>
              <th>Dagen op blacklist</th>
              <th>Verwijder</th>
            </tr>";
      while ($result = mysqli_fetch_assoc($zoek_uitvoering_resultaat)) {
        echo "<tr>
                <td>" . htmlspecialchars($result['email']) . "</td>";
        echo "<td>" . htmlspecialchars($result['blacklistReasons']) . "</td>";
        echo "<td>" . htmlspecialchars($result['daysOnBlacklist']) . "</td>";
        echo "<td><a href='#' class='verwijder_link' data-email='" . htmlspecialchars($result['email']) . "'><img class='verwijder' src='images/svg/circle-xmark-solid.svg' alt='verwijder van blacklist'></a></td>";
        echo "</tr>";
      }
    } else {
      echo "Geen resultaten gevonden";
    }
    mysqli_close($conn);
  } else {
    //indien de admin op de loop drukt, worden alle resultaten opgehaald
    include 'functies/blacklist_ophalen.php';
  }
}
