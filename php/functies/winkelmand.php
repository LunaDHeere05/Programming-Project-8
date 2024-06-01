<?php 

include '../database.php';
include '../sessionStart.php';

if (isset($gebruikersnaam)) {
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['startDate']) || empty($_POST['endDate']) || empty($_POST['itemId']) || empty($_POST['aantal'])) {
        die('Alle velden moeten worden ingevuld.');
        }

        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $itemId = $_POST['itemId'];
        $aantal = $_POST['aantal'];

        //tegen SQL-injecties
        $startDate = mysqli_real_escape_string($conn, $startDate);
        $endDate = mysqli_real_escape_string($conn, $endDate);
        $itemId = intval($itemId);
        $aantal = intval($aantal);

        // controle of de datums geldig zijn en in het juiste formaat (bijv. YYYY-MM-DD)
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $startDate) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $endDate)) {
        die('Ongeldig datumformaat. Gebruik het formaat YYYY-MM-DD.');
        }
        
        // controle of de datums valide zijn
        if (!strtotime($startDate) || !strtotime($endDate)) {
        die('Ongeldige datums opgegeven.');
        }
        
        // controle of $aantal een geldig getal is en groter dan 0
        if (!is_numeric($aantal) || intval($aantal) <= 0) {
            die('Aantal moet een positief getal zijn.');
        }
        
        // controle of $itemId een geldig getal is en groter dan 0
        if (!is_numeric($itemId) || intval($itemId) <= 0) {
        die('Item ID moet een positief getal zijn.');
        }


//info steken in DB-winkelmand
$queryWinkelMandId="SELECT winkelmand_id FROM WINKELMAND WHERE email='$gebruikersnaam'";
$queryWinkelMandId_result=mysqli_query($conn,$queryWinkelMandId);
$queryWinkelMandId_row=mysqli_fetch_assoc($queryWinkelMandId_result);

//checken of item al in winkelmand staat
$queryCheck="SELECT * FROM WINKELMAND_ITEMS WHERE item_id=$itemId AND winkelmand_id={$queryWinkelMandId_row['winkelmand_id']} AND uitleen_datum='{$startDate}' AND inlever_datum='{$endDate}'";
$queryCheck_result=mysqli_query($conn,$queryCheck);

if(mysqli_num_rows($queryCheck_result)>0){
    $aantal+=mysqli_num_rows($queryCheck_result);
    $updateQuery = "UPDATE `WINKELMAND_ITEMS` SET `aantal` = {$aantal} WHERE `item_id` = {$itemId} AND `winkelmand_id` = {$queryWinkelMandId_row['winkelmand_id']}";
    mysqli_query($conn, $updateQuery);
}else{
$insertWinkelmand="INSERT INTO `WINKELMAND_ITEMS` (`winkelmand_id`, `item_id`, `uitleen_datum`, `inlever_datum`, `aantal`) VALUES (".$queryWinkelMandId_row['winkelmand_id'].", {$itemId}, '{$startDate}', '{$endDate}', {$aantal})";
$insertWinkelmand_result=mysqli_query($conn,$insertWinkelmand); 

}

}
}
?>