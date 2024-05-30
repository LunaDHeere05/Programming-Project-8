<?php include 'sessionStart.php'; 
include 'database.php';//AN: om te weten welke mail er gebruikt wordt om in te loggen
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defect melden</title>
    <link rel="stylesheet" href="/css/stylesheet.css">
    <style>
        .bevestig{
    margin: 0em 4em 2em 4em;
    font-size: 20px;
}
.item_info{
    display: flex;
    justify-content: space-around;
    align-items: center;
    position: relative;
}
.item_info img{
    width: 15%;
    height: 15%;
    margin: auto 1em;
}
.item_info_container{
    background-color: rgb(193, 193, 193);
    width: 80%;
    margin: 1em auto;
    border-radius: 2em;
}
.item_info_container img{
  width: 15%;
}
.bevestig_btn{
    background-color: #1bbcb6;
    padding: 1em;
    border-radius: 2em;
    margin: auto;
    width: 10em;
    text-align: center;
}
.bevestig_btn button{
  background: none;
  border: none;
  color: white;
  font-weight: bold;
  font-size: 20px;
  letter-spacing: 1px;
}
.verwijder{
    position: absolute;
    right: 0;
    top: 0.5em;
    width: 2em !important;
}
.defecte_apparaten_container{
  display: flex;
  width: 100%;
}
.item_info_en_selectiebol{
  display: flex;
  justify-content: flex-start;
}
#selectie_bol img{
  margin: auto;
  filter: invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg)
    brightness(103%) contrast(79%);
}
#selectie_bol{
  width: 3em;
  margin: auto;
  margin-right: 0em;
}

.defecte_apparaten{
  display: flex;
  background-color: rgb(193, 193, 193);
  height: 20em;
  border-radius: 2em;
}
.beschrijving_defect {
  width: 90%;
  margin: auto;
  height: 20em;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 2em;
  color: black;
  border: 0.5px solid grey;
  border-radius: 2em;
  padding: 1em;
  margin-bottom: 1em;
}
.beschrijving_defect:focus {
  border: none;
  outline: 0.5px solid #1bbcb6;
}
.beschrijving_defect::placeholder{
  height: 100%;
  text-wrap: wrap;
  font-size: 16px;
}
.beschrijf{
  margin: 0em 0em 0em 4em;
}
.annulerenEnTerug{
  display: flex;
}
.annulerenEnTerug img{
  width: 1.5em;
  height: auto;
  margin: 1.5em;
}
.annulerenEnTerug h1{
  margin: 0.6em 0.5em 0em 0.5em;
}
        </style>
</head>
<body>
    <?php include 'top_nav.php'?>
    <div class="annulerenEnTerug">
        <a href="<?php echo $_SERVER['HTTP_REFERER'];?>"><img src="images/svg/chevron-left-solid.svg" alt=""></a>
        <h1>Defect melden</h1> 
    </div>
    <p class="bevestig">1. Bekijk de ID-sticker op jouw apparaat. <br>
        2. Duid het apparaat (max. 1) aan waarvan je een defect wilt melden. </p>

    <?php include 'functies/defect_copies_ophalen.php'; ?>
    <div class="bevestig_btn">
        <button id="bevestig">Bevestig</button>
    </div>
    <?php include 'footer.php'?>
    <script>
        document.getElementById('bevestig').addEventListener('click', function() {
            window.location.href = 'FinalDefectMelden.php';
            });
    </script>
</body>
</html>