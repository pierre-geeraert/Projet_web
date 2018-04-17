<?php
/**
 * Created by PhpStorm.
 * User: pi-ux-ce
 * Date: 16/04/18
 * Time: 22:18
 */
session_start();

$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');
$requete2 = $bdd->prepare("select count(*) as test from appreciate where picture_id=:picture_id;");
$picture_id_in= $_GET['picture_id'];
$requete2->bindValue(':picture_id', $picture_id_in, PDO::PARAM_STR);
$requete2->execute();
$donnees = $requete2->fetch();
$json_like=json_encode($donnees);
echo $json_like;

?>