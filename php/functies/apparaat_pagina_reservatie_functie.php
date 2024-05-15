<?php

include '../database.php';

if(isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // TODO: Insert the start_date and end_date into the database

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO UITLENING (uitleen_datum, inlever_datum) VALUES ($start_date, $end_date)");
    $stmt->bind_param("ss", $start_date, $end_date);

    // Execute the statement
    $stmt->execute();

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}

/*<ul class="reservatie_plaatsen">
            <li class="datum">
                <label for="start_date">Start datum:</label>
                <input type="date" id="start_date" name="start_date">
            </li>
            <li class="datum">
                <label for="end_date">Eind datum:</label>
                <input type="date" id="end_date" name="end_date">
            </li>
            <li class="aantal">
                <label for="aantal">Aantal:</label>
                <input type="number" id="aantal_apparaten" name="aantal_apparaten" placeholder="0">
            </li>
            <li class="reserveer_nu_btn">
              <a href="functies/apparaat_pagina_reservatie_functie.php"><button>reserveer nu</button></a>
            </li>
            <li class="winkelmand_toevoegen_btn">
                <button>Voeg toe</button>
                <img src="images/svg/cart-shopping-solid.svg" alt="winkelmandje">
            </li>
        </ul>