<?php
include '..\database.php';
include '..\sessionStart.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    if (empty($_POST['ArrayVerlengItems'])) {
            die('Er is een fout opgetreden. Gelieve opnieuw te proberen.');
            }
    
        $_SESSION['verleng_info']=[];

        $jsonString= $_POST['ArrayVerlengItems'];
    
        $Ids = json_decode($jsonString, true);
    
        foreach ($Ids as $Id) {           
            $uitleenId = intval($Id);

            $query = "SELECT U.uitleen_id, U.uitleen_datum, U.inlever_datum, U.isVerlengd,
            EI.exemplaar_item_id,
            I.*
            FROM UITLENING U 
            JOIN EXEMPLAAR_ITEM EI ON U.exemplaar_item_id = EI.exemplaar_item_id
            JOIN ITEM I ON EI.item_id = I.item_id
            WHERE U.email = '$gebruikersnaam' AND U.isOpgehaald = 1 AND U.uitleen_id={$uitleenId}"; 
                    
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $vergelijkDatum = new DateTime($row['inlever_datum']);
            $vergelijkDatum->setTime(0, 0, 0); 
    
            //query om te checken of item verlengbaar is 
            $volgendeMaandag = clone $vergelijkDatum; 
            $volgendeMaandag->modify('next Monday');
            $volgendeMaandagString=$volgendeMaandag->format('Y-m-d');
    
            $volgendeVrijdag = clone $volgendeMaandag;  
            $volgendeVrijdag->add(new DateInterval('P4D'));
            $volgendeVrijdagString=$volgendeVrijdag->format('Y-m-d');
            
    
            $queryCheck = "SELECT u.exemplaar_item_id
            FROM UITLENING u 
            JOIN EXEMPLAAR_ITEM ei ON u.exemplaar_item_id = ei.exemplaar_item_id
            WHERE u.uitleen_id = $uitleenId
            AND NOT EXISTS (
                SELECT 1
                FROM UITLENING u2
                WHERE u2.exemplaar_item_id = ei.exemplaar_item_id
                AND (
                    (u2.uitleen_datum <= '{$volgendeMaandagString}' AND u2.inlever_datum >= '{$volgendeVrijdagString}')
                    OR (u2.uitleen_datum >= '{$volgendeMaandagString}' AND u2.uitleen_datum < '{$volgendeVrijdagString}')
                    OR (u2.inlever_datum <= '{$volgendeVrijdagString}' AND u2.inlever_datum > '{$volgendeMaandagString}')
                )
            )
            AND ei.zichtbaarheid = 1";        
   



        $queryCheck_result=mysqli_query($conn, $queryCheck);   
        
        if(mysqli_num_rows($queryCheck_result)){
            $queryVerleng="UPDATE `UITLENING` SET `inlever_datum` = '{$volgendeVrijdagString}' WHERE `UITLENING`.`uitleen_id` = $uitleenId"; 
            $queryVerlengUpdate="UPDATE `UITLENING` SET `isVerlengd` = 1 WHERE `UITLENING`.`uitleen_id` = $uitleenId"; 
        }

        $queryVerleng_result = mysqli_query($conn, $queryVerleng);
        $queryVerlengUpdate_result = mysqli_query($conn, $queryVerlengUpdate);


        if($queryVerleng_result){
        //gegevens bijhouden om die te kunnen gebruiken in Final page
        $_SESSION['verleng_info'][] = [
            'item_id' => $row['item_id'],
            'uitleen_id' => $row['uitleen_id'],
            'inlever_datum' =>  $row['inlever_datum'],
            'uitleen_datum' =>  $row['uitleen_datum'],
        ];
        }

    
    header("Location: ../FinalVerlengenReservatie.php");
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


?>