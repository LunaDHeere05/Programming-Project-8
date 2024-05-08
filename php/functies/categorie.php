<?php
include 'database.php';
// Assuming you have already connected to your database

// Query to fetch recent items from the database
$query = "SELECT DISTINCT categorie FROM ITEM";
$result = mysqli_query($conn, $query);

// Check if query was successful
if ($result) {
    echo '<div class="categorie">';
    echo '<a href="Categorie.php"><h2>Categorieën</h2></a>';
    echo '<ul class="categorie_lijst">';
    
    // Loop through each row of the result
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<li><a href="#">' . $row['categorie'] . '</a></li>'; // Display the category
    }
    
    echo '</ul>';
    echo '</div>';
} else {
    // Handle errors
    echo "Error: " . mysqli_error($connection);
}


// Close the connection
mysqli_close($conn);
?>
