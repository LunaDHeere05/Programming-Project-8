<footer>
        <div class="footer_container">
      <div class="ehb-info">
        <ul>
          <!-- emial linken met echte mail -->
          <li>
            <a href="#"><img src="../images/svg/envelope-solid.svg" alt="envelope"> medialab.ehb@ehb.be</a>
          </li>
          <!-- linken so that it calls directly -->
          <li><a href="#"><img src="../images/svg/phone-solid.svg" alt="phone"> +32 84 42 63 78</a></li>
          <!-- linken so that it can directly go to the webside -->
          <li>
            <a href="#"><img src="../images/svg/desktop-solid.svg" alt="desktop"> www.erasmushogeschool.be</a>
          </li>
          <!-- linken met google maps -->
          <li>
            <a href="#"> <img src="../images/svg/location-dot-solid.svg" alt="location"> Nijverheidskaai 170,1070 Anderlecht</a
            >
          </li>
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
            <td>/</td>
            <td>/</td>
          </tr>
          <tr>
            <th>Woensdag</th>
            <td>/</td>
            <td>/</td>
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
            <td>/</td>
            <td>/</td>
          </tr>
        </table>
      </div>
    </div>
      <div class="einde"><p>&copy;Groep 8 - Programming Project</p></div>
    </footer>

<style>
footer{
    display: block; 
    background-color: #303030;
    color: white;
    margin-top: 4em;
}
.ehb-info li a{
    text-decoration: none;
    color: white;
} 

.ehb-info ul{
    padding: 1em;
}
.ehb-info li{
    list-style: none;
    padding: 0.5em;
    
}

.ehb-info a img{
    width: 1.2em;
    height: auto;
    padding: 0em 1em 0em 0em;
    filter: invert(100%) sepia(0%) saturate(2%) hue-rotate(8deg) brightness(109%) contrast(101%);
}

.footer_container{
    display: flex;
    justify-content: space-between;
    padding: 0.5em;
}
.opening-hours{
    padding: 0em 1em 0em 0em;
    margin: 0;
}
.opening-hours table {
    border-collapse: collapse;
}

.opening-hours h1{
    padding: 0em 0em 0.5em 0em ;
    color: white;
}
.opening-hours table,th, td {
    border: 0.05em solid white;
}

.opening-hours th,td{
    padding: 0.5em;
}

.einde {
    background-color: red;
    text-align: center;
    padding: 0.5em;
    font-size: large;
}
</style>