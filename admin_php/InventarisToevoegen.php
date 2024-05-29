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

    .inventaris_toe_text input {
      height: 2rem;
      width: 100%;
      border: 0;
      border-radius: 2em;
      padding: 0.5em 0em 0.5em 1em;
      margin: 0.5rem;
    }

    .in_doos_input input {
      height: 2rem;
      width: 100%;
      border: 0;
      border-radius: 2em;
      padding: 0.5em 0em 0.5em 1em;
      margin: 0.5rem;
    }

    .device_info {
      margin: 2em 0em 2em 0em;
      border: rgb(192,192,192) 3px solid;
      padding: 0em 2em 0.5em 1em;
      border-radius: 20px;
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

    .inventaris_toe_opslaan button:hover {
      background-color: #0A7D7C;
    }

    .inventaris_toe_buttons {
      display: flex;
      justify-content: center;
    }

    .image_upload {
      margin: 2em 0em 2em 0em;
      border: rgb(192,192,192) 3px solid;
      padding: 0em 2em 0.5em 1em;
      border-radius: 20px;
    }

    .manual_upload {
      margin: 2em 0em 2em 0em;
      border: rgb(192,192,192) 3px solid;
      padding: 0em 2em 0.5em 1em;
      border-radius: 20px;
    }

    .functionaliteiten {
      margin: 2em 0em 2em 0em;
      border: rgb(192,192,192) 3px solid;
      padding: 0em 2em 0.5em 1em;
      border-radius: 20px;
      }

    .functionaliteiten button {
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

    .functionaliteiten button:hover {
      background-color: #0A7D7C;
    }

    .doos_content {
      margin: 2em 0em 2em 0em;
      border: rgb(192,192,192) 3px solid;
      padding: 0em 2em 0.5em 1em;
      border-radius: 20px;
    }

    .doos_content button {
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

    .doos_content button:hover {
      background-color: #0A7D7C;
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
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      background-color: #fefefe;
      margin: 15% auto; /* 15% from the top and centered */
      padding: 20px;
      border: 1px solid #888;
      width: 80%; /* Could be more or less, depending on screen size */
    }

    #yesBtn, #noBtn {
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

    #yesBtn:hover, #noBtn:hover {
      background-color: #0A7D7C;
    }
    
  </style>
</head>
<body>
  <div class="inventaris_toe_specificaties">
    <div class="inventaris_toe_block">
      <div class="inventaris_toe_block1"> 
        <form id="form" action="functies/InventarisToevoegenFunctie.php" method="post" enctype="multipart/form-data">
          <div class="device_info">
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
          </div>

          <div class="image_upload">  
            <h3>Image</h3>
            <input type="file" name="image">
          </div>

          <div class="manual_upload">
            <h3>Handleiding</h3>
            <input type="file" name="handleiding" placeholder="pdf van de handleiding">
          </div>
          
          <div class="functionaliteiten">
            <h3>Specificaties</h3>
            <div class="inventaris_toe_text">
              <input name="functionaliteit[]" type="text" placeholder="Functionaliteit ...">
            </div>
            <button type="button" onclick="addInputFieldFunct()">Nieuw Functionaliteit</button>
          </div>
          
          <div class="doos_content">
            <h3>Doos Content</h3>
            <div class="in_doos_input">
              <input name="in_doos[]" type="text" placeholder="Wat zit er in de doos?">
            </div>
            <button type="button" onclick="addInputFieldDoos()">Nieuw Randapparatuur</button>
          </div>

          <div class="inventaris_toe_buttons">
            <div class="inventaris_toe_opslaan">
              <button name="submitForm" type="button">Bevestigen</button>
              <input type="hidden" id="add_item" name="submitForm" value="save">
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- The Modal -->
    <div id="myModal" class="modal">
      <!-- Modal content -->
      <div class="modal-content">
        <p>Weet u zeker dat u wilt indienen?</p>
        <div>
          <button id="yesBtn">JA</button>
          <button id="noBtn">NEE</button>
        </div>
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
</script>
