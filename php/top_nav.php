<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}           

nav{
    display: flex;
    justify-content: space-between;
    margin:0.2em 0.8em auto 0.8em;
    align-items: center;
}

.linker_navigatie{
    list-style: none;   
    display: flex;
    font-size: 120%;
    font-weight: bold;
    gap:2em;
    margin:0.2em 0.8em auto 0.8em;

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
    height: 54px;
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
    <?php echo 'background: url(images/svg/sliders-solid.svg) no-repeat center;'; ?>;
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
  width: 50%;
  margin: auto;
  border: 1px solid black;
  border-radius: 2em;
  padding: 1em;
  background-color: white;
  position: absolute;
  border: none;
  z-index: 9999;
}
#winkelmand_popup h3{
    margin-bottom: 1em;
}
#close_window{
    width: 2em;
    height: 2em;
    cursor: pointer;
    position: absolute;
    top: 1em;
    right: 2em;
}
#winkelmand_items{
    display: block;
}
.item{
    background-color: rgb(193, 193, 193);
    padding: 1.5em;
    border-radius: 2em;
    display: flex;
    margin-bottom: 2em;
    justify-content: space-between;
    align-items: center;
}
.datum_aanpassen {
    display: flex;
    flex-direction: column;
}
.datum_aanpassen img{
    width: 2em;
    height: auto;
    margin: auto;
    margin-bottom: 0.5em;
}
.datum_aanpassen input:focus{
    outline: none;
}
.aantal{
    background-color: white;
    font-weight: bold;
    border-radius: 2em;
    padding-left: 0.5em;
}
.aantal input{
    width: 2em;
    height: 2em;
    text-align: center;
    font-weight: bold;
    border: none;
    margin-right: 1em;
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
    margin-top: 1em;
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
    left: -99999px;
}
body.blur > :not(#winkelmand_popup) {
        filter: blur(50px);
        pointer-events: none;
}
</style>
<nav>
<a href="Home.php"><img class="ehb_logo" src="images/jpg/horizontaal EhB-logo (transparante achtergrond).png" alt="EhB-logo"></a>
    <div class="linker_navigatie">
    
        <a href="Info.php"><h1>Info</h1></a>
        <a href="Inventaris.php"><h1>Inventaris</h1></a>
        <a href="Kalender.php"><h1>Kalender</h1></a>
        <a href="Reservaties.php"><h1>Reservaties</h1></a>
    
    </div class="linker_navigatie">
    <div class="rechter_navigatie">

        <a href="Favorietenlijst.php"><img src="images/svg/heart-solid.svg" alt="favorietenlijst"></a>
        <a href="#" id="winkelmand"><img src="images/svg/cart-shopping-solid.svg" alt="winkelmandje"></a>
        <a href="#"><img src="images/svg/user-solid.svg" alt="profiel - logout"></a>
    
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
    <h3>Winkelmand</h3>
    <div id="winkelmand_items">
        <div class="item">
            <img class="item_foto" src="images\webp\eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="">
            <h3>Canon - M50</h3>
            <div class="datum_aanpassen">
                <img src="images\svg\pen-to-square-regular.svg" alt="wijzig datum">
                <p>Van 22/04/2024</p>
                <p>Tot 27/04/2024</p>
            </div>
            <div class="aantal">
                <label for="aantal">Aantal:</label>
                <input type="number" placeholder="0">
            </div>
        </div>
        <div class="item">
            <img class="item_foto" src="images\webp\eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="">
            <h3>Canon - M50</h3>
            <div class="datum_aanpassen">
                <img src="images\svg\pen-to-square-regular.svg" alt="wijzig datum">
                <p>Van 22/04/2024</p>
                <p>Tot 27/04/2024</p>
            </div>
            <div class="aantal">
                <label for="aantal">Aantal:</label>
                <input type="number" id="aantal" placeholder="0">
            </div>
        </div>
        </div>
    <img src="images/svg/xmark-solid.svg" alt="sluit venster" id="close_window">
    <form>
        <input type="submit" value="Reserveer nu">
    </form>
</div>
<script>
document.getElementById('winkelmand').addEventListener('click', function(){
    document.getElementById('winkelmand_popup').classList.remove('hidden');
    document.body.classList.add('blur');
});

document.getElementById('close_window').addEventListener('click', function(){
    document.getElementById('winkelmand_popup').classList.add('hidden');
    document.body.classList.remove('blur');
});
</script>