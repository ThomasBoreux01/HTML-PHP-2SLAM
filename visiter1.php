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
    <link rel="stylesheet" href="css/style.css">
    <link href="/www/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <title>Validation</title>
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
          <li><a href="agent.php">Accueil</a></li>
          <li class="active"><a href="visiter1.php">Validation d'une intervention</a></li>
          <li><a href="consulte.php">Consultation</a></li>
		      <li><a href="deconnexion.php">Déconnexion</a></li>
        </ul>
      </div>
    </nav>
    <form action='visiter2.php' method="post">
      <p> Intervention :
        <select name="intervention" size="1">
          <?php
            $reponse = $bdd->query('SELECT intervention.NumIntervention  AS NumIntervention FROM intervention, controler WHERE intervention.NumIntervention=controler.NumIntervention');
            while ($donnees = $reponse->fetch())
            {
          ?>
          <option selected> <?php echo $donnees['NumIntervention']; ?> </option>
          <?php
            }
            $reponse->closeCursor(); // Termine le traitement de la requête
          ?>
        </select>
      </p>
      <button type="submit" class="btn btn-primary btn-block btn-large" name="Valider">Valider</button>
    </form>
  </body>
  <script src="/www/bootstrap/js/jquery.js"></script>
  <script src="/www/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="/www/js/bootstrap.min.js"></script>
</html>
