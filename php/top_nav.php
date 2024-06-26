<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

@font-face {
    font-family: 'neoneon';
    src: url('Neoneon.otf') format('opentype')
}

@import url('https://fonts.googleapis.com/css2?family=Neonderthaw&display=swap');


*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}           

nav{
    display: flex;
    justify-content: space-between;
    margin:0.1em 0.8em;
    align-items: center;
}

.linker_navigatie{
    list-style: none;   
    display: flex;
    font-size: 120%;
    font-weight: bold;
    gap:2em;
    align-items: center;
}

.linker_navigatie a{
    text-decoration: none;
    color:black;
}

.linker_navigatie a:hover{
    color: #1BBCB6;
    transition-duration: 0.5s;
}

.ehb_logo{
    width: auto;
    height: 45px;
}

#medialabTitle{
    font-family: 'neoneon';
    font-size:125%;
    color:red;
    letter-spacing: 3px;
    font-weight: bold;
    text-align: center;
    padding-left:10px;
}

#medialab{
    padding:5px 0;  
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
   
}

#medialab a{
    text-decoration: none;
}

.rechter_navigatie{
    display: flex;
    width: 10em;
    height: auto;
    justify-content: space-between;
    align-items: end;
    gap:1.5em;
}

.rechter_navigatie img{
    width: 100%;
    height:100%
}

.rechter_navigatie a:hover{
    filter: invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg) brightness(103%) contrast(79%);
    transition-duration: 0.5s;
}

    /*  zoekbalk */

.zoekbalk_container{
    height: 6em;
    display: flex;
    background: url(images/jpg/jj-ying-7JX0-bfiuxQ-unsplash.jpg) no-repeat center center/cover;
}

.zoekbalk{
    display: flex;
    height: 50%;
    width: 60%;
    margin: auto;
    background-color: white;
    border-radius: 5em;
}
#zoeken_functie{
    display: flex;
    width: 100%;
    height: 100%;
}
#zoeken_functie input[type="submit"]{
    background: url(images/svg/magnifying-glass-solid.svg) no-repeat center;
    border: none;
    background-color: none;
    cursor: pointer;
    width: 2em;
    margin-right: 1em;
}
#zoek_input{
    background: none;
    border: none;
    color: #5B5B5B;
    width: 95%;
    margin-left: 1em;
}
#zoek_input:focus{
    outline: none;
}

#zoek_btn img{
    height: 80%;
    width: 70%;
}
#zoek_btn{
    background: none;
    border: none;
    margin-right: 1em;
}
.zoekbalk select{
    background: none;
    border: none;
    color: #5B5B5B;
    width: 8em;
    background: url(images/svg/sliders-solid.svg) no-repeat center;
}

.zoekbalk select{
    cursor:pointer;
    background-size: 20%;
    -webkit-appearance: none;
    -moz-appearance: none;
    text-indent: 1px;
    text-overflow: '';
  }

.zoekbalk select:focus{
    outline: none;
}

#winkelmand_popup {
  display: flex;
  flex-direction: column;
  height:27em;
width: 39em;
gap:2em;
 align-items: center;
  border: 1px solid black;
  border-radius: 2em;
  padding: 1em;
  padding-top:0;
  background-color: white;
  position: fixed;
  border: none;
  z-index: 9999; 
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  overflow: auto;
}

/* hide scrollbar */
#winkelmand_popup::-webkit-scrollbar {
    width: 0;
    height: 0;
}

#winkelmand_popup {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}

.title {
    position: sticky;
    top: 0;
    display: flex;
    padding: 10px 0;
    width: 100%;
    border-bottom: 2px solid #b1b1b1cf;
    z-index: 1;
    margin: 0;
    background-color: white;
    justify-content: space-between; 
    align-items: center;
}

.title h1 {
    flex-grow: 1; 
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin: 0; 
}

.title #close_window, .item_kruis {
    width: 2em;
    height: 2em;
    cursor: pointer;
}


#winkelmand_items{
    display: flex;   
    flex-direction: column;
    gap:2em;
    justify-content: space-between;
}

.item{
    background-color: #edededcf;
    padding: 1em 0.5em;
    border-radius: 1em; 
    display: flex;
    justify-content: space-between;
    gap:0.5em;
    align-items: center;
    transition: transform 0.5s ease; 

}

.item .item_kruis{
    margin:0px 2px auto auto
}

#winkelmand_popup table{
    text-align: center;
    border-collapse: collapse;
  }

#winkelmand_popup table th{
    color:#b1b1b1cf;
    font-size: 120%;}

#winkelmand_popup table th, #winkelmand_popup table td{
    border-right:3px solid #b1b1b1cf;
   
}

#winkelmand_popup table th:last-child, #winkelmand_popup table td:last-child{
    border:none;
}

#winkelmand_popup table th{
    padding: 5px;
}

#winkelmand_popup .item_foto{
    width: 10em;
    height: 10em;
    cursor: pointer;
    background-color: white;
    border-radius: 0.5em;
}
#winkelmand_popup form{
    display: flex;
    width: 40%;
    margin: auto;
    justify-content: center;
    align-items: center;
    background-color: #1BBCB6;
    border-radius: 2em;
    padding: 0.5em;
    cursor: pointer;
}

#winkelmand_popup form input{
    background-color: transparent;
    border: none;
    border-radius: 2em;
    font-weight: bold;
    cursor: pointer;
    color: white;
    font-size: 18px;

}

.hidden{
    left: -99999px !important;
    display: none;
    visibility: hidden;
}
body.blur > *:not(#winkelmand_popup):not(#close_window) {
        filter: blur(50px);
        pointer-events: none;
}

.emptyCart{
    color:grey;
    display:flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    flex:1 0 basis;
    gap:1em;
 
}

.emptyCart img{
    height:15em;
    margin:0;
    padding:0;
}

/* .login{
    margin-left:1em;
} */

button{
    cursor: pointer;
}
#uitloggen{
    background-color: #b1b1b1cf;
    flex: 0 1 auto;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 4em;
    right: 0;
    color: white;
    font-weight: bold;
    padding:1em 20px;
}

#uitloggen a button{
    background-color: #b1b1b1cf;
    font-weight: bold;
    padding-top:10px;
    font-size: 20px;
    color: white;
    border: none;
}

#uitloggen .gebruikersnaam{
    border-bottom:1px solid #edededcf;
    padding-bottom:1em;
}

</style>
<nav>
    <div id="medialab">
<a href="Home.php"><img class="ehb_logo" src="images/jpg/horizontaal EhB-logo (transparante achtergrond).png" alt="EhB-logo"> <p id="medialabTitle">mediahub</p></a>

</div>
    <div class="linker_navigatie" id='nav'>
        <a class='link' href="Info.php" ><h1 >Info</h1></a>
        <a class='link' href="Inventaris.php"><h1 >Inventaris</h1></a>
        <a class='link' href="Reservaties.php"><h1>Reservaties</h1></a>
    
    </div>
    <div class="rechter_navigatie">
        <a href="Favorietenlijst.php" class='link'><img src="images/svg/heart-solid.svg" alt="favorietenlijst"></a>
        <a href="#" id="winkelmand"><img src="images/svg/cart-shopping-solid.svg" alt="winkelmandje"></a>
        <a href="#" id="uitlog_icoon"><img src="images/svg/user-solid.svg" alt="profiel - logout"></a>
    </div>
</nav>

<!-- zoekbalk -->
<div class="zoekbalk_container">
    <div class="zoekbalk">
        <form action="Inventaris.php" method="GET" id="zoeken_functie">
        <input id="zoek_input" type="text" placeholder="Geef een zoekterm in ..." name="zoek_query">
        <input type="submit" value="">
        </form>
    </div>
</div>

<div id="winkelmand_popup" class="hidden">

    <div class='title'>
    <h1>Winkelmand</h1>
    <img src="images/svg/xmark-solid.svg" alt="sluit venster" id="close_window">
    </div>
    <div id="winkelmand_items">
        <?php include 'functies/winkelmandItems.php'?>
    </div>
  
</div>

<div id="uitloggen" class="hidden">
    <a id='log-functie'><button><p id='log-message'></p></button></a>   
</div>
<script>
document.getElementById('winkelmand').addEventListener('click', function(){
    document.getElementById('winkelmand_popup').classList.remove('hidden');
    document.body.classList.add('blur');
    document.getElementById('winkelmand_popup').classList.add('no-blur');
});

document.getElementById('close_window').addEventListener('click', function(){
    document.getElementById('winkelmand_popup').classList.add('hidden');
    document.body.classList.remove('blur');
    document.getElementById('winkelmand_popup').classList.remove('no-blur');
});

document.getElementById('uitlog_icoon').addEventListener('click', function(){
    document.getElementById('uitloggen').classList.toggle('hidden');
});

let link=document.getElementsByClassName('link')
//nav wordt blauw op page die open is 
for(let i=0;i<link.length;i++){
    var image = link[i].querySelector('img');
    if(window.location.href==link[i].href){
        if(image){
            link[i].style.filter="invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg) brightness(103%) contrast(79%)";
        }else{
        link[i].style.color="#1BBCB6";
        }
    }
}

//verwijderen van items in winkelmand
document.addEventListener('click',function(e){

  if(e.target.classList.contains('item_kruis')){
    let formData = new FormData();
    console.log(e.target.id)
    formData.append('itemId', e.target.id);

  fetch('functies/winkelmandVerwijderen.php', {
        method: 'POST',
        body: formData
      }).then(response => response.text())
      .then(data => {
      e.target.parentElement.style.transform='translateX(1000px)'; 
      setTimeout(() => { 
        window.location.reload();
      }, 150)
})
  }
})
  ;



//log-in en log-out functies
<?php 
if(isset($gebruikersnaam)){
    echo "
    let gebruikersnaam = document.createElement('p');
    gebruikersnaam.classList='gebruikersnaam';
    gebruikersnaam.textContent= '".$gebruikersnaam."';
    document.getElementById('log-functie').before(gebruikersnaam)

    document.getElementById('log-message').textContent = 'Log uit';
    document.getElementById('log-functie').href = 'functies/uitlog.php';
    ";
} else {
    echo "
    document.getElementById('log-message').textContent = 'Log in';
    document.getElementById('log-functie').href = 'Profiel.php';
    ";
}
?>

</script>