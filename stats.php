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
    <title>Outil statistique</title>
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
			<form method='POST'>
				<p> Matricule :
          <select name="technicien" size="1">
					  <?php
						  $reponse = $bdd->query('SELECT technicien.MatriculeT FROM technicien');
						  while ($donnees = $reponse->fetch())
						  {
					  ?>
					  <option selected> <?php echo $donnees['MatriculeT']; ?> </option>
					  <?php
						  }
						  $reponse->closeCursor(); // Termine le traitement de la requête
				    ?>
				  </select>
        </p>
        <p> Mois :
          <select name="mois" size="1">
					  <option value="1" selected>Janvier</option>
            <option value="2">Février</option>
            <option value="3">Mars</option>
            <option value="4">Avril</option>
            <option value="5">Mai</option>
            <option value="6">Juin</option>
            <option value="7">Juillet</option>
            <option value="8">Août</option>
            <option value="9">Septembre</option>
            <option value="10">Octobre</option>
            <option value="11">Novembre</option>
            <option value="12">Décembre</option>
				  </select>
        </p>
				<button type="submit" class="btn btn-primary btn-block btn-large" name="visualiser">Visualiser</button>
			</form>
      <?php
        if(isset($_POST['visualiser'])){
          $technicien = $_POST['technicien'];
          $mois = $_POST['mois'];
          if($technicien&&$mois)
          {
            $requser = $bdd->query("SELECT COUNT(intervention.Numero_Intervention) AS Numero_Intervention, SUM(intervention.Heure_Visite) AS Heure_Visite, MONTH(intervention.Date_Visite) AS Mois, YEAR(intervention.Date_Visite) AS Annee FROM intervention WHERE intervention.MatriculeT=$technicien");
          }
          else{
            echo "Erreur";
          }
        }
        else {
          echo "Erreur";
        }
      ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Matricule</th>
            <th>Nombre d'interventions</th>
            <th>Nombre d'heures</th>
            <th>Mois</th>
            <th>Année</th>
          </tr>
        </thead>
        <tbody>
          <?php
            //On affiche les lignes du tableau une à une à l'aide d'une boucle
            while ($donnees = $requser->fetch()){
              $moisbdd = $donnees['Mois'];
              if($moisbdd==$mois){
          ?>
          <tr class="success">
            <td><?php echo $technicien;?></td>
            <td><?php echo $donnees['Numero_Intervention'];?></td>
            <td><?php echo $donnees['Heure_Visite'];?></td>
            <td><?php echo $moisbdd;?></td>
            <td><?php echo $donnees['Annee'];?></td>
          </tr>
          <?php
              }
              else{
                echo "Aucune intervention sur ce mois";
              }
            } //fin de la boucle, le tableau contient toute la BDD
              $requser->closeCursor(); // Termine le traitement de la requête
          ?>
        </tbody>
      </table>
		</div>
  </body>
  <script src="/www/bootstrap/js/jquery.js"></script>
  <script src="/www/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="/www/js/bootstrap.min.js"></script>
</html>
