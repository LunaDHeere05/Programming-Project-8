<?php
//database connection
include $_SERVER['DOCUMENT_ROOT'] . '/Programming-Project-8/admin_php/database.php';

// Check if a GET request with the parameter "zoekquery" exists
if (isset($_GET['zoekquery'])) {
    // Sanitize the input to prevent SQL injection
    $zoekquery = filter_input(INPUT_GET, 'zoekquery', FILTER_SANITIZE_STRING);

    // Modify your SQL query to filter the results based on the "zoekquery" parameter
    $query = "SELECT * FROM EXEMPLAAR_ITEM WHERE exemplaar_item_id LIKE '%" . $zoekquery . "%'";
} else {
    // Get the item_id from the URL
    $item_id = $_GET['item_id'];

    // Query to fetch all attributes from the table
    $query = "SELECT * FROM EXEMPLAAR_ITEM WHERE item_id = $item_id";
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
        echo "<td>" . $row['exemplaar_item_id'] . "</td>";
        echo "<td class='isUitgeleend'>" . $row['isUitgeleend'] . "</td>";
        echo "<td class='zichtbaarheid'>". $row["zichtbaarheid"] . "</td>";
        echo "<td>" . $row['item_id'] . "</td>";
        echo "<td><a href='DefectToevoegen.php'><img src='images/svg/screwdriver-wrench-solid.svg' alt='apparaat wijzigen'></a></td>";
        echo "<td><a href='functies/InventarisVEFunctie.php?item_id=".$row['item_id']."&exemplaar_item_id=".$row['exemplaar_item_id']."'><img src='images/svg/xmark-solid.svg' alt='apparaat verwijderen'></a></td>";
        echo "</tr>";
    }
} else {
    // Handle the error if the query fails
    echo "Error: " . mysqli_error($connection);
}

// Close the database connection
mysqli_close($conn);

?>