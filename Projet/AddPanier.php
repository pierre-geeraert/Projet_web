<?php
	session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require 'database.php'; 
    require 'panier.class.php';

    $DB = new Database();           
    $panier = new panier($DB);  //Database and Basket Instance

    if (isset($_GET['id'])) {
        $DB->query('SELECT product_id FROM products WHERE product_id = :id');  //Retrieves the product id 
        $DB->bindParam(':id', htmlspecialchars(strip_tags($_GET['id'])));

        $product = $DB->fetch();
        $DB->closeCursor();


        if (empty($product)) {
            $json['message'] = "Ce produit n'existe pas";
        }
        $panier->add($product['product_id']);

        header('Location: Boutique.php');
    } else {
        die("vous n'avais pas séletionné de produit");
    }
?>