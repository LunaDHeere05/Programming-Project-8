<?php 
include 'sessionStart.php' //AN: om te weten welke mail er gebruikt wordt om in te loggen
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/css/stylesheet.css">
    <style>
    /* Your existing styles */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap');


    /*Categorie*/
    .categorie{
            margin: 1em 0em 1em 1em;
        }

    .categorie_lijst {
    gap:0.8em;
    display: flex;
    margin:1em;
    }

    .categorie_lijst a {
    font-weight: bold;
    letter-spacing: 3px;
    width: 20%;
    background-color: #1bbcb6;
    padding: 2em;
    border-radius: 4em;
    text-transform: uppercase;
    text-align: center;
    text-decoration: none;
    color:white;
    }

    .categorie_lijst a:hover {
    background-color: white;
    color: #1bbcb6;
    border: 0.01em solid #1bbcb6;
    }


    /* Recent bekeken */
    .recent_lijst_container {
        display: flex;
        justify-content: space-between;
    }
    .recent_lijst_container img {
        width: 2em;
        margin: 1em;
    }
    .recent_container {
        display: block;
    }
    .recent_container h2 {
        margin: 1em 0em 1em 1em;
    }
    .recent_lijst {
        display: flex;
        margin-top: 1em;
    gap:7em;
        list-style: none;
        margin:0;
        justify-content: space-between;
        align-items: center;
    }
    .recent_lijst a{
        text-decoration: none;
    }
    .recent_lijst a h3{
        text-decoration: none;
        color: black;
    }
    .recent_lijst li {
        padding: 1em;
        background-color: #edededcf;
         width:100%;
        height:100%;
        text-align: center;
        border-radius: 1em;
        cursor:pointer;
    }

    .recent_lijst li:hover{
        background-color: #cfcfcfcf;
    }
    .recent_lijst li img {
        width: 13em;
        height: 10em;
        background-color: white;
        margin-top: 1em;
    }

    /* Hoe leen je iets uit? */
    .uitleen_uitleg h2 {
        padding-left: 1em;
    }
    .uitleen_uitleg ul li h3 {
        color: white;
    }
    .uitleen_uitleg ul li p {
        font-size: 85%;
        padding: 1em;
    }

    .uitleen_uitleg ul {
        list-style: none;
        display: flex;
        margin-top: 1em;
        justify-content: space-between;
        margin: auto;
        width: 80%;
    }
    .uitleen_uitleg h2 {
        margin: 1em 0em;
    }
    .uitleen_uitleg ul li {
        width: 15%;
        height: 8em;
        border-radius: 1em;
        text-align: center;
        background-color: #1bbcb6;
    }
    .uitleen_uitleg ul li a {
        text-decoration: none;
        padding: 1em;
        color: white;
    }
    .meer_info {
        background-color: rgb(193, 193, 193);
        border-radius: 1em;
        width: 10%;
        text-align: center;
        margin: 1.5em 9em 1em auto;
    }
    .meer_info a {
        text-decoration: none;
        color: white;
    }
    </style>
</head>
<body>
    <?php include 'top_nav.php'; ?>
    <div class="inhoud_body">
        <?php include 'functies/categorie.php'; ?>
        
        <?php include 'functies/recent_bekeken.php'; 
        ?>

        <!-- Hoe leen je iets uit? -->
        <div class="uitleen_uitleg">
            <h2>Hoe leen je iets uit?</h2>
            <ul>
                <li><a href="Info.php">
                    <h3>Stap 1</h3>
                    <p>Kies een apparaat</p>
                </a></li>
                <li><a href="Info.php">
                    <h3>Stap 2</h3>
                    <p>Bepaal je uitleenperiode</p>
                </a></li>
                <li><a href="Info.php">
                    <h3>Stap 3</h3>
                    <p>Plaats je reservatie</p>
                </a></li>
                <li><a href="Info.php">
                    <h3>Stap 4</h3>
                    <p>Haal het apparaat op in het medialab</p>
                </a></li>
            </ul>
            <div class="meer_info">
                <a href="Info.php">
                    <h3>Meer info</h3>
                </a>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <?php 
    function checkFile(){
        $currentFile = $_SERVER["PHP_SELF"];
        if($currentFile == "/php/Home.php"){
            return 'user';
        }else{
            return 'admin';
        }
    }
    ?>
    <script>
      document.getElementById('profileBtn').addEventListener('click', function() {
           var currentFile = '<?php echo checkFile(); ?>';
           if(currentFile == 'user'){
               window.location.href = 'admin/Dashboard.php';     
          }else{
              window.location.href = 'Home.php';
          }
      });
    </script>
</body>
</html>
