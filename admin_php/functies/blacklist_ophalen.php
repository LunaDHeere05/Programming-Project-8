<?php
include 'database.php';

// Query to get the required data
$query = "SELECT s.email, 
                 GROUP_CONCAT(w.waarschuwingsType SEPARATOR ' - ') AS blacklistReasons, 
                 DATEDIFF(CURDATE(), MAX(w.waarschuwingDatum)) AS daysOnBlacklist,
                 COUNT(w.waarschuwing_id) AS warningCount
          FROM PERSOON s
          JOIN WAARSCHUWING w ON s.email = w.email
          GROUP BY s.email
          HAVING warningCount >= 2 AND daysOnBlacklist <= 90
          ORDER BY daysOnBlacklist DESC";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "    <tr>
    <th>E-mail</th>
    <th>Reden</th>
    <th>Dagen op blacklist</th>
    <th>Verwijder</th>
  </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td><a href='mailto:" . $row['email'] . "'>" . $row['email'] . "</a></td>";
        echo "<td>" . htmlspecialchars($row['blacklistReasons']) . "</td>";
        echo "<td style='color:red;font-weight:bold'>" . htmlspecialchars($row['daysOnBlacklist']) . "</td>";
        echo "<td><a href='#' class='verwijder_link' data-email='" . htmlspecialchars($row['email']) . "'><img class='verwijder' src='images/svg/circle-xmark-solid.svg' alt='verwijder van blacklist'></a></td>";
        echo "</tr>";
    }
} else {
    echo "Er staan momenteel geen studenten op de blacklist. ";
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['verwijderButton'])) {
        $email = $_POST['email'];

        $verwijderquery = "DELETE FROM WAARSCHUWING WHERE email = ?";
        $stmt = $conn->prepare($verwijderquery);
        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            echo "Student is verwijderd van de blacklist";
        } else {
            echo "Er is iets fout gegaan: " . $stmt->error;
        }
        $stmt->close();

        echo "$email is verwijderd van de blacklist.";
    }
}


// Close the database connection
$conn->close();
?>
