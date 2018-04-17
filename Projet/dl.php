

<?php
session_start();
$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

try {

    $requete2 = $bdd->query("call download");


} catch (PDOException $e) {
    echo $e;
}

$donnees = $requete2->fetchAll();



$zip = new ZipArchive();
$filename = "./images.zip";

if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
    exit("Impossible d'ouvrir le fichier <$filename>\n");
}
//add try catch
//$file_add='test.txt';





$tt = count($donnees);
for ($i=0; $i < $tt; $i++) {
    //echo $donnees[$i]['url'];
    $zip->addFile($donnees[$i]['url']);
}
$zip->close();



header('Content-disposition: attachment; filename=images.zip');
header('Content-type: application/zip');
readfile($filename);
unlink($filename);
?>
