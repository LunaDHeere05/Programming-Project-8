<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris</title>
    <?php include 'top_nav_admin.php'?>
    <style>
.inventaris_tabel{
  width: 90%;
  text-align: center;
  margin: auto;
  margin-top: 2em;
}
.inventaris_tabel table{
  border-collapse: collapse;
  margin: auto;
  width: 100%;
}
.inventaris_tabel th, td{
  width: 30%;
  border-collapse: collapse;
  border-bottom: 2px solid rgb(193,193,193);
  border-left: 2px solid rgb(193,193,193);
}
.inventaris_tabel tr:last-child td{
  border-bottom: none;
}
.inventaris_tabel th:first-child, td:first-child{
  border-left: none;
}
.inventaris_tabel img{
  width: 100%;
  width: 2em;
  height: auto;
  filter: invert(58%) sepia(17%) saturate(6855%) hue-rotate(139deg);
  padding-top: 0.5em;
}
.apparaat_toevoegen{
  background-color: #1BBCB6;
  text-align: center;
  width: 23%;
  border-radius: 2em;
  margin-left: 4em;
  margin-top: 2em;
}
.apparaat_toevoegen a{
  text-decoration: none;
  color: white;
}
        </style>
</head>
<body>
    <div class="rechter_grid">
        <div class="inventaris_tabel">
            <table>
                <tr>
                    <th>Apparaat</th>
                    <th>Categorie</th>
                    <th>Apparaat-ID</th>
                    <th>Verbergen</th>
                    <th>Defect</th>
                    <th>Wijzigen</th>
                </tr>
                <tr>
                    <td>Canon-M50</td>
                    <td>Video & fotografie</td>
                    <td>AAA</td>
                    <td><a href="#"><img src="images/svg/eye-solid.svg" alt=""></a></td>
                    <td><a href="#"><img src="images/svg/screwdriver-wrench-solid.svg" alt=""></a></td>
                    <td><a href="#"><img src="images/svg/pen-to-square-regular.svg" alt="apparaat wijzigen"></a></td>
                </tr>
            </table>
        </div>
        <div class="apparaat_toevoegen">
            <h3><a href="">Apparaat toevoegen</a></h3>
        </div>
    
</body>
</html>