<?php
include("database.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wijzigen of Verwijderen</title>
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

        .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        }

        .close:hover,
        .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
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

    $functionaliteitQuery = "SELECT functionaliteit FROM FUNCTIONALITEIT WHERE item_id ='$item_id'";
    $functionaliteitResult = mysqli_query($conn, $functionaliteitQuery);
    $functionaliteitData = mysqli_fetch_all($functionaliteitResult);

    $inDoosQuery = "SELECT accessoire FROM ITEMBUNDEL WHERE item_id ='$item_id'";
    $inDoosResult = mysqli_query($conn, $inDoosQuery);
    $inDoosData = mysqli_fetch_all($inDoosResult);
    ?>

    <div class="inventaris_toe_specificaties">
        <div class="inventaris_toe_block">
            <div class="inventaris_toe_block1">
                <form id="form" method="POST" enctype="multipart/form-data">
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
                    <input type="file" name="usermanual" value="<?php echo $gebruiksaanwijzing ?>">
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
                        <input name="functionaliteit[]" type="text" placeholder="Apparaat functionaliteit ...">
                        <button type="button" onclick="addInputFieldFunct()">Add another field</button>
                    </div>

                    <div class="inventaris_toe_text">
                        <h2>Accessoires in de doos:</h2>
                        <?php
                        // Displaying each inDoos data
                        foreach ($inDoosData as $inDoos) {
                            echo "<input type='text' name ='in_doos[]' value='{$inDoos[0]}'><br>";
                        }
                        ?>

                    <div class="inventaris_toe_text">
                        <input name="in_doos[]" type="text" placeholder="Wat zit er in de doos?">
                        <button type="button" onclick="addInputFieldDoos()">Add another field</button>
                    </div>
                    
                    <div class="inventaris_toe_buttons">
                    <div class="inventaris_toe_verwijderen">
                        <button id="delete-btn" name="submitForm" type="button" onclick="openDeleteModal()">Apparaat verwijderen <img src="../images/svg/circle-xmark-solid.svg" alt="x"></button>
                        <input type="hidden" id="delete-input" name="submitForm" value="delete">
                        <input type="hidden" value="Apparaat verwijderen">
                    </div>
                    <div class="inventaris_toe_opslaan">
                        <button id="save-changes-btn" name="submitForm" type="button" onclick="openSaveChangesModal()">Wijzigingen opslaan </button>
                        <input type="hidden" id="save-input" name="submitForm" value="save">
                        <input type="hidden" value="Wijzigingen opslaan">                   
                    </div>
                    </div>
                </form>

            </div>
            <div class="inventaris_toe_img">

            </div>
        </div>
        <!-- The Modal for Delete -->
        <div id="deleteModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Are you sure you want to delete this item?</p>
                <button id="confirm-delete-btn">Yes</button>
                <button id="cancel-delete-btn">No</button>
            </div>
        </div>

        <!-- The Modal for Save Changes -->
        <div id="saveChangesModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Are you sure you want to save changes?</p>
                <button id="confirm-save-changes-btn">Yes</button>
                <button id="cancel-save-changes-btn">No</button>
            </div>
        </div>
    </div>
</body>
<script>

    var deleteModal = document.getElementById("deleteModal");
    var saveChangesModal = document.getElementById("saveChangesModal");

    // Get the buttons that open the modals
    var deleteBtn = document.getElementById("delete-btn");
    var saveChangesBtn = document.getElementById("save-changes-btn");

    // Get the <span> elements that close the modals
    var spans = document.getElementsByClassName("close");

    // When the user clicks the button, open the modal 
    function openDeleteModal() {
    deleteModal.style.display = "block";
    }

    function openSaveChangesModal() {
    saveChangesModal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    for (var i = 0; i < spans.length; i++) {
    spans[i].onclick = function() {
        deleteModal.style.display = "none";
        saveChangesModal.style.display = "none";
    }
    }

    // When the user clicks on Yes, submit the form
document.getElementById("confirm-save-changes-btn").onclick = function() {
    document.getElementById('form').action = "functies/InventarisWFunctie.php";
    document.getElementById('save-input').value = 'save'; // Set the value of the hidden input field
    document.getElementById('form').submit();
}

document.getElementById("confirm-delete-btn").onclick = function() {
    document.getElementById('form').action = "functies/InventarisVFunctie.php";
    document.getElementById('delete-input').value = 'delete'; // Set the value of the hidden input field
    document.getElementById('form').submit();
}

    // When the user clicks on No, close the modal
    document.getElementById("cancel-delete-btn").onclick = function() {
    deleteModal.style.display = "none";
    }

    document.getElementById("cancel-save-changes-btn").onclick = function() {
    saveChangesModal.style.display = "none";
    }

    function addInputFieldFunct() {
            // Create a new input element
            var newInput = document.createElement("input");

            // Set the input's attributes
            newInput.setAttribute("name", "functionaliteit[]");
            newInput.setAttribute("type", "text");
            newInput.setAttribute("placeholder", "Functionaliteit ...");

            // Append the new input to the container
            document.querySelector(".inventaris_toe_text").appendChild(newInput);
    }

    function addInputFieldDoos() {
            // Create a new input element
            var newInput = document.createElement("input");

            // Set the input's attributes
            newInput.setAttribute("name", "in_doos[]");
            newInput.setAttribute("type", "text");
            newInput.setAttribute("placeholder", "Cabels, oplader, SD-kaart, etc...");

            // Append the new input to the container
            document.querySelector(".in_doos_input").appendChild(newInput);
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