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
            $uitleenId = intval($Id);

            $query = "SELECT U.uitleen_id, U.uitleen_datum, U.inlever_datum, 
            EI.exemplaar_item_id,
            I.naam, I.beschrijving, I.images, I.item_id
            FROM UITLENING U
            JOIN EXEMPLAAR_ITEM EI ON U.exemplaar_item_id = EI.exemplaar_item_id
            JOIN ITEM I ON EI.item_id = I.item_id
            WHERE U.email = '$gebruikersnaam' AND U.isOpgehaald = 0 AND U.uitleen_id={$uitleenId}";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {
        $delete_items_query = "DELETE U FROM UITLENING U
         WHERE uitleen_id = {$row['uitleen_id']}";
        $delete_items_result = mysqli_query($conn, $delete_items_query);
    
        //gegevens bijhouden om die te kunnen gebruiken in Final page

        $_SESSION['annuleer_info'][] = [
            'item_id' => $row['item_id'],
            'inlever_datum' =>  $row['inlever_datum'],
            'uitleen_datum' =>  $row['uitleen_datum'],
            'uitleen_id' => $row['uitleen_id'],
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