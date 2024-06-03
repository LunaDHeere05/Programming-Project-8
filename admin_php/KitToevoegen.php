<?php
include 'database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kit Builder</title>
  <?php include 'top_nav_admin.php'?>

  <style>
    
    .rechter_grid{
      justify-content: center;
    }
    .modal {
      display: none; 
      position: fixed; 
      z-index: 1; 
      left: 0;
      top: 0;
      width: 100%; 
      height: 100%; 
      overflow: auto;  
      background-color: rgba(0,0,0,0.4); 
    }

    /* Modal Content */
    .modal-content {
      background-color: #fefefe;
      margin: 15% auto; 
      padding: 1.5em;
      border: none;
      width: 60%; 
    }

    .items {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #aaa;
      padding: 1em;
      margin: 1.5em;
      border-radius: 1em;
      width: 90%;
    }

    .items img {
      width: 8em;
      height: 6em;
      margin-right: 1em;
      border-radius: 1em;
      background-color: white;
    }

    .items button {
      background-color: #1BBCB6;
      color: white;
      padding: 1em;
      border: none;
      cursor: pointer;
      border-radius: 2em;
      margin: 1em;
    }

    .kitName {
      margin: 1em 0em 2em 8em;
      border: 0.2em solid #ccc;
      padding: 1em;
      border-radius: 1.5em;
      width: 70%;
      display: flex;
    }

    .kitName label {
      margin-right: 1em;
    }

    .kitName input {
      width: auto;
      flex-grow: 1;
      border-radius: 2em;
      padding-left: 0.7em;
    }
    .item {
      display: flex;
      width: 100%;
      border: 0.2em solid #ccc;
      padding: 1em;
      margin: 1em;
      border-radius: 0.5em;
      width: 70%;
      justify-content: space-around;
    }

    .item img {
      width: 7em;
      height: 5em;
      margin-right: 1em;
      border-radius: 1em;
    }

    .item button {
      background-color: red;
      color: white;
      padding: 0.7em 1em 2em 1em;
      border: none;
      cursor: pointer;
      border-radius: 2em;
      height: 3em;
      margin: 1em;
    }

    #myBtn {
      background-color: #1BBCB6;
      color: white;
      padding: 1em;
      border: none;
      cursor: pointer;
      border-radius: 2em;
      margin: 0em 5em 2em 20em;
    }

    #save-button {
      background-color: #1BBCB6;
      color: white;
      padding: 1em 2em 1em 2em;
      border: none;
      cursor: pointer;
      border-radius: 2em;
      margin: 0em 20em 2em 5em;
    }

    /* The Close Button */
    .close {
      color: #aaa;
      float: right;
      font-size: 2.5em;
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
  include 'database.php';

  // Fetch items from the database
  $query = "SELECT * FROM ITEM";
  $result = mysqli_query($conn, $query);
  $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
  ?>
 

  <!-- Input fields -->
  <form class="kitName">
    <label for="kit_naam">Kit naam:</label><br>
    <input type="text" id="kit_naam" name="kit_naam"><br>
  </form>

  <ul id="item-list"></ul>

  <!-- Trigger/Open The Modal -->
  <button id="myBtn">voeg apparaat toe</button>

  <!-- The Modal -->
  <div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <p>Kies de apparaaten voor de kit</p>
      
        <?php foreach ($items as $item): ?>
          <div class="items">
            <img src="<?php echo $item['images']; ?>" alt="Item image">
            <h3><?php echo $item['naam']; ?></h3>
            <p><?php echo $item['beschrijving']; ?></p>
            <button class="add-button" data-id="<?php echo $item['item_id']; ?>" data-name="<?php echo $item['naam']; ?>" data-description="<?php echo $item['beschrijving']; ?>" data-image="<?php echo $item['images']; ?>">Voeg toe</button>
          </div>
        <?php endforeach; ?>
    </div>
  </div>
  <button id="save-button">Sla op</button>

  <script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// Get all "Voeg toe" buttons
var buttons = document.getElementsByClassName("add-button");

// Add an event listener to each button
for (var i = 0; i < buttons.length; i++) {
  buttons[i].addEventListener("click", function() {
    // Get the item data from the button's data attributes
    var itemId = this.getAttribute("data-id"); // Fetch the item_id
    var itemName = this.getAttribute("data-name");
    var itemDescription = this.getAttribute("data-description");
    var itemImageLink = this.getAttribute("data-image");

    // Create a new list item
    var li = document.createElement("li");
    li.classList.add('item');
    li.innerHTML = '<img src="' + itemImageLink + '" alt="Item image"><br>' + itemName + '<br>' + itemDescription;

    // Create a "wijzigen" button
    var wijzigenButton = document.createElement("button");
    wijzigenButton.textContent = "wijzigen";
    wijzigenButton.addEventListener("click", function() {
      // Remove the parent list item when the button is clicked
      this.parentNode.remove();
    });

    // Append the "wijzigen" button to the list item
    li.appendChild(wijzigenButton);

    // Set the data-id attribute on the list item
    li.setAttribute("data-id", itemId);

    // Add the list item to the list
    var list = document.getElementById("item-list");
    list.appendChild(li);
  });
}

// Get the "Sla op" button
var saveButton = document.getElementById("save-button");

// Add an event listener to the button
saveButton.addEventListener("click", function() {
  // Get all list items
  var listItems = document.getElementById("item-list").children;

  // Create an array to hold the item IDs
  var itemIds = [];

  // Loop through the list items and add each item ID to the array
  for (var i = 0; i < listItems.length; i++) {
    itemIds.push(listItems[i].getAttribute("data-id"));
  }

  // Convert the array to a JSON string
  var itemIdsJson = JSON.stringify(itemIds);

  // Get the kit_naam input field value
  var kitNaam = document.getElementById("kit_naam").value;

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "functies/kit_toevoegen.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log("Request successful. Response: " + this.responseText);
      // Redirect to the kits page
      window.location.href = "kits.php";
    } else if (this.readyState == 4) {
      console.log("Request failed. Status: " + this.status);
    }
  };

  xhr.onerror = function() {
    console.log("Request error: " + this.status);
  };

  // Send the item_ids and kit_naam to the PHP file
  xhr.send("item_ids=" + itemIdsJson + "&kit_naam=" + encodeURIComponent(kitNaam));
});
</script>
</body>
</html>