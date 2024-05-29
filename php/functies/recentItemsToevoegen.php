<?php
include 'database.php';

if (isset($gebruikersnaam)) {
    if (isset($item_id)) {
        $queryRecentId = "SELECT recent_id FROM `RECENT_BEKEKEN` WHERE email='$gebruikersnaam'";
        $resultRecentId = mysqli_query($conn, $queryRecentId);
        $result_rowRecentId = mysqli_fetch_assoc($resultRecentId);


        if ($result_rowRecentId) {
            //eerst checken of het geklikte item niet al in de lijst staat
            $check = "SELECT 1 FROM `RECENT_ITEMS` WHERE recent_id='" . $result_rowRecentId["recent_id"] . "' AND item_id=$item_id";
            $resultCheck = mysqli_query($conn, $check);

            if (mysqli_num_rows($resultCheck) == 0) {
                $insert = "INSERT INTO `RECENT_ITEMS` (`recent_id`, `item_id`) VALUES ('" . $result_rowRecentId["recent_id"] . "', $item_id)";
                $insertResult = mysqli_query($conn, $insert);
            }
        }

        //enkel de 4 meest recente items bijhouden (adhv timestamps)       
        $keepItemsQuery = "SELECT `item_id` FROM `RECENT_ITEMS` WHERE recent_id='" . $result_rowRecentId["recent_id"] . "' ORDER BY `wanneerBekeken` DESC LIMIT 4";
        $keepItemsResult = mysqli_query($conn, $keepItemsQuery);

        if ($keepItemsResult) {

            $keepItemIds = array();

            while ($row = mysqli_fetch_assoc($keepItemsResult)) {
                $keepItemIds[] = $row['item_id'];
            }


            $deleteQuery = "DELETE FROM `RECENT_ITEMS` WHERE recent_id='" . $result_rowRecentId["recent_id"] . "' AND `item_id` NOT IN (" . implode(",", $keepItemIds) . ")";
            mysqli_query($conn, $deleteQuery);
        }
    } else {
        echo "No item found with item_id $item_id";
    }
}


?>
