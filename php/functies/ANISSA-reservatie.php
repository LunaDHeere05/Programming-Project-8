<?php

// Toon alle fouten en waarschuwingen
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    if (isset($_GET['apparaat_id'])) {
        $apparaat_id = $_GET['apparaat_id'];

        // Pas hier de query aan om het correcte item_id te gebruiken
        $item_query = "SELECT exemplaar_item_id, isUitgeleend, zichtbaarheid FROM EXEMPLAAR_ITEM WHERE item_id = $apparaat_id ORDER BY isUitgeleend ASC";
        $item_result = mysqli_query($conn, $item_query);

        if ($item_result) {
            while ($item_result_row = mysqli_fetch_assoc($item_result)) {
                if ($item_result_row['isUitgeleend'] == 0 && $item_result_row['zichtbaarheid'] == 1) {
                    // Bereid de SQL query voor met correcte datum insluiting
                    $nieuweUitlening = "INSERT INTO `UITLENING` (`uitleen_datum`, `inlever_datum`, `emailStudent`, `emailDocent`) 
                                            VALUES ('$start_date', '$end_date', 'student1@example.com', NULL)";

                    // Voer de query uit en controleer op fouten
                    if (mysqli_query($conn, $nieuweUitlening)) {
                        echo "Record succesvol toegevoegd.";
                        exit;
                    } else {
                        echo "Fout bij het toevoegen van het record: " . mysqli_error($conn);
                    }
                }
            }
        }
    } else {
        echo "Geen apparaat_id gespecificeerd.";
    }
} else {
    echo "Verzoeksmethode is niet POST.";
}

// Sluit de verbinding
mysqli_close($conn);
