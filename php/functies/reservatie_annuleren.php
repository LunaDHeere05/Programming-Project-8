<?php
include '..\database.php';
include '..\sessionStart.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    if (empty($_POST['ArrayAnnuleerItems'])) {
            die('Er is een fout opgetreden. Gelieve opnieuw te proberen.');
            }
    
        $jsonString= $_POST['ArrayAnnuleerItems'];
    
        $Ids = json_decode($jsonString, true);
    
        foreach ($Ids as $Id) {
            $exemplaarId = intval($Id['exemplaarId']);
            $uitleenId = intval($Id['uitleenId']);

            $query = "SELECT U.uitleen_id, U.uitleen_datum, U.inlever_datum, UI.isVerlengd,
            EI.exemplaar_item_id,
            I.naam, I.beschrijving, I.images, I.item_id
            FROM UITGELEEND_ITEM UI
            JOIN EXEMPLAAR_ITEM EI ON UI.exemplaar_item_id = EI.exemplaar_item_id
            JOIN ITEM I ON EI.item_id = I.item_id
            JOIN UITLENING U ON UI.uitleen_id = U.uitleen_id 
            WHERE U.email = '$gebruikersnaam' AND UI.isOpgehaald = 0 AND EI.exemplaar_item_id={$exemplaarId} AND U.uitleen_id={$uitleenId}";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {
        $delete_items_query = "DELETE UI FROM UITGELEEND_ITEM UI
         JOIN EXEMPLAAR_ITEM EI ON UI.exemplaar_item_id = EI.exemplaar_item_id
         WHERE uitleen_id = {$row['uitleen_id']} AND EI.exemplaar_item_id={$row['exemplaar_item_id']}";
        $delete_items_result = mysqli_query($conn, $delete_items_query);

        //check of er nog andere items in de uitlening zitten, indien niet wordt de uitlening ook verwijderd

        $check_delete_query="SELECT * FROM UITGELEEND_ITEM WHERE uitleen_id = {$row['uitleen_id']}";
        $check_delete_result = mysqli_query($conn, $check_delete_query);

        if(mysqli_num_rows($check_delete_result)==0){
        $delete_uitleen_query = "DELETE FROM UITLENING WHERE uitleen_id = {$row['uitleen_id']}";
        $delete_uitleen_result = mysqli_query($conn, $delete_uitleen_query);
        }
    
        //gegevens bijhouden om die te kunnen gebruiken in Final page

        $_SESSION['annuleer_info'][] = [
            'item_id' => $row['item_id'],
            'inlever_datum' =>  $row['inlever_datum'],
            'uitleen_datum' =>  $row['uitleen_datum'],
        ];



        header("Location: ../FinalAnnulerenReservatie.php");
    }
}else{
    echo "<script>
    window.location.href = 'Reservaties.php';
    </script>";
}
}
    }else{
        echo "<script>
        window.location.href = 'Reservaties.php';
        </script>";
    }