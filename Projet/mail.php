<?php

$to=$_POST['to'];
$subject=$_POST['subject'];
$token=$_POST['message'];
//$subject=date(' j F h:i:s ');
ini_set( 'display_errors', 1 );

error_reporting( E_ALL );

//$from = "pi-ux-ce@alwaysdata.net";
$from = "BDE@cesi.fr";

//$to = "pierre.geeraert@viacesi.fr";

//$subject = "Vérification PHP mail";

$message = "<!DOCTYPE html><body><a href=\"http://projet/Projet/validation_user.php/?token=".$token."\">Lien de validation</a></body></html>";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= "From:" . $from;




mail($to,$subject,$message, $headers);

echo "L'email a été envoyé.";
header('location: http://127.0.0.1/index.php');
?>
