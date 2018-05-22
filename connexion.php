<?php
  session_start();
  $bdd = new PDO('mysql:host=localhost;dbname=ppe;charset=utf8', 'root', '');
  if(isset($_POST['connexion']))
  {
    $login = htmlspecialchars(trim($_POST['login']));
    $mdp = htmlspecialchars(trim($_POST['mdp']));
    if($login&&$mdp)
    {
      $requser = $bdd->prepare("SELECT * FROM user WHERE nom = ? AND password = ? ");
      $requser -> execute(array($login, $mdp));
      $userexist = $requser -> rowCount();
      $userinfo = $requser -> fetch();
      if($login == 'assistant' AND $userexist == 1)
      {
        $_SESSION['login']=$userinfo['login'];
        header("Location: assistant.php");
      }
      elseif($login == 'tec' AND $userexist ==1)
      {
        $_SESSION['login']=$userinfo['login'];
        header("Location: agent.php");
      }
      else {
        echo 'Vous allez être redirigé dans 5 secondes';
        sleep(5);
        header('Location: index.php');
      }
    }
  }
?>
