<?php
include 'database.php';

// Query to fetch recent items from the database
$query = "SELECT DISTINCT categorie FROM ITEM ORDER BY categorie ASC";
$result = mysqli_query($conn, $query);

// Check if query was successful
if ($result) {
    echo '<div class="categorie">';
    echo '<h2>Categorieën</h2>';
    echo '<div class="categorie_lijst">';
    
    // Loop through each row of the resdivt
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<a href="inventaris.php?categorie=' . urlencode($row['categorie']) . '">' . htmlspecialchars($row['categorie']) . '</a>'; 
    }
    echo '</ul>';
    echo '</div>';
    echo '</div>';
} 

?>
