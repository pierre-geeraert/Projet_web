<?php
session_start();
$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

$event_id_in= $_POST['id'];
$user_id=$_SESSION['id'];

$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );

//1. strrchr renvoie l'extension avec le point (« . »).
//2. substr(chaine,1) ignore le premier caractère de chaine.
//3. strtolower met l'extension en minuscules.

//find extension of pictures
$extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );

$num = md5(uniqid(rand(), true));

$nom = "image/photos/{$num}.{$extension_upload}";

$resultat = move_uploaded_file($_FILES['image']['tmp_name'],$nom);

echo "<p> $nom</p>";
echo "<p> $user_id</p>";
echo "<p> $event_id_in</p>";
echo "<p>$resultat</p>";
$requete1 = $bdd->prepare("call add_picture(:url,:user_id,:event_id)");


if ($resultat) {

    try {
        $requete1->bindValue(':url', $nom, PDO::PARAM_STR);
        $requete1->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $requete1->bindValue(':event_id', $event_id_in, PDO::PARAM_STR);
        $requete1->execute();
    } catch (PDOException $e) {
        echo $e;
    }
    header('location: Evenements.php');
}



?>