

<?php
session_start();
//bdd connection
$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

try 
{
    //try catch to take all pictures'url from DB
    $requete2 = $bdd->query("call download");


} catch (PDOException $e) 
{
    echo $e;
}
//we parse the request to turn this into an array
$donnees = $requete2->fetchAll();


//create and assign zip to images.zip
$zip = new ZipArchive();
$filename = "./images.zip";

if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) 
{
    exit("Impossible d'ouvrir le fichier <$filename>\n");
}
//add try catch
//$file_add='test.txt';




//browse all pictures'ur one per one to put them into zip
$tt = count($donnees);
for ($i=0; $i < $tt; $i++) 
{
    //echo $donnees[$i]['url'];
    $zip->addFile($donnees[$i]['url']);
}
$zip->close();


//download the zip
header('Content-disposition: attachment; filename=images.zip');
header('Content-type: application/zip');
readfile($filename);
unlink($filename);
?>
