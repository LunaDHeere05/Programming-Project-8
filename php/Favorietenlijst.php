<?php 
include 'sessionStart.php' //AN: om te weten welke mail er gebruikt wordt om in te loggen
?>
<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn favorietenlijst</title>
    <?php include 'top_nav.php'?>
    <style>
.favorietenEnTerug{
  display: flex;
}
.favorietenEnTerug img{
  width: 1.5em;
  height: auto;
  margin: 1.5em;
}
.favorietenEnTerug h1{
  margin: 0.6em 0.5em 0em 0.5em;
}
.favoriet_apparaat_container{
  width: 90%;
  height: 15em;
  margin: auto;
  display: flex;
  flex-wrap: wrap;   /*hierdoor is er probleem wnt komt over*/
}
.favoriet_apparaat{
  display: flex;
  flex-direction: column;
  position: relative;
  background-color: rgb(193, 193, 193);
  border-radius: 2em;
  width: 20%;
  margin: 1em;
}
.favoriet_apparaat .mijnFavorieteApparaat_foto{
  width: 60%;
  height: auto;
  margin: 0.5em auto;
  background-color: white;
  border-radius: 1em;
}
.text_apparaat{
  text-align: center;
  font-weight: bold;
  margin: auto;
  display: flex;
}
.text_apparaat img{
  width: 1.5em;
  height: auto;
  margin: 0em 0.5em;
  filter: invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg)
    brightness(103%) contrast(79%);
}
.verwijder_btn{
  width: 1.5em;
  position: absolute;
  top: 0.5em;
  right: 1em;
}
    
</style>
</head>
<body>
<div class="favorietenEnTerug">
<!-- wat ik in de a href heb gestoken is gewoon om terug te gaan naar de vorige pagina -->
        <a href="<?php echo $_SERVER['HTTP_REFERER'];?>"><img src="images/svg/chevron-left-solid.svg" alt=""></a>
        <h1>Mijn favorietenlijst</h1>
</div>
    <div class="favoriet_apparaat_container">
    <?php include 'functies/favorietenLijst.php'?> 
    </div>

    <script>    
    console.log( document.querySelectorAll(".verwijder_btn"))
    for(let i = 0; i<document.querySelectorAll(".favoriet_apparaat").length; i++){
    document.querySelectorAll(".verwijder_btn").[i].addEventListener("click", function() {
      console.log("test");
      <?php
        $delete_items_query = "DELETE FROM FAVORIETE_ITEMS WHERE item_id = ".$exemplaren_row['item_id']."";
        $delete_items_result = mysqli_query($conn, $delete_items_query);   
?>
})
}</script>
</body>
</html>


<?php include("footer.php") ?>