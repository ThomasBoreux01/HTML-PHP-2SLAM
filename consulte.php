<?php
  session_start();
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
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link href="/www/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <title>Accueil</title>
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
          <li class="active"><a href="agent.php">Accueil</a></li>
          <li><a href="visiter1.php">Validation d'une intervention</a></li>
          <li><a href="consulte.php">Consultation</a></li>
		      <li><a href="deconnexion.php">Déconnexion</a></li>
        </ul>
      </div>
    </nav>
    <div class="container-fluid">
      <div class="formulaire">
  			<form method='POST'>
          Choisir le matricule à consulter :
  				<select id="technicien" name="technicien">
  					<?php
              $reponse = $bdd->query('SELECT * FROM technicien');
              while ($donnees = $reponse->fetch()){
                $Matricule = $donnees['Matricule'];
                echo "<OPTION VALUE='$Matricule'> $Matricule </OPTION>\n";
              }
              $reponse->closeCursor();
            ?>
          </select>
          <br/>
  				<button type="submit" class="btn btn-primary btn-block btn-large" name="consulter">Consulter</button>
  			</form>
  		</div>
      <?php
      	if(isset($_POST['consulter'])){
        	$mat = $_POST["technicien"];
        	$sql = $bdd->query("SELECT * FROM intervention, client WHERE intervention.Matricule=$mat AND intervention.NumClient=client.NumClient ORDER BY DistanceKM");
      	}
    	?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Numéro d'intervention</th>
            <th>Date de visite</th>
            <th>Heure de visite</th>
            <th>Matricule</th>
            <th>Numéro du client</th>
            <th>Distance en KM</th>
          </tr>
        </thead>
        <?php
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
  <script src="/www/bootstrap/js/jquery.js"></script>
  <script src="/www/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="/www/js/bootstrap.min.js"></script>
</html>
