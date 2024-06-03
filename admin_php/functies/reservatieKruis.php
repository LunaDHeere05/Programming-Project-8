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
$email=$row['email'];

$vandaag=new DateTime();
$vandaagString=$vandaag->format('Y-m-d');

if($isOpgehaald==0){

    $insertQuery = "INSERT INTO `WAARSCHUWING` ( `waarschuwingDatum`, `waarschuwingsType`, `email`, `uitleen_id`) VALUES ('$vandaagString', 'niet opgehaald', '$email', '$uitleen_id')"; //reservatie niet opgehaald
    $insertQuery_result=mysqli_query($conn,$insertQuery);
    
}else{
   $insertQuery = "INSERT INTO `WAARSCHUWING` ( `waarschuwingDatum`, `waarschuwingsType`, `email`, `uitleen_id`) VALUES ('$vandaagString', 'te laat', '$email', '$uitleen_id')"; //reservatie niet ingeleverd
    $insertQuery_result=mysqli_query($conn,$insertQuery);
}

}

mysqli_close($conn);


?>
