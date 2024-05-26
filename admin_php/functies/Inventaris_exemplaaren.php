<?php

//database connection

include 'database.php';

// Get the item_id from the URL
$item_id = $_GET['item_id'];

// Query to fetch all attributes from the table
$query = "SELECT * FROM EXEMPLAAR_ITEM WHERE item_id = $item_id";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query executed successfully
if ($result) {
    // Start the table
    echo "<table>";
    
    // Table header
    
    
    // Fetch and display the data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['exemplaar_item_id'] . "</td>";
        echo "<td class='isUitgeleend'>" . $row['isUitgeleend'] . "</td>";
        echo "<td class='zichtbaarheid'>". $row["zichtbaarheid"] . "</td>";
        echo "<td><img src='images/svg/screwdriver-wrench-solid.svg' alt='apparaat wijzigen'></td>";
        echo "<td><a href='functies/InventarisVEFunctie.php?item_id=".$row['item_id']."&exemplaar_item_id=".$row['exemplaar_item_id']."'><img src='images/svg/xmark-solid.svg' alt='apparaat verwijderen'></a></td>";
        
        
        echo "</tr>";
    }
    
    // End the table
    echo "</table>";
} else {
    // Handle the error if the query fails
    echo "Error: " . mysqli_error($connection);
}

// Close the database connection
mysqli_close($conn);

?>

