<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apparaat toevoegen</title>
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
      margin: 0.5em 1em 0em 8em ;
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

    /* The Modal (background) */
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
  </style>
</head>
<body>
  <div class="inventaris_toe_specificaties">
    <div class="inventaris_toe_block">
      <div class="inventaris_toe_block1"> 
        <form id="form" action="functies/InventarisToevoegenFunctie.php" method="post" enctype="multipart/form-data">
          <div class="inventaris_toe">
            <h2>Apparaat naam:</h2>
            <input id="apparaat_naam" name="apparaat_naam" type="text">
          </div>
          <div class="inventaris_toe">
            <h2>Merk:</h2>
            <input id="merk" name="merk" type="text">
          </div>
          <div class="inventaris_toe">
            <h2>Categorie:</h2>
            <input id="categorie" name="categorie" type="text">
          </div>
          <div class="inventaris_toe">
            <h2>Beschrijving:</h2>
            <input id="beschrijving" name="beschrijving" type="text">
          </div>
          <input type="file" name="image">
          <input type="text" name="link" placeholder="Link naar handleiding">
          <div class="inventaris_toe_text">
            <input name="functionaliteit[]" type="text" placeholder="Apparaat beschrijving ...">
          </div>
          <button type="button" onclick="addInputField()">Add another field</button>
          <div class="inventaris_toe_buttons">
            <div class="inventaris_toe_opslaan">
              <button name="submitForm" type="button">Bevestigen</button>
              <input type="hidden" id="add_item" name="submitForm" value="save">
            </div>
          </div>
        </form>
      </div>
      <div class="inventaris_toe_img">
      </div>
    </div>
    <!-- The Modal -->
    <div id="myModal" class="modal">
      <!-- Modal content -->
      <div class="modal-content">
        <p>Are you sure you want to submit?</p>
        <button id="yesBtn">Yes</button>
        <button id="noBtn">No</button>
      </div>
    </div>
  </div>
</body>
</html>

<script>
  var modal = document.getElementById("myModal");

  // Get the button that opens the modal
  var btn = document.querySelector(".inventaris_toe_opslaan button");

  // Get the <span> element that closes the modal
  var yesBtn = document.getElementById("yesBtn");
  var noBtn = document.getElementById("noBtn");

  // When the user clicks the button, open the modal 
  btn.onclick = function(event) {
    event.preventDefault();
    modal.style.display = "block";
  }

  // When the user clicks on yes
  yesBtn.onclick = function() {
    modal.style.display = "none"; // Hide the modal
    form.submit(); // Submit the form
  }

  // When the user clicks on no
  noBtn.onclick = function() {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
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
</script>
