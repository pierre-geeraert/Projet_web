<?php


$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');


$term = $_GET['term'];


$requete = $bdd->prepare('SELECT `name` FROM products WHERE `name` LIKE :term'); 



$requete->execute(array('term' => '%'.$term.'%'));


$array = array(); // on créé le tableau

while($donnee = $requete->fetch()) // we make a loop to get data

{

    array_push($array, $donnee['name']); // add data to array

}


echo json_encode($array);
?>