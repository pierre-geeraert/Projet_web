<?php
    require 'database.php';
    
    $DB = new Database();
   
    
    $DB->query("SELECT * FROM products");
    $products = $DB->fetchAll();
    $DB->closeCursor();

    echo json_encode($products);
    
 