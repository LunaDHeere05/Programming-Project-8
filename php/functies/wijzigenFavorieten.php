<?php
include '../database.php';
include '../sessionStart.php';

if (isset($gebruikersnaam)){

$itemId= $_POST['itemId'];

$query="SELECT 1
FROM FAVORIETE_ITEMS FI 
JOIN FAVORIETENLIJST F on F.Fav_id = FI.fav_id 
WHERE F.email = '$gebruikersnaam' AND FI.item_id={$itemId}";

$result=mysqli_query($conn,$query);

if(mysqli_num_rows($result)>0){
//betekent dat het al in favorieten zit en dat de bedoeling dus is om het item uit de lijst te verwijderen
$delete="DELETE FI FROM FAVORIETE_ITEMS FI
JOIN FAVORIETENLIJST F on F.fav_id = FI.fav_id 
WHERE F.email = '$gebruikersnaam' AND FI.item_id=$itemId";

$deleteResult=mysqli_query($conn,$delete);

}else if(mysqli_num_rows($result)==0){

$insert="INSERT INTO FAVORIETE_ITEMS (fav_id, item_id)
SELECT (SELECT fav_id FROM FAVORIETENLIJST WHERE email = '$gebruikersnaam') AS fav_id, $itemId";

$insertResult=mysqli_query($conn,$insert);
}

header("Location: ../Inventaris.php");
}

