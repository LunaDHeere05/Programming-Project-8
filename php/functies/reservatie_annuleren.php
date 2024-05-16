<?php
include '..\database.php';
$query = "SELECT U.uitleen_id, U.uitleen_datum, U.inlever_datum, U.isVerlengd,
                EI.exemplaar_item_id,
                I.naam, I.beschrijving
                FROM UITGELEEND_ITEM UI
                JOIN EXEMPLAAR_ITEM EI ON UI.exemplaar_item_id = EI.exemplaar_item_id
                JOIN ITEM I ON EI.item_id = I.item_id
                JOIN UITLENING U ON UI.uitleen_id = U.uitleen_id AND U.isOpgehaald = 0
                WHERE U.{$user} = '$gebruikersnaam'"; 
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $delete_items_query = "DELETE FROM UITGELEEND_ITEM WHERE uitleen_id = {$row['uitleen_id']}";
        $delete_items_result = mysqli_query($conn, $delete_items_query);
        $delete_uitleen_query = "DELETE FROM UITLENING WHERE uitleen_id = {$row['uitleen_id']}";
        $delete_uitleen_result = mysqli_query($conn, $delete_uitleen_query);

        header("Location: ../FinalAnnulerenReservatie.php");
    }
}
exit();
mysqli_close($conn);
?>