<?php
include '..\database.php';
include '..\sessionStart.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    if (empty($_POST['ArrayVerlengItems'])) {
            die('Er is een fout opgetreden. Gelieve opnieuw te proberen.');
            }
    
        $jsonString= $_POST['ArrayVerlengItems'];
    
        $Ids = json_decode($jsonString, true);
    
        foreach ($Ids as $Id) {
            $exemplaarId = intval($Id['exemplaarId']);
            $uitleenId = intval($Id['uitleenId']);

            $vergelijkDatum = new DateTime($row['inlever_datum']);
            $vergelijkDatum->setTime(0, 0, 0); 
    
            //query om te checken of item verlengbaar is 
            $volgendeMaandag = clone $vergelijkDatum; 
            $volgendeMaandag->modify('next Monday');
            $volgendeMaandagString=$volgendeMaandag->format('Y-m-d');
    
            $volgendeVrijdag = clone $volgendeMaandag;  
            $volgendeVrijdag->add(new DateInterval('P4D'));
            $volgendeVrijdagString=$volgendeVrijdag->format('Y-m-d');
    
            $queryCheck="SELECT ei.exemplaar_item_id
            FROM EXEMPLAAR_ITEM ei
            WHERE ei.exemplaar_item_id = $exemplaarId 
            AND NOT EXISTS (
                SELECT 1
                FROM UITLENING u
                WHERE u.exemplaar_item_id = ei.exemplaar_item_id
                AND (
                    (u.uitleen_datum <= '{$volgendeMaandagString}' AND u.inlever_datum >= '{$volgendeVrijdagString}')
                    OR (u.uitleen_datum >= '{$volgendeMaandagString}' AND u.uitleen_datum < '{$volgendeVrijdagString}')
                    OR (u.inlever_datum <= '{$volgendeVrijdagString}' AND u.inlever_datum > '{$volgendeMaandagString}')
                    )
                )
            AND zichtbaarheid=1 
           ";



        $queryCheck_result=mysqli_query($conn, $queryCheck);   
        
        if(mysqli_num_rows($queryCheck_result)){
            $queryVerleng="UPDATE `UITLENING` SET `uitleen_datum` = '{$volgendeVrijdagString}' WHERE `UITLENING`.`uitleen_id` = $uitleenId"; ///// HERE I AMMMM
        }


        //gegevens bijhouden om die te kunnen gebruiken in Final page
        $_SESSION['verleng_info'][] = [
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


?>