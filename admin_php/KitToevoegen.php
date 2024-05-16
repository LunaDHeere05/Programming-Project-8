<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defect</title>
    <?php include 'top_nav_admin.php'?>
    <style>
      .kit_toe{
  display: flex;
  align-items: center;
  margin: 1em;
  background-color: #D9D9D9;
  border-radius: 1.5em;
  padding: 1em;
}
.kit_toe input{
  border-radius: 1em;
  border: 0;
  background-color: #fff;
  height: 3em;
  width: 73%;
  margin: 0em 0em 0em 1em;
  padding: 0em 1em 0em 1em;
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
<div class="kit_toe">
            <h2>Naam van de kit:</h2>
            <input type="text">
        </div>
<div class="kit_toe_button">
    <div class="kit_toe_apparaat">
        <button type="submit">Apparaat <img src="../images/svg/plus-solid.svg" alt=""> </button>
    </div> 
<div class="kit_toe_opslaan">
<button type="submit">Sla op </button>
</div>
</div>
    </div>  
</body>
</html>