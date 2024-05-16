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

    #imagelogin{
      display: flex;
      flex-direction: column;
      justify-content: center;
      gap:1em;  
      margin-top:1em;

    }

    #profiel {
      margin: auto;
      width:30%;
      background: white;
      text-align: left;
      display: flex;
      flex-direction: column;
    }

    #profiel label,legend {
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
      width: 60%;
      margin: auto;
    }

    fieldset{
      display: flex;
      flex-direction: row;
      justify-content: space-around;
      padding:0;
      border:none;
      margin-top:1em; 
    }

    fieldset legend{
    text-transform: none;
      margin:0;
      padding:0;
    }

    .fieldset {
      display: flex;
     padding:0;

    }

    .warning{
      font-size:90%;
      color:red;
      font-weight: bold;
      text-align: center;
      padding:10px;
    }

  </style>
</head>

<body>
  <div id="imagelogin">
  <img src="images/jpg/horizontaal EhB-logo (transparante achtergrond).png">
  <form id="profiel" action="functies/log-in.php" method="POST">
    <label for="gebruikersnaam"> Gebruikersnaam</label>
    <input type="email" id="gebruikersnaam" name="gebruikersnaam">

    <label for="wachtwoord"> Wachtwoord</label>
    <input type="password" id="wachtwoord" name="wachtwoord">

      <fieldset>
    <legend>Ik ben een ...</legend>
 <div class="fieldset">
 <input type="radio" id="student" name="user" checked value="student">
    <label for="student">student</label>
    </div>  
    <div class="fieldset">
    <input type="radio" id="docent" name="user" value="docent">
    <label for="docent">docent</label>   
   
    </div>
  </fieldset>

    <input type="submit" value="Log in">
  </form>
  </div>
  <?php  
session_start();
if (isset($_SESSION['error_message'])) //controleren of er een foutmelding is;
  {
    echo "<p class='warning'>".$_SESSION['error_message']."</p>";
    unset($_SESSION['error_message']); //foutmelding verwijderen
  }
   ?>
  <?php include 'footer.php' ?>
  <script>
    let form = document.getElementById('profiel');
    let p = document.createElement('p');
    p.classList="warning"
    p.textContent = '';

    form.addEventListener('submit', function(e) {
      e.preventDefault();
      let gebruikersnaam = document.getElementById('gebruikersnaam');
      let wachtwoord = document.getElementById('wachtwoord');
  
      if (gebruikersnaam.value && wachtwoord.value) {
        this.submit();
      } else if (!gebruikersnaam.value) {
        p.textContent = 'Gebruikersnaam is leeg.'
        gebruikersnaam.after(p)
      } else if (!wachtwoord.value) {
        p.textContent = 'Wachtwoord is leeg.'
        wachtwoord.after(p)
      }
    })
  </script>
</body>

</html>