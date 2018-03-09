<?php
	session_start();
	try
	{
		// On se connecte à MySQL
		$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
	}
	catch(Exception $e)
	{
		// En cas d'erreur, on affiche un message et on arrête tout
  	die('Erreur : '.$e->getMessage());
	}
	echo "Bienvenue " .$_SESSION['login']. " vous êtes maintenant connecté";
	$reponse = $bdd->query('SELECT * FROM technicien');
?>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="index.css" />
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
		<div class="formulaire">
			<form action='try { $bdd = new PDO('mysql:host=localhost;dbname=ppe;charset=utf8', 'root', ''); } catch(Exception $e) { die('Erreur : '.$e->getMessage()); }' method='POST'>
				<select name="technicien" size="1">
					<?php
						while ($donnees = $reponse->fetch())
						{
					?>
					<option> <?php echo $donnees['Matricule_technicien']; ?>
					<?php
						}
						$reponse->closeCursor(); // Termine le traitement de la requête
					?>
				</select>
				<button type="submit" class="btn btn-primary btn-block btn-large" name="affecter"> Affecter</button>
			</form>
		</div>
  </body>
  <script src="/www/bootstrap/js/jquery.js"></script>
  <script src="/www/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="/www/js/bootstrap.min.js"></script>
</html>
