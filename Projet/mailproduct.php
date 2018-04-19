<?php
session_start();
require 'database.php';
require 'panier.class.php';
$DB = new Database();
$panier = new panier($DB);

$_SESSION['panier'] = $_POST['panier'];



//----------------------------------------------------------------------


$to      = 'pierre.geeraert@viacesi.fr';
$subject = 'Commande';
$message = 'Bonjour ! Une nouvelle commande vient d\'être effectué par ';
$message .= $_SESSION['name']."</br> Pour la consulter veuillez accedez à l'onglet notification.";

echo $message;

$headers = 'From: BDE@cesi.com' . "\r\n" .
'Reply-To: BDE@cesi.com' . "\r\n" .
'X-Mailer: PHP/' . phpversion();

echo '
<form name=mail id="mail" action="http://pi-ux-ce.alwaysdata.net/projet/mailproduct_web.php" method="post">
    <input type="hidden" name="to" value="'.$to.'"/>
    <input type="hidden" name="subject" value="Commande";/>
    <input type="hidden" name="message" value="'.$message.'"/>

</form>
<script language="JavaScript" type="text/JavaScript">document.mail.submit(); </SCRIPT>
';
//header('location: connexion.php');
//----------------------------------------------------------------------

?>