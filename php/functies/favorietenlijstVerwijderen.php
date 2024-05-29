<?php 

include '../database.php';
include '../sessionStart.php';

if(isset($gebruikersnaam)){
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$itemId=$_POST['itemId'];


$query="DELETE FI FROM FAVORIETE_ITEMS FI
JOIN FAVORIETENLIJST F on F.fav_id = FI.fav_id 
WHERE F.email = '$gebruikersnaam' AND FI.item_id=$itemId";

$result=mysqli_query($conn,$query);

};
}



?>