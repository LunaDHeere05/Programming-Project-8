<?php 
include 'sessionStart.php'; // Om te weten welke mail er gebruikt wordt om in te loggen
include 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservatie bevestiging</title>
    <link rel="stylesheet" href="/css/stylesheet.css">
    <style>
        .bevestig {
            margin: 0em 4em 2em 4em;
            font-size: 20px;
        }
        .item_info_container {
            background-color: rgb(193, 193, 193);
            width: 90%;
            margin: 1em auto;
            border-radius: 2em;
        }
        .item_info {
            display: flex;
            justify-content: space-around;
            align-items: center;
            position: relative;
        }
        .item_info img {
            width: 15%;
            height: 15%;
            margin: auto 1em;
        }
        .verwijder {
            position: absolute;
            right: 0;
            top: 0.5em;
            width: 2em !important;
        }
        .item_info_container img {
            width: 15%;
        }

        #formBevestiging{
            display: flex;
            flex-direction: column;
            gap:1em;
            justify-content: center;
            align-items: center;
        }

        #formBevestiging .aantal{
            width:25%;
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
    <div class="item_info">
        <img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="foto apparaat">
        <img class="verwijder" src="images/svg/xmark-solid.svg" alt="klik weg">

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if ($userType == "emailSTUDENT"){
            $beginDatum = $_POST['start_date'];
            $eindDatum = new DateTime($beginDatum);
            // Uitleentermijn bij studenten max één week dus van maandag tot vrijdag.
            $eindDatum->modify('+4 days');
            $eindDatumStr = $eindDatum->format('Y-m-d');  

            $itemId = $_POST['item_id'];

            $vandaag = new DateTime();
            // uitlenen kan enkel op maandag + reserveren kan max 2 weken vooraf
            $eersteWeekUitlenen = clone $vandaag;
            if ($vandaag->format('N') != 1) { 
              $eersteWeekUitlenen->modify('next Monday');
            }
            $eersteWeekUitlenenFormatted = $eersteWeekUitlenen->format('Y-m-d');
            
            $tweedeWeekUitlenen = clone $eersteWeekUitlenen;
            $tweedeWeekUitlenen->modify('+1 week');
            $tweedeWeekUitlenenFormatted = $tweedeWeekUitlenen->format('Y-m-d');

            // Checken welke maandag de user heeft gekozen, om bijhorend aantal beschikbare items te laten zien.
            if ($beginDatum == $eersteWeekUitlenenFormatted ) {
                $aantal = $_POST['aantal1'];
            } else if ( $beginDatum  == $tweedeWeekUitlenenFormatted) {
                $aantal = $_POST['aantal2'];
            } else {
                $aantal = 0; 
            }

            $itemId = (int) $itemId;
            $query = "SELECT naam, merk FROM ITEM WHERE item_id=$itemId";
            $query_result = mysqli_query($conn, $query);

            if ($query_result) {
                $item_row = mysqli_fetch_assoc($query_result);
                echo "<h2>" . $item_row['merk'] . ' - ' . $item_row['naam'] . "</h2>";
                echo '<form action="functies/reserveren.php" method="POST" id="formBevestiging">';
                echo '<p class="data"> Van ' .$beginDatum  . ' tot ' . $eindDatumStr . ' </p>';
                echo '<input type="hidden" name="itemId" value="' . $itemId . '">';
                echo '<input type="hidden" name="start_date" value="' . $beginDatum  . '">';
                echo '<input type="hidden" name="end_date" value="' . $eindDatumStr . '">';
                echo '<input type="hidden" name="merk" value="' . $item_row['merk'] . '">';
                echo '<input type="hidden" name="naam" value="' . $item_row['naam'] . '">';
                echo '<div class="aantal">';
                echo '<label for="aantal">Aantal:</label>';
                echo '<input type="number" id="aantal" name="aantal" value="1" min="1" max="' . $aantal . '" required>';
                echo '</div>';
               
                echo '</div>';
                echo '</div>';
                echo '<div class="bevestig_btn">';
                echo '<button type="submit">Bevestig</button>';
                echo '</form>';
                echo '</div>';
               
            } else {
                echo "Fout bij het ophalen van de itemgegevens.";
            }
        }

    }
        ?>
   
<?php include 'footer.php'?>
</body>
</html>
