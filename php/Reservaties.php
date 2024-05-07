<?php include 'top_nav.php' ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reservatie</title>
  </head>
  <body>
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Reservaties</title>
        <link rel="stylesheet" href="/css/stylesheet.css" />
        <style>
          @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
        </style>
      </head>
      <body>
        <div class="reservatie-chevron-left">
          <a href="#">
            <img src="/images/svg/chevron-left-solid.svg" alt="chevron left"
          /></a>
          <h1><b>Mijn Reservaties</b></h1>
        </div>
        <div class="reservatie-top">
          <h2>Nog op te halen</h2>
          <a href="">
            Alles annuleren
            <img src="../images/svg/circle-xmark-solid.svg" alt="xmark" />
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
                  src="../images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp"
                  alt="foto"
                />
              </div>
              <div class="reservatie-artikel-info">
                <h3>Canon-M50</h3>
                <p>van 22/04/2024</p>
                <p>tot 27/04/2024</p>
                <div class="reservatie-artikel-info-aantal"><h3>aantal:</h3>
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
                  <div class="reservatie-artikel-info-aantal"><h3>aantal:</h3>
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
                  <div class="reservatie-artikel-info-aantal"><h3>aantal:</h3>
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


<?php echo "hello"; ?>
<?php include "footer.php" ?>