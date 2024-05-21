<?php
include 'database.php';

$query = "SELECT item_id, categorie, merk, naam
        FROM ITEM";
$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($result)){
    echo '<tr>';
    echo '<td>'.$row['merk'].' - '.$row['naam'].'</td>';
    echo '<td>'.$row['categorie'].'</td>';
    echo '<td>'.$row['item_id'].'</td>';
    echo '<td><a href="#"><img src="images/svg/eye-solid.svg" alt=""></a></td>
    <td><a href="#"><img src="images/svg/screwdriver-wrench-solid.svg" alt=""></a></td>
    <td><a href="#"><img src="images/svg/pen-to-square-regular.svg" alt="apparaat wijzigen"></a></td>
    </tr>';
}

mysqli_close($conn);
?>