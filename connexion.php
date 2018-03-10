<?php
  session_start();
  $bdd = new PDO('mysql:host=localhost;dbname=ppe;charset=utf8', 'root', '');
  if(isset($_POST['connexion']))
  {
    $login = htmlspecialchars(trim($_POST['login']));
    $mdp = htmlspecialchars(trim($_POST['mdp']));
    if($login&&$mdp)
    {
      $requser = $bdd->prepare("SELECT * FROM connexion WHERE login = ? AND mdp = ? ");
      $requser -> execute(array($login, $mdp));
      $userexist = $requser -> rowCount();
      $userinfo = $requser -> fetch();
      if($login == 'assistant' AND $userexist ==1)
      {
        $_SESSION['login']=$userinfo['login'];
        header("Location: rechercheclient.php");
      }
      if($login == 'agent' AND $userexist ==1)
      {
        $_SESSION['login']=$userinfo['login'];
        header("Location: page2.php");
      }
    }
  }
?>
