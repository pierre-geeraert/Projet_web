<?php
$out = fopen('php://output', 'w');
$var="ee";
$bar="dd";
fputcsv($out, array($bar,$var));
fclose($out);
echo "<script language='javascript'>window.close()</script>";
?>