<?php
    require_once('database.php');

    // JUSTE POUR LE DEBUGAGE , TU PEUX L'ENLEVER APRES
  

    $db = new Database;

    $db->query("SELECT * from products order by number_of_sales desc limit 3");
    $bestsell = $db->fetchAll();
    $db->closeCursor();

    echo json_encode($bestsell);
    
