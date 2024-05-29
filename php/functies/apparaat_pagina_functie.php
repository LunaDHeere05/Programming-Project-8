<?php
include 'database.php';

if(isset($_GET['apparaat_id'])){
    $item_id = $_GET['apparaat_id'];
    $item_query = "SELECT * FROM ITEM WHERE item_id = $item_id";
    $item_result = mysqli_query($conn, $item_query);

      if($item_result && mysqli_num_rows($item_result) > 0){
        $item_row = mysqli_fetch_assoc($item_result);

        echo '<div class="download_handleiding">';
        echo "<img id='imageSrc' src='" . $item_row['images'] . "' >";
        echo "<li><a href='" . $item_row['gebruiksaanwijzing'] . "' target='_blank'>Bekijk de gebruikershandleiding</a></li>";
        echo '</div>';
    
        echo '<div class="apparaat_beschrijving">';

        echo '<h1 id="naamEnMerk">'.$item_row['merk']. ' - ' .$item_row['naam'].'</h1>';
        echo '<p class="beschrijving">' . $item_row['beschrijving'] . '</p>';

        //functionaliteiten
        $functionaliteit_query="SELECT functionaliteit FROM `FUNCTIONALITEIT` WHERE FUNCTIONALITEIT.item_id=$item_id";
        $functionaliteit_result=mysqli_query($conn, $functionaliteit_query);
        
        if(mysqli_num_rows($functionaliteit_result) > 0){
            echo "<h2>Functionaliteiten</h2> ";
            while($functionaliteit_row = mysqli_fetch_assoc($functionaliteit_result)){
                echo "<li>".$functionaliteit_row['functionaliteit']."</li>";
            }
         
        }

        //in doos
        $inDoos_query="SELECT accessoire FROM `ITEMBUNDEL` WHERE ITEMBUNDEL.item_id=$item_id";
        $inDoos_result=mysqli_query($conn, $inDoos_query);

      
        if(mysqli_num_rows($inDoos_result) > 0){
          
            echo "<h2>In de doos</h2>
            <li>".$item_row['naam']."</li>";
        
            while($inDoos_row = mysqli_fetch_assoc($inDoos_result)){
                echo "<li>".$inDoos_row['accessoire']."</li>";
            }
            
        }

        echo '</div>';


        //defecten
        // $defect_query="SELECT beschrijving FROM `DEFECT` WHERE DEFECT.item_id=$item_id";
        // $defect_result=mysqli_query($conn, $defect_query);

        // if(mysqli_num_rows($item_result) > 0){
        //     echo "<h2 class='defecten'><span>Defecten</span></h2>
        //     <ul>";
        
        //     while($defect_row = mysqli_fetch_assoc($defect_result)){
        //         echo "<li>".$defect_row['functionaliteit']."</li>";
        //     }
        //     echo "</ul>";
        // }
       
      
    }
    else{
        echo 'Geen informatie gevonden voor dit item.';
    }


}else{
    echo "Geen item-id meegegeven in de URL.";
}



?>
