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
        Choisir le client :
        <select id="client" name="client">
          <?php
            $reponse = $bdd->query('SELECT Numero_Client,Raison_Sociale FROM client');
            while ($donnees = $reponse->fetch()){; ?>
              <option value=" <?php echo $donnees['Numero_Client']; ?>"> <?php echo $donnees['Numero_Client'] ?> - <?php echo $donnees['Raison_Sociale']?></option>;<?php
            }
            $reponse->closeCursor();
            ?>
        </select>
      </p>
        <button type="submit" class="btn btn-primary btn-block btn-large" name="rechercher">Rechercher</button>
        <button type="submit" class="btn btn-primary btn-block btn-large" name="modifier">Modifer</button>
      </form>
    </div>
<?php
    if(isset($_POST['rechercher'])){
      $num = $_POST["client"];
      $requser = $bdd->query("SELECT * FROM client WHERE Numero_Client=$num");
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
            $requser->closeCursor(); // Termine le traitement de la requête
          ?>
        </tbody>
      </table>
      <?php
       } 
      ?>
  <?php
    if(isset($_POST['modifier'])){
      $Numero_Client = $_POST["client"];
      $requser = $bdd->query("SELECT * FROM client WHERE Numero_Client=$Numero_Client");
      ?>?>
    <div class="container-fluid" style="width:auto; height:350px; overflow: auto;" >
      <form method='POST'>
        <?php while ($donnees = $requser->fetch()){ ?>
        Numéro client : <input value="<?php echo $donnees['Numero_Client'] ?>" required="required" type="text" name="Numero_Client" readonly> 
        Raison Sociale: <input value="<?php echo $donnees['Raison_Sociale'] ?>" required="required" type="text" name="Raison_Sociale">
        SIREN: <input value="<?php echo $donnees['Siren'] ?>" required="required" type="text" name="Siren">
        Code APE: <input value="<?php echo $donnees['Code_Ape'] ?>" required="required" type="text" name="Code_Ape">
        Adresse: <input value="<?php echo $donnees['Adresse'] ?>"required="required" type="text" name="Adresse">
        Telephone: <input value="<?php echo $donnees['Telephone_Client'] ?>" required="required" type="text" name="Telephone_Client">
        FAX: <input value="<?php echo $donnees['Fax_Client'] ?>" required="required" type="text" name="Fax_Client"></p>
        Email: <input value="<?php echo $donnees['Email'] ?>" required="required" type="text" name="Email"></p>
        Duree Deplacement: <input value="<?php echo $donnees['Duree_Deplacement'] ?>" required="required" type="text" name="Duree_Deplacement">
        Distance KM: <input value="<?php echo $donnees['Distance_KM'] ?>"required="required" type="text" name="Distance_KM">
        Numero contrat: <input value="<?php echo $donnees['Numero_de_contrat'] ?>" required="required" type="text" name="Numero_de_contrat">
        Numero agence: <input value="<?php echo $donnees['Numero_Agence'] ?>" required="required" type="text" name="Numero_Agence"> 
        <br/>
        <button type="submit" class="btn btn-primary btn-block btn-large" name="valider">Faire les modifications</button>
      </form>
    </div>
  <?php }}
    if(isset($_POST['valider'])){
      $Numero_Client = $_POST["Numero_Client"];
      $Raison_Sociale = $_POST["Raison_Sociale"];
      $Siren = $_POST["Siren"];
      $Code_Ape = $_POST["Code_Ape"];
      $Adresse = $_POST["Adresse"];
      $Telephone_Client = $_POST["Telephone_Client"];
      $Fax_Client = $_POST["Fax_Client"];
      $Email = $_POST["Email"];
      $Duree_Deplacement = $_POST["Duree_Deplacement"];
      $Distance_KM = $_POST["Distance_KM"];
      $Numero_de_contrat = $_POST["Numero_de_contrat"];
      $Numero_Agence = $_POST["Numero_Agence"];
      $sql = $bdd->prepare("UPDATE client SET Raison_Sociale= :Raison_Sociale, Siren= :Siren, Code_Ape= :Code_Ape, Adresse= :Adresse, Telephone_Client= :Telephone_Client, Fax_Client= :Fax_Client, Email= :Email, Duree_Deplacement= :Duree_Deplacement, Distance_KM= :Distance_KM, Numero_de_contrat= :Numero_de_contrat, Numero_Agence= :Numero_Agence WHERE Numero_Client= :Numero_Client");
      $sql->execute(array(
        ':Numero_Client'=>$Numero_Client,
        ':Raison_Sociale'=>$Raison_Sociale,
        ':Siren'=>$Siren,
        ':Code_Ape'=>$Code_Ape,
        ':Adresse'=>$Adresse,
        ':Telephone_Client'=>$Telephone_Client,
        ':Fax_Client'=>$Fax_Client,
        ':Email'=>$Email,
        ':Duree_Deplacement'=>$Duree_Deplacement,
        ':Distance_KM'=>$Distance_KM,
        ':Numero_de_contrat'=>$Numero_de_contrat,
        ':Numero_Agence'=>$Numero_Agence
      ));
      $message='Modification réussie';
      echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
      @$requser->closeCursor(); // Termine le traitement de la requête
    } 
  ?>
  </body>
  <script src="/www/bootstrap/js/jquery.js"></script>
  <script src="/www/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="/www/js/bootstrap.min.js"></script>
</html>
