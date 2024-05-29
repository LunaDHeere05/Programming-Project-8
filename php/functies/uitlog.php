<?php
include '../sessionStart.php';
include '../database.php';

//bij het uitloggen -> winkelmand leegmaken
// $query="DELETE wi FROM WINKELMAND_ITEMS wi
// JOIN WINKELMAND w ON w.winkelmand_id=wi.winkelmand_id 
// WHERE w.email = '$gebruikersnaam'";
// $result=mysqli_query($conn,$query);

session_destroy();

header("Location: ../Home.php");
?>