<?php
$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$token = $_GET['token'];




try {
    $requete = $bdd->prepare("call validation(:token)");
    $requete->bindValue(':token', $token, PDO::PARAM_STR);
    $requete->execute();

}catch(PDOException $e) {
    echo($e->getMessage());
}
echo "compte validée avec succés";

?>
