<?php
include 'database.php';

        // Query to get the required data
        $query = "SELECT p.email, waarschuwingDatum AS datum,
                         w.exemplaar_item_id
                  FROM PERSOON p
                  JOIN WAARSCHUWING w ON p.email = w.email
                  WHERE w.waarschuwingsType = 'Te laat' AND p.rol='student'
                  ";

        $result = mysqli_query($conn, $query);
    

    if (mysqli_num_rows($result) > 0) {
        echo "    <tr>
        <th>E-mail</th>
        <th>Apparaat</th>
        <th>Dagen te laat</th>
        <th>Meer info</th>
    </tr>";
        while ($row = mysqli_fetch_assoc($result)) {

            $queryItemNaam = "SELECT i.item_id, i.naam, i.merk FROM ITEM i
            JOIN EXEMPLAAR_ITEM ei on ei.item_id=i.item_id
            WHERE ei.exemplaar_item_id=" . $row['exemplaar_item_id'];

            $itemNaam = mysqli_query($conn, $queryItemNaam);
            $itemNaamRow = mysqli_fetch_assoc($itemNaam);

            if ($itemNaamRow) {
                $huidigeDatum = new DateTime();
                $waarschuwingDatum = new DateTime($row['datum']);

                $verschil = $huidigeDatum->diff($waarschuwingDatum)->days;
                echo "<tr>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $itemNaamRow['merk'] . " - " . $itemNaamRow['naam'] . "</td>";
                echo "<td>" . $verschil . "</td>";
                echo "<td><a href='#'><img src='images/svg/circle-info-solid.svg' alt='meer info'></a></td>";
                echo "</tr>";
            }
        }
    } else {
        echo "Er zijn momenteel geen studenten te laat met het inleveren van hun uitlening(en). ";
    }


// Close the database connection
$conn->close();
?>
