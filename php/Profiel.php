<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 minimal-scale=1.0" >
    <title>Log in</title>
    <style>

body{
    margin:0;
    padding:0;
}
#profiel {
  max-width: 420px;
  margin: 8em auto;
  background: white;
  text-align: left;
  padding: 40px;
  display: flex;
  flex-direction: column;
}

#profiel label {
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

    </style>
</head>
<body>
    <form id="profiel">
    <label for="gebruikersnaam"> Gebruikersnaam</label>
    <input type="text" id="gebruikersnaam">

    <label for="wachtwoord"> Wachtwoord</label>
    <input type="password" id="wachtwoord">
    </form>

    <?php include 'footer.php'?>
</body>
</html>