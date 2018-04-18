<?php


$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');


$term = $_GET['term'];


$requete = $bdd->prepare('SELECT `name` FROM products WHERE `name` LIKE :term'); 



$requete->execute(array('term' => '%'.$term.'%'));


$array = array(); // on créé le tableau

while($donnee = $requete->fetch()) // on effectue une boucle pour obtenir les données

{

    array_push($array, $donnee['name']); // et on ajoute celles-ci à notre tableau

}


echo json_encode($array);
?>