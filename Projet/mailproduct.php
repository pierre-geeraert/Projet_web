<?php
$dest = 'jeanclement.podevin@viacesi.fr';
$sujet = 'le sujet';
$message = 'Bonjour ! ';
$entete = "From: jeanclement.podevin@viacesi.fr"."\r\n" ;
$entete.= "Reply-To: jeanclement.podevin@viacesi.fr" . "\r\n" ;
$entete.= "X-Mailer: PHP/" . phpversion( );


mail($dest, $sujet, $message, $entete);
?>