<?php
/**
 * Created by PhpStorm.
 * User: pi-ux-ce
 * Date: 16/04/18
 * Time: 22:18
 */
session_start();

$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');
$requete2 = $bdd->query("select count(*) as test from appreciate where user_id=29 and picture_id=11;");
//$requete2->bindValue(':user_id', $user_id, PDO::PARAM_STR);
//$requete2->bindValue(':picture_id', $picture_id, PDO::PARAM_STR);
//$requete2->execute();
$donnees = $requete2->fetch();
echo $donnees[ 'test' ];
$json_like=json_encode($donnees);
echo $json_like;

?>