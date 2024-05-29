<?php include 'sessionStart.php'; //AN: om te weten welke mail er gebruikt wordt om in te loggen
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
  display: flex;
  flex-wrap: wrap;
        gap:3em;
        list-style: none;
        margin:1em;
        padding:0;
        justify-content: center;
        align-items: center;
}

.favoriet_apparaat{
  display:flex;
    padding:0.5em 0;
    flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #edededcf;
        width:20em;
        height:15em;
        text-align: center;
        border-radius: 1em;
        cursor:pointer;
        position: relative;
    transition: transform 0.5s ease; 

}

.favoriet_apparaat a{
  text-decoration: none;
  color:black;
}

.favoriet_apparaat:hover{
        background-color: #cfcfcfcf;
        transition: transform 0.5s ease; 
    
    }

    .favoriet_apparaat .mijnFavorieteApparaat_foto {
        width: 13em;
        height: 10em;
        background-color: white;
        margin-top: 1em;
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
.fav_kruis{
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
    <?php include 'functies/favorietenLijst_functie.php'?>
    </div>
    <?php include("footer.php") ?> 
    <script>    
//verwijderen van items in winkelmand
document.addEventListener('click',function(e){

if(e.target.classList.contains('fav_kruis')){
  let formData = new FormData();
  console.log(e.target.id)
  formData.append('itemId', e.target.id);

fetch('functies/favorietenlijstVerwijderen.php', {
      method: 'POST',
      body: formData
    }).then(response => response.text())
    .then(data => {
    e.target.parentElement.parentElement.style.transform='translateX(1000px)'; 
    setTimeout(() => { 
      window.location.reload();
    }, 200)
})

}
})
</script>

</body>
</html>