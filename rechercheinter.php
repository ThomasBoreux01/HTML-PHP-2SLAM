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
    <title>Recherche</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
  </head>
  <body>
    <div class="container-fluid">
      <form action='rechercheinter.php' method="post">
        <p> Date de l'intervention: <input type="date" name="dateinter"></p>
        <button type="submit" class="btn btn-primary btn-block btn-large">Valider</button>
      </form>
      <form action='rechercheinter.php' method="post">
        <p> Matricule du technicien: <input type="text" name="matricule"></p>
        <button type="submit" class="btn btn-primary btn-block btn-large">Valider</button>
      </form>
      <?php
        $datevisite=$_POST['dateinter'];
        $matricule=$_POST['matricule'];
        if ($datevisite)
        {
          $requser = $bdd->query("SELECT * FROM intervention where DateVisite=$datevisite");
        }
        if ($matricule)
        {
          $requser = $bdd->query("SELECT * FROM intervention where Matricule=$matricule");
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
        <?php
          //On affiche les lignes du tableau une à une à l'aide d'une boucle
          while ($donnees = $requser->fetch())
          {
        ?>
        <tbody>
          <tr class="success">
            <td><?php echo $donnees['NumIntervention'];?></td>
            <td><?php echo $donnees['DateVisite'];?></td>
            <td><?php echo $donnees['HeureVisite'];?></td>
            <td><?php echo $donnees['Matricule'];?></td>
            <td><?php echo $donnees['NumClient'];?></td>
          </tr>
        </tbody>
      </table>
      <?php
        } //fin de la boucle, le tableau contient toute la BDD
        $requser->closeCursor(); // Termine le traitement de la requête
      ?>
    </div>
  </body>
  <script src="/www/bootstrap/js/jquery.js"></script>
  <script src="/www/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="/www/js/bootstrap.min.js"></script>
</html>
