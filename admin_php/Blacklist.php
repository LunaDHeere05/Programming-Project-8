<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blacklist</title>
    <?php include 'top_nav_admin.php'?>
    <style>
        .blacklist_tabel{
  width: 90%;
  text-align: center;
  margin: auto;
  margin-top: 2em;
}
.blacklist_tabel table{
  border-collapse: collapse;
  margin: auto;
  width: 100%;
}
.blacklist_tabel th, td{
  width: 30%;
  border-collapse: collapse;
  border-bottom: 2px solid rgb(193,193,193);
  border-left: 2px solid rgb(193,193,193);
}
.blacklist_tabel tr:last-child td{
  border-bottom: none;
}
.blacklist_tabel th:first-child, td:first-child{
  border-left: none;
}
.blacklist_tabel .meer_info{
  width: 2em;
  height: auto;
  padding-top: 0.5em;
  filter: invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg);
}
.verwijder{
    filter: invert(13%) sepia(91%) saturate(6506%) hue-rotate(353deg) brightness(88%) contrast(103%);
    width: 2em;
    height: auto;
    padding-top: 0.5em;
  }
#verwijder_popup, #meer_info_popup{
  width: 50%;
  height: auto;
  cursor: pointer;
  background-color: white;
  border-radius: 2em;
  margin: auto;
  position: relative;
  padding: 0.5em 0em;
}
#verwijder_popup #user, #meer_info_popup #user{
  width: 2em;
  height: auto;
  margin-right: 1em;
}
.user{
  display: flex;
  margin: 1em 0em 0em 1em;
}
#verwijder_popup h2{
  text-align: center;
  margin: 3em 0em;
}
#close_window_verwijder, #close_window_meerInfo{
  position: absolute;
  width: 2em;
  height: 2em;
  top: 0.5em;
  right: 1em;
}
.bevestig_btn{
  width: 100%;
  display: flex;
}
.bevestig_btn form{
  margin: auto;
}
.bevestig_btn form input{
  background-color: #1BBCB6;
  color: white;
  font-weight: bold;
  border: none;
  width: 10em;
  height: 3em;
  border-radius: 2em;
}
.extra_info{
  margin: 2em 1em;
}
.contacteer{
  width: 25%;
  margin-left: 30%;
  display: flex;
  justify-content: center;
  text-align: center;
}
.contacteer a{
  display: flex;
  width: 100%;
  height: 2em;
  background-color: #1BBCB6;;
  border-radius: 2em;
  margin: auto;
  text-decoration: none;
  color: white;
  font-weight: bold;
}
.contacteer a p{
  margin: auto;
}
.hidden{
    left: -99999px !important;
    display: none;
}
body.blur > *:not(#verwijder_popup):not(#close_window_verwijder):not(#meer_info_popup):not(#close_window_meerInfo) {
        filter: blur(50px);
        pointer-events: none;
}
        </style>
</head>
<body>
        <div class="rechter_grid">
        <div id="verwijder_popup" class="hidden">
          <div class="user">
            <img id="user" src="images\svg\user-solid.svg" alt="user icoon">
            <div class="user_info">
            <h3>Luna D'Heere</h3>
            <p>Student</p>
            </div>
          </div>
            <h2>Bevestig dat je deze persoon wilt <b>verwijderen</b> uit de blacklist.</h2>
            <div class="bevestig_btn">
              <form>
              <input type="submit" value = "Bevestig">
              </form>
            </div>
            <img id="close_window_verwijder" src="images\svg\xmark-solid.svg" alt="sluit venster">
          </div>

          <!-- meer info -->

          <div id="meer_info_popup" class="hidden">
            <div class="user">
              <img id="user" src="images\svg\user-solid.svg" alt="user icoon">
              <div class="user_info">
                <h3>Luna D'Heere</h3>
                <p>Student</p>
              </div>
              <div class="contacteer">
                  <a href="#">
                    <p>Contacteer</p></a> 
                  <!-- de href hier gaat een mailto: moeten zijn naar de persoon hun emailadres -->
                </div>
            </div>
            <div class="extra_info">
              <h2>Reden: </h2>
              <h2>Dagen Blacklist: </h2>
              <h2>Momenteel uitgeleend? </h2>
              <h2>Dagen tot inleverdatum: </h2>
            </div>
            <img id="close_window_meerInfo" src="images\svg\xmark-solid.svg" alt="sluit venster">
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
                    <?php include 'functies\blacklist_ophalen.php'?>
                </table>
            </div>
<script>
  // document.getElementById('verwijder_popup').addEventListener('click', function(){
  //   document.getElementById('verwijder_popup').classList.remove('hidden');
  //   document.body.classList.add('blur'); //mag enkel werken als er op de verwijder knop wordt geklikt
  //   //momenteel werkt dit dus nog niet
  // })
  document.getElementById('close_window_verwijder').addEventListener('click', function(){
    document.getElementById('verwijder_popup').classList.add('hidden');
    document.body.classList.remove('blur');
  })
  // document.getElementById('meer_info_popup').addEventListener('click', function(){
  //   document.getElementById('meer_info_popup').classList.remove('hidden');
  //   document.body.classList.add('blur'); //mag enkel werken als er op de meer info knop wordt geklikt
  //   //momenteel werkt dit dus nog niet
  // })
  document.getElementById('close_window_meerInfo').addEventListener('click', function(){
    document.getElementById('meer_info_popup').classList.add('hidden');
    document.body.classList.remove('blur');
  })
</script>
</body>
</html>