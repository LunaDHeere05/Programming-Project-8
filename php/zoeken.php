
<?php
include 'database.php';
include 'top_nav.php';
echo "<ul class='apparatenlijst'>";
?>
<div class="zoekresultaat_container"> 
        <h3>Verfijn je resultaat: </h3>
        <ul class="filters">
            <li>
                <select name="Categorie" id="categorie">
                  <option value="Categorie" disabled selected>Categorie</option>
                  <?php include 'functies\filter_categorie_inventaris.php' ?>
                </select>
            </li>
            <li>
                <select name="Merk" id="merk">
                    <option value="merk" disabled selected>Merk</option>
                    <?php include 'functies\filter_merk_inventaris.php' ?>
                </select>
            </li>
            <li>
                <select name="Beschrijving" id="beschrijving">
                    <option value="beschrijving" disabled selected>Beschrijving</option>
                    <?php include 'functies\filter_beschrijving_inventaris.php' ?>
                </select>
            </li>
            <li>
                <select name="Beschikbaarheid" id="beschikbaarheid">
                    <option value="Beschikbaarheid">Beschikbaarheid</option>
                </select>
            </li>
        </ul>
    </div>
<?php


//de query om de beschikbaarheid van het item op te halen: 
$beschikbaarheid = "SELECT UITLENING.inlever_datum, UITLENING.uitleen_datum
                    FROM UITLENING";
$availability_result = mysqli_query($conn, $beschikbaarheid);

//dit is om de item id mee te geven aan de url als er op geklikt wordt (zo krijgen we de juiste informatie op de apparaatpagina)
$item_id_query = "SELECT item_id FROM ITEM";
$item_id_result = mysqli_query($conn, $item_id_query);
// de volgende query is gewoon om de info over het apparaat te halen uit de databank:
$item_info = "SELECT naam, merk, beschrijving FROM ITEM";
$item_info_result = mysqli_query($conn, $item_info);
//om de availability te doen werken
if($row = mysqli_fetch_assoc($availability_result)){
    if ($row['inlever_datum'] != null  ) { //deze conditie moet aangepast worden wnt nu checkt da gewoon of da inleverdatum null is
        $availability = "Niet beschikbaar tot " . $row['inlever_datum'];
        $availability_color = '#E30613';
        $availability_img = 'images/svg/circle-xmark-solid.svg';
        $availability_filter = 'invert(15%) sepia(88%) saturate(3706%) hue-rotate(347deg) brightness(94%) contrast(115%);';
    } else {
        $availability = "Beschikbaar";
        $availability_color = '#1BBCB6';
        $availability_img = 'images/svg/circle-check-solid.svg';
        $availability_filter = 'invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg)
        brightness(103%) contrast(79%)';
    }
}

$zoek_query = isset($_GET['zoek_query']) ? $_GET['zoek_query'] : '';

if(!empty($zoek_query)) {
    //voor injecties te voorkomen:
    $zoek_query = mysqli_real_escape_string($conn, $zoek_query);
    
    $zoek_resultaat = "SELECT * FROM ITEM 
                      WHERE LOWER(naam) LIKE LOWER('%$zoek_query%')
                      OR LOWER(merk) LIKE LOWER('%$zoek_query%')
                      OR LOWER(beschrijving) LIKE LOWER('%$zoek_query%')";
    $zoek_uitvoering_resultaat = mysqli_query($conn, $zoek_resultaat);

    if($zoek_uitvoering_resultaat) {
        if(mysqli_num_rows($zoek_uitvoering_resultaat) > 0) {
            while($resultaat = mysqli_fetch_assoc($zoek_uitvoering_resultaat)) {
                echo "<li class='apparaat'>";
                echo "<a href='ApparaatPagina.php?apparaat_id=".$resultaat['item_id']."'>";
                echo '<img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="" class="apparaat_foto">';
                echo "<div class='korte_beschrijving'>";
                echo "<h3>" . $resultaat['naam'] . "</h3>";
                echo "<p>" . $resultaat['merk'] . "</p>";
                echo "<p>" . $resultaat['beschrijving'] . "</p>";
                echo "</div>";
                echo "<div class='beschikbaarheid_apparaat'>";
                echo "<h3 style= 'color: $availability_color;'>$availability</h3>";
                echo "<img style= 'filter: $availability_filter;' src='$availability_img' alt='Availability Icon'>";
                echo "</div>";
                echo "<div class='toevoegen'>";
                echo "<button class='favoriet'><img src='images/svg/heart-regular.svg' alt='Favorietenlijst'></button>";
                echo "<button class='winkelmand'><img src='images/svg/shopping-cart-regular.svg' alt='Winkelmandje'></button>";
                echo "</div>";
                echo "</a>";
                echo "</li>";
            }
        } else {
            echo "Geen resultaten gevonden";
        }
    } else {
        echo "Query failed: " . mysqli_error($conn);
    }
}
include 'footer.php';
mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris</title>
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
}
.apparaat a {
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

.beschikbaarheid_apparaat {
  display: flex;
  width: 20%;
  color: #1bbcb6;
  font-weight: bold;
}
.beschikbaarheid_apparaat img {
  width: 4em;
  margin: 0em 2em;
  filter: invert(62%) sepia(49%) saturate(680%) hue-rotate(129deg)
    brightness(90%) contrast(89%);
}
    </style>
</head>
<script>
    document.querySelectorAll('.favoriet').forEach(function(button) {
    button.addEventListener('click', function(event) {
      event.preventDefault(); //gaat ervoor zorgen dat er ni naar de volgende pagina wordt gegaan in plaats van het hartje aan te klikken
      let favorite_img = this.querySelector('img');
      if (favorite_img.src.endsWith('heart-regular.svg')) {
        favorite_img.src = 'images/svg/heart-solid.svg';
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
</html>