<?php 

require 'database.php';
require 'panier.class.php';
$DB = new Database();
$panier = new panier($DB);
//Initialize a session
if(isset($_GET['id'])){
    $product=$DB ->query('DELETE * FROM products WHERE name="souris"');
 }