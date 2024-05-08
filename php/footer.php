<footer>
        <div class="footer_container">
      <div class="ehb-info">
        <ul>
          <?php
          echo '<li><a href="#"><img src="../images/svg/envelope-solid.svg" alt="envelope">medialab.ehb@ehb.be</a></li>';
          echo '<li><a href="#"><img src="../images/svg/phone-solid.svg" alt="phone"> +32 84 42 63 78</a></li>';
          echo '<li><a href="#"><img src="../images/svg/desktop-solid.svg" alt="desktop"> www.erasmushogeschool.be</a></li>';
          echo '<li><a href="#"> <img src="../images/svg/location-dot-solid.svg" alt="location"> Nijverheidskaai 170,1070 Anderlecht</a></li>';
          ?>
        </ul>
      </div>
      <div class="opening-hours">
        <h1>Openingsuren</h1>
        <table>
          <tr>
            <th>Maandag</th>
            <td>10:00 - 12:00</td>
            <td>12:30 - 17:00</td>
          </tr>
          <tr>
            <th>Dinsdag</th>
            <td colspan="2">Gesloten</td>
          </tr>
          <tr>
            <th>Woensdag</th>
            <td colspan="2">Gesloten</td>
          </tr>
          <tr>
            <th>Donderdag</th>
            <td>10:00 - 12:00</td>
            <td>12:30 - 17:00</td>
          </tr>
          <tr>
            <th>Vrijdag</th>
            <td>10:00 - 12:00</td>
            <td>12:30 - 17:00</td>
          </tr>
          <tr>
            <th>Weekend</th>
            <td colspan="2">Gesloten</td>
          </tr>
        </table>
      </div>
    </div>
      <div class="einde"><p>&copy;Groep 8 - Programming Project</p></div>
    </footer>

<style>
  
footer{ 
 background-color: #303030;
 color: white;
}

a{
text-decoration: none;
color: white;
} 

ul{
 padding: 1em;
}

li{
 list-style: none;
 padding: 0.5em;
 display: flex;
 justify-content: start;
}

.ehb-info a img{
 width: 1.5em;
 height: auto;
padding-right:0.5em;
 filter: invert(100%) sepia(0%) saturate(2%) hue-rotate(8deg) brightness(109%) contrast(101%);
}

.footer_container{
 display: flex;
 justify-content: space-around;
 align-items: center;
 padding:1em 0
}

table {
 border-collapse: collapse;
 padding:1em
}

th,td{
padding: 0.5em;
border-bottom:0.1em solid white
}

th{
    text-align: left;
}
td{
    text-align: center;
}

table tr:last-child th, table tr:last-child td{
    border-bottom: none;
  }

.einde {
 background-color: red;
 text-align: center;
 padding: 1em;
 font-size: large;
}
</style>