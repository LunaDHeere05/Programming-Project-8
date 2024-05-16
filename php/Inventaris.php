<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris</title>

</head>
<body>
<?php include 'top_nav.php'; ?> 
 <!--zoekresultaat container  -->
<div class="zoekresultaat_container"> 
        <h3>Verfijn je resultaat: </h3>
        <ul class="filters">
            <li>
                <select name="Categorie" id="categorie">
                    <option value="Categorie" disabled selected>Categorie</option>
                    <?php include 'functies\filter_categorie_inventaris.php'; ?> <!-- Include the options dynamically from your database if needed -->
                </select>
            </li>
            <li>
                <select name="Merk" id="merk">
                    <option value="merk" disabled selected>Merk</option>
                    <?php include 'functies\filter_merk_inventaris.php'; ?>
                </select>
            </li>
            <li>
                <select name="Beschrijving" id="beschrijving">
                    <option value="beschrijving" disabled selected>Beschrijving</option>
                    <?php include 'functies\filter_beschrijving_inventaris.php'; ?>
                </select>
            </li>
            <li>
                <select name="Beschikbaarheid" id="beschikbaarheid">
                    <option value="Beschikbaarheid">Beschikbaarheid</option>
                </select>
            </li>
        </ul>
    </div>

    <!-- apparatenlijst -->
        <ul class="apparatenlijst">
        <?php include 'functies\inventaris_functie.php'; ?>
        </ul>

        <script>
            // Get the category parameter from the URL
            const urlParams = new URLSearchParams(window.location.search);
            const selectedCategory = urlParams.get('category');

            // Set the selected category in the dropdown box
            if (selectedCategory) {
                const categoryDropdown = document.getElementById('categorie');
                const option = document.createElement('option');
                option.text = selectedCategory;
                option.value = selectedCategory;
                option.selected = true;
                categoryDropdown.appendChild(option);
            }
        </script>

        <script>
  document.querySelectorAll('.favoriet').forEach(function(button) {
    button.addEventListener('click', function(event) {
      event.preventDefault(); //gaat ervoor zorgen dat er ni naar de volgende pagina wordt gegaan in plaats van het hartje aan te klikken
      let favorite_img = this.querySelector('img');
      if (favorite_img.src.endsWith('heart-regular.svg')) {
        favorite_img.src = 'images/svg/heart-solid.svg';
        <?php include 'toevoegenFavorieten.php'; ?> 
      } else {
        favorite_img.src = 'images/svg/heart-regular.svg';
      }
    });
  });
  document.querySelectorAll('.winkelmand').forEach(function(button) {
    button.addEventListener('click', function(event) {
      event.preventDefault(); //gaat ervoor zorgen dat er ni naar de volgende pagina wordt gegaan in plaats van het winkelmandje aan te klikken
      let cart_img = this.querySelector('img');
      if (cart_img.src.endsWith('cart-shopping-solid.svg')) {
        cart_img.src = 'images/svg/shopping-cart-regular.svg';
      } else {
        cart_img.src = 'images/svg/cart-shopping-solid.svg';
      }
    });
  });
</script>

</body>
</html>

<style>

.zoekresultaat_container {
  margin-top: 1em;
  display: flex;
}
.zoekresultaat_container h3 {
  margin: 0em 2em;
}
.filters {
  display: flex;
  list-style: none;
  width: 40%;
  justify-content: space-between;
}
.filters select {
  border-radius: 1em;
  border: none;
  background-color: rgb(193, 193, 193);
  padding: 0em 1em;
}

/* apparaat */
.apparatenlijst {
  display: inline-block;
  width: 97%;
  height: 12em;
  list-style: none;
  margin: auto;
}
.apparaat {
  width: 100%;
  height: 100%;
  border-radius: 2em;
  background-color: rgb(193, 193, 193);
  margin: 1em 0em 0em 2em;
  display: flex;
}
.apparaat a {
  width: 100%;
  display: flex;
  justify-content: space-between;
  text-decoration: none;
  color: #000000;
  align-items: center;
}
.apparaat_foto {
  height: 10em;
  margin: 1em;
  width: auto;
  background: white;
  border-radius: 2em;
}
.toevoegen {
  display: flex;
  width: 20%;
  align-items: center;
}
.toevoegen button {
  width: 4em;
  margin: auto;
  background-color: transparent;
  border: none;
}

.beschikbaar{
  color:#1BBCB6;
}

.beschikbaarheid_apparaat {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 30%;
  color: #E30613;
  font-weight: bold;
}

.beschikbaarheid_apparaat p{
  font-weight:lighter;

}
.beschikbaarheid_apparaat img {
  width: 3em;
  margin: 0.5em 2em;

}</style>

<?php include("footer.php"); ?>
