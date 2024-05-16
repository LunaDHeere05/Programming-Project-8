<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defect</title>
    <?php include 'top_nav_admin.php'?>
    <style>
.defect_container{
  background-color: #D9D9D9;
  border: #D9D9D9;
  border-radius: 1em;
  padding: 1em;
  margin: 1.5em;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.defect_informatie span{
  color: #5B5B5B;
}

.defect_visueel_img img {
  background-color: #fff;
  padding: 1,5em;
  margin: 1em;
  height: auto;
width: 7em;
padding: 1em;
}

.defect_hersteld a{
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
.defect_verwijder a{
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

.defect_visueel{
  display: flex;
  align-items: center;
}
.defect_hersteld a img{
  width: 1em;
  height: auto;
  margin-left: 1em;
  filter: invert(100%) sepia(0%) saturate(5878%) hue-rotate(26deg) brightness(116%) contrast(115%);
}

.defect_verwijder img{
  width: 1em;
  height: auto;
  margin-left: 1em;
  filter: invert(100%) sepia(0%) saturate(5878%) hue-rotate(26deg) brightness(116%) contrast(115%);
}
.defect_acties{
text-decoration: none;
margin: 0em 1em 0em 1em;

}

.defect_add{
  background-color: #D9D9D9;
  margin: 1.5em;
  padding: 0.5em;
  border-radius: 2em;
  height: auto;
  width: 10em;
}

.defect_add a{
  color: #5B5B5B;
  text-decoration: none;
}
</style>
</head>
<body>
        <!-- container box  -->
        
        <div class="defect_container">
            <div class="defect_visueel_img">
                <img
                  src="../images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp"
                  alt=""
                />
              </div>
          <div class="defect_informatie">
            <h3>Naam: <span>Canon-M50</span></h3>
            <h3>Kit-ID: <span>RZ</span></h3>
            <h3>Defect: <span>flash werkt niet</span></h3>
          </div>
            <!-- imges  -->
            <div class="defect_visueel">
              <!-- verwijderen wijzigen  -->
              <div class="defect_acties">
                <div class="defect_hersteld">
                  <a href="#">
                    Hersteld
                    <img src="../images/svg/screwdriver-wrench-solid.svg" alt="xmark" />
                  </a>
                </div>
                <div class="defect_verwijder">
                  <a href="">
                    Verwijder
                    <img
                      src="../images/svg/circle-xmark-solid.svg"
                      alt=""
                    />
                  </a>
                </div>
              </div>
          </div>
        </div>
        <div class="defect_add">
            <a href="">Defect toevoegen</a>
        </div>
      </div>
    </div>  
</body>
</html>
