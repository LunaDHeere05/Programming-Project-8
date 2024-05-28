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
  position: relative;
}
.kit_visueel_img{
  display: flex;
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
position: absolute;
top: 20%;
right: 20%;

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
    <?php include 'functies\kits_zoeken.php'?>
    <div class="rechter_grid">
        <!-- container box  -->
        <?php include 'functies\kits_ophalen.php'?>
        <div class="kit_add">
            <a href="">kit toevoegen</a>
        </div>
      </div>
    </div>
  </body>
</html>