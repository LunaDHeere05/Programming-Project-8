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

    <!-- apparatenlijst -->
        <ul class="apparatenlijst">
        <?php include 'functies\inventaris_functie.php'; ?>
        </ul>
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



</style>
<?php include("footer.php"); ?>
