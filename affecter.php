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
  if(isset($_POST['affecter']))
  {
    $technicien = htmlspecialchars(trim($_POST['technicien']));
    if($technicien)
    {
      $requser = $bdd->prepare("INSERT INTO intervention(Matricule) VALUES(:Matricule)");
      $requser->execute(array($technicien));
      echo "Intervention affectée";
    }
  }
  else
  {
    echo "Intervention échouée";
  }
?>
