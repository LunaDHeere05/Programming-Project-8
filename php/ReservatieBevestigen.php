<?php 
include 'database.php';
include 'sessionStart.php'; //AN: om te weten welke mail er gebruikt wordt om in te loggen
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservatie bevestiging</title>
    <!-- <link rel="stylesheet" href="../css/stylesheet.css"> -->
    <style>
        .bevestig {
            margin: 0em 4em 2em 4em;
            font-size: 20px;
        }
        .item_info_container {
            width: 90%;
            margin: 1em auto;
            border-radius: 2em;
            display: flex;
            flex-direction: column;
            gap:1em;
            justify-content: center;
            align-items: center;
        }
        .item_info {
            background-color: #edededcf;
            display: flex;
            justify-content: space-around;
            align-items: center;
            position: relative;
            width:60em;
            height:10em;
            padding: 1em;
            border-radius: 2em;
            transition: transform 0.5s ease; 
        }

        .item_info img {
            width: 8em;
            height: 8em;
               
        }
        .verwijder {
            position: absolute;
            right: 3%;
            top: 5%;
            width: 1.5em !important;
            cursor:pointer;
        }
    
        #formBevestiging{
            display: flex;
            flex-direction: column;
            gap:1em;
            justify-content: center;
            align-items: center;
        }
        #formBevestiging .aantal{
            width:55%;
            text-align: center;
        }
        .bevestig_btn {
            background-color: #1bbcb6;
            padding: 1em;
            border-radius: 2em;
            margin: auto;
            width: 10em;
            text-align: center;
        }
        .bevestig_btn button {
            background: none;
            border: none;
            color: white;
            font-weight: bold;
            font-size: 20px;
            letter-spacing: 1px;
        }
        .reserverenEnTerug {
            display: flex;
        }
        .reserverenEnTerug img {
            width: 1.5em;
            height: auto;
            margin: 1.5em;
        }
        .reserverenEnTerug h1 {
            margin: 0.6em 0.5em 0em 0.5em;
        }
    </style>
</head>
<body>
<?php include 'top_nav.php'?>
<div class="reserverenEnTerug">
    <a href="<?php echo $_SERVER['HTTP_REFERER'];?>"><img src="images/svg/chevron-left-solid.svg" alt=""></a>
    <h1>Reserveren</h1>
</div>
<p class="bevestig">Bevestig dat je deze item(s) wilt <b>reserveren</b>.</p>
<div class="item_info_container">
 


        <?php
    if(isset($gebruikersnaam)){

    if(!isset( $_POST['reserveerNu'])){ // hier gaan we checken of de user vanuit itempage reserveert of vanuit winkelmand

//WINKELMAND
    $query="SELECT * 
    FROM WINKELMAND_ITEMS wi 
    JOIN WINKELMAND w ON w.winkelmand_id=wi.winkelmand_id 
    JOIN ITEM i on i.item_id=wi.item_id 
    WHERE w.email =  '$gebruikersnaam'";
    
    $result=mysqli_query($conn,$query);
    
    if(mysqli_num_rows($result)>0){

        while($item_row=mysqli_fetch_assoc($result)){

        $aantal=$item_row['aantal'];
        $itemId=$item_row['item_id'];

        $vrijeExemplaren = "SELECT ei.exemplaar_item_id
        FROM EXEMPLAAR_ITEM ei
        WHERE ei.item_id = {$itemId}
        AND NOT EXISTS (
            SELECT 1
            FROM UITGELEEND_ITEM ui
            JOIN UITLENING u ON ui.uitleen_id = u.uitleen_id
            WHERE ui.exemplaar_item_id = ei.exemplaar_item_id
            AND (
                (u.uitleen_datum <= '" . $item_row['uitleen_datum'] . "' AND u.inlever_datum >=  '" . $item_row['inlever_datum'] . "' )
                OR (u.uitleen_datum >= '" . $item_row['uitleen_datum'] . "'  AND u.uitleen_datum <  '" . $item_row['inlever_datum'] . "' )
                OR (u.inlever_datum <=  '" . $item_row['inlever_datum'] . "'  AND u.inlever_datum > '" . $item_row['uitleen_datum'] . "' )
                )
            )
        AND zichtbaarheid=1
        LIMIT {$aantal};       
    "; 
            
        $vrijeExemplaren_result = mysqli_query($conn, $vrijeExemplaren);

        echo '<div class="item_info">';                
        echo '<img class="img" src="' . $item_row['images'] . '" alt="foto apparaat">';
        echo "<h2>" . $item_row['merk'] . ' - ' . $item_row['naam'] . "</h2>";

        if(mysqli_num_rows($vrijeExemplaren_result)>=$aantal){
                $startDate=new dateTime($item_row['uitleen_datum']);
                $startDateString=$startDate->format('d-m-Y');
        
                $endDate=new dateTime($item_row['inlever_datum']);
                $endDateString=$endDate->format('d-m-Y');

                echo '<img class="verwijder" id='.$item_row['item_id'].' src="images/svg/xmark-solid.svg" alt="klik weg">';          
                echo '<form id="formBevestiging">';
                echo '<p class="data"> Van ' .   $startDateString . ' tot ' .  $endDateString . ' </p>';
                echo '<input type="hidden" name="itemId" value="' . $itemId . '">';
                echo '<input type="hidden" name="start_date" value="' . $startDateString  . '">';
                echo '<input type="hidden" name="end_date" value="' . $endDateString . '">';
                echo '<input type="hidden" name="aantal" value="' . $aantal . '">';
                echo '<div class="aantal">';
                echo '<p>Aantal: '.$aantal.'</p>';
                echo '</div>';
                echo '</div>';
                echo '</form>';             
        }else{
            echo '<p> Dit artikel is intussen al uitgeleend en wordt uit je winkelmand verwijderd, sorry. </p>';
            echo '</div>';
            echo '</div>';

            $queryDelete="DELETE wi FROM WINKELMAND_ITEMS wi
            JOIN WINKELMAND w ON w.winkelmand_id=wi.winkelmand_id 
            WHERE w.email = '$gebruikersnaam' AND wi.item_id=$itemId";

            $resultDelete=mysqli_query($conn,$queryDelete);

            echo '<script>
            setTimeout(function(){
                window.location.reload();
            }, 2500);
            </script>';

        }
    }
            echo '</div>';
             echo '<div class="bevestig_btn">';
             echo '<form action="functies/winkelmandReserveren.php" method="POST"> 
                 <button type="submit">Bevestig</button>';
             echo '</form>';
             echo '</div>';

}else{
    //indien er geen items zijn in de winkelmand en de user niet op de 'reserveer nu' button heeft geklikt op item page gaat de website terug naar inventaris

   echo "<script>
       window.location.href = 'Inventaris.php';
</script>";

}

    }else{

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST['start_date']) || empty($_POST['hiddenEndDate']) || empty($_POST['itemId']) || empty($_POST['quantity'])) {
                die('Alle velden moeten worden ingevuld.');
                }

            //checks 
            $startDate = $_POST['start_date'];
            $endDate = $_POST['hiddenEndDate'];
            $itemId= $_POST['itemId'];
            $aantal= $_POST['quantity'];

            // Beveilig de waarden tegen SQL-injecties
            $startDate = mysqli_real_escape_string($conn, $startDate);
            $endDate = mysqli_real_escape_string($conn, $endDate);
            $itemId = intval($itemId);
            $aantal = intval($aantal);

            // controle of de waarden bestaan en niet leeg zijn
 
            
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

	
            $start_dateObject=new DateTime($startDate);
            $end_dateObject=new DateTime($endDate);
     
            $query = "SELECT naam, merk, images FROM ITEM WHERE item_id=$itemId";
            $query_result = mysqli_query($conn, $query);

            if ($query_result) {
                $item_row = mysqli_fetch_assoc($query_result);
                echo '<div class="item_info">';     
                echo '<img src="' . $item_row['images'] . '" alt="foto apparaat">';
                echo "<h2>" . $item_row['merk'] . ' - ' . $item_row['naam'] . "</h2>";
                echo '<form action="functies/reserveren.php" method="POST" id="formBevestiging">';
                echo '<p class="data"> Van ' .  $start_dateObject->format('d-m-Y')  . ' tot ' .  $end_dateObject->format('d-m-Y') . ' </p>';
                echo '<input type="hidden" name="itemId" value="' . $itemId . '">';
                echo '<input type="hidden" name="start_date" value="' . $startDate  . '">';
                echo '<input type="hidden" name="end_date" value="' . $endDate . '">';
                echo '<input type="hidden" name="aantal" value="' . $aantal . '">';
                echo '<div class="aantal">';
                echo '<p>Aantal: '.$aantal.'</p>';
                echo '</div>';
                echo '</div>';
               
                echo '</div>';
                echo '<div class="bevestig_btn">';
                echo '<form action="functies/reserveren.php" method="POST"> 
                    <button type="submit">Bevestig</button>';
                echo '</form>';
                echo '</div>';
            }
        }else {
            echo "Fout bij het ophalen van de itemgegevens.";
            echo "<script>
            window.location.href = 'Inventaris.php';
            </script>";
        }
        }
    }else {
        echo "Fout bij het ophalen van de itemgegevens.";
        echo "<script>
        window.location.href = 'Inventaris.php';
        </script>";
    }
    
include("footer.php"); ?>


<script>

//items verwijderen van lijst

document.addEventListener('click',function(e){
if(e.target.classList.contains('verwijder')){
    let formData = new FormData();
    console.log(e.target.id)
    formData.append('itemId', e.target.id);

  fetch('functies/winkelmandVerwijderen.php', {
        method: 'POST',
        body: formData
      }).then(response => response.text())
      .then(data => {
      e.target.parentElement.style.transform='translateX(1000px)'; 
      setTimeout(() => { 
        window.location.reload();
      }, 150)
})
  }
})


</script>
</body>
</html>