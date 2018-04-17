<?php

require 'database.php';
require 'panier.class.php';
$DB = new Database();
$panier = new panier($DB);

if(isset($_GET['id'])){
    $product=$DB ->query('SELECT product_id FROM products WHERE product_id=:id', array('id' => $_GET['id']));
    if(empty($product)){
        $json['message'] = "Ce produit n'existe pas";
    }
    $panier->add($product[0]->product_id);
    
    header('Location: Boutique.php');
}
        


else{
    die("vous n'avais pas séletionné de produit");
}

