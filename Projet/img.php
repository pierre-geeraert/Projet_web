<?php

$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );

//1. strrchr renvoie l'extension avec le point (« . »).
//2. substr(chaine,1) ignore le premier caractère de chaine.
//3. strtolower met l'extension en minuscules.

$extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );

$num = md5(uniqid(rand(), true));

$nom = "image/photos/{$num}.{$extension_upload}";

$resultat = move_uploaded_file($_FILES['image']['tmp_name'],$nom);

if ($resultat) header('location: Evenements.php');

?>