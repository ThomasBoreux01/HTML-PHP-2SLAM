<?php
  session_start();
  try
  {
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=ppe;charset=utf8', 'root', '');
  }
  catch(Exception $e)
  {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
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
    <title>Validation</title>
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
          <li><a href="agent.php">Accueil</a></li>
          <li class="active"><a href="validation.php">Validation d'une intervention</a></li>
          <li><a href="consulter.php">Consultation</a></li>
          <li><a href="deconnexion.php">Déconnexion</a></li>
        </ul>
      </div>
    </nav>
    <div class="container-fluid">
      <form method="post">
        <p> Intervention :
          <select name="intervention" size="1">
            <?php
              $reponse = $bdd->query('SELECT intervention.Numero_Intervention FROM intervention, controler WHERE intervention.Numero_Intervention=controler.Numero_Intervention');
              while ($donnees = $reponse->fetch())
              {
            ?>
            <option selected> <?php echo $donnees['Numero_Intervention']; ?> </option>
            <?php
              }
              $reponse->closeCursor(); // Termine le traitement de la requête
            ?>
          </select>
        </p>
        <p> Commentaire: <input type="text" name="comment"></p>
        <p> Temps passé: <input type="timestamp" name="time"></p>
        <button type="submit" class="btn btn-primary btn-block btn-large" name="visiter">Valider</button>
      </form>
      <?php
        if(isset($_POST['visiter']))
        {
          $inter = $_POST['intervention'];
          $comment = $_POST['comment'];
          $time = $_POST['time'];
          if($comment&&$time)
          {
            $requser = $bdd->query("UPDATE controler SET Temps_Passe=$time, Commentaire=$comment WHERE Numero_Intervention=$inter");
            echo "Visite validée";
          }
        }
        else
        {
          echo "Visite non validée";
        }
        $requser->closeCursor(); // Termine le traitement de la requête
      ?>
    </div>
  </body>
  <script src="/www/bootstrap/js/jquery.js"></script>
  <script src="/www/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="/www/js/bootstrap.min.js"></script>
</html>
