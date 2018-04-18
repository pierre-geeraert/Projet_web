<?php
session_start();


require 'database.php';
$DB = new Database();


// we find our title , description date and user_id from post or session var
$title=$_POST['title'];
$desc=$_POST['desc'];
$prix=$_POST['prix'];

//Use to upload and move pictures
$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
$extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );
$num = md5(uniqid(rand(), true));
$nom = "image/photos/{$num}.{$extension_upload}";

try {
    $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $nom);
    if (!$resultat) {
        throw new Exception('Could not move file');
    }
} catch (Exception $e) {
    die ('File did not upload: ' . $e->getMessage());
}


try {

    $bdd->query('INSERT INTO products("name, description, price, url) VALUES ('.$title.', '.$desc.','.$prix.', '.$nom.'")');

} catch (PDOException $e) {
    echo $e;
}








?>

