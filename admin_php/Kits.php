<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kits</title>
    <?php include 'top_nav_admin.php'?>
    <style>
.kit_informatie span{
  color: #5B5B5B;
}
.kit_container{
  background-color: #D9D9D9;
  border: #D9D9D9;
  border-radius: 1em;
  padding: 1em;
  margin: 1.5em;
}

.kit_visueel_img img {
  background-color: #fff;
  padding: 1,5em;
  margin: 1em;
  height: auto;
width: 7em;
padding: 1em;
}

.kit_visueel_small img{
  height: auto;
  width: 1em;
  padding: 1em;

}

.kit_verwijder_kit a{
  background-color: #E30613;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border: #E30613;
  border-radius: 2em;
  width: 8.5em;
  height: 1em;
  text-decoration: none;
  color: white;
  padding: 1em;
  margin: 1em;
}
.kit_wijzig_kit a{
  background-color: #1BBCB6;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border: #1BBCB6;
  border-radius: 2em;
  width: 8.5em;
  height: 1em;
  text-decoration: none;
  color: white;
  padding: 1em;
  margin: 1em;
}

.kit_visueel{
  display: flex;
  align-items: center;
}
.kit_verwijder_kit a img{
  width: 1em;
  height: auto;
  margin-left: 1em;
  filter: invert(100%) sepia(0%) saturate(5878%) hue-rotate(26deg) brightness(116%) contrast(115%);
}

.kit_wijzig_kit img{
  width: 1em;
  height: auto;
  margin-left: 1em;
  filter: invert(100%) sepia(0%) saturate(5878%) hue-rotate(26deg) brightness(116%) contrast(115%);
}

.kit_acties{
text-decoration: none;
margin: 0em 1em 0em 1em;

}

.kit_add{
  background-color: #D9D9D9;
  margin: 1.5em;
  padding: 0.5em;
  border-radius: 2em;
  height: auto;
  width: 7em;
}

.kit_add a{
  color: #5B5B5B;
  text-decoration: none;
}
    </style>
  </head>
  <body>
    <div class="rechter_grid">
        <!-- container box  -->
        <div class="kit_container">
          <div class="kit_informatie">
            <h3>Naam: <span>Fotografie kit Canon-M50</span></h3>
            <h3>Kit-ID: <span>0001</span></h3>
          </div>
          <div class="kit_visueel_container">
            <!-- imges  -->
            <div class="kit_visueel">
              <div class="kit_visueel_small">
                <img src="images/svg/chevron-left-solid.svg" alt="" />
              </div>
              <div class="kit_visueel_img">
                <img
                  src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp"
                  alt=""
                />
              </div>
              <div class="kit_visueel_small">
                <img src="images/svg/plus-solid.svg" alt="" />
              </div>
              <div class="kit_visueel_img">
                <img
                  src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp"
                  alt=""
                />
              </div>
              <div class="kit_visueel_small">
                <img src="images/svg/plus-solid.svg" alt="" />
              </div>
              <div class="kit_visueel_img">
                <img
                  src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp"
                  alt=""
                />
              </div>

              <div class="kit_visueel_small">
                <img src="images/svg/chevron-right-solid.svg" alt="" />
              </div>
              <!-- verwijderen wijzigen  -->
              <div class="kit_acties">
                <div class="kit_verwijder_kit">
                  <a href="#">
                    Verwijder kit
                    <img src="images/svg/circle-xmark-solid.svg" alt="xmark" />
                  </a>
                </div>
                <div class="kit_wijzig_kit">
                  <a href="">
                    Wijzig kit
                    <img
                      src="images/svg/pen-to-square-regular.svg"
                      alt=""
                    />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="kit_add">
            <a href="">kit toevoegen</a>
        </div>
      </div>
    </div>
  </body>
</html>
