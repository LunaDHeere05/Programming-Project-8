<?php 
include 'database.php';

if(isset($_GET['apparaat_id'])){
    $item_id = $_GET['apparaat_id'];
    $item_handleiding = "SELECT naam, gebruiksaanwijzing FROM ITEM WHERE item_id = $item_id";
    $item_handleiding_result = mysqli_query($conn, $item_handleiding);
    
    if($item_handleiding_result){
    
    $item_row = mysqli_fetch_assoc($item_handleiding_result);
    $pdf_handleiding = $item_row['gebruiksaanwijzing'];
    echo "<li><a href='$pdf_handleiding' target='_blank'>Bekijk de gebruikershandleiding</a></li>"; 
    
    }else{
        echo 'geen handleiding gevonden';
    }
}
mysqli_close($conn);
?>