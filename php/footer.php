<footer>
        <div class="footer_container">
      <div class="ehb-info">
        <ul>
          <?php
          echo '<li><a href="mailto: medialab.ehb@ehb.be"><img src="images/svg/envelope-solid.svg" alt="envelope">medialab.ehb@ehb.be</a></li>';
          echo '<li><a href="#"><img src="images/svg/phone-solid.svg" alt="phone"> +32 84 42 63 78</a></li>';
          echo '<li><a href="https://www.erasmushogeschool.be/nl"><img src="images/svg/desktop-solid.svg" alt="desktop"> www.erasmushogeschool.be</a></li>';
          echo '<li><a href="#"> <img src="images/svg/location-dot-solid.svg" alt="location"> Nijverheidskaai 170, 1070 Anderlecht</a></li>';
          ?>
        </ul>
      </div>
      <div>
        <h1>Openingsuren</h1>
        <?php
          include 'database.php';

          $query = "SELECT * FROM OPENINGSTIJDEN ORDER BY FIELD(dagen, 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag', 'zondag')";
          $result = mysqli_query($conn, $query);

          if(mysqli_num_rows($result) > 0){
            echo '<table>';
            while($row = mysqli_fetch_assoc($result)){
            echo '<tr>';
            echo '<th>' . $row['dagen'] . '</th>';
            
            echo '<td>' . $row['begin_uren'] . '</td>';
            echo '<td>' . $row['eind_uren'] . '</td>';

            echo '</tr>';
            }
            echo '</table>';
            }

$conn->close();
?>
      </div>
    </div>
      <div class="einde"><p>&copy;Groep 8 - Programming Project</p></div>
    </footer>

<style>
footer{ 
 background-color: #303030;
 color: white;
 margin-top:1em;
}

footer h1{
  text-align: center;
  letter-spacing:3px;
}

footer a{
text-decoration: none;
color: white;
} 

footer ul{
 padding: 1em;
}

footer li{
 list-style: none;
 padding: 0.5em;
 display: flex;
 justify-content: start;
}

footer .ehb-info a img{
 width: 1.5em;
 height: auto;
padding-right:0.5em;
 filter: invert(100%) sepia(0%) saturate(2%) hue-rotate(8deg) brightness(109%) contrast(101%);
}

footer .footer_container{
 display: flex;
 justify-content: space-around;
 align-items: center;
 padding:1em 0
}

footer table {
 border-collapse: collapse;
 padding:1em;
 color:white;
}

footer th,td{
padding: 0.5em;
border-bottom:0.1em solid white
}

footer th{
    text-align: left;
}
footer td{
    text-align: center;
}

footer table tr:last-child th, table tr:last-child td{
    border-bottom: none;
  }

footer .einde {
 background-color: red;
 text-align: center;
 padding: 1em;
 font-size: large;
}
</style>

