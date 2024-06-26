<?php
include 'database.php';

if (isset($_GET['zoekButton'])) {

  // zoeken op id, naam van item, naam van student
    $zoek_query = $_GET['zoekquery'];
    if (!empty($zoek_query)) { // Controleer of de zoekopdracht niet leeg is
        $zoek_query = mysqli_real_escape_string($conn, $zoek_query);
        $zoek_resultaat = "SELECT W.*,I.*
        FROM WAARSCHUWING W
        JOIN UITLENING U on U.uitleen_id=W.uitleen_id
        JOIN EXEMPLAAR_ITEM EI ON U.exemplaar_item_id = EI.exemplaar_item_id
        JOIN ITEM I ON EI.item_id = I.item_id
        WHERE (LOWER(W.email) LIKE LOWER('%$zoek_query%') 
               OR (EXISTS (SELECT 1
                          FROM WAARSCHUWING W2
                          WHERE W2.uitleen_id = U.uitleen_id)
              )
              AND (LOWER(I.naam) LIKE LOWER('%$zoek_query%') 
                   OR LOWER(I.merk) LIKE LOWER('%$zoek_query%')
                   OR EI.exemplaar_item_id LIKE '$zoek_query'
              ))
              AND W.waarschuwingsType = 'Te laat'";
        

        $zoek_uitvoering_resultaat = mysqli_query($conn, $zoek_resultaat);

        if (mysqli_num_rows($zoek_uitvoering_resultaat) > 0) {
          echo "    <tr>
          <th>E-mail</th>
          <th>Apparaat</th>
          <th>Dagen te laat</th>

          </tr>";
          while ($row = mysqli_fetch_assoc($zoek_uitvoering_resultaat)) {
                  $huidigeDatum = new DateTime();
                  $waarschuwingDatum = new DateTime($row['waarschuwingDatum']);
  
                  $verschil = $huidigeDatum->diff($waarschuwingDatum)->days;
                  $verschil += 1;

                  echo "<tr>";
                  echo "<td><a href='mailto:" . $row['email'] . "'>" . $row['email'] . "</a></td>";
                  echo "<td>" . $row['merk'] . " - " . $row['naam'] . "</td>";
                  echo "<td style='color:red;font-weight:bold';>" . $verschil . "</td>";
                  echo "</tr>";
              }
          }else {
                echo "Geen resultaten gevonden";
            }
      mysqli_close($conn);

    }else{
      //indien de admin op de loop drukt, worden alle resultaten opgehaald
      include 'functies/teLaat_ophalen.php';

    }



}


?>
