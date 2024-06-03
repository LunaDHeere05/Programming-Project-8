<?php
include 'database.php';

        // Query to get the required data
        $query = "SELECT p.email, waarschuwingDatum AS datum,
                         w.uitleen_id
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
    </tr>";
        while ($row = mysqli_fetch_assoc($result)) {

            $queryItemNaam = "SELECT i.item_id, i.naam, i.merk FROM ITEM i
            JOIN EXEMPLAAR_ITEM ei on ei.item_id=i.item_id
            JOIN UITLENING u on ei.exemplaar_item_id=u.exemplaar_item_id
            WHERE u.uitleen_id=" . $row['uitleen_id'];

            $itemNaam = mysqli_query($conn, $queryItemNaam);
            $itemNaamRow = mysqli_fetch_assoc($itemNaam);

            if ($itemNaamRow) {
                $huidigeDatum = new DateTime();
                $waarschuwingDatum = new DateTime($row['datum']);

                $verschil = $huidigeDatum->diff($waarschuwingDatum)->days;
                $verschil += 1;
                
                echo "<tr>";
                echo "<td><a href='mailto:" . $row['email'] . "'>" . $row['email'] . "</a></td>";
                echo "<td>" . $itemNaamRow['merk'] . " - " . $itemNaamRow['naam'] . "</td>";
                echo "<td style='color:red;font-weight:bold'>" . $verschil . "</td>";
                echo "</tr>";
            }
        }
    } else {
        echo "Er zijn momenteel geen studenten te laat met het inleveren van hun uitlening(en). ";
    }


// Close the database connection
$conn->close();
?>
