<?php
include("database.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defect</title>
    <?php include 'top_nav_admin.php'?>
    <style>
        .inventaris_toe_specificaties {
            margin: 1em;
            background-color: #D9D9D9;
            border-radius: 2em;
            padding: 2em;
        }

        .inventaris_toe {
            display: flex;
            margin: 2em 2em 2em 0em;
        }

        .inventaris_toe h2 {
            margin: 0em 1em 0em 0em;
        }

        .inventaris_toe input {
            background-color: #fff;
            border-radius: 2em;
            border: 0;
            width: 17em;
            height: 1em;
            padding: 1em;
        }

        .inventaris_toe_block {
            display: flex;
        }

        .inventaris_toe_img button {
            width: 5em;
            height: auto;
            cursor: pointer;
            margin: 0.5em 1em 0em 8em;
            background-color: #D9D9D9;
            border: 0;
        }

        .inventaris_toe_text input {
            height: 2rem;
            width: 100%;
            border: 0;
            border-radius: 2em;
            margin: 0.5rem;
        }

        .inventaris_toe_verwijderen button {
            background-color: #E30613;
            border-radius: 2em;
            width: 15em;
            height: 3em;
            border: 0;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin: 1em 2em 0em 0em;
            display: flex;
            align-items: center;
            padding: 0em 0em 0em 1em;
        }

        .inventaris_toe_opslaan button {
            background-color: #1BBCB6;
            border-radius: 2em;
            width: 15em;
            height: 3em;
            border: 0;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin: 1em 0em 0em 0em;
        }

        .inventaris_toe_buttons {
            display: flex;
            justify-content: center;
        }

        .inventaris_toe_verwijderen img {
            width: 1em;
            height: auto;
            margin: 0em 0em 0em 0.5em;
            filter: invert(100%) sepia(0%) saturate(5878%) hue-rotate(26deg) brightness(116%) contrast(115%);
        }
    </style>
</head>

<body>

    <?php
    $item_id = $_GET['item_id'];

    $itemInfoQuery = "SELECT * FROM ITEM WHERE item_id = '$item_id'";
    $itemInfo = mysqli_query($conn, $itemInfoQuery);

    $row1 = mysqli_fetch_array($itemInfo);
    $naam = $row1["naam"];
    $merk = $row1["merk"];
    $categorie = $row1["categorie"];
    $beschrijving = $row1["beschrijving"];
    $gebruiksaanwijzing = $row1["gebruiksaanwijzing"];
    $image_id = $row1["image_id"];

    $functionaliteitQuery = "SELECT functionaliteit FROM FUNCTIONALITEIT WHERE item_id ='$item_id'";
    $functionaliteitResult = mysqli_query($conn, $functionaliteitQuery);
    $functionaliteitData = mysqli_fetch_all($functionaliteitResult);

    ?>

    <div class="inventaris_toe_specificaties">
        <div class="inventaris_toe_block">
            <div class="inventaris_toe_block1">
                <form id="the_form" method="POST" enctype="multipart/form-data">
                    <div class="inventaris_toe">
                        <h2>Apparaat naam:</h2>
                        <input id="apparaat_naam" name="apparaat_naam" type="text" value="<?php echo $naam ?>">
                    </div>
                    <div class="inventaris_toe">
                        <h2>Merk:</h2>
                        <input id="merk" name="merk" type="text" value="<?php echo $merk ?>">
                    </div>
                    <div class="inventaris_toe">
                        <h2>Categorie:</h2>
                        <input id="categorie" name="categorie" type="text" value="<?php echo $categorie ?>">
                    </div>
                    <div class="inventaris_toe">
                        <h2>Beschrijving:</h2>
                        <input id="beschrijving" name="beschrijving" type="text" value="<?php echo $beschrijving ?>">
                    </div>
                    

                    <input type="file" name="image">
                    <input type="text" name="link" value="<?php echo $gebruiksaanwijzing ?>">
                    <input type="hidden" name="item_id" value="<?php echo $item_id ?>">
                    

                    <div class="inventaris_toe_text">
                        <h2>Functionaliteit:</h2>
                        <?php
                        // Displaying each functionaliteit data
                        foreach ($functionaliteitData as $functionaliteit) {
                            echo "<input type='text' name ='functionaliteit[]' value='{$functionaliteit[0]}'><br>";
                        }
                        ?>
                    </div>
                    <div class="inventaris_toe_text">
                        <input name="functionaliteit[]" type="text" placeholder="Apparaat beschrijving ...">
                    </div>
                    <button type="button" onclick="addInputField()">Add another field</button>
                    <div class="inventaris_toe_buttons">
                    <div class="inventaris_toe_verwijderen">
                        <button name="submit" type="submit" onclick="submitForm('functies/InventarisVFunctie.php')">Apparaat verwijderen <img src="../images/svg/circle-xmark-solid.svg" alt="x"></button>
                        <input type="hidden" name="submit" value="Apparaat verwijderen">
                    </div>
                    <div class="inventaris_toe_opslaan">
                        <button name="submit" type="submit" onclick="submitForm('functies/InventarisWFunctie.php')">Wijzigingen opslaan </button>
                        <input type="hidden" name="submit" value="Wijzigingen opslaan">
                    </div>
                    </div>
                </form>

            </div>
            <div class="inventaris_toe_img">

            </div>
        </div>

    </div>
</body>
<script>

    function submitForm(action) {
        var form = document.getElementById('the_form');
        form.action = action;
        form.submit();
    }

    function addInputField() {
            // Create a new input element
            var newInput = document.createElement("input");

            // Set the input's attributes
            newInput.setAttribute("name", "functionaliteit[]");
            newInput.setAttribute("type", "text");
            newInput.setAttribute("placeholder", "Apparaat beschrijving ...");

            // Append the new input to the container
            document.querySelector(".inventaris_toe_text").appendChild(newInput);
    }

    document.getElementById('myForm').addEventListener('submit', function(e) {
        var inputs = document.querySelectorAll('input[name="functionaliteit[]"]');
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].value === '') {
                e.preventDefault();
                alert('Please fill out all functionaliteit fields before submitting.');
                return;
            }
        }
    });

    
</script>
</html>