<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defect</title>
    <?php include 'top_nav_admin.php'?>
    <style>



#overlay {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

#popup {
    position: fixed;
    z-index: 1001;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-height: 80vh; /* 80% of the viewport height */
    overflow-y: auto; /* Add scrollbar if content exceeds max-height */
}

.pop-up-item {
    display: flex;
    align-items: center;
    margin: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 8px;
    justify-content: space-between;
    text-align: center;
    width: auto;
}


.pop-up-item img {
    width: 100px;
    height: auto;
    object-fit: cover;
    border-radius: 10%;
}

.pop-up-item button {
    background-color: #1BBCB6;
    color: white;
    border: none;
    border-radius: 20px;
    padding: 8px;
    cursor: pointer;
}

.verwijder {
    background-color: red;
    color: white;
    border: none;
    border-radius: 20px;
    padding: 8px;
    cursor: pointer;
}

.items {
    display: flex;
    flex-wrap: wrap;
    margin: 8px;
}

.item {
    display: flex;
    margin: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 8px;
    align-items: center;
    background-color: rgb(192, 192, 192);
    justify-content: space-around;
    text-align: center;
}

.item img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 50%;
}
#kitName {
    border: rgb(192, 192, 192) 2px solid;
    border-radius: 20px;
    padding: 8px;
    width: 100%;
    margin: 8px;
}

.buttons {
    display: flex;
    justify-content: center;
    align-items: center;
}

.buttons img {
    width: 20px;
    height: 20px;
    margin-left: 8px;
}
#apparaat {
    background-color: #1BBCB6;
    color: white;
    border: none;
    border-radius: 20px;
    padding: 8px;
    cursor: pointer;
    margin: 8px;
    width: 10%;
}

#Sla-op {
    width: 10%;
    background-color: #1BBCB6;
    color: white;
    border: none;
    border-radius: 20px;
    padding: 8px;
    cursor: pointer;
    margin: 8px;
}

    </style>
  </head>
  <body>

  <?php
include 'database.php';

if(isset($_GET['kit_id'])){
    $kit_id = $_GET['kit_id'];

    // Fetch the kit name from the KIT table
    $kit_query = "SELECT naam FROM KIT WHERE kit_id = $kit_id";
    $kit_result = mysqli_query($conn, $kit_query);
    $kit = mysqli_fetch_assoc($kit_result);

    // Fetch the current items in the kit from the ITEM_KIT table
    $items_query = "SELECT I.naam, I.merk, I.item_id, I.images 
                    FROM ITEM I 
                    JOIN ITEM_KIT KI ON I.item_id = KI.item_id 
                    WHERE KI.kit_id = $kit_id";
    $items_result = mysqli_query($conn, $items_query);
    $items = mysqli_fetch_all($items_result, MYSQLI_ASSOC);

    // Fetch all items from the ITEM table
    $allItems_query = "SELECT naam, merk, item_id, images FROM ITEM";
    $allItems_result = mysqli_query($conn, $allItems_query);
    $allItems = mysqli_fetch_all($allItems_result, MYSQLI_ASSOC);
}
?>

<form method="POST" action="functies/kit_wijzigen.php">
    <input type="text" name="kit_naam" id="kitName" value="<?php echo $kit['naam']; ?>">
    <input type="hidden" name="kit_id" value="<?php echo $kit_id; ?>">
    
    <div id="items">
        <?php foreach ($items as $item): ?>
            <div class="item">
                <img src="<?php echo $item['images']; ?>" alt="Item image">
                <p><?php echo $item['naam']; ?><br><?php echo $item['merk']; ?></p>
                <button type="button" class="verwijder" data-id="<?php echo $item['item_id']; ?>">Verwijder</button>
                <input type="hidden" name="item_id[]" value="<?php echo $item['item_id']; ?>">
            </div>
        <?php endforeach; ?>
    </div>
    <div class="buttons">
        <button type="button" id="apparaat">Apparaat</button>
        <button type="submit" id="Sla-op">Sla op</button>
    </div>
</form>
<div id="overlay" style="display: none;">
    <div id="popup">
    <?php foreach ($allItems as $item): ?>
        <div class="pop-up-item">
            <img src="<?php echo $item['images']; ?>" alt="Item image">
            <p><?php echo $item['naam']; ?></p>
            <button type="button" class="voeg-toe" data-id="<?php echo $item['item_id']; ?>" data-img="<?php echo $item['images']; ?>" data-naam="<?php echo $item['naam']; ?>" data-merk="<?php echo $item['merk']; ?>">Voeg toe</button>
        </div>
    <?php endforeach; ?>                                        
    </div>
</div>

<script>

  
var changes = {
    add: [],
    remove: []
};

document.getElementById('apparaat').addEventListener('click', function() {
    document.getElementById('overlay').style.display = 'block';
});

document.getElementById('overlay').addEventListener('click', function(e) {
    if (e.target.classList.contains('voeg-toe')) {
        var itemId = e.target.dataset.id;
        var itemName = e.target.dataset.naam; // Assuming the name is stored in a data-naam attribute
        var itemBrand = e.target.dataset.merk; // Assuming the brand is stored in a data-merk attribute

        var newItemDiv = document.createElement('div');
        newItemDiv.classList.add('item');

        var newItemImg = document.createElement('img');
        newItemImg.src = e.target.dataset.img; // Assuming the image URL is stored in a data-img attribute
        newItemDiv.appendChild(newItemImg);

        var newItemInfo = document.createElement('p');
        newItemInfo.innerHTML = itemName + "<br>" + itemBrand;
        newItemDiv.appendChild(newItemInfo);

        var newItemButton = document.createElement('button');
        newItemButton.textContent = 'Verwijder';
        newItemButton.classList.add('verwijder');
        newItemButton.dataset.id = itemId;
        newItemDiv.appendChild(newItemButton);

        var newItemInput = document.createElement('input');
        newItemInput.type = 'hidden';
        newItemInput.name = 'item_id[]';
        newItemInput.value = itemId;
        newItemDiv.appendChild(newItemInput);

        document.getElementById('items').appendChild(newItemDiv);
        changes.add.push(itemId);
    }
});

document.getElementById('items').addEventListener('click', function(e) {
    if (e.target.classList.contains('verwijder')) {
        var itemDiv = e.target.parentElement;
        itemDiv.parentNode.removeChild(itemDiv);

        var itemId = e.target.dataset.id;
        var index = changes.add.indexOf(itemId);
        if (index !== -1) {
            changes.add.splice(index, 1);
        } else {
            changes.remove.push(itemId);
        }
    }
});

document.getElementById('overlay').addEventListener('click', function(e) {
    if (e.target.id === 'overlay') {
        document.getElementById('overlay').style.display = 'none';
    }
});
</script>
</body>
</html>