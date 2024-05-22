<?php
include '..\database.php';

if(isset($_GET['kit_id'])) {
    //zorgen dat er geen sql injection kan zijn in de link
    $kit_id = mysqli_real_escape_string($conn, $_GET['kit_id']);
        //verwijderen van de rij in ITEM_KIT
        $delete_item_kit_query = "DELETE FROM ITEM_KIT WHERE kit_id = '$kit_id'";
        $delete_item_kit_result = mysqli_query($conn, $delete_item_kit_query);
        
        if(!$delete_item_kit_result) {
            throw new Exception("Failed to delete related items: " . mysqli_error($conn));
        }

        //verwijderen in KIT
        $delete_kit_query = "DELETE FROM KIT WHERE kit_id = '$kit_id'";
        $delete_kit_result = mysqli_query($conn, $delete_kit_query);
        
        if(!$delete_kit_result) {
            throw new Exception("Failed to delete kit: " . mysqli_error($conn));
        }

        // Dit gaat gwn de pagina herladen om te zien dat het is verwijdert
        header("Location: ..\Kits.php");
}
mysqli_close($conn);
?>
