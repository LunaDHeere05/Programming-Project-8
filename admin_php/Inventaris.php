<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Programming-Project-8/admin_php/database.php';
?>

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
  padding-top: 0.5em;
}
.apparaat_toevoegen{
  background-color: #1BBCB6;
  text-align: center;
  width: 23%;
  border-radius: 2em;
  margin-left: 4em;
  margin-top: 2em;
  position: absolute;
  position: sticky;
  bottom: 2em;
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.50);

}
.apparaat_toevoegen a{
  text-decoration: none;
  color: white;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
      $('#zoekbalk').on('input', function() {
        var zoekbalkValue = $(this).val();
        console.log('zoekbalkValue:', zoekbalkValue); // Add this line
        $.post('functies/Inventaris_apparaten.php', {zoekbalkValue: zoekbalkValue}, function(data) {
            $('#tableContainer tbody').html(data);
        });
    });
  });
</script>
</head>
<body>
    <div class="rechter_grid">
        <div class="inventaris_tabel">
            <table id="tableContainer">    
              <thead>
                <tr>
                  <th>Apparaat</th>
                  <th>Categorie</th>
                  <th>Apparaat-ID</th>
                  <th>Wijzigen</th>
                  <th>Exemplaren</th>
                </tr>
              </thead>
              <tbody>
                <?php include 'functies\Inventaris_apparaten.php'?>
              </tbody>
              
                
            </table>
        </div>
        <div class="apparaat_toevoegen">
            <h3><a href="InventarisToevoegen.php">Apparaat toevoegen</a></h3>
        </div>
    
</body>
<script>
  
</script>
</html>