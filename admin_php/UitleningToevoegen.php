<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Uitlening Toevoegen</title>
  <?php include 'top_nav_admin.php' ?>
  <style>
    .uitlening_specificaties {
      margin: 2em;
      align-content: space-between;
    }

    .uitlening_specificaties form input {
      background-color: #D9D9D9;
      border-radius: 2em;
      border: 0;
      width: 17em;
      height: 1em;
      padding: 1em;
    }

    .uitlening_specificaties h2 {
      margin: 0em 1em 0em 0em;
    }

    .uitlening_toe {
      display: flex;
      margin: 2em 2em 2em 1em;
    }

    .datum_kiezen {
      display: flex;
      margin: 2em 2em 2em 1em;
    }

    .apparaat_uitlening_toevoegen {
      display: flex;
      margin: 2em 2em 2em 1em;
    }

    .apparaat_uitlening_toevoegen h3 {
      margin: 0em 0em 0em 1em;
    }

    .apparaat_uitlening_toevoegen img {
      width: 1.5em;
      height: auto;
      cursor: pointer;
    }

    .bevestig button {
      background-color: #1BBCB6;
      border-radius: 2em;
      width: 15em;
      height: 3em;
      border: 0;
      color: white;
      font-weight: bold;
      cursor: pointer;
    }

    .bevestig {
      margin: 0em 0em 0em 7em;
    }
   #studentButton{
      width: 50px;
    }
    #docentButton{
      width: 50px;
    }
  </style>
</head>
<body>
  <div class="uitlening_specificaties">
    <form method="post">
    <div class="radio-group">
            <label>
                <input  id="studentButton" type="radio" name="email_type" value="student" required>Student
            </label>
            <label>
                <input id="docentButton" type="radio" name="email_type" value="docent" required>Docent
            </label>
        </div>
      <div class="uitlening_toe">
        <h2>E-mail:</h2>
        <input type="email" name="email" placeholder="Vul het e-mailadres in ...">
      </div>
      <div class="uitlening_toe">
        <h2>Apparaat:</h2>
        <input type="text" name="apparaat" placeholder="Voer het apparaat in...">
      </div>
      <div class="datum_kiezen">
        <h2>Uitleentermijn:</h2>
        <input type="date" name="datum" placeholder="Bepaal het uitleentermijn">
      </div>

      <div class="apparaat_uitlening_toevoegen">
        <img src="../images/svg/plus-circle.svg" alt="">
        <h3>Apparaat toevoegen aan uitlening</h3>
      </div>
      <div class="bevestig">
        <button type="submit" name="bevestig_button">Bevestig</button>
      </div>
  </div>
  <?php include 'functies/uitlening_toevoegen.php' ?>
  </form>
  </div>
</body>

</html>