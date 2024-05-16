<?php 
session_start();

if (isset($_SESSION['gebruikersnaam'])) //controleren of er een foutmelding is;
  {
    $gebruikersnaam=$_SESSION['gebruikersnaam'];
  }

  if (isset($_SESSION['user'])) //controleren of er een foutmelding is;
  {
    $user=strtoupper($_SESSION['user']); 
    if($user=="DOCENT"){
        $email="emailDOCENT";
    }else if($user=="STUDENT"){
        $email="emailSTUDENT";
    }

    $_SESSION['email']=$email;

    
    //omzetten naar hoofdletter (want tabellen in databank zijn uppercase)
  }

?>
