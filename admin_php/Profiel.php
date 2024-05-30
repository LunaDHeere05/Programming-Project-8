<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0 minimal-scale=1.0">
  <title>Log in</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: "Poppins", sans-serif;
    }

    #imagelogin {
      display: flex;
      flex-direction: column;
      justify-content: center;
      gap: 1em;
      margin-top: 1em;
    }

    #profiel {
      margin: auto;
      width: 30%;
      background: white;
      text-align: left;
      display: flex;
      flex-direction: column;
    }

    #profiel label,
    legend {
      color: #aaa;
      display: inline-block;
      margin: 25px 0 15px;
      font-size: 1em;
      text-transform: uppercase;
      letter-spacing: 1px;
      font-weight: bold;
    }

    #profiel input {
      display: block;
      padding: 10px 6px;
      width: 100%;
      box-sizing: border-box;
      border: none;
      border-bottom: 1px solid #ddd;
      color: #555;
    }

    #profiel input[type="submit"] {
      margin-top: 1em;
      font-size: 1em;
      background-color: #E30613;
      color: white;
      cursor: pointer;
      border-radius: 20px;
    }

    img {
      width: 50%;
      margin: auto;
    }

    fieldset {
      display: flex;
      flex-direction: row;
      justify-content: space-around;
      padding: 0;
      border: none;
      margin-top: 1em;
    }

    fieldset legend {
      text-transform: none;
      margin: 0;
      padding: 0;
    }

    .fieldset {
      display: flex;
      padding: 0;
    }

    .warning {
      font-size: 90%;
      color: red;
      font-weight: bold;
      text-align: center;
      padding: 10px;
    }
  </style>
</head>
<?php
include 'database.php';
?>
<body>
  <div id="imagelogin">
    <img src="images/jpg/horizontaal EhB-logo (transparante achtergrond).png">
    <form id="profiel" action="functies/log_in.php" method="POST">
        <h2>Admin login</h2>
      <label for="gebruikersnaam">Gebruikersnaam</label>
      <input type="email" id="gebruikersnaam" name="gebruikersnaam" required>

      <label for="wachtwoord">Wachtwoord</label>
      <input type="password" id="wachtwoord" name="wachtwoord" required>

      <input type="submit" value="Log in">
    </form>
  </div>
  <?php
  
  session_start();
  if (isset($_SESSION['error_message'])) // controleren of er een foutmelding is;
  {
    echo "<p class='warning'>" . $_SESSION['error_message'] . "</p>";
    unset($_SESSION['error_message']); // foutmelding verwijderen
  }
  ?>

</body>

</html>
