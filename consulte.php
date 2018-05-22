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
          <a class="navbar-brand" href="#"><?php echo $_SESSION['nom']; ?></a>
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
                $Matricule = $donnees['MatriculeT'];
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
        	$reponse = $bdd->query("SELECT * FROM intervention, client WHERE intervention.MatriculeT=$mat AND intervention.Numero_Client=client.Numero_Client ORDER BY Distance_KM");
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
        <tbody>
          <?php
            //On affiche les lignes du tableau une à une à l'aide d'une boucle
            while ($donnees = $reponse->fetch())
            {
          ?>
          <tr class="success">
            <td><?php echo $donnees['Numero_Intervention'];?></td>
            <td><?php echo $donnees['Date_Visite'];?></td>
            <td><?php echo $donnees['Heure_Visite'];?></td>
            <td><?php echo $donnees['MatriculeT'];?></td>
            <td><?php echo $donnees['Numero_Client'];?></td>
            <td><?php echo $donnees['Distance_KM'];?></td>
          </tr>
        </tbody>
        <?php
          } //fin de la boucle, le tableau contient toute la BDD
          $reponse->closeCursor(); // Termine le traitement de la requête
        ?>
      </table>
    </div>
  </body>
  <script src="/www/bootstrap/js/jquery.js"></script>
  <script src="/www/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="/www/js/bootstrap.min.js"></script>
</html>
