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
          <li><a href="assistant.php">Accueil</a></li>
          <li class="active"><a href="rechercheclient1.php">Recherche d'un client</a></li>
          <li><a href="rechercheinter1.php">Recherche d'une intervention</a></li>
          <li><a href="affecter1.php">Affectation des visites</a></li>
          <li><a href="stats1.php">Statistiques des techniciens</a></li>
          <li><a href="creapdf.php">Création d'un PDF</a></li>
          <li><a href="deconnexion.php">Déconnexion</a></li>
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
    <div class="formulaire">
			<form method='POST'>
        <p> Raison Sociale: <input required="required" type="text" name="raison"></p>
        <p> SIREN: <input required="required" type="text" name="siren"></p>
        <p> Code APE: <input required="required" type="text" name="codeape"></p>
        <p> Adresse: <input required="required" type="text" name="adresse"></p>
        <p> Telephone: <input required="required" type="text" name="telephone"></p>
        <p> FAX: <input required="required" type="text" name="fax"></p>
        <p> Email: <input required="required" type="text" name="email"></p>
        <p> Duree Deplacement: <input required="required" type="text" name="duree"></p>
        <p> Distance KM: <input required="required" type="text" name="distancekm"></p>
        <p> Numero contrat: <input required="required" type="text" name="numcontrat"></p>
        <p> Numero agence: <input required="required" type="text" name="numagence"></p>
        <p> Code Region: <input required="required" type="text" name="coderegion"></p>
        </br>
				<button type="submit" class="btn btn-primary btn-block btn-large" name="modifier">Modifier</button>
			</form>
		</div>
  </body>
  <?php
  	if(isset($_POST['modifier'])){
      $raison = $_POST["raison"];
      $siren = $_POST["siren"];
      $codeape = $_POST["codeape"];
      $adresse = $_POST["adresse"];
      $telephone = $_POST["telephone"];
      $fax = $_POST["fax"];
      $email = $_POST["email"];
      $duree = $_POST["duree"];
      $distancekm = $_POST["distancekm"];
      $numcontrat = $_POST["numcontrat"];
      $numagence = $_POST["numagence"];
      $coderegion = $_POST["coderegion"];
    	$sql = $bdd->query("UPDATE client SET RaisonSociale=$raison, SIREN=$siren, CodeAPE=$codeape, Adresse=$adresse, TelephoneClient=$telephone, FaxClient=$fax, Email=$email, DureeDeplacement=$duree, DistanceKM=$distancekm, NumContrat=$numcontrat, NumAgence=$numagence, CodeRegion=$coderegion  WHERE NumClient=$donnees['NumClient']");
    	$message='Modification réussi';
    	echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
  	}
	?>
  <script src="/www/bootstrap/js/jquery.js"></script>
  <script src="/www/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="/www/js/bootstrap.min.js"></script>
</html>
