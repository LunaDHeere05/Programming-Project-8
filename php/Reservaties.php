<?php include 'top_nav.php' ?>
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Reservaties</title>
        <link rel="stylesheet" href="/css/stylesheet.css" />
        <style>
          @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

          
  .chevron-left{
    width: 100%;
    align-items: center;
    display: flex;
    margin: 0.5em 1em;
    gap:1em;
    align-items: center;
    font-size:90%
}

.chevron-left a img{
    width: 1.5em;
}

.reservatie-top h2{
  font-size: 1em;
  color: #1bbcb6;
  padding: 1em;
  }
  .reservatie-top{
    display: flex;
    align-items: baseline;
  }

  .reservatie-top a {
    color: #fff;
    background-color: #E30613;
    border-radius: 2em;
    border: #E30613;
    padding: 0.5em 0.5em 0em 1em;
    height: 2em;
    text-decoration: none;
  }
  .reservatie-top a img {
    margin: auto;
    height: 1em;
    width: auto;
    padding: 0em 0em 0em 0.5em;
    filter: invert(100%) sepia(0%) saturate(2%) hue-rotate(129deg) brightness(107%) contrast(100%);
    }

  .reservatie-annuleren img{
  margin: auto;
height: 1em;
width: auto;
padding: 0em 0em 0em 0.5em;
filter: invert(100%) sepia(0%) saturate(2%) hue-rotate(129deg) brightness(107%) contrast(100%);
  }
  
.reservatie-annuleren a{
    display: flex;
    height: 1.5em;
    width: 7em;
    margin-top: 3.5em;
    text-align: center;
    padding: 0.5em;
    background-color: #E30613;
    border: #E30613;
    border-radius: 2em;
    text-decoration:none;
    color: #fff;
  }


  .reservatie-box-full{
    background-color: rgb(193, 193, 193);
    border-radius: 2em;
    margin: 1em 1em 1em 2.5em;
    padding: 1em;
    height: 10em;
    width: 80em;
    display: flex;
    justify-content: space-between;
  }

  .reservatie-box-full p{
    margin: 0.1em 0em 0.5em 0em;
  }
  .reservatie-box1 b {
    color: #E30613;
  }

  .reservatie-box2 b {
    color: #1bbcb6;
  }

  .reservatie-box-info img{
   width: 10em;
   height: auto;
   background-color: #fff; 
  }

.reservatie-box1{
  display: flex;
  align-items: center;
}
.reservatie-box2{
  display: flex;
  align-items: center;
}

.reservatie-opgehaald{
  display: flex;
  align-items: baseline;
}
.reservatie-opgehaald h2{
  font-size: 1em;
  color: #1bbcb6;
  padding: 1em;
  }
