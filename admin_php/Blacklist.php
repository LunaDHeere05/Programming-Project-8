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
  </style>
</head>

<body>
  <div class="rechter_grid">
    <div class="overlay" id="meerInfoPopup">
      <div class="popupContent">
        <span class="closePopup" id="closeMeerInfo">&times;</span>
        <div id="meerInfoData"></div>
      </div>
    </div>
    <div class="overlay" id="verwijderPopup">
      <div class="popupContent">
        <span class="closePopup" id="closeVerwijder">&times;</span>
        <div id="verwijderData"></div>
        <button class="confirmButton" id="confirmVerwijder">Bevestigen</button>
      </div>
    </div>

    <!-- blacklist tabel -->
    <div class="blacklist_tabel">
      <table>
        <tr>
          <th>E-mail</th>
          <th>Reden</th>
          <th>Dagen op blacklist</th>
          <th>Meer info</th>
          <th>Verwijder</th>
        </tr>
        <?php include 'functies\blacklist_ophalen.php' ?>
      </table>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const meerInfoLinks = document.querySelectorAll(".meer_info_link");
      const verwijderLinks = document.querySelectorAll(".verwijder_link");

      const meerInfoPopup = document.getElementById("meerInfoPopup");
      const verwijderPopup = document.getElementById("verwijderPopup");

      const closeMeerInfo = document.getElementById("closeMeerInfo");
      const closeVerwijder = document.getElementById("closeVerwijder");

      const meerInfoData = document.getElementById("meerInfoData");
      const verwijderData = document.getElementById("verwijderData");

      const confirmVerwijder = document.getElementById("confirmVerwijder");

      meerInfoLinks.forEach(function (link) {
        link.addEventListener("click", function (event) {
          event.preventDefault(); // Voorkom de standaardactie van het volgen van de link

          // Haal gegevens op en toon de popupinhoud
          const email = link.closest("tr").querySelector("td:first-child").textContent;
          const meerInfoContentHTML = `<p><strong>Email</strong>: ${email}</p>`;
          meerInfoData.innerHTML = meerInfoContentHTML;

          // Toon de popup overlay
          meerInfoPopup.style.display = "block";
        });
      });

      verwijderLinks.forEach(function (link) {
        link.addEventListener("click", function (event) {
          event.preventDefault(); // Voorkom de standaardactie van het volgen van de link

          // Haal gegevens op en toon de popupinhoud
          const email = link.closest("tr").querySelector("td:first-child").textContent;
          const verwijderContentHTML = `<p><strong>Email</strong>: ${email}</p>
            <p>Klik op <strong>Bevestigen</strong> om de persoon uit de Blacklist te verwijderen</p><br>`;
          verwijderData.innerHTML = verwijderContentHTML;

          // Toon de popup overlay
          verwijderPopup.style.display = "block";
        });
      });

      // Sluit de popup wanneer de sluitknop wordt geklikt
      closeMeerInfo.addEventListener("click", function () {
        meerInfoPopup.style.display = "none";
      });
      closeVerwijder.addEventListener("click", function () {
        verwijderPopup.style.display = "none";
      });

      // Sluit de popup wanneer er buiten de popupinhoud wordt geklikt
      window.addEventListener("click", function (event) {
        if (event.target === meerInfoPopup) {
          meerInfoPopup.style.display = "none";
        }
        if (event.target === verwijderPopup) {
          verwijderPopup.style.display = "none";
        }
      });

      // Verwerk het klikken op de bevestigingsknop
      confirmVerwijder.addEventListener("click", function () {
        // Voeg hier je logica toe voor wat er moet gebeuren wanneer de bevestigingsknop wordt geklikt
        // Bijvoorbeeld, je kunt een formulier verzenden, een AJAX-verzoek maken, etc.
        console.log("Bevestigingsknop geklikt");
        // Sluit de popup
        verwijderPopup.style.display = "none";
      });
    });
  </script>
</body>

</html>
