<?php
include 'database.php';

// Query to fetch recent items from the database
$query = "SELECT ITEM.naam AS item_naam, ITEM.merk AS item_merk
FROM RECENT_BEKEKEN
JOIN ITEM ON RECENT_BEKEKEN.recent_id = item_id
ORDER BY RECENT_BEKEKEN.recent_id DESC
LIMIT 4";
$result = mysqli_query($conn, $query);

// Check if query was successful
if ($result) {
    echo '<div class="recent_container">';
    echo '<h2>Recent bekeken</h2>';
    echo '<div class="recent_lijst_container">';
    echo '<img src="images/svg/chevron-left-solid.svg" alt="">';
    echo '<ul class="recent_lijst">';
    
    // Loop through each row of the result
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<li><a href="ApparaatPagina.php?apparaat_id"' .$row['item_id'] . '">"';
        echo '<img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="">';
        echo '<h3>' . $row['item_merk'] . ' - ' . $row['item_naam'] . '</h3>'; // Display the item name
        echo '</a></li>';
    }
    
    echo '</ul>';
    echo '<img src="images/svg/chevron-right-solid.svg" alt="">';
    echo '</div>';
    echo '</div>';
} else {
    // Handle errors
    echo "Error: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
