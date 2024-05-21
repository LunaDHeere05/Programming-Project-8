<?php

include("../database.php");

if (isset($_POST["submit"])) {

    $item_id = $_POST['item_id'];
    $apparaat = $_POST['apparaat_naam'];
    $merk = $_POST['merk'];
    $categorie = $_POST['categorie'];
    $beschrijving = $_POST['beschrijving'];
    $image = $_FILES['image']['name'];
    $link = $_POST['link'];
    $functionaliteit = $_POST['functionaliteit'];

    // Update ITEM table
    $valueUpdateQuery = "UPDATE ITEM SET ";
    if (!empty($apparaat)) $valueUpdateQuery .= "naam='$apparaat', ";
    if (!empty($merk)) $valueUpdateQuery .= "merk='$merk', ";
    if (!empty($categorie)) $valueUpdateQuery .= "categorie='$categorie', ";
    if (!empty($beschrijving)) $valueUpdateQuery .= "beschrijving='$beschrijving', ";
    if (!empty($link)) $valueUpdateQuery .= "gebruiksaanwijzing='$link', ";
    // Remove trailing comma and space
    $valueUpdateQuery = rtrim($valueUpdateQuery, ', ');
    $valueUpdateQuery .= " WHERE item_id='$item_id'";
    $conn->query($valueUpdateQuery);

    // Get func_ids for this item_id
    $funcIdsQuery = "SELECT functionaliteit_id FROM FUNCTIONALITEIT WHERE item_id='$item_id'";
    $result = $conn->query($funcIdsQuery);
    $func_ids = array();
    while ($row = $result->fetch_assoc()) {
        $func_ids[] = $row['functionaliteit_id'];
    }

    // Update each functionaliteit
    foreach ($functionaliteit as $index => $func) {
        if (isset($func_ids[$index])) {
        // Update existing row
        $func_id = $func_ids[$index];
        if (!empty($func)) {
            // Only update if new value is not empty
            $functionaliteitQuery = "UPDATE FUNCTIONALITEIT SET functionaliteit='$func' WHERE functionaliteit_id='$func_id'";
            $conn->query($functionaliteitQuery);
        }
        } else if (!empty($func)) {
        // Insert new row
            $functionaliteitQuery = "INSERT INTO FUNCTIONALITEIT (item_id, functionaliteit) VALUES ('$item_id', '$func')";
            $conn->query($functionaliteitQuery);
        }
    }

    mysqli_close($conn);

    header("Location: ../inventaris.php");
    exit();
}