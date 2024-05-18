<?php
include 'database.php';

// Query to get the required data
$query = "SELECT s.email, 
                 GROUP_CONCAT(w.WaarschuwingType SEPARATOR ' - ') AS blacklistReasons, 
                 DATEDIFF(CURDATE(), MAX(w.waarschuwingDatum)) AS daysOnBlacklist,
                 COUNT(w.waarschuwing_id) AS warningCount
          FROM STUDENT s
          JOIN WAARSCHUWING w ON s.email = w.emailStudent
          GROUP BY s.email
          HAVING warningCount > 1 AND daysOnBlacklist <= 90
          ORDER BY daysOnBlacklist DESC";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['blacklistReasons']) . "</td>";
        echo "<td>" . htmlspecialchars($row['daysOnBlacklist']) . "</td>";
        echo "<td><a href='#'><img class='meer_info' src='images/svg/circle-info-solid.svg' alt='meer informatie'></a></td>
              <td><a href='#'><img class='verwijder' src='images/svg/circle-xmark-solid.svg' alt='verwijder van blacklist'></a></td>";
        echo "</tr>";
    }
} else {
    echo "Er staan momenteel geen studenten op de blacklist. ";
}
?>
