<?php
require 'database.php';
require 'panier.class.php';
$DB = new Database();
$panier = new panier($DB);
?>
<?php
$_SESSION['panier'] = $_POST['panier'];

?>



<form name=mail id="mail" action="http://pi-ux-ce.alwaysdata.net/projet/mail.php" method="post">
    <input type="hidden" name="to" value="jeanclement.podevin@viacesi.fr"/>
    <input type="hidden" name="subject" value="'.${date(' j F h:i:s ')}.'";/>
    <input type="hidden" name="message" value="Bonjour voici :".{$_SESSION['panier']}."/>'



</form>
<script language="JavaScript" type="text/JavaScript">document.mail.submit(); </SCRIPT>
