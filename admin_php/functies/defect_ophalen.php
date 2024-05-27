<?php
include 'database.php';

$query = "SELECT defect_id, DEFECT.beschrijving, DEFECT.datum, bruikbaarheid, DEFECT.exemplaar_item_id, ITEM.naam, ITEM.item_id
          FROM DEFECT
          JOIN EXEMPLAAR_ITEM ON DEFECT.exemplaar_item_id = EXEMPLAAR_ITEM.exemplaar_item_id
          JOIN ITEM ON EXEMPLAAR_ITEM.item_id = ITEM.item_id
          ORDER BY defect_id";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo '<div class="defect_container">
        <div class="defect_visueel_img">
            <img
              src="images/webp/eos-m50-bk-ef-m15-45-stm-frt-2_b6ff8463fb194bfd9631178f76e73f9a.webp"
              alt=""
            />
          </div>
      <div class="defect_informatie">';
      echo'<h3>Naam: <span>' .$row['naam']. '</span></h3>';
      echo '<h3>Apparaat-ID: <span>' .$row['item_id']. '</span></h3>';
      echo '<h3>Exemplaar-ID: <span>' .$row['exemplaar_item_id']. '</span></h3>';
      echo '<h3>Defect: <span>' .$row['beschrijving']. '</span></h3>';
      echo '</div>
        <!-- images  -->
        <div class="defect_visueel">
          <!-- verwijderen wijzigen  -->
          <div class="defect_acties">
            <div class="defect_hersteld">
              <a href="#">
                Hersteld
                <img src="images/svg/screwdriver-wrench-solid.svg" alt="xmark" />
              </a>
            </div>
            <div class="defect_verwijder">
              <a href="">
                Verwijder
                <img
                  src="images/svg/circle-xmark-solid.svg"
                  alt=""
                />
              </a>
            </div>
          </div>
      </div>
    </div>';
    }
}
?>