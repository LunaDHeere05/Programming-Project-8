<?php 

include '../database.php';
include '../sessionStart.php';

if(isset($gebruikersnaam)){

$query="SELECT * FROM WINKELMAND_ITEMS wi
JOIN WINKELMAND w ON w.winkelmand_id=wi.winkelmand_id 
WHERE w.email = '$gebruikersnaam'";

$result=mysqli_query($conn,$query);

while($row=mysqli_fetch_assoc($result)){   
    $aantal=$row['aantal'];

            $vrijeExemplaren = "SELECT ei.exemplaar_item_id
            FROM EXEMPLAAR_ITEM ei
            WHERE ei.item_id = ".$row['item_id']."
            AND NOT EXISTS (
                SELECT 1
                FROM UITLENING u 
                WHERE u.exemplaar_item_id = ei.exemplaar_item_id
                AND (
                    (u.uitleen_datum <= '".$row['uitleen_datum']."' AND u.inlever_datum >= '".$row['inlever_datum']."')
                    OR (u.uitleen_datum >= '".$row['uitleen_datum']."' AND u.uitleen_datum < '".$row['inlever_datum']."')
                    OR (u.inlever_datum <= '".$row['inlever_datum']."' AND u.inlever_datum > '".$row['uitleen_datum']."')
                    )
                )
            AND zichtbaarheid=1
            LIMIT $aantal";
        
    
            $vrijeExemplaren_result = mysqli_query($conn, $vrijeExemplaren);
    
            if(mysqli_num_rows($vrijeExemplaren_result)>0){
             while ($exemplaren_row = mysqli_fetch_assoc($vrijeExemplaren_result)) {
                $uitgeleendItem = "INSERT INTO UITLENING (email, exemplaar_item_id, uitleen_datum, inlever_datum) 
                VALUES ('$gebruikersnaam', '" . $exemplaren_row['exemplaar_item_id'] . "', '".$row['uitleen_datum']."', '".$row['inlever_datum']."')";
    
            //zonder dit werkt het niet - waarom??
            if (!mysqli_query($conn, $uitgeleendItem)) {
                        echo "Error inserting row into UITGELEEND_ITEM: " . mysqli_error($conn);
                    };
                
       
                }
            }else{
                    echo 'Dit item is intussen al uitgeleend, sorry.';
                }
      
                $_SESSION['reservering_info'][] = [
                    'uitleen_id' => $uitleen_id
                ];
    
    } 
    

    //winkelmand resetten
    $query="DELETE wi FROM WINKELMAND_ITEMS wi
    JOIN WINKELMAND w ON w.winkelmand_id=wi.winkelmand_id 
    WHERE w.email = '$gebruikersnaam'";
    $result=mysqli_query($conn,$query);

    header("Location: ../FinalBevestigingReservatie.php");

}else{
    echo "<script>
        window.location.href = '../Home.php';
    </script>";
  
}

?>