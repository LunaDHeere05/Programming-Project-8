<?php 
include 'database.php' ;


if (isset($gebruikersnaam)) {

//info steken in winkelmand op website
$queryWinkelMandId="SELECT winkelmand_id FROM WINKELMAND WHERE email='$gebruikersnaam'";
$queryWinkelMandId_result=mysqli_query($conn,$queryWinkelMandId);
$queryWinkelMandId_row=mysqli_fetch_assoc($queryWinkelMandId_result);

$query = "SELECT i.item_id, i.naam, i.merk, i.images, wi.uitleen_datum, wi.inlever_datum, wi.aantal
            FROM ITEM i
            JOIN WINKELMAND_ITEMS wi ON wi.item_id = i.item_id
            WHERE wi.winkelmand_id = ".$queryWinkelMandId_row['winkelmand_id']."
              ";

$result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result)>0) {
        while ($row = mysqli_fetch_assoc($result)) {
           echo ' <div class="item">
            <img class="item_foto" src='.$row['images'].' alt="Item Image">
            <table>
                <tr>
                    <th>Naam</th>
                    <th>Datum</th>
                    <th>Aantal</th>
                </tr>
                <tr>
                    <td>'.$row['merk'].' - '. $row['naam'].'</td>
                    <td>Van '.$row['uitleen_datum'].' tot '.$row['inlever_datum'].'</td>
                    <td>'.$row['aantal'].'</td>
                </tr>
            </table>
            <img class="item_kruis" id='.$row['item_id'].'  src="images/svg/xmark-solid.svg" alt="Item Remove">
        </div>';
        
        }
        echo '<form action="functies/winkelmandReserveren.php" method="POST">
        <input type="submit" value="Reserveer nu">
    </form>';
    }else{
        echo "<div class='emptyCart'>";
        echo '<h2>Oops ...</h2>';
        echo '<p>Jouw winkelmand is momenteel leeg.</p>';
        echo '<img src="images/png/emptyCart.PNG">';
        echo "</div>";
    }
}else{
  echo '<h2 class="login"> <a href="Profiel.php"> Log in</a> om jouw winkelmand te gebruiken.</h2>';

}

?>