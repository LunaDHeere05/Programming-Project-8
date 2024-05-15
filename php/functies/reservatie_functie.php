<?php
include 'database.php';

$query = $sql = "SELECT UI.uitleen_id, UI.inlever_datum, UI.isOpgehaald, UI.isVerlengd,
                        EI.exemplaar_item_id, EI.status AS exemplaar_status, EI.zichtbaarheid, EI.item_id,
                        I.item_name, I.item_description
                FROM UITGELEEND_ITEM UI
                JOIN EXEMPLAAR_ITEM EI ON UI.exemplaar_item_id = EI.exemplaar_item_id
                JOIN ITEM I ON EI.item_id = I.item_id
                WHERE UI.email = 'user1@example.com'";
$result = mysqli_query($conn, $query);
if($result){
    echo 'gelukt';
}else{
    echo 'mislukt';
}
?>