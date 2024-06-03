<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blacklist</title>
  <?php include 'top_nav_admin.php' ?>
  <style>
    .blacklist_tabel {
      width: 90%;
      text-align: center;
      margin: auto;
      margin-top: 2em;
    }

    .blacklist_tabel table {
      border-collapse: collapse;
      margin: auto;
      width: 100%;
    }

    .blacklist_tabel th,
    td {
      width: 30%;
      border-collapse: collapse;
      border-bottom: 2px solid rgb(193, 193, 193);
      border-left: 2px solid rgb(193, 193, 193);
    }

    .blacklist_tabel tr:last-child td {
      border-bottom: none;
    }

    .blacklist_tabel th:first-child,
    td:first-child {
      border-left: none;
    }

    .blacklist_tabel .meer_info {
      width: 2em;
      height: auto;
      padding-top: 0.5em;
      filter: invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg);
    }

    .verwijder {
      filter: invert(13%) sepia(91%) saturate(6506%) hue-rotate(353deg) brightness(88%) contrast(103%);
      width: 2em;
      height: auto;
      padding-top: 0.5em;
    }

    .overlay {
      display: none;
      position: fixed;
      z-index: 9999;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .popupContent {
      background-color: white;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 40%;
      height: auto;
      border-radius: 1rem;
      position: relative;
    }

    .closePopup {
      color: #aaa;
      position: absolute;
      top: 0.5em;
      right: 0.5em;
      font-size: 28px;
      font-weight: bold;
    }

    .closePopup:hover,
    .closePopup:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }

    .confirmButton {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      bottom: 15%;
      background-color: #1BBCB6;
      border-radius: 0.5rem;
      width: 15%;
      color: antiquewhite;
    }

    .confirmButton:hover {
      cursor: pointer;
      color: black;
    }
    .voegToe {
  margin-top: 2em;
  text-align: left;
}

.voegToe button {
  background-color: #1BBCB6;
  color: antiquewhite;
  border-radius: 0.5rem;
  padding: 0.5em;
  margin-left: 0.5em;
}

.voegToe button:hover {
  cursor: pointer;
  color: black;
}
  </style>
</head>

<body>
  <div class="rechter_grid">

    <!-- <div class="zoeken_container">
  </div> -->
  <div class="voegToe">
    <button id="openVoegToePopup">Voeg Persoon Toe</button>
  </div>


  <div class="overlay" id="voegToePopup">
  <div class="popupContent">
    <span class="closePopup" id="closeVoegToe">&times;</span>
    <form id="voegToeForm" method="POST">
      <p>Voer de gegevens in:</p>
      <label for="email">E-mail:</label>
      <input type="email" id="email" name="email" required>
      <br>
      <label for="reden">Reden:</label>
      <input type="text" id="reden" name="reden" required>
      <br>
      <button type="submit" class="confirmButton" id="confirmVoegToe" name="voegToeButton">Toevoegen</button>
      <?php include 'functies/Blacklist_voegtoe.php'; ?>
    </form>
  </div>
</div>



    <div class="overlay" id="verwijderPopup">
      <div class="popupContent">
        <span class="closePopup" id="closeVerwijder">&times;</span>
        <div id="verwijderData"></div>
        <form id="verwijderform" method="POST">
          <input type="hidden" id="studentEmail" name="email">
          <button type="submit" class="confirmButton" id="confirmVerwijder" name="verwijderButton">Bevestigen</button>
        </form>
      </div>
    </div>

    <!-- blacklist tabel -->
    <div class="blacklist_tabel" id="blacklist_tabel">
      <table>
        <?php if (isset($_GET['zoekButton'])) {
          include 'functies/blacklist_zoeken.php';
        } else {
          include 'functies/blacklist_ophalen.php';
        } ?>
      </table>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const verwijderLinks = document.querySelectorAll(".verwijder_link");
      const verwijderPopup = document.getElementById("verwijderPopup");
      const closeVerwijder = document.getElementById("closeVerwijder");
      const verwijderData = document.getElementById("verwijderData");
      const confirmVerwijder = document.getElementById("confirmVerwijder");
      const voegToePopup = document.getElementById("voegToePopup");
      const openVoegToePopup = document.getElementById("openVoegToePopup");
      const closeVoegToe = document.getElementById("closeVoegToe");
      const confirmVoegToe = document.getElementById("confirmVoegToe");

      // popups
      verwijderLinks.forEach(function(link) {
        link.addEventListener("click", function(event) {
          event.preventDefault();


          const email = link.getAttribute("data-email");
          document.getElementById("studentEmail").value = email;

          // const email = link.closest("tr").querySelector("td:first-child").textContent;
          const verwijderContentHTML = `<p><strong>Email</strong>: ${email}</p>
            <p>Klik op <strong>Bevestigen</strong> om de persoon uit de Blacklist te verwijderen</p><br>`;
          verwijderData.innerHTML = verwijderContentHTML;

          // Toon de popup overlay
          verwijderPopup.style.display = "block";
        });
      });

      // Sluit de popup wanneer de sluitknop wordt geklikt
      closeVerwijder.addEventListener("click", function() {
        verwijderPopup.style.display = "none";
      });

      // Sluit de popup wanneer er buiten de popupinhoud wordt geklikt
      window.addEventListener("click", function(event) {
        if (event.target === verwijderPopup) {
          verwijderPopup.style.display = "none";
        }
      });

      // Verwerk het klikken op de bevestigingsknop
      confirmVerwijder.addEventListener("click", function() {

        const email = verwijderData.querySelector("#studentEmail").textContent;
        document.getElementById("studentEmail").value = email;

        console.log("Bevestigingsknop geklikt");
        // Sluit de popup
        verwijderPopup.style.display = "none";

        // Refresh the page
        location.reload();
      });
      // Voeg toe popup
      openVoegToePopup.addEventListener("click", function() {
        voegToePopup.style.display = "block";
      });

      closeVoegToe.addEventListener("click", function() {
        voegToePopup.style.display = "none";
      });

      window.addEventListener("click", function(event) {
        if (event.target === voegToePopup) {
          voegToePopup.style.display = "none";
        }
      });

      confirmVoegToe.addEventListener("click", function() {
        console.log("Toevoegen knop geklikt");
        voegToePopup.style.display = "none";
      });
    });
  </script>

</body>

</html>