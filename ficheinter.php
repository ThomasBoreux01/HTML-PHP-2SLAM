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
          <a class="navbar-brand" href="#"><?php echo $_SESSION['nom']; ?></a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="assistant.php">Accueil</a></li>
          <li><a href="rechercheclient.php">Recherche d'un client</a></li>
          <li><a href="rechercheinter.php">Recherche d'une intervention</a></li>
          <li><a href="affecter.php">Affectation des visites</a></li>
          <li><a href="stats.php">Statistiques des techniciens</a></li>
          <li><a href="creapdf.php">Création d'un PDF</a></li>
          <li><a href="deconnexion.php">Déconnexion</a></li>
        </ul>
      </div>
    </nav>
    <div class="container-fluid">
      <?php
        $datevisite=$_POST['dateinter'];
        $matricule=$_POST['matricule'];
        if ($datevisite){
          $requser = $bdd->query("SELECT * FROM intervention WHERE Date_Visite=$datevisite");
        }
        elseif($matricule){
          $requser = $bdd->query("SELECT * FROM intervention WHERE MatriculeT=$matricule");
        }
        elseif($datevisite&&$matricule){
          $requser = $bdd->query("SELECT * FROM intervention WHERE MatriculeT=$matricule AND Date_Visite=$datevisite");
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
        <tbody>
          <?php
            //On affiche les lignes du tableau une à une à l'aide d'une boucle
            while ($donnees = $requser->fetch())
            {
          ?>
          <tr class="success">
            <td><?php echo $donnees['Numero_Intervention'];?></td>
            <td><?php echo $donnees['Date_Visite'];?></td>
            <td><?php echo $donnees['Heure_Visite'];?></td>
            <td><?php echo $donnees['MatriculeT'];?></td>
            <td><?php echo $donnees['Numero_Client'];?></td>
          </tr>
          <?php
            } //fin de la boucle, le tableau contient toute la BDD
            $requser->closeCursor(); // Termine le traitement de la requête
          ?>
        </tbody>
      </table>
    </div>
    <div class="formulaire">
      <form method="post">
        <p> Intervention :
          <select name="intervention" size="1">
					  <?php
						  $reponse = $bdd->query("SELECT intervention.Numero_Intervention FROM intervention");
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
        <p> Date de visite: <input required="required" type="date" name="date"></p>
        <p> Heure de visite: <input required="required" type="time" name="heure"></p>
        <p> Matricule: <input required="required" type="text" name="matricule"></p>
        <p> Numéro du client: <input required="required" type="text" name="numClient"></p>
        <button type="submit" class="btn btn-primary btn-block btn-large" name="modifier">Modifier</button>
      </form>
    </div>
  </body>
  <?php
    if(isset($_POST['valider'])){
      $intervention = $_POST["intervention"]
      $date = $_POST["date"];
      $heure = $_POST["heure"];
      $matricule = $_POST["matricule"];
      $num = $_POST["numClient"];
      $sql = $bdd->query("UPDATE intervention SET Date_Visite=$date, Heure_Visite=$heure, MatriculeT=$matricule, Numero_Client=$num WHERE Numero_Intervention=$intervention");
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
