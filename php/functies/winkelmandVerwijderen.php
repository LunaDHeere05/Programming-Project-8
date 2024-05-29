<?php 

include '../database.php';
include '../sessionStart.php';

if(isset($gebruikersnaam)){
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$itemId=$_POST['itemId'];


$query="DELETE wi FROM WINKELMAND_ITEMS wi
JOIN WINKELMAND w ON w.winkelmand_id=wi.winkelmand_id 
WHERE w.email = '$gebruikersnaam' AND wi.item_id=$itemId";

$result=mysqli_query($conn,$query);

};
}



?>