<?php 
session_start();

//dit is de email van de ingelogde user, alsook of het een docent of student is. 

if (isset($_SESSION['gebruikersnaam'])) //controleren of er een foutmelding is;
  {
    $email=$_SESSION['gebruikersnaam'];
  }

  if (isset($_SESSION['user'])) //controleren of er een foutmelding is;
  {
    $user=strtoupper($_SESSION['user']); 
    if($user=="DOCENT"){
        $userType="emailDOCENT";
    }else if($user=="STUDENT"){
        $userType="emailSTUDENT";
    }

    $_SESSION['userType']=$userType;
  }

  

?>
