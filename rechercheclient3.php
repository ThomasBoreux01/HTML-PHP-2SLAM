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
          <li><a href="rechercheclient1.php">Recherche d'un client</a></li>
          <li><a href="rechercheinter1.php">Recherche d'une intervention</a></li>
          <li><a href="affecter.php">Affectation des visites</a></li>
          <li><a href="stats1.php">Statistiques des techniciens</a></li>
          <li><a href="creapdf.php">Création d'un PDF</a></li>
          <li><a href="deconnexion.php">Déconnexion</a></li>
        </ul>
      </div>
    </nav>
    <div class="container-fluid">
      <?php
        if(isset($_POST['modifier'])){
          $numclient = $_POST["numclient"];
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
          $sql = $bdd->query("UPDATE client SET Raison_Sociale=$raison, Siren=$siren, Code_Ape=$codeape, Adresse=$adresse, Telephone_Client=$telephone, Fax_Client=$fax, Email=$email, Duree_Deplacement=$duree, Distance_KM=$distancekm, NumContrat=$numcontrat, NumAgence=$numagence WHERE NumClient=$numclient");
          $message='Modification réussi';
          echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
          $sql->closeCursor(); // Termine le traitement de la requête
        }
        $sql = $bdd->query("SELECT * FROM client where Numero_Client=$numclient");
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
            <th>Numero de contrat</th>
            <th>Numero Agence</th>
          </tr>
        </thead>
        <tbody>
          <?php
            //On affiche les lignes du tableau une à une à l'aide d'une boucle
            while ($donnees = $requser->fetch())
            {
          ?>
          <tr class="success">
            <td><?php echo $donnees['Numero_Client'];?></td>
            <td><?php echo $donnees['Raison_Sociale'];?></td>
            <td><?php echo $donnees['Siren'];?></td>
            <td><?php echo $donnees['Code_Ape'];?></td>
            <td><?php echo $donnees['Adresse'];?></td>
            <td><?php echo $donnees['Telephone_Client'];?></td>
            <td><?php echo $donnees['Fax_Client'];?></td>
            <td><?php echo $donnees['Email'];?></td>
            <td><?php echo $donnees['Duree_Deplacement'];?></td>
            <td><?php echo $donnees['Distance_KM'];?></td>
            <td><?php echo $donnees['Numero_de_contrat'];?></td>
            <td><?php echo $donnees['Numero_Agence'];?></td>
          </tr>
          <?php
            } //fin de la boucle, le tableau contient toute la BDD
            $sql->closeCursor(); // Termine le traitement de la requête
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