.reservatie-opgehaald a {
  color: #fff;
  background-color:#1bbcb6;
  border-radius: 2em;
  border: #1bbcb6;
  padding: 0.5em 0.5em 0em 1em;
  height: 2em;
  text-decoration: none;
}
.reservatie-opgehaald a img {
  margin: auto;
  height: 1em;
  width: auto;
  padding: 0em 0em 0em 0.5em;
  filter: invert(100%) sepia(0%) saturate(2%) hue-rotate(129deg) brightness(107%) contrast(100%);
  }

  .reservatie-artikel-info-aantal{
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .reservatie-verleng-box1{
    display: flex;
    flex-direction: column;
  }
  .reservatie-verleng-box1 a{
    text-decoration: none;
    color: #fff;
  }
  .reservatie-verleng-box1 img{
   margin: auto;
    width: 1.1em;
    height: auto;
    padding: 0em 0em 0em 0.5em;
  }
  .reservatie-defect{
    background-color: #000000;
    border-radius: 2em;
    border: #000000;
    padding: 0.5em 0.5em 0.5em 1em;
    height: auto;
    width: 6em;
  }
  .reservatie-verleng-box1 img{
    filter: invert(100%) sepia(0%) saturate(5878%) hue-rotate(26deg) brightness(116%) contrast(115%);
  }
  .reservatie-verlengen{
    background-color: #1bbcb6;
    border-radius: 2em;
    border: #1bbcb6;
    padding: 0.5em 0.5em 0.5em 1em;
    height: auto;
    width: 6em;
    margin: 1em 0em 0em 0em;
  }
  /* Customize the label (the container) */
.reservatie-checkbox-container {
  display: flex;
  position: relative;
  cursor: pointer;
  font-size: 1.5em;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.reservatie-checkbox-container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.reservatie-checkmark {
  position: absolute;
  top: 0;
  left: 0.5em;
  height: 1em;
  width: 1em;
  background-color: #eee;
  border-radius: 0.5em;
}


/* On mouse-over, add a grey background color */
.reservatie-checkbox-container:hover input ~ .reservatie-checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.reservatie-checkbox-container input:checked ~ .reservatie-checkmark {
  background-color: #1bbcb6;
}

/* Create the checkmark/indicator (hidden when not checked) */
.reservatie-checkbox-container:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.reservatie-container input:checked ~ .reservatie-checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.reservatie-container .reservatie-checkmark:after {
 border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
      </head>
      <body>
        <div class="chevron-left">
          <a href="#">
            <img src="images/svg/chevron-left-solid.svg" alt="chevron left"
          /></a>
          <h1>Reservaties</h1>
        </div>
        <div class="reservatie-top">
          <h2>Nog op te halen</h2>
          <a href="">
            Alles annuleren
            <img src="images/svg/circle-xmark-solid.svg" alt="xmark" />
          </a>
        </div>
        <div class="reservatie-boxes">
          <div class="reservatie-box1">
            <label class="reservatie-checkbox-container">
              <input type="checkbox" />
              <span class="reservatie-checkmark"></span>
            </label>
            <div class="reservatie-box-full">
              <div class="reservatie-box-info">
                <img
                  src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp"
                  alt="foto"
                />
              </div>
              <div class="reservatie-artikel-info">
                <h3>Canon-M50</h3>
                <p>van 22/04/2024</p>
                <p>tot 27/04/2024</p>
                <div class="reservatie-artikel-info-aantal"><h3>Aantal:</h3>
                <p>1</p>
            </div>
              </div>
              <div class="reservatie-status">
                <h3>Status:</h3>
                <p><b>Binnen 3 dagen ophalen</b></p>
                <h2>Reservatie-ID:</h2>
                <p>04125</p>
              </div>
              <div class="reservatie-annuleren">
                <a href="">
                  Annuleren<img
                    src="../images/svg/circle-xmark-solid.svg"
                    alt="xmark"
                  />
                </a>
              </div>
            </div>
          </div>

            <div class="reservatie-box1">
              <label class="reservatie-checkbox-container">
                <input type="checkbox" />
                <span class="reservatie-checkmark"></span>
              </label>
              <div class="reservatie-box-full">
                <div class="reservatie-box-info">
                  <img
                    src="../images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp"
                    alt="foto"
                  />
                </div>
                <div class="reservatie-artikel-info">
                  <h3>Canon-M50</h3>
                  <p>van 22/04/2024</p>
                  <p>tot 27/04/2024</p>
                  <div class="reservatie-artikel-info-aantal"><h3>Aantal:</h3>
                    <p>1</p>
                </div>
                </div>
                <div class="reservatie-status">
                  <h3>Status:</h3>
                  <p><b>Binnen 3 dagen ophalen</b></p>
                  <h2>Reservatie-ID:</h2>
                  <p>04125</p>
                </div>
                <div class="reservatie-annuleren">
                  <a href="">
                    annuleren<img
                      src="../images/svg/circle-xmark-solid.svg"
                      alt="xmark"
                    />
                  </a>
                </div>
              </div>
            </div>
        </div>

        <div class="reservatie-opgehaald">
            <h2>Opgehaald</h2>
            <a href="">
              Alles verlengen
              <img src="../images/svg/calendar-regular.svg" alt="calender" />
            </a>
          </div>
          <div class="reservatie-boxes">
            <div class="reservatie-box2">
              <label class="reservatie-checkbox-container">
                <input type="checkbox" />
                <span class="reservatie-checkmark"></span>
              </label>
              <div class="reservatie-box-full">
                <div class="reservatie-box-info">
                  <img
                    src="../images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp"
                    alt="foto"
                  />
                </div>
                <div class="reservatie-artikel-info">
                  <h3>Canon-M50</h3>
                  <p>van 15/04/2024</p>
                  <p>tot 25/04/2024</p>
                  <div class="reservatie-artikel-info-aantal"><h3>Aantal:</h3>
                    <p>1</p>
                </div>
                </div>
                <div class="reservatie-status">
                  <h3>Status:</h3>
                  <p><b>Binnen 3 dagen in te leveren</b></p>
                  <h2>Reservatie-ID:</h2>
                  <p>04125</p>
                </div>
                <div class="reservatie-verleng-box1">
                    <div class="reservatie-defect">
                  <a href="">
                    Defect<br>melden <img
                      src="../images/svg/screwdriver-wrench-solid.svg"
                      alt="fixing"
                    />
                  </a>
                </div>
                <div class="reservatie-verlengen">
                  <a href="">
                    Verleng <img
                      src="../images/svg/calendar-regular.svg"
                      alt="calender"
                    />
                  </a>
                </div>
                </div>
              </div>
            </div>
        <!-- footer -->
      </body>
    </html>
  </body>
</html>

<?php include "footer.php" ?>