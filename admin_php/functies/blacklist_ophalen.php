<?php
include 'database.php';

$query = "SELECT email, blacklistCounter FROM STUDENT
            WHERE blacklistCounter > 1";
            // er zou eigenlijk dan ook ge orderd moeten worden op hoelang een persoon op de blacklist staat

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['blacklistCounter'] . "</td>";
        echo "<td><a href='#'><img class='meer_info' src='images/svg/circle-info-solid.svg' alt='meer informatie'></a></td>
                <td><a href='#'><img class='verwijder' src='images/svg/circle-xmark-solid.svg' alt='verwijder van blacklist'></a></td>";
        echo "</tr>";
    }
} else {
    echo "Er staan momenteel geen studenten op de blacklist. ";
}

?>