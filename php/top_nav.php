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

}

.item .item_kruis{
    margin:0px 2px auto auto
}

#winkelmand_popup table{
    text-align: center;
  }

#winkelmand_popup table th{
    color:#b1b1b1cf;
    font-size: 120%;
}


#winkelmand_popup .item_foto{
    width: 20%;
    height: auto;
    cursor: pointer;
    background-color: white;
    border-radius: 2em;
    margin: none;

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
}
body.blur > *:not(#winkelmand_popup):not(#close_window) {
        filter: blur(50px);
        pointer-events: none;
}

.login{
    margin-left:1em;
}

button{
    cursor: pointer;
}
#uitloggen{
    background-color: black;
    width: 10%;
    height: 5em;
    display: flex;
    justify-content: center;
    position: absolute;
    top: 4em;
    right: 0;
}
#uitloggen a{
    margin: auto;
}
#uitloggen a button{
    width: 100%;
    background-color: transparent;
    color: white;
    font-weight: bold;
    font-size: 20px;
    border: none;
}
</style>
<nav>
    <div id="medialab">
<a href="Home.php"><img class="ehb_logo" src="images/jpg/horizontaal EhB-logo (transparante achtergrond).png" alt="EhB-logo"> <p id="medialabTitle">medialab</p></a>

</div>
    <div class="linker_navigatie" id='nav'>
        <a class='link' href="Info.php" ><h1 >Info</h1></a>
        <a class='link' href="Inventaris.php"><h1 >Inventaris</h1></a>
        <a class='link' href="Kalender.php"><h1 >Kalender</h1></a>
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
        <!--categorieën halen uit databank-->
        <select name="categorie" id="" >
            <option value="alles"></option>
            <option value="audio">Audio</option>
            <option value="belichting">Belichting</option>
            <option value="tools">Tools</option>
            <option value="varia">Varia</option>
            <option value="video">Video</option>
            <option value="xr">XR</option>
        </select>
        <form action="zoeken.php" method="GET" id="zoeken_functie">
        <input id="zoek_input" type="text" placeholder="Geef een zoekterm in ..." name="zoek_query">
        <input type="submit" value="">
        </form>
    </div>
</div>

<div id="winkelmand_popup" class="hidden">
<?php
    if (isset($_SESSION['gebruikersnaam'])) {
        $email = $_SESSION['gebruikersnaam'];
        // Winkelmand initialiseren
        echo "<script>
            localStorage.setItem('winkelmand', JSON.stringify([]));
        </script>";
    }
    ?>


    <div class='title'>
    <h1>Winkelmand</h1>
    <img src="images/svg/xmark-solid.svg" alt="sluit venster" id="close_window">
    </div>
    <div id="winkelmand_items"></div>
    <form>
        <input type="submit" value="Reserveer nu">
    </form>
</div>

<div id="uitloggen" class="hidden">
    <a href="functies\uitlog.php"><button><p>Log out</p></button></a>
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

let mandje= document.getElementById('winkelmand_items');

document.getElementById('winkelmand').addEventListener('click',function(){
for (item of winkelmand) {
    let itemDiv = document.createElement('div');
    itemDiv.classList = 'item';
    itemDiv.classList.add(item[item.naam]);
    mandje.append(itemDiv);

    let itemImg = document.createElement('img');
    itemImg.classList = 'item_foto';
    itemImg.src = item.imageSrc;
    itemDiv.append(itemImg);

    let table = document.createElement('table');

    // Header row
    let headerRow = document.createElement('tr');
    let naamHeader = document.createElement('th');
    naamHeader.textContent = 'Naam';
    headerRow.appendChild(naamHeader);

    let datumHeader = document.createElement('th');
    datumHeader.textContent = 'Datum';
    headerRow.appendChild(datumHeader);

    let aantalHeader = document.createElement('th');
    aantalHeader.textContent = 'Aantal';
    headerRow.appendChild(aantalHeader);

    table.appendChild(headerRow);

    // Data rows
    let dataRow = document.createElement('tr');
    let naamData = document.createElement('td');
    naamData.textContent = item.naam;
    dataRow.appendChild(naamData);

    let datumData = document.createElement('td');
    datumData.textContent = 'Van ' + item.start + ' tot ' + item.end;
    dataRow.appendChild(datumData);

    let aantalData = document.createElement('td');
    aantalData.textContent = item.aantal;
    dataRow.appendChild(aantalData);

    table.appendChild(dataRow);

    itemDiv.appendChild(table);

    let itemKruis = document.createElement('img');
    itemKruis.classList = 'item_kruis';
    itemKruis.src = "images/svg/xmark-solid.svg" ;
    itemDiv.append(itemKruis);
}
})


//item verwijderen uit WM
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('item_kruis')) {
        console.log('kruis');
        console.log(e.target.parentElement); 
    }
});







</script>