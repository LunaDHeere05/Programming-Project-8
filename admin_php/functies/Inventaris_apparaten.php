<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Programming-Project-8/admin_php/database.php';

$zoekbalkValue = isset($_POST['zoekbalkValue']) ? $_POST['zoekbalkValue'] : '';


$query = "SELECT ITEM.item_id, ITEM.categorie, ITEM.merk, ITEM.naam
        FROM ITEM
        JOIN EXEMPLAAR_ITEM ON ITEM.item_id = EXEMPLAAR_ITEM.item_id
        WHERE ITEM.naam LIKE '%$zoekbalkValue%'
        GROUP BY ITEM.item_id";
$result = mysqli_query($conn, $query);


while($row = mysqli_fetch_assoc($result)){
    $item_id = $row['item_id'];
    $query2 = "SELECT zichtbaarheid FROM EXEMPLAAR_ITEM WHERE item_id = $item_id";
    $result2 = mysqli_query($conn, $query2);
    $row2 = mysqli_fetch_assoc($result2);
    $zichtbaarheid = $row2['zichtbaarheid'];
    
    echo '<tr onclick="window.location=\'InventarisExemplaars.php?item_id='.$row['item_id'].'\';">';
    echo '<td>'.$row['merk'].' - '.$row['naam'].'</td>';
    echo '<td>'.$row['categorie'].'</td>';
    echo '<td>'.$row['item_id'].'</td>';

    /*if($zichtbaarheid == 1) {
        echo '<td><a href="functies/hideButtonFunctie.php?value=2&item_id='.$row['item_id'].'" onclick="toggleImageAndValue(this, \'images/svg/eye-off-svgrepo-com.svg\', \'images/svg/eye-solid.svg\', '.$row['item_id'].')"><img src="images/svg/eye-solid.svg" alt=""></a></td>';
    } else {
        echo '<td><a href="functies/hideButtonFunctie.php?value=1&item_id='.$row['item_id'].'" onclick="toggleImageAndValue(this, \'images/svg/eye-off-svgrepo-com.svg\', \'images/svg/eye-solid.svg\', '.$row['item_id'].')"><img src="images/svg/eye-off-svgrepo-com.svg" alt=""></a></td>';
    }
    echo '<td><a href="#"><img src="images/svg/screwdriver-wrench-solid.svg" alt=""></a></td>';*/
    echo '<td><a href="InventarisW-V.php?item_id='.$row['item_id'].'"><img src="images/svg/pen-to-square-regular.svg" alt="apparaat wijzigen"></a></td>';
    echo '</tr>';

}

mysqli_close($conn);
?>

<script>
/*function toggleImageAndValue(element, newImageSrc, oldImageSrc, itemId) {
    var imgElement = element.getElementsByTagName('img')[0];
    if (imgElement.src.endsWith(oldImageSrc)) {
        imgElement.src = newImageSrc;
        element.href = "functies/hideButtonFunctie.php?value=1&item_id=" + itemId;
    } else {
        imgElement.src = oldImageSrc;
        element.href = "functies/hideButtonFunctie.php?value=2&item_id=" + itemId;
    }
}*/
</script>