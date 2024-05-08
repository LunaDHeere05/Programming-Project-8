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
    margin:0.2em 0.8em;
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
    <?php echo 'background: url(images/jpg/jj-ying-7JX0-bfiuxQ-unsplash.jpg) no-repeat center center/cover;'; ?>

}
.zoekbalk{
    display: flex;
    height: 50%;
    width: 60%;
    margin: auto;
    background-color: white;
    border-radius: 5em;
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
</style>
<nav>
<?php
echo '<a href="Home.php"><img class="ehb_logo" src="images/jpg/horizontaal EhB-logo (transparante achtergrond).png" alt="EhB-logo"></a>';
?>
    <div class="linker_navigatie">
        <?php
        echo '<a href="Info.php"><h1>Info</h1></a>';
        echo '<a href="Inventaris.php"><h1>Inventaris</h1></a>';
        echo '<a href="Kalender.php"><h1>Kalender</h1></a>';
        echo '<a href="Reservaties.php"><h1>Reservaties</h1></a>';
        ?>
    </div class="linker_navigatie">
    <div class="rechter_navigatie">
    <?php
        echo '<a href="#"><img src="images/svg/heart-solid.svg" alt="favorietenlijst"></a>';
        echo '<a href="#"><img src="images/svg/cart-shopping-solid.svg" alt="winkelmandje"></a>';
        echo '<a href="#"><img src="images/svg/user-solid.svg" alt="profiel - logout"></a>';
        ?>
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
        <input id="zoek_input" type="text" placeholder="Geef een zoekterm in ...">

        <button id="zoek_btn"><img src="images/svg/magnifying-glass-solid.svg" alt="magnifying glass"></button>';
        
    </div>
</div>

