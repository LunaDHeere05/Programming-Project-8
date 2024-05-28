<?php
include '..\database.php';
include '..\sessionStart.php';

function getExemplaarItemIDs($item_id) {
    global $conn;

    $query = "SELECT exemplaar_item_id 
            FROM EXEMPLAAR_ITEM 
            JOIN UITLENINGEN U ON EXEMPLAAR_ITEM.exemplaar_item_id = U.exemplaar_item_id
            WHERE item_id = '$item_id' AND U.{$userType} = '$email'";
    $result = mysqli_query($conn, $query);

    $exemplaar_item_ids = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $exemplaar_item_ids[] = $row['exemplaar_item_id'];
    }

    return $exemplaar_item_ids;
}
if (isset($_POST['item_id'])) {
    $item_id = $_POST['item_id']; // Retrieve item_id from the form submission
    $exemplaar_item_ids = getExemplaarItemIDs($item_id); // Call the function to get all exemplaar_item_id values

    // Display items with the retrieved exemplaar_item_id values
    if (!empty($exemplaar_item_ids)) {
        foreach ($exemplaar_item_ids as $exemplaar_item_id) {
            $item_query = "SELECT naam, merk, E.exemplaar_item_id
                             FROM ITEM
                             JOIN EXEMPLAAR_ITEM E ON ITEM.item_id = E.item_id
                             WHERE E.exemplaar_item_id = '$exemplaar_item_id'";
        $item_result = mysqli_query($conn, $item_query);

        if ($item_result && mysqli_num_rows($item_result) > 0) {
            $row = mysqli_fetch_assoc($item_result);
            echo '<div class="item_info_en_selectiebol">
                    <div id="selectie_bol">
                        <img src="images/svg/circle-regular.svg" alt="check">
                    </div>
                <div class="item_info_container">
                  <div class="item_info">
                      <img  src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="foto apparaat">
                  <h2>'.$row['merk']. '-'.$row['naam'].'</h2>
                  <div class="apparaat_id">
                      <h3>exemplaar ID:</h3>
                      <p>'.$row['exemplaar_item_id'].'</p>
                  </div>
                  <img class="verwijder" src="images/svg/xmark-solid.svg" alt="klik weg">
                  </div>
              </div>
            </div>
              </div>';
        }
    }
    } else {
        echo '<p>No items found with defects.</p>';
    }
} else {
    echo '<p>No item ID provided.</p>';
}
?>

