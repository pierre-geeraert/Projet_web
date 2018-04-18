<?php
$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

for($var=1; $var<=3 ; $var++)
{
	if (isset($_POST[$var]))
	{
		$bdd->query('call delete_comment("'.$_POST[$var].'")');
	}
}

header('Location: Evenements.php');
?>