<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reservatie</title>
    <style>

.reservatiesEnTerug{
    display: flex;
}
.reservatiesEnTerug img{
    width: 1.5em;
    height: auto;
    margin: 1.5em;
}
.reservatiesEnTerug h1{
    margin: 0.6em 0.5em 0em 0.5em;
}
.reservatie-chevron-left img{
  width: 1em;
  height: auto;
  padding: 1em;
}
.reservatie-chevron-left {
    display: flex;
}
.alles_annuleren, .alles_verlengen{
  display: flex;
  background-color: #E30613;
  width: 25%;
  height: 2em;
  border-radius: 1em;
  align-items: center;
}
.alles_annuleren a, .alles_verlengen a{
  display: flex;
  text-decoration: none;
  margin: auto;
  color: white;
}
.alles_verlengen{
  background-color: #1bbcb6;

}
.reservatie-top{
  width: 50%;
}
.reservatie-top h2{
  color: #1bbcb6;
  padding: 1em;
  }

.reservatie-top{
    display: flex;
    align-items: baseline;
}
.reservatie-top a img {
    margin: auto;
    height: 1em;
    width: auto;
    padding: 0em 0em 0em 0.5em;
    filter: invert(100%) sepia(0%) saturate(2%) hue-rotate(129deg) brightness(107%) contrast(100%);
}
.ophalen_reservatie_container, .opgehaald_reservatie_container{
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 1em 2em 1em 0em;
}
.ophalen_reservatie_container input[type=checkbox], .opgehaald_reservatie_container input[type=checkbox]{
    appearance: none;
    -webkit-appearance: none;
    display: flex;
    align-content: center;
    justify-content: center;
    padding: 1em;
    border: 0.25rem solid #1bbcb6;
    border-radius: 50%;
    margin-left: 2em;
}
.ophalen_reservatie_container input[type=checkbox]:checked, .opgehaald_reservatie_container input[type=checkbox]:checked{
    background-color: #1bbcb6;
}

.reservatie_item{
  width: 90%;
}
.reservatie_item_a{
  text-decoration: none;
  color: black;
  width: 100%;
}
.reservatie_item a{
  text-decoration: none;
  color: black;
}
.reservatie_item ul{
  display: flex;
  list-style: none;
  background-color: rgb(193, 193, 193);
  border-radius: 2em;
  justify-content: space-between;
}
.reservatie_item ul li{
  width: 30%;
  height: 80%;
  display: flex;
  flex-direction: column;
  margin: auto;
  text-align: center;
  justify-content: space-between;
}
.reservatie_item ul li:last-child{
  margin-right: 3em;
  align-items: flex-end;
}
.reservatie_item_a ul li:first-child img{
  width: 10em;
  margin: auto;
  margin: 1em auto;
  background-color: white;
  padding: 0.5em;
}
.status h3{
  color:black;
  font-weight: bold;
}
.status p{
  font-weight: normal;
  color: #E30613;
}
.status span{
  color: black;
  font-weight: normal;

}
.annuleer_btn img{
  width: 1.5em;
  height: auto;
  margin: 1em;
}
.annuleer_btn{ 
  width: 50%;
}
.annuleer_btn button{
  margin: auto;
  display: flex;
  background-color: #E30613;
  border: none;
  border-radius: 2em;
  width: 100%;
  align-items: center;
  justify-content: center;
  text-align: center;
}
.annuleer_btn button p{
  color: white;
  font-weight: bold;
  font-size: 16px;
  margin-left: 2em;

}
.annuleer_btn button img{
  background-color: transparent;
  filter: invert(100%) sepia(0%) saturate(2%) hue-rotate(8deg) brightness(109%) contrast(101%);
}

.opgehaald_reservatie_container .status p{
  color: #1bbcb6;

}
.opgehaald_reservatie_container .reservatie_item ul li:last-child{
  width: 15%;
}
.defect_btn button, .verleng_btn button{
  display: flex;
  width: 100%;
  justify-content: center;
  background-color: #303030;
  color: white;
  border: none;
  border-radius: 2em;
  align-items: center;
}
.defect_btn button p, .verleng_btn button p{
  margin-left: 1em;
  font-weight: bold;
  font-size: 16px;
}
.defect_btn button img, .verleng_btn button img{
  width: 1.5em;
  height: auto;
  margin: 1em;
  filter: invert(100%) sepia(0%) saturate(2%) hue-rotate(8deg) brightness(109%) contrast(101%);
}
.verleng_btn button{
  background-color: #1bbcb6;
  width: 100%;
  margin-top: 2em;
}
    </style>
  </head>
  <body>
    <?php include 'top_nav.php'?>
        <div class="reservatiesEnTerug">
          <a href="<?php echo $_SERVER['HTTP_REFERER'];?>"><img src="images/svg/chevron-left-solid.svg" alt=""></a>
        <h1>Mijn reservaties</h1>
        </div>
        <div class="reservatie-top">
          <h2>Nog op te halen</h2>
          <div class="alles_annuleren">
            <a href="#">
              <p>Alles annuleren</p>
              <img src="images/svg/circle-xmark-solid.svg" alt="xmark" />
            </a>
          </div>
        </div>

        <div class="ophalen_lijst_container">
          <?php include 'functies\reservatie_functie.php'?>
          <div class="ophalen_reservatie_container">
            <!-- <label for="#">
              <input type="checkbox">
            </label>
            <div class="reservatie_item">
              <a href="#" class="reservatie_item_a">
                <ul>
                  <li><img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt=""></li>
                  <li class="reservatie_info">
                    <h3>Canon-M50</h3>
                    <p>van 22/04/2024</p>
                    <p>tot 27/04/2024</p>
                    <h3>Aantal: <br><span>1</span></h3>
                  </li>
                  <li class="status">
                    <h3>Status:</h3>
                    <p><b>Binnen 3 dagen ophalen</b></p>
                    <h3>Reservatie-ID: <br> <span>04125</span></h2>
                  </li>
                  <li>
                    <div class="annuleer_btn">
                      <button class= "reservatieAnnulerenBevestiging">
                        <p>Annuleren</p>
                        <img src="images/svg/circle-xmark-solid.svg" alt="xmark"/>
                      </button>
                    </div>
                  </li>
                </ul>
              </a>
            </div>-->
          </div>
          <div class="ophalen_reservatie_container">
            <!-- <label for="#">
              <input type="checkbox">
            </label>
            <div class="reservatie_item">
              <a href="#" class="reservatie_item_a">
                <ul>
                  <li><img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt=""></li>
                  <li class="reservatie_info">
                    <h3>Canon-M50</h3>
                    <p>van 22/04/2024</p>
                    <p>tot 27/04/2024</p>
                    <h3>Aantal: <br><span>1</span></h3>
                  </li>
                  <li class="status">
                    <h3>Status:</h3>
                    <p><b>Binnen 3 dagen ophalen</b></p>
                    <h3>Reservatie-ID: <br> <span>04125</span></h2>
                  </li>
                  <li>
                    <div class="annuleer_btn">
                    <button class= "reservatieAnnulerenBevestiging">
                        <p>Annuleren</p>
                        <img src="images/svg/circle-xmark-solid.svg" alt="xmark"/>
                      </button>
                    </div>
                  </li>
                </ul>
              </a>
            </div>
          </div>
        </div>
         -->
        <div class="reservatie-top">
          <h2>Opgehaald</h2>
          <div class="alles_verlengen">
            <a href="#">
              <p>Alles verlengen</p>
              <img src="images/svg/calendar-regular.svg" alt="xmark" />
            </a>
          </div>
        <!-- </div>
        <div class="opgehaald_lijst_container">
          <div class="opgehaald_reservatie_container">
            <label for="#">
              <input type="checkbox">
            </label>
            <div class="reservatie_item">
              <a href="#" class="reservatie_item_a">
                <ul>
                  <li><img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt=""></li>
                  <li class="reservatie_info">
                    <h3>Canon-M50</h3>
                    <p>van 22/04/2024</p>
                    <p>tot 27/04/2024</p>
                    <h3>Aantal: <br><span>1</span></h3>
                  </li>
                  <li class="status">
                    <h3>Status:</h3>
                    <p><b>Binnen 3 dagen ophalen</b></p>
                    <h3>Reservatie-ID: <br> <span>04125</span></h2>
                  </li>
                  <li>
                    <div class="defect_btn">
                      <button class="defect_button">
                        <p>Defect melden</p>
                        <img src="images/svg/screwdriver-wrench-solid.svg" alt="defect"/>
                      </button>
                    </div>
                    <div class="verleng_btn">
                      <button>
                        <p>Verleng</p>
                      <img src="images/svg/calendar-regular.svg" alt="verleng">
                      </button>
                    </div>
                  </li>
                </ul>
              </a>
            </div> -->
          </div> 
      </div>
      <?php include 'footer.php'?>
  </body>
  <script>
  var annuleer_buttons = document.querySelectorAll('.reservatieAnnulerenBevestiging');
  annuleer_buttons.forEach(function(button) {
    button.addEventListener('click', function() {
      window.location.href = 'ReservatieAnnuleren.php';
    });
  });
  var defect_buttons = document.querySelectorAll('.defect_button');
  defect_buttons.forEach(function(button) {
    button.addEventListener('click', function() {
      window.location.href = 'DefectMelden.php';
    });
  });

</script>
</html>