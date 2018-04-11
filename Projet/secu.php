<?php
if ($_POST['login'] == 'azerty')
{
	header('location: even1.php');
}
else
{
echo ("désolé cet espace est reservé à l'administrateur");
}