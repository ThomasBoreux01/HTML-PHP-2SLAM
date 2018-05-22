<?php
	session_start();
	try
	{
		// On se connecte à MySQL
		$bdd = new PDO('mysql:host=localhost;dbname=ppe;charset=utf8','root','');
	}
	catch(Exception $e)
	{
		// En cas d'erreur, on affiche un message et on arrête tout
  	die('Erreur : '.$e->getMessage());
	}
?>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style.css"/>
    <link href="/www/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <title>Affectation des visites</title>
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
          <li><a href="rechercheinter1.php">Recherche d'une intervention</a></li>
          <li><a href="affecter.php">Affectation des visites</a></li>
          <li><a href="stats1.php">Statistiques des techniciens</a></li>
					<li><a href="creapdf.php">Création d'un PDF</a></li>
          <li><a href="deconnexion.php">Déconnexion</a></li>
        </ul>
      </div>
    </nav>
		<div class="formulaire">
			<form method='POST'>
        Choisir le technicien a affecté :
				<select id="technicien" name="technicien">
					<?php
            $reponse = $bdd->query('SELECT technicien.MatriculeT As MatriculeT FROM technicien, client, intervention WHERE technicien.Numero_Agence=client.Numero_Agence AND client.Numero_Client=intervention.Numero_Client');
            while ($donnees = $reponse->fetch()){
              $Matricule = $donnees['MatriculeT'];
              echo "<OPTION VALUE='$Matricule'> $Matricule </OPTION>\n";
            }
            $reponse->closeCursor();
            ?>
          </select>
          <br/>
          Choisir l'intervention :
          <select id="intervention" name="intervention">
          <?php
            $reponse = $bdd->query('SELECT * FROM intervention');
            while ($donnees = $reponse->fetch()){
              $valeur = $donnees['Numero_Intervention'];
              echo "<OPTION VALUE='$valeur'> $valeur </OPTION>\n";
            }
            $reponse->closeCursor();
            ?>
        </select>
        <br/>
				<button type="submit" class="btn btn-primary btn-block btn-large" name="affecter">Affecter</button>
			</form>
		</div>
  </body>
  <?php
  	if(isset($_POST['affecter'])){
    	$mat = $_POST["technicien"];
    	$int = $_POST["intervention"];
    	$sql = $bdd->query("UPDATE intervention SET MatriculeT=$mat WHERE Numero_Intervention=$int");
    	$message='Affectation réussi';
    	echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
			$sql->closeCursor();
  	}
	?>
  <script src="/www/bootstrap/js/jquery.js"></script>
  <script src="/www/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="/www/js/bootstrap.min.js"></script>
</html>
