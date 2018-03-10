<?php
  session_start();
  try
  {
  	$bdd = new PDO('mysql:host=localhost;dbname=ppe;charset=utf8','root','');
  }
  catch (Exception $e)
  {
  	die('Erreur : ' . $e->getMessage());
  }
?>
<html>
  <head>
    <!-- En-tête de la page -->
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link href="/www/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <title>Recherche</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#"><?php echo $_SESSION['login']; ?></a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="assistant.php">Accueil</a></li>
          <li><a href="rechercheclient.php">Recherche d'un client</a></li>
          <li><a href="#">Page 2</a></li>
          <li><a href="#">Page 3</a></li>
        </ul>
      </div>
    </nav>
    <div class="container-fluid">
      <?php
        $numclient=$_POST['numclient'];
        $requser = $bdd->query("SELECT * FROM client where NumClient=$numclient");
      ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>NumClient</th>
            <th>RaisonSociale</th>
            <th>SIREN</th>
            <th>CodeAPE</th>
            <th>Adresse</th>
            <th>TelephoneClient</th>
            <th>FaxClient</th>
            <th>Email</th>
            <th>DureeDeplacement</th>
            <th>DistanceKM</th>
          </tr>
        </thead>
        <?php
          //On affiche les lignes du tableau une à une à l'aide d'une boucle
          while ($donnees = $requser->fetch())
          {
        ?>
        <tbody>
          <tr class="success">
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
        </tbody>
      </table>
      <?php
        } //fin de la boucle, le tableau contient toute la BDD
        $requser->closeCursor(); // Termine le traitement de la requête
      ?>
    </div>
  </body>
</html>
