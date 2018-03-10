<?php
  session_start();
  try
  {
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=ppe;charset=utf8', 'root', '');
  }
  catch(Exception $e)
  {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
  }
  if(isset($_POST['visiter']))
  {
    $comment = htmlspecialchars(trim($_POST['comment']));
    $time = htmlspecialchars(trim($_POST['time']));
    if($comment&&$time)
    {
      $requser = $bdd->prepare("INSERT INTO controler(commentaire, tempspasse) VALUES(:commentaire, tempspasse)");
      $requser->execute(array($comment, $time));
      echo "Visite validée";
    }
  }
  else
  {

  }
?>
