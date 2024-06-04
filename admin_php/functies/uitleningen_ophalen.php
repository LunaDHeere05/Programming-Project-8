<?php
include 'database.php';

$query = "SELECT u.uitleen_id, 
                 u.email,
                 u.inlever_datum, u.uitleen_datum,
                 GROUP_CONCAT(CONCAT(i.merk, ' - ', i.naam) SEPARATOR '<br>') AS items,
                 u.isVerlengd
          FROM UITLENING u
          JOIN EXEMPLAAR_ITEM ei ON u.exemplaar_item_id = ei.exemplaar_item_id
          JOIN ITEM i ON ei.item_id = i.item_id
          WHERE u.isVerlengd = 0
          GROUP BY u.uitleen_id, u.email, u.inlever_datum";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . $row['items'] . "</td>";
        echo "<td>" . htmlspecialchars($row['uitleen_id']) . " </td>";
        echo "<td>" . htmlspecialchars(date("d/m", strtotime($row['uitleen_datum']))) . " - " . htmlspecialchars(date("d/m", strtotime($row['inlever_datum']))) . " </td>";
        echo "</tr>";
        
        //als de reservatie is verlengd moet da in een aparte rij komen anders zijn er problemen met de inlever_datum
        if ($row['isVerlengd'] == 1) {
            $extendedQuery = "SELECT u.*,
                                     CONCAT(i.merk, ' - ', i.naam) AS item
                              FROM UITLENING u
                              JOIN EXEMPLAAR_ITEM ei ON u.exemplaar_item_id = ei.exemplaar_item_id
                              JOIN ITEM i ON ei.item_id = i.item_id
                              WHERE u.uitleen_id = " . $row['uitleen_id'] . " AND u.isVerlengd = 1";

            $extendedResult = mysqli_query($conn, $extendedQuery);

            while ($extendedRow = mysqli_fetch_assoc($extendedResult)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($extendedRow['email']) . "</td>";
                echo "<td>" . htmlspecialchars($extendedRow['item']) . " (Verlengd)</td>";
                echo "<td>" . htmlspecialchars($extendedRow['uitleen_id']) . " </td>";                
                echo "<td>" . htmlspecialchars(date("d/m", strtotime($extendedRow['uitleen_datum']))) . " - " . htmlspecialchars(date("d/m", strtotime($extendedRow['inlever_datum']))) . " </td>";
                echo "</tr>";
            }
        }
    }
} else {
    echo "<tr><td colspan='5'>Er zijn momenteel geen uitleningen.</td></tr>";
}

mysqli_close($conn);
?>
