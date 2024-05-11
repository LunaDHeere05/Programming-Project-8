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
        </style>
</head>
<body>
        <div class="rechter_grid">

            <div class="blacklist_tabel">
                <table>
                    <tr>
                        <th>E-mail</th>
                        <th>Rede</th>
                        <th>Dagen op blacklist</th>
                        <th>Meer info</th>
                        <th>Verwijder</th>
                    </tr>
                    <tr>
                        <td><E-Mail>luna.dheere@student.ehb.be</E-Mail></td>
                        <td>2x te laat</td>
                        <td>5</td>
                        <td><a href="#"><img class="meer_info" src="images/svg/circle-info-solid.svg" alt="meer informatie"></a></td>
                        <td><a href="#"><img class="verwijder" src="images/svg/circle-xmark-solid.svg" alt="verwijder van blacklist"></a></td>
                    </tr>
                </table>
            </div>
    
</body>
</html>