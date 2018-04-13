

<?php

include_once('BDD.php');

$bdd->prepare('SELECT * FROM products' );
$bdd->execute();
$result=$bdd->fetchall();

var_dump($result);
echo json_encode($result);

