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
    <style>
       .reserverenEnTerug{
    display: flex;
}
.reserverenEnTerug img{
    width: 1.5em;
    height: auto;
    margin: 1.5em;
}
.reserverenEnTerug h1{
    margin: 0.6em 0.5em 0em 0.5em;
}        .bevestig{
    margin: 0em 4em 2em 4em;
    font-size: 20px;
}
.item_info_container{
    background-color: rgb(193, 193, 193);
    width: 80%;
    margin: 1em auto;
    border-radius: 2em;
}
.item_info{
    display: flex;
    justify-content: space-around;
    align-items: center;
    position: relative;
}
.item_info img{
    width: 15%;
    height: 15%;
    margin: auto 1em;
}
.verwijder{
    position: absolute;
    right: 0;
    top: 0.5em;
    width: 2em !important;
}
.item_info_container img{
  width: 15%;
}
.bevestig_btn{
    background-color: #1bbcb6;
    padding: 1em;
    border-radius: 2em;
    margin: auto;
    width: 10em;
    text-align: center;
}
.bevestig_btn button{
  background: none;
  border: none;
  color: white;
  font-weight: bold;
  font-size: 20px;
  letter-spacing: 1px;
}
        </style>
</head>
<body>
    <?php include 'top_nav.php'?>
<div class="reserverenEnTerug">
    <a href="Home.php"><img src="images/svg/chevron-left-solid.svg" alt=""></a>
    <h1>Reserveren</h1>
</div>
<p class="bevestig">Deze items werden <b>succesvol</b> gereserveerd. Check je inbox voor een bevestigingsmail.</p>
<div class="item_info_container">
   
        <?php 


    if (isset($_SESSION['reservering_info'])){
    foreach ($_SESSION['reservering_info'] as $reservering) {
    $query = "SELECT i.*, COUNT(i.item_id) as aantal, u.uitleen_datum, u.inlever_datum
    FROM UITGELEEND_ITEM ui 
    JOIN EXEMPLAAR_ITEM ei on ei.exemplaar_item_id=ui.exemplaar_item_id 
    JOIN ITEM i on i.item_id=ei.item_id 
    JOIN UITLENING u on u.uitleen_id=ui.uitleen_id 
    WHERE u.uitleen_id={$reservering['uitleen_id']}
    GROUP BY i.item_id;";

    $query_result = mysqli_query($conn, $query);

    while ($query_result && $item_row = mysqli_fetch_assoc($query_result)) {

        $startDate=new dateTime($item_row['uitleen_datum']);
        $startDateString=$startDate->format('d-m-Y');

        $endDate=new dateTime($item_row['inlever_datum']);
        $endDateString=$endDate->format('d-m-Y');

        echo '<div class="item_info">';
        echo '   <img src="'. $item_row['images'] . '" alt="foto apparaat">';
        echo "<h2>" . $item_row['merk'] . ' - ' . $item_row['naam'] . "</h2>";
        echo '<p class="data"> Van '. $startDateString . '  tot '. $endDateString . '</p>';
        echo '<h3>Aantal: '. $item_row['aantal'] . ' </h3>';
        echo '</div>';
    }
        
    }
    }
        ?>
 
  
</div>
<?php include 'footer.php'?>
</body>
</html>