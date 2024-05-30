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

    /* Modal Content */
    .modal-content {
      background-color: #fefefe;
      margin: 15% auto; /* 15% from the top and centered */
      padding: 20px;
      border: 1px solid #888;
      width: 70%; /* Could be more or less, depending on screen size */
    }

    .modal-content img {
      width: 10%;
      height: auto;
    }

    .items {
      display: flex;
      width: 100%;
      background-color: rgb(192,192,192);
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
  include 'database.php';

  // Fetch items from the database
  $query = "SELECT * FROM ITEM";
  $result = mysqli_query($conn, $query);
  $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
  ?>
 

  <!-- Input fields -->
  <form>
    <label for="kit_naam">Kit naam:</label><br>
    <input type="text" id="kit_naam" name="kit_naam"><br>
  </form>

  <ul id="item-list"></ul>

  <!-- Trigger/Open The Modal -->
  <button id="myBtn">Open Modal</button>

  <!-- The Modal -->
  <div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <p>Some text in the Modal..</p>
      
        <?php foreach ($items as $item): ?>
          <div class="items">
            <h3><?php echo $item['naam']; ?></h3>
            <p><?php echo $item['item_id']; ?></p>
            <img src="<?php echo $item['images']; ?>" alt="Item image">
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
    li.innerHTML = '<img src="' + itemImageLink + '" alt="Item image"><br>' + itemName + '<br>' + itemDescription + '<br>' + itemId;

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
      // Refresh the page
      //location.reload();
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