<?php
include '../database.php';

if(isset($_GET['kit_id']) && isset($_GET['item_id'])){
    $kit_id = $_GET['kit_id'];
    $item_id = $_GET['item_id'];

    echo 'kit_id: ' . $kit_id . '<br>';
    echo 'item_id: ' . $item_id . '<br>';

    $delete_query = "DELETE FROM ITEM_KIT WHERE kit_id = $kit_id AND item_id = $item_id";
    $delete_result = mysqli_query($conn, $delete_query);

    if($delete_result){
        // Redirect back to the kit_wijzigen.php page or show a success message
        header("Location: ../KitWijzigen.php?kit_id=$kit_id");
        exit();
    } else {
        echo "Failed to remove item from kit: " . mysqli_error($conn);
    }
} else {
    echo "No kit_id or item_id provided.";
}
?>
