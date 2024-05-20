<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uitleningen</title>
    <?php include 'top_nav_admin.php'?>
    <style>
.uitlening_toevoegen{
  background-color: #1BBCB6;
  text-align: center;
  width: 23%;
  border-radius: 2em;
  margin-left: 4em;
  margin-top: 2em;
}
.uitlening_toevoegen a{
  text-decoration: none;
  color: white;
}
.uitlening_tabel{
  width: 90%;
  text-align: center;
  margin: auto;
  margin-top: 2em;
}
.uitlening_tabel table{
  border-collapse: collapse;
  margin: auto;
  width: 100%;
}
.uitlening_tabel th, td{
  width: 30%;
  border-collapse: collapse;
  border-bottom: 2px solid rgb(193,193,193);
  border-left: 2px solid rgb(193,193,193);
}
.uitlening_tabel tr:last-child td{
  border-bottom: none;
}
.uitlening_tabel th:first-child, td:first-child{
  border-left: none;
}
.uitlening_tabel .meer_info{
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
        </style>
</head>
<body>
    <div class="rechter_grid">
        </div>
            <div class="uitlening_tabel">
                <table>
                    <tr>
                        <th>E-mail</th>
                        <th>Apparaat</th>
                        <th>Inleverdatum</th>
                        <th>Meer info</th>
                        <th>Verwijder</th>
                    </tr>
                    <tr>
                        <td><E-Mail>luna.dheere@student.ehb.be</E-Mail></td>
                        <td>Canon-M50</td>
                        <td>02/06</td>
                        <td><a href="#"><img class="meer_info" src="images/svg/circle-info-solid.svg" alt="meer informatie"></a></td>
                        <td><a href="#"><img class="verwijder" src="images/svg/circle-xmark-solid.svg" alt="verwijder van blacklist"></a></td>
                    </tr>
                    <?php include 'functies\uitleningen_ophalen.php'?>
                </table>
            </div>

            <!-- misschien moet btn voor uitlening toevoegen sticky worden wnt anders moet je steeds naar onder scrollen om een uitlening toe te voegen -->
            <div class="uitlening_toevoegen">
                <h3><a href="/html/Admin/UitleningToevoegen.html">Uitlening toevoegen</a></h3> 
            </div>
</body>
</html>