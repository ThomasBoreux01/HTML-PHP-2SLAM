<?php
  // Page d'index du site.
  session_start ();
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
          <li><a href="assistant.php">Accueil</a></li>
          <li><a href="rechercheclient1.php">Recherche d'un client</a></li>
          <li class="active"><a href="rechercheinter1.php">Recherche d'une intervention</a></li>
          <li><a href="affecter1.php">Affectation des visites</a></li>
          <li><a href="stats1.php">Statistiques des techniciens</a></li>
          <li><a href="creapdf.php">Création d'un PDF</a></li>
          <li><a href="deconnexion.php">Déconnexion</a></li>
        </ul>
      </div>
    </nav>
    <div class="container-fluid">
      <?php
        $datevisite=$_POST['dateinter'];
        if ($datevisite)
        {
          $requser = $bdd->query("SELECT * FROM intervention WHERE DateVisite=$datevisite");
        }
      ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Numéro de l'intervention</th>
            <th>Date de visite</th>
            <th>Heure de visite</th>
            <th>Matricule</th>
            <th>Numéro de client</th>
          </tr>
        </thead>
        <?php
        $numclient = $donnees['NumClient'];
          //On affiche les lignes du tableau une à une à l'aide d'une boucle
          while ($donnees = $requser->fetch())
          {
        ?>
        <tbody>
          <tr class="success">
            <td><?php echo $donnees['NumIntervention'];?></td>
            <td><?php echo $donnees['DateVisite'];?></td>
            <td><?php echo $donnees['HeureVisite'];?></td>
            <td><?php echo $donnees['Matricule'];?></td>
            <td><?php echo $donnees['NumClient'];?></td>
          </tr>
        </tbody>
      </table>
      <?php
        } //fin de la boucle, le tableau contient toute la BDD
        $requser->closeCursor(); // Termine le traitement de la requête
      ?>
    </div>
    <div class="formulaire">
			<form method='POST'>
        <p> Date de visite: <input required="required" type="date" name="date"></p>
        <p> Heure de visite: <input required="required" type="time" name="heure"></p>
        <p> Matricule: <input required="required" type="text" name="matricule"></p>
        <p> Numéro du client: <input required="required" type="text" name="numClient"></p>
        </br>
				<button type="submit" class="btn btn-primary btn-block btn-large" name="modifier">Modifier</button>
			</form>
		</div>
  </body>
  <?php
    if(isset($_POST['modifier'])){
      $date = $_POST["date"];
      $heure = $_POST["heure"];
      $matricule = $_POST["matricule"];
      $num = $_POST["numClient"];
      $sql = $bdd->query("UPDATE intervention SET DateVisite=$date, HeureVisite=$heure, Matricule=$matricule, NumClient=$num WHERE NumIntervention=$numclient");
      $message='Modification réussi';
      echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
      $sql->closeCursor(); // Termine le traitement de la requête
    }
	?>
  <script src="/www/bootstrap/js/jquery.js"></script>
  <script src="/www/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="/www/js/bootstrap.min.js"></script>
</html>
