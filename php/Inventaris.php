<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris</title>
</head>
<body>
<?php include 'components/top_nav.php'; ?> 
 <!--zoekresultaat container  -->
<div class="zoekresultaat_container"> 
        <h3>Verfijn je resultaat: </h3>
        <ul class="filters">
            <li>
                <select name="Categorie" id="">
                    <option value="categorie">Categorie</option>
                </select>
            </li>
            <li>
                <select name="Merk" id="">
                    <option value="merk">Merk</option>
                </select>
            </li>
            <li>
                <select name="Beschrijving" id="">
                    <option value="beschrijving">Beschrijving</option>
                </select>
            </li>
            <li>
                <select name="Beschikbaarheid" id="">
                    <option value="Beschikbaarheid">beschikbaarheid</option>
                </select>
            </li>
        </ul>
    </div>

    <!-- apparatenlijst -->
        <ul class="apparatenlijst">
          <!-- gaat gegenereerd moeten worden met onze javascript of iets anders -->
            <li class="apparaat"><a href="ApparaatPagina.html">
                <img class="apparaat_foto" src="/images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="">
                <div class="korte_beschrijving">
                    <h3>Canon M50</h3>
                    <p>Fototoestel</p> 
                </div>
                <div class="beschikbaarheid_apparaat">
                    <p>Beschikbaar tot <br><span>30/05/2024</span></p>
                    <img src="/images/svg/circle-check-solid.svg" alt="check">
                </div>
                <div class="toevoegen">
                    <img src="/images/svg/heart-solid.svg" alt="favorietenlijst">
                    <img src="/images/svg/cart-shopping-solid.svg" alt="winkelmandje">
                </div>
            </a></li>
            <li class="apparaat"><a href="#">
                <img class="apparaat_foto" src="/images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="">
                <div class="korte_beschrijving">
                    <h3>Canon M50</h3>
                    <p>Fototoestel</p> 
                </div>
                <div class="beschikbaarheid_apparaat">
                    <p>Beschikbaar tot <br><span>30/05/2024</span></p>
                    <img src="/images/svg/circle-check-solid.svg" alt="check">
                </div>
                <div class="toevoegen">
                    <img src="/images/svg/heart-solid.svg" alt="favorietenlijst">
                    <img src="/images/svg/cart-shopping-solid.svg" alt="winkelmandje">
                </div>
            </a></li>
        </ul>  
<?php include 'components/footer.php'; ?>
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
.toevoegen img {
  width: 4em;
  margin: auto;
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
}</style>