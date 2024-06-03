<?php include 'sessionStart.php'; //AN: om te weten welke mail er gebruikt wordt om in te loggen
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 minimal-scale=1.0">
    <title>Reservatie annuleren</title>
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
            gap: 1em;
            justify-content: center;
            align-items: center;
        }

        .item_info {
            background-color: #edededcf;
            display: flex;
            justify-content: space-around;
            align-items: center;
            position: relative;
            width: 60em;
            height: 10em;
            padding: 2em;
            border-radius: 2em;
            transition: transform 0.5s ease;
        }

        .item_info img {
            width: 8em;
            height: 8em;
            background-color: white;
            padding:10px;
        }

        .verwijder {
            position: absolute;
            right: 2%;
            top: 0;
            width: 1.5em !important;
            cursor: pointer;
        }

        #formBevestiging {
            display: flex;
            flex-direction: column;
            gap: 1em;
            justify-content: center;
            align-items: center;
        }

        #formBevestiging .aantal {
            width: 55%;
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

        .annulerenEnTerug {
            display: flex;
        }

        .annulerenEnTerug img {
            width: 1.5em;
            height: auto;
            margin: 1.5em;
        }

        .annulerenEnTerug h1 {
            margin: 0.6em 0.5em 0em 0.5em;
        }
    </style>
</head>

<body>
    <?php include 'top_nav.php' ?>
    <div class="annulerenEnTerug">
        <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><img src="images/svg/chevron-left-solid.svg" alt=""></a>
        <h1>Annuleren</h1>
    </div>
    <p class="bevestig">Bevestig dat je deze items wilt <b>annuleren</b>.</p>
    <?php
    include 'database.php';


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (empty($_POST['ArrayAnnuleerItems'])) {
            die('Er is een fout opgetreden. Gelieve opnieuw te proberen.');
        }

        $jsonString = $_POST['ArrayAnnuleerItems'];

        echo "<script>var annuleerItems = JSON.parse('$jsonString');</script>";


        $Ids = json_decode($jsonString, true);

        foreach ($Ids as $Id) {
            $uitleenId = intval($Id);

            $query = "SELECT U.uitleen_id, U.uitleen_datum, U.inlever_datum, 
                EI.exemplaar_item_id,
                I.naam, I.beschrijving, I.images, I.merk
                FROM UITLENING U 
                JOIN EXEMPLAAR_ITEM EI ON U.exemplaar_item_id = EI.exemplaar_item_id
                JOIN ITEM I ON EI.item_id = I.item_id
                WHERE U.email = '$gebruikersnaam' AND U.isOpgehaald = 0 AND U.uitleen_id={$uitleenId}";

            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                    $startDate = new dateTime($row['uitleen_datum']);
                    $startDateString = $startDate->format('d-m-Y');

                    $endDate = new dateTime($row['inlever_datum']);
                    $endDateString = $endDate->format('d-m-Y');

                    echo '<div class="item_info_container">
        <div class="item_info">
            <img src="' . $row['images'] . '" alt="foto apparaat">
            <h2>' . $row['merk'] . ' - ' . $row['naam'] . '</h2>
            <p class="data">van ' . $startDateString . '<br> tot ' . $endDateString . '</p>
            <h2>Aantal: 1</h2>
        </div>
    </div> ';
                }
            }
        }
    }

    ?>
    <div class="bevestig_btn">
        <form action="functies/reservatie_annuleren.php" method="POST">
            <input type="hidden" id="hidden" name="ArrayAnnuleerItems">
            <button id="bevestig" name="bevestigAnnuleren">Bevestig</button>

        </form>

    </div>
    <?php include 'footer.php' ?>

    <script>
        document.getElementById('hidden').value = JSON.stringify(annuleerItems);
    </script>
</body>

</html>