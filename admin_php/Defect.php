<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defect</title>
    <?php include 'top_nav_admin.php'?>
    <style>
        .defect_container {
            background-color: #D9D9D9;
            border: #D9D9D9;
            border-radius: 1em;
            padding: 1em;
            margin: 1.5em;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .defect_informatie span {
            color: #5B5B5B;
        }

        .defect_visueel_img img {
            background-color: #fff;
            padding: 1.5em;
            margin: 1em;
            height: auto;
            width: 7em;
            padding: 1em;
        }

        .defect_hersteld a, .defect_verwijder a {
            background-color: #1BBCB6;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: none;
            border-radius: 2em;
            width: 8.5em;
            height: 1em;
            text-decoration: none;
            color: white;
            padding: 1em;
            margin: 1em;
        }

        .defect_verwijder a {
            background-color: #E30613;
        }

        .defect_visueel {
            display: flex;
            align-items: center;
        }

        .defect_hersteld a img, .defect_verwijder img {
            width: 1em;
            height: auto;
            margin-left: 1em;
            filter: invert(100%) sepia(0%) saturate(5878%) hue-rotate(26deg) brightness(116%) contrast(115%);
        }

        .defect_acties {
            text-decoration: none;
            margin: 0 1em;
        }

        .defect_add {
            background-color: #D9D9D9;
            margin: 1.5em;
            padding: 0.5em;
            border-radius: 2em;
            height: auto;
            width: 10em;
        }

        .defect_add a {
            color: #5B5B5B;
            text-decoration: none;
        }

        #bevestiging_hersteld, #bevestiging_verwijderen {
            width: 40%;
            background-color: blue;
            padding: 4em;
            text-align: center;
            border-radius: 2em;
            position: fixed;
            z-index: 9999;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
        }

        .jaNee {
            display: flex;
            justify-content: space-evenly;
            margin: 2em 1em 1em 1em;
            width: 100%;
        }

        .ja, .neen {
            background-color: #1BBCB6;
            width: 30%;
            height: 3em;
            border-radius: 2em;
            color: white;
            text-decoration: none;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .neen {
            background-color: #E30613;
        }

        .ja p, .neen p {
            margin: auto;
            font-weight: bold;
            font-size: 1.2em;
        }

        #close_hersteld, #close_verwijder {
            width: 1.5em;
            height: auto;
            position: absolute;
            top: 1em;
            right: 2em;
            cursor: pointer;
            z-index: 10000;
        }

        .blur {
            filter: blur(5px);
            pointer-events: none;
        }
    </style>
</head>
<body>
    <?php include 'functies/defect_ophalen.php'?>
    <div id="content">
        <div class="defect_add">
            <a href="DefectToevoegen.php">Defect toevoegen</a>
        </div>
        <!-- Add your other content here -->
    </div>

    <div id="bevestiging_hersteld">
        <h2>Bent u zeker dat u dit apparaat als 'hersteld' wilt aanduiden?</h2>
        <div class="jaNee">
            <form action="functies\defect_hersteld.php" method="post">
                <input type="hidden" name="defect_id" id="defect_id" value="">
                <button type="submit" class="ja"><p>Ja</p></button>
            </form>
            <button class="neen"><p>Neen</p></button>
        </div>
        <img id="close_hersteld" src="images/svg/xmark-solid.svg" alt="">
    </div>

    <div id="bevestiging_verwijderen">
        <h2>Bent u zeker dat u dit apparaat wilt verwijderen?</h2>
        <div class="jaNee">
            <form action="functies\defect_verwijderen.php" method="post">
                <input type="hidden" name="defect_id" id="defect_id_verwijder" value="">
                <button type="submit" class="ja"><p>Ja</p></button>
            </form>
            <button class="neen"><p>Neen</p></button>
        </div>
        <img id="close_verwijder" src="images/svg/xmark-solid.svg" alt="">
    </div>

    <script>
        document.querySelectorAll('.defect_hersteld a').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const defectId = this.getAttribute('defect_id');
                document.getElementById('defect_id').value = defectId;
                document.getElementById('bevestiging_hersteld').style.display = 'block';
                document.getElementById('content').classList.add('blur');
            });
        });

        document.getElementById('close_hersteld').addEventListener('click', function() {
            document.getElementById('bevestiging_hersteld').style.display = 'none';
            document.getElementById('content').classList.remove('blur'); // momenteel wordt enkel de button "defect toevoegen" geblurd
        });

        document.querySelectorAll('.defect_verwijder a').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const defectId = this.getAttribute('defect_id');
                document.getElementById('defect_id_verwijder').value = defectId;
                document.getElementById('bevestiging_verwijderen').style.display = 'block';
                document.getElementById('content').classList.add('blur');
            });
        });

        document.getElementById('close_verwijder').addEventListener('click', function() {
            document.getElementById('bevestiging_verwijderen').style.display = 'none';
            document.getElementById('content').classList.remove('blur');
        });

        document.querySelectorAll('.neen').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                document.getElementById('bevestiging_hersteld').style.display = 'none';
                document.getElementById('bevestiging_verwijderen').style.display = 'none';
                document.getElementById('content').classList.remove('blur');
            });
        });
    </script>
</body>
</html>
