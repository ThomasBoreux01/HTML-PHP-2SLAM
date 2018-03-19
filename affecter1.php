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
          <li class="active"><a href="assistant.php">Accueil</a></li>
          <li><a href="rechercheclient1.php">Recherche d'un client</a></li>
          <li><a href="rechercheinter1.php">Recherche d'une intervention</a></li>
          <li><a href="affecter1.php">Affectation des visites</a></li>
					<li><a href="stats1.php">Statistiques des techniciens</a></li>
        </ul>
      </div>
    </nav>
		<div class="formulaire">
			<form action='affecter2.php' method='POST'>
				<p> Matricule :
					<select name="technicien" size="1">
						<?php
							$reponse = $bdd->query('SELECT * FROM technicien');
							while ($donnees = $reponse->fetch())
							{
						?>
						<option> <?php echo $donnees['Matricule']; ?>
						<?php
							}
							$reponse->closeCursor(); // Termine le traitement de la requête
						?>
					</select>
				</p>
				<button type="submit" class="btn btn-primary btn-block btn-large" name="affecter">Affecter</button>
			</form>
		</div>
  </body>
  <script src="/www/bootstrap/js/jquery.js"></script>
  <script src="/www/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="/www/js/bootstrap.min.js"></script>
</html>
