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
  </style>
</head>
<body>

<script>
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
  <div class="inventaris_toe_specificaties">
    <div class="inventaris_toe_block">
      <div class="inventaris_toe_block1"> 
        <form action="functies/InventarisToevoegenFunctie.php" method="post" enctype="multipart/form-data">
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
              <button name="submit" type="submit">upload</button>
            </div>
          </div>
        </form>
        
      </div>
      <div class="inventaris_toe_img">
        
      </div>
    </div>
    
  </div>
</body>
</html>