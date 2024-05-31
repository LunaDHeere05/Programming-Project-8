<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Te laat</title>
    <?php include 'top_nav_admin.php'?>
    <style>


.te_laat_tabel{
  width: 90%;
  text-align: center;
  margin: auto;
  margin-top: 2em;
}
.te_laat_tabel table{
  border-collapse: collapse;
  margin: auto;
  width: 100%;
}
.te_laat_tabel th, td{
  width: 30%;
  border-collapse: collapse;
  border-bottom: 2px solid rgb(193,193,193);
  border-left: 2px solid rgb(193,193,193);
}
.te_laat_tabel tr:last-child td{
  border-bottom: none;
}
.te_laat_tabel th:first-child, td:first-child{
  border-left: none;
}
.te_laat_tabel img{
  width: 100%;
  width: 2em;
  height: auto;
  filter: invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg);
  padding-top: 0.5em;
}
        </style>
</head>
<body>
    <div class="rechter_grid">
        <!-- <div class="zoeken_container">
  </div> --> 

    <!-- te laat tabel -->
        <div class="te_laat_tabel">
            <table>
          <?php if(isset($_GET['zoekButton']))
          {include 'functies/teLaat_zoeken.php';
          }else {include 'functies/teLaat_ophalen.php';
          } ?>

               
            </table>
        </div>

<div class="meer_info_popup">
  <div class="persoon">
    <img src="" alt="">
    <div class="persoon_info">
      <h2>Naam<h2>
      <p>student<p>
    </div>
    <div class="contacteer_btn">
      <button>Contacteer</button>
    </div>
  </div>
  <div class="meer_info">
    <h2>Apparaat: <span>USB-C kabel</span></h2>
    <h2>Categorie: <span>Kabels</span></h2>
    <h2>Dagen: <span>5</span></h2>
    <h2>blacklist: <span>Ja</span></h2>
  </div>
  <img src="admin_php\images\svg\xmark-solid.svg" alt="sluit venster">
</div>