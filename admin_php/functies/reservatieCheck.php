<?php
// verwijder_reservatie.php

include '../database.php';

$reservatieID = intval($_POST['reservatieID']);


$query="SELECT * FROM UITLENING WHERE uitleen_id=$reservatieID";
$query_result=mysqli_query($conn,$query);

if($query_result){

$row=mysqli_fetch_assoc($query_result);

$uitleen_id = $row['uitleen_id'];
$uitleen_datum = $row['uitleen_datum'];
$inlever_datum = $row['inlever_datum'];
$isOpgehaald = $row['isOpgehaald'];

if($isOpgehaald==0){
    $updateQuery = "UPDATE UITLENING SET isOpgehaald = 1 WHERE uitleen_id = '$reservatieID'"; //reservatie net opgehaald
    $updateQuery_result=mysqli_query($conn,$updateQuery);
    
}else{
    $updateQuery = "DELETE U FROM UITLENING U WHERE uitleen_id = '$reservatieID'"; //reservatie net ingeleverd
    $updateQuery_result=mysqli_query($conn,$updateQuery);
}

}

mysqli_close($conn);
?>



