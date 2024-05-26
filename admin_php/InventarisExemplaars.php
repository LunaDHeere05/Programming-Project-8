<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
.inventaris_tabel .column1 {
  width: 20%;
}

.inventaris_tabel .column2 {
  width: 30%;
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
                    <th>Exemplaar-ID</th>
                    <th>Uitgeleend</th>
                    <th>Zichtbaarheid</th>
                    <th>Defect</th>
                    <th>Verwijderen</th>
                </tr>
                <?php include 'functies\Inventaris_exemplaaren.php'?>
            </table>
        </div>
        <div class="apparaat_toevoegen">
            <div class="apparaat_toevoegen">
                <h3><a href="ExemplaarToevoegen.php?item_id=<?php echo $item_id; ?>" onclick="showExemplaarID();">Exemplaar toevoegen</a></h3>
                
            </div></div>
        </div>
        <script>
            
        </script>
    </div>

    <script>
        
        window.onload = function() {
            var isUitgeleendElements = document.querySelectorAll(".isUitgeleend");
            isUitgeleendElements.forEach(function(element) {
                if(element.innerHTML == "1"){
                    element.innerHTML = "Ja";
                } else {
                    element.innerHTML = "Nee";
                }
            });

            var zichtbaarheidElements = document.querySelectorAll(".zichtbaarheid");
            zichtbaarheidElements.forEach(function(element) {
                if(element.innerHTML == "1"){
                    element.innerHTML = "Ja";
                } else {
                    element.innerHTML = "Nee";
                }
            });
        }
    </script>   
</body>
</html>