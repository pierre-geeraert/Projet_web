<?php
    require_once('database.php');

    // JUSTE POUR LE DEBUGAGE , TU PEUX L'ENLEVER APRES
  

    $db = new Database;

    $db->query("SELECT * FROM products");
    $products = $db->fetchAll();
    $db->closeCursor();

    echo json_encode($products);
    
