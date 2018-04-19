<?php 

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require 'database.php';

$DB = new Database();

if (isset($_GET['id'])) 
{
        // Function who will permit to delete a product form the shopcart when we are BDE
    $DB->query("DELETE FROM products WHERE `product_id` = :pID LIMIT 1");
    $DB->bindParam(':pID', htmlspecialchars(strip_tags($_GET['id'])));
    $DB->execute(); 

    $DB->closeCursor();     
} else 
{
    throw new Exception("L'id n'existe pas.");
}