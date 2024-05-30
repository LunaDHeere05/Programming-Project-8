<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session if not already started
}

include '../database.php'; // Ensure this file correctly initializes $conn 

function getExemplaarItemIDs($item_id, $conn, $gebruikersnaam) {
    // SQL query to fetch exemplaar_item_id based on item_id and user's email
    $query = "SELECT ei.exemplaar_item_id 
              FROM EXEMPLAAR_ITEM ei 
              JOIN UITGELEEND_ITEM ui ON ui.exemplaar_item_id = ei.exemplaar_item_id 
              JOIN UITLENING u ON u.uitleen_id = ui.uitleen_id 
              JOIN ITEM i ON i.item_id = ei.item_id
              WHERE i.item_id = '$item_id' AND u.email = '$gebruikersnaam'";
    $result = mysqli_query($conn, $query);

    $exemplaar_item_ids = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $exemplaar_item_ids[] = $row['exemplaar_item_id'];
    }

    return $exemplaar_item_ids;
}

if (isset($_POST['item_id']) && isset($_SESSION['gebruikersnaam'])) {
    $item_id = $_POST['item_id'];
    $gebruikersnaam = $_SESSION['gebruikersnaam']; // Retrieve user's email from session

    // Ensure the function gets the connection and session information
    $exemplaar_item_ids = getExemplaarItemIDs($item_id, $conn, $gebruikersnaam);

    // Prepare the output in a variable
    $output = '';

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
                $output .= '<div class="item_info_en_selectiebol">
                                <div id="selectie_bol">
                                    <img src="images/svg/circle-regular.svg" alt="check">
                                </div>
                                <div class="item_info_container">
                                    <div class="item_info">
                                        <img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="foto apparaat">
                                        <h2>'.$row['merk'].'-'.$row['naam'].'</h2>
                                        <div class="apparaat_id">
                                            <h3>exemplaar ID:</h3>
                                            <p>'.$row['exemplaar_item_id'].'</p>
                                        </div>
                                        <img class="verwijder" src="images/svg/xmark-solid.svg" alt="klik weg">
                                    </div>
                                </div>
                            </div>';
            }
        }
        // Only redirect if items are found
        header('Location: ../DefectMelden.php');
        exit;
    } else {
        $output = '<p>No items found with defects.</p>';
    }

    echo $output;
} else {
    echo '<p>No item ID provided or session username not set.</p>';
}
exit;
?>
