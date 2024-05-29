<?php 

include '../database.php';
include '../sessionStart.php';

if(isset($gebruikersnaam)){

$query="SELECT * FROM WINKELMAND_ITEMS wi
JOIN WINKELMAND w ON w.winkelmand_id=wi.winkelmand_id 
WHERE w.email = '$gebruikersnaam'";

$result=mysqli_query($conn,$query);

while($row=mysqli_fetch_assoc($result)){    
    $uitlening = "INSERT INTO UITLENING (uitleen_datum, inlever_datum, email) VALUES ('".$row['uitleen_datum']."', '".$row['inlever_datum']."','$gebruikersnaam')";
    
    if (mysqli_query($conn, $uitlening)) {
        // Get the ID of the newly inserted row
        $uitleen_id = mysqli_insert_id($conn);
    
            $vrijeExemplaren = "SELECT ei.exemplaar_item_id
            FROM EXEMPLAAR_ITEM ei
            WHERE ei.item_id = ".$row['item_id']."
            AND NOT EXISTS (
                SELECT 1
                FROM UITGELEEND_ITEM ui
                JOIN UITLENING u ON ui.uitleen_id = u.uitleen_id
                WHERE ui.exemplaar_item_id = ei.exemplaar_item_id
                AND (
                    (u.uitleen_datum <= '".$row['uitleen_datum']."' AND u.inlever_datum >= '".$row['inlever_datum']."')
                    OR (u.uitleen_datum >= '".$row['uitleen_datum']."' AND u.uitleen_datum < '".$row['inlever_datum']."')
                    OR (u.inlever_datum <= '".$row['inlever_datum']."' AND u.inlever_datum > '".$row['uitleen_datum']."')
                    )
                )
            AND zichtbaarheid=1
            LIMIT ".$row['aantal']."";
        
    
            $vrijeExemplaren_result = mysqli_query($conn, $vrijeExemplaren);
    
            if(mysqli_num_rows($vrijeExemplaren_result)>0){
             while ($exemplaren_row = mysqli_fetch_assoc($vrijeExemplaren_result)) {
    
            $uitgeleendItem = "INSERT INTO UITGELEEND_ITEM (exemplaar_item_id, uitleen_id) 
                                VALUES ('" . $exemplaren_row['exemplaar_item_id'] . "', '" . $uitleen_id . "')";
    
            //zonder dit werkt het niet - waarom??
            if (!mysqli_query($conn, $uitgeleendItem)) {
                        echo "Error inserting row into UITGELEEND_ITEM: " . mysqli_error($conn);
                    };
                
                    $updateSql = "UPDATE EXEMPLAAR_ITEM 
                                  SET isUitgeleend = 1 
                                  WHERE exemplaar_item_id = '" . $exemplaren_row['exemplaar_item_id'] . "'";
    
                    //zonder dit werkt het niet - waarom??
                    if (!mysqli_query($conn, $updateSql)) {
                        echo "Error updating EXEMPLAAR_ITEM: " . mysqli_error($conn);
                    };     

            //informatie in een session steken om die te kunnen gebruiken in volgende page
        
                }
            }else{
                    echo 'Dit item is intussen al uitgeleend, sorry.';
                }
      


                $_SESSION['reservering_info'][] = [
                    'uitleen_id' => $uitleen_id,
                ];
    
    } else {
        echo "Error inserting UITLENING: " . mysqli_error($conn);
    }
    
}


    //winkelmand resetten
    $query="DELETE wi FROM WINKELMAND_ITEMS wi
    JOIN WINKELMAND w ON w.winkelmand_id=wi.winkelmand_id 
    WHERE w.email = '$gebruikersnaam'";
    $result=mysqli_query($conn,$query);

    
    header("Location: ../FinalBevestigingReservatie.php");
}