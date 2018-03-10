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
<html>
  <head>
    <!-- En-tête de la page -->
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style.css" />
    <link href="/www/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <title>PPE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
  </head>
  <body>
    <form action='rechercheclient.php' method="post">
      <p> Numero client: <input type="text" name="numclient" /></p>
    </form>
    <?php
      $numclient=$_POST['numclient']
      $requser = $bdd->query("SELECT * FROM client where NumClient=$numclient");
    ?>
    <table>
      <tr>
        <td>NumClient</td>
        <td>RaisonSociale</td>
        <td>SIREN</td>
        <td>CodeAPE</td>
        <td>Adresse</td>
        <td>TelephoneClient</td>
        <td>FaxClient</td>
        <td>Email</td>
        <td>DureeDeplacement</td>
        <td>DistanceKM</td>
      </tr>
    </table>
    <?php
      //On affiche les lignes du tableau une à une à l'aide d'une boucle
      while ($donnees = $requser->fetch())
      {
    ?>
    <table>
      <tr>
        <td><?php echo $donnees['NumClient'];?></td>
        <td><?php echo $donnees['RaisonSociale'];?></td>
        <td><?php echo $donnees['SIREN'];?></td>
        <td><?php echo $donnees['CodeAPE'];?></td>
        <td><?php echo $donnees['Adresse'];?></td>
        <td><?php echo $donnees['TelephoneClient'];?></td>
        <td><?php echo $donnees['FaxClient'];?></td>
        <td><?php echo $donnees['Email'];?></td>
        <td><?php echo $donnees['DureeDeplacement'];?></td>
        <td><?php echo $donnees['DistanceKM'];?></td>
      </tr>
    </table>
    <?php
      } //fin de la boucle, le tableau contient toute la BDD
      $reponse->closeCursor(); // Termine le traitement de la requête
    ?>
  </body>
</html>
