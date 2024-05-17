<?php 
session_start();

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
