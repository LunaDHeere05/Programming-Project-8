<?php
include 'database.php';

// Check if a category is selected
if(isset($_GET['category'])) {
    $selected_category = htmlspecialchars($_GET['category']);
    echo '<div>';
    echo '<h2>Verfijn je resultaat</h2>';
    echo '<p>Je hebt de categorie <strong>' . $selected_category . '</strong> geselecteerd.</p>';
    echo '</div>';
}

// Query to fetch recent items from the database
$query = "SELECT DISTINCT categorie FROM ITEM";
$result = mysqli_query($conn, $query);

// Check if query was successful
if ($result) {
    echo '<div class="categorie">';
    echo '<a href="#"><h2>Categorieën</h2></a>';
    echo '<ul class="categorie_lijst">';
    
    // Loop through each row of the result
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<li><a href="inventaris.php?category=' . urlencode($row['categorie']) . '">' . htmlspecialchars($row['categorie']) . '</a></li>'; // Redirect to inventaris.php with the category parameter
    }
    echo '</ul>';
    echo '</div>';
} else {
    // Handle errors
    echo "Error: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
