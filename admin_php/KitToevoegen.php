<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defect</title>
    <?php include 'top_nav_admin.php'?>
    <style>
      .kit_toe {
        display: flex;
        align-items: center;
        margin: 1em;
        background-color: #D9D9D9;
        border-radius: 1.5em;
        padding: 1em;
      }

      .kit_toe input {
        border-radius: 1em;
        border: 0;
        background-color: #fff;
        height: 3em;
        width: 73%;
        margin: 0em 0em 0em 1em;
        padding: 0em 1em 0em 1em;
      }

      .kit_toe_button {
        display: flex;
        justify-content: center;
      }

      #kit_toe_apparaat button {
        background-color: #5B5B5B;
        border-radius: 2em;
        width: 10em;
        height: 2em;
        border: 0;
        color: white;
        font-weight: bold;
        cursor: pointer;
        margin: 1em 0em 0em 0em;
        font-size: 1em;
        display: flex;
        align-items: center;
        padding: 0em 0em 0em 1.5em;
      }

      #kit_toe_apparaat img {
        width: 1em;
        height: auto;
        margin-left: 1em;
        filter: invert(100%) sepia(0%) saturate(5878%) hue-rotate(26deg) brightness(116%) contrast(115%);
      }

      .kit_toe_opslaan button {
        background-color: #1BBCB6;
        border-radius: 2em;
        width: 10em;
        height: 2em;
        border: 0;
        color: white;
        font-weight: bold;
        cursor: pointer;
        margin: 1em 0em 0em 2em;
        font-size: 1em;
        display: flex;
        align-items: center;
        padding: 0em 0em 0em 3em;
      }

      #apparaat_kiezen_container {
        display: none; /* Initially hidden */
        background-color: #edededcf;
        width: 70%;
        height: auto;
        border-radius: 2em;
        padding: 0.5em;
        position: fixed;
        z-index: 10000; /* Ensure this is higher than the blurred content */
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        overflow: auto;
      }

      .zoekbalk {
        display: flex;
        height: 3em;
        width: 80%;
        margin: auto;
        background-color: white;
        border-radius: 5em;
      }

      #zoeken_functie {
        display: flex;
        width: 100%;
      }

      #zoeken_functie input[type="submit"] {
        background: url(images/svg/magnifying-glass-solid.svg) no-repeat center;
        border: none;
        background-color: none;
        cursor: pointer;
        width: 2em;
        margin-right: 1em;
      }

      #zoek_input {
        border: none;
        background: none;
        color: #5b5b5b;
        width: 95%;
        margin-left: 2em;
      }

      #zoek_input:focus {
        outline: none;
      }

      #apparaat_kiezen_container button {
        background: none;
        border: none;
      }

      #apparaat_kiezen_container button img {
        width: 2em;
        height: auto;
        position: absolute;
        top: 1em;
        right: 2em;
      }

      .apparaat_container {
        display: flex;
        background-color: #d9d9d9;
        border-radius: 2em;
        width: 98%;
        margin: 2em auto;
      }

      .apparaat {
        display: flex;
        position: relative;
      }

      .apparaat img {
        width: 20%;
        margin: 1em;
        background-color: white;
        border-radius: 2em;
        padding: 1em;
      }

      .apparaat_info {
        display: flex;
        flex-direction: column;
        margin: auto 2em;
      }

      .apparaat_acties {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        justify-content: flex-end;
      }

      .apparaat_acties input[type=checkbox] {
        appearance: none;
        -webkit-appearance: none;
        padding: 1em;
        border: 0.25rem solid #1bbcb6;
        border-radius: 50%;
        margin-right: 3em;
      }

      .apparaat_acties input[type=checkbox]:checked {
        background-color: #1bbcb6;
      }

      .hidden {
        display: none;
      }
    </style>
</head>
<body>
<div class="kit_toe">
    <h2>Naam van de kit:</h2>
    <input type="text">
</div>
<div class="kit_toe_button">
    <div id="kit_toe_apparaat">
        <button type="submit">Apparaat <img src="images/svg/plus-solid.svg" alt=""></button>
    </div>
    <div class="kit_toe_opslaan">
      <button type="submit">Sla op</button>
    </div>
</div>

<div id="apparaat_kiezen_container" class="hidden">
  <div class="zoekbalk">
    <form action="#" method="GET" id="zoeken_functie">
      <input id="zoek_input" type="text" placeholder="Zoek op apparaatnaam of apparaat-ID" name="zoek_query">
      <input type="submit" value="">
    </form>
  </div>
  <div class="apparaten_lijst_container">
    <div class="apparaat_container">
      <div class="apparaat">
        <img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="">
        <div class="apparaat_info">
          <h2>Apparaatnaam</h2>
          <p>Apparaat-ID: <span>1</span></p>
        </div>
      </div>
      <div class="apparaat_acties">
        <label for="">
          <input type="checkbox">
        </label>
      </div>
    </div>
    <div class="apparaat_container">
      <div class="apparaat">
        <img src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp" alt="">
        <div class="apparaat_info">
          <h2>Apparaatnaam</h2>
          <p>Apparaat-ID: <span>1</span></p>
        </div>
      </div>
      <div class="apparaat_acties">
        <label for="">
          <input type="checkbox">
        </label>
      </div>
    </div>
  </div>
  <button><img id="sluit_popup" src="images/svg/xmark-solid.svg" alt="sluit venster"></button>
</div>

<script>
  document.getElementById('kit_toe_apparaat').addEventListener('click', function() {
    document.getElementById('apparaat_kiezen_container').classList.remove('hidden');
    document.getElementById('apparaat_kiezen_container').style.display = 'block';
    document.body.classList.add('blur');
  });
  document.getElementById('sluit_popup').addEventListener('click', function() {
    document.getElementById('apparaat_kiezen_container').classList.add('hidden');
    document.body.classList.remove('blur');
  });
</script>
</body>
</html>
