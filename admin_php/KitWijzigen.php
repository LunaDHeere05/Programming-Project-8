<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defect</title>
    <?php include 'top_nav_admin.php'?>
    <style>
.kit_wijzig_toe{
  width: 55%;
  display: flex;
  align-items: center;
  margin: 1em auto;
  background-color: #D9D9D9;
  border-radius: 1.5em;
  padding: 0em 1em 0em 1em;
}
.kit_wijzig_toe input{
  background-color: #fff;
  padding: 0.5em;
  margin: 1em;
  border-radius: 0.9em;
  width: 40em;
  display: flex;
  align-items: center;
  justify-content: center;
  border: none;
}
.kit_wijzig_container{
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: #D9D9D9;
  border: #D9D9D9;
  border-radius: 1em;
  padding: 1em;
  margin: auto;
  width: 80%;
  margin-bottom: 1.5em;
}
.kit_wijzig_visueel_img img {
  background-color: #fff;
  padding: 1,5em;
  margin: 1em;
  height: auto;
width: 7em;
padding: 1em;
}
.kit_wijzig_verwijder a{
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
.kit_wijzig_verwijder img{
  width: 1em;
  height: auto;
  margin-left: 1em;
  filter: invert(100%) sepia(0%) saturate(5878%) hue-rotate(26deg) brightness(116%) contrast(115%);
}
.kit_toe_button{
  display: flex;
  justify-content: center;
}
.kit_toe_apparaat button{
  background-color: #5B5B5B;
  border-radius: 2em;
  width: 10em;
  height: 2em;
  border: 0;
  color: white;
  font-weight: bold;
  cursor: pointer;
  margin: 1em 0em 0em 0em;
  font-size:1em;
  display: flex;
  align-items: center;
  padding: 0em 0em 0em 1.5em;
}
.kit_toe_apparaat img{
  width: 1em;
  height: auto;
  margin-left: 1em;
  filter: invert(100%) sepia(0%) saturate(5878%) hue-rotate(26deg) brightness(116%) contrast(115%);
}
.kit_toe_opslaan button{
  background-color: #1BBCB6;
  border-radius: 2em;
  width: 10em;
  height: 2em;
  border: 0;
  color: white;
  font-weight: bold;
  cursor: pointer;
  margin: 1em 0em 0em 2em;
  font-size:1em;
  display: flex;
  align-items: center;
  padding: 0em 0em 0em 3em;
}
    </style>
</head>
<body>
<?php include 'functies/kit_wijzigen.php'?>
        <div class="kit_toe_button">
          <div class="kit_toe_apparaat">
            <button type="submit">
              Apparaat <img src="images/svg/plus-solid.svg" alt="" />
            </button>
          </div>
          <div class="kit_toe_opslaan">
            <button type="submit">Sla op</button>
          </div>
        </div>
      </div>
    </div> 
</body>
</html>