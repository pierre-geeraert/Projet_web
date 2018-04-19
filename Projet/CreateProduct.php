<?php
session_start();


//require 'database.php';
//$DB = new Database();
$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

// we find our title , description date and user_id from post or session var
$title=$_POST['title'];

$desc=$_POST['desc'];
$prix=$_POST['prix'];

echo $title;
echo $prix;
echo $desc;
//Use to upload and move pictures
$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
$extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );
$num = md5(uniqid(rand(), true));
$nom = "Images/Produits/{$num}.{$extension_upload}";
echo "<p>$extension_upload</p>";
echo "<p>$num</p>";
echo "<p>$nom</p>";


try {
    $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $nom);
    if (!$resultat) {
        throw new Exception('Could not move file');
                    }           
    } catch (Exception $e) 
{
    die ('File did not upload: ' . $e->getMessage());
}


try {

    //$bdd->query('INSERT INTO products(name, description, price, url) VALUES ('.$title.', '.$desc.','.$prix.', '.$nom.')');

    $requete1 = $bdd->prepare("INSERT INTO products(name, description, price, url) VALUES (:nom,:description,:prix,:url)");
    $requete1->bindValue(':nom', $title, PDO::PARAM_STR);
    $requete1->bindValue(':description', $desc, PDO::PARAM_STR);
    $requete1->bindValue(':prix', $prix, PDO::PARAM_STR);
    $requete1->bindValue(':url', $nom, PDO::PARAM_STR);
    $requete1->execute();


    } catch (PDOException $e)
{
    echo $e;
}








?>

