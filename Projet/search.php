<?php

    require('database.php');
  

    $search = $_POST['recherche'];
	echo $search;

    $DB = new Database;

    $DB->query("SELECT * from products WHERE name = '$search'");
    $Jsearch = $DB->fetchAll();
    $DB->closeCursor();

    echo json_encode($Jsearch);

    
?>