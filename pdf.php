<?php
 session_start();
  try
  {
  	$bdd = new PDO('mysql:host=localhost;dbname=ppe;charset=utf8', 'root', '');
  }
  catch (Exception $e)
  {
  	die('Erreur : ' . $e->getMessage());
  }

  require('fpdf.php');

$pdf = new FPDF("P","cm","A4");

//Titres des colonnes
$header=array("Intervention", "Date visite","Heure visite","Matricule","Numero client");

$pdf->SetFont('Arial','B',14);
$pdf->AddPage();
$pdf->SetFillColor(96,96,96);
$pdf->SetTextColor(255,255,255);

$numinter=$_POST['intervention'];
$reponse = $bdd->query("SELECT * FROM intervention where Numero_Intervention=$numinter");

$pdf->SetXY(3,3);
for($i=0;$i<sizeof($header);$i++)
    $pdf->cell(3.5,1,$header[$i],1,0,'C',1);

$pdf->SetFillColor(0xdd,0xdd,0xdd);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',10);
$pdf->SetXY(3,$pdf->GetY()+1);
$fond=0;

while($donnees = $reponse->fetch())
  {
   $pdf->cell(3.5,0.7,$donnees['Numero_Intervention'],1,0,'C',$fond);
   $pdf->cell(3.5,0.7,$donnees['Date_Visite'],1,0,'C',$fond);
   $pdf->cell(3.5,0.7,$donnees['Heure_Visite'],1,0,'C',$fond);
   $pdf->cell(3.5,0.7,$donnees['MatriculeT'],1,0,'C',$fond);
   $pdf->cell(3.5,0.7,$donnees['Numero_Client'],1,0,'C',$fond);
   $pdf->SetXY(3,$pdf->GetY()+0.7);
   $fond=!$fond;
  }

$reponse->closeCursor(); // Termine le traitement de la requête
$pdf->Output();
?>
