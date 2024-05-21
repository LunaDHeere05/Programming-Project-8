<?php
include 'database.php';

//dit gaat gewoon de kit_id gaan halen die is meegegeven in kits_ophalen.php
if(isset($_GET['kit_id'])) {
    //sql injections vermijden
    $kit_id = mysqli_real_escape_string($conn, $_GET['kit_id']);

    // Delete kit from the database
    $delete_kit_query = "DELETE FROM KIT WHERE kit_id = '$kit_id'";
    $delete_result = mysqli_query($conn, $delete_kit_query);

    if($delete_result) {
        // gewoon opnieuw de pagina laden
        header("Location: Kits.php");
        exit();
    }
}
mysqli_close($conn);
?>
