<?php 

include '../database.php';
include '../sessionStart.php';

if (isset($gebruikersnaam)) {
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $itemId = $_POST['itemId'];
    $aantal = $_POST['aantal'];

//info steken in DB-winkelmand
$queryWinkelMandId="SELECT winkelmand_id FROM WINKELMAND WHERE email='$gebruikersnaam'";
$queryWinkelMandId_result=mysqli_query($conn,$queryWinkelMandId);
$queryWinkelMandId_row=mysqli_fetch_assoc($queryWinkelMandId_result);

$insertWinkelmand="INSERT INTO `WINKELMAND_ITEMS` (`winkelmand_id`, `item_id`, `uitleen_datum`, `inlever_datum`, `aantal`) VALUES (".$queryWinkelMandId_row['winkelmand_id'].", {$itemId}, '{$startDate}', '{$endDate}', {$aantal})";
$insertWinkelmand_result=mysqli_query($conn,$insertWinkelmand); 
}
}
?>