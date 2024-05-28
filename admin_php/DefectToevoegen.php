<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defect</title>
    <?php include 'top_nav_admin.php'?>
    <style>
        /* defect toevoegen page  */
.Info_rechter_grid{
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.defect_toe{
  display: flex;
  align-items: center;
  margin: 1em;
  margin-left: 2em;
}
.defect_toe img{
  width: 2em;
  height: auto;
  margin: 1em;
  cursor: pointer;
}
.defect_toe input, .exemplaar_id input{
  margin: 1.5em;
  border-radius: 2em;
  border: 0;
  background-color: #D9D9D9;
  height: 2em;
  width: 15em;
  padding: 1em;
}
.defect_toe_textbox h2{
  margin: 1em 0em 1em 1em;

}
.defect_toe_text input{
  height: 15em;
  width: 95%;
  border: 0;
  border-radius: 1em;
  background-color: #D9D9D9;
  padding: 1em 0em 1em 1em;
  margin: 1em;
}

.defect_toe_bevestig button{
  background-color: #1BBCB6;
  border-radius: 2em;
  width: 10em;
  height: 2em;
  border: 0;
  color: white;
  font-weight: bold;
  cursor: pointer;
  margin: 1em 0em 0em 0em;
  font-size:1em;
}
.defect_toe_bevestig{
  display: flex;
  justify-content: center;
}
    </style>
</head>
<body>
  <form action="functies\defect_toevoegen.php" method="POST">
        <div class="defect_toe">
            <h2>Exemplaar ID:</h2>
            <input type="text" name="exemplaar_id">
            <img src="images\svg\eye-solid.svg" alt="eye">
            <input type="hidden" name="eye_state" value="solid">
        </div>
        <div class="defect_toe_textbox">
          <h2>Beschrijf het defect:</h2>
          <div class="defect_toe_text">
            <input type="text" name="beschrijving">
          </div>
    </div>
    <div class="defect_toe_bevestig">
            <button type="submit">Bevestig</button>
        </div>
    </div>  
  </form>
</body>
</html>