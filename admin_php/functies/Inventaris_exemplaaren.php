<?php
// Database connection
include $_SERVER['DOCUMENT_ROOT'] . '/Programming-Project-8/admin_php/database.php';

// Check if a GET request with the parameter "zoekquery" exists
if (isset($_GET['zoekquery'])) {
    // Sanitize the input to prevent SQL injection
    $zoekquery = filter_input(INPUT_GET, 'zoekquery', FILTER_SANITIZE_STRING);

    // Modify your SQL query to filter the results based on the "zoekquery" parameter
    $query = "
        SELECT 
            EXEMPLAAR_ITEM.*, 
            IF(UITLENING.exemplaar_item_id IS NOT NULL, 1, 0) AS isUitgeleend 
        FROM 
            EXEMPLAAR_ITEM 
        LEFT JOIN 
            UITLENING 
        ON 
            EXEMPLAAR_ITEM.exemplaar_item_id = UITLENING.exemplaar_item_id 
        WHERE 
            EXEMPLAAR_ITEM.exemplaar_item_id LIKE '%" . $zoekquery . "%'
        GROUP BY
            EXEMPLAAR_ITEM.exemplaar_item_id";
} else {
    // Get the item_id from the URL
    $item_id = $_GET['item_id'];

    // Query to fetch all attributes from the table
    $query = "
        SELECT 
            EXEMPLAAR_ITEM.*, 
            IF(UITLENING.exemplaar_item_id IS NOT NULL, 1, 0) AS isUitgeleend 
        FROM 
            EXEMPLAAR_ITEM 
        LEFT JOIN 
            UITLENING 
        ON 
            EXEMPLAAR_ITEM.exemplaar_item_id = UITLENING.exemplaar_item_id 
        WHERE 
            EXEMPLAAR_ITEM.item_id = $item_id
        GROUP BY
            EXEMPLAAR_ITEM.exemplaar_item_id";
}

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query executed successfully
if ($result) {
    // Fetch and display the data
    echo "<tr>
    <th>Exemplaar-ID</th>
    <th>Uitgeleend</th>
    <th>Zichtbaar</th>
    <th>Item-ID</th>
    <th>Defect</th>
    <th>Verwijderen</th>
    </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['exemplaar_item_id']) . "</td>";
        echo "<td class='isUitgeleend'>" . htmlspecialchars($row['isUitgeleend']) . "</td>";
        echo "<td class='zichtbaarheid'>" . htmlspecialchars($row['zichtbaarheid']) . "</td>";
        echo "<td>" . htmlspecialchars($row['item_id']) . "</td>";
        echo "<td><a href='DefectToevoegen.php'><img src='images/svg/screwdriver-wrench-solid.svg' alt='apparaat wijzigen'></a></td>";
        echo "<td><a href='functies/InventarisVEFunctie.php?item_id=" . htmlspecialchars($row['item_id']) . "&exemplaar_item_id=" . htmlspecialchars($row['exemplaar_item_id']) . "'><img src='images/svg/xmark-solid.svg' alt='apparaat verwijderen'></a></td>";
        echo "</tr>";
    }
} else {
    // Handle the error if the query fails
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
