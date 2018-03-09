<?php
  session_start();
  echo "Bienvenue " .$_SESSION['login']. " vous êtes maintenant connecté";
  try
  {
  	$bdd = new PDO('mysql:host=localhost;dbname=ppe;charset=utf8', 'root', '');
  }
  catch (Exception $e)
  {
  	die('Erreur : ' . $e->getMessage());
  }
?>
