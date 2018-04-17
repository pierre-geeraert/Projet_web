<?php

define("FPDF_FONTPATH","font/"); 
//lien vers le dossier " font " 
require("fpdf/fpdf.php"); 
//lien vers le fichier contenant la classe FPDF

$pdf = new FPDF("P","pt","A4"); 
//création d'une instance de classe, P pour portrait

$pdf ->Open(); //indique que l'on crée un fichier PDF
$pdf ->AddPage(); //permet d'ajouter une page
$pdf ->SetFont('Helvetica','B',11); //choix de la police
$pdf ->SetXY(330, 25); // indique des coordonnées pour 

$pdf ->Cell(190,50,"texte dans le cadre",0,0, "L"); 
//création d'une cellule
$pdf ->Text(498,20, "texte"); //insertion d'une ligne 

$pdf ->Output(); //génère le PDF et l'affiche	

?>