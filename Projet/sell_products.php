<?php
require 'database.php';

$DB = new Database();

if (isset($_POST['search']) && !empty($_POST['search'] && $_POST['search'] != '')) {
    $DB->query("SELECT * FROM products WHERE `name` LIKE :pName ");
    $DB->bindParam(':pName', htmlspecialchars(strip_tags($_POST['search'])));
} else {
    $DB->query("SELECT * FROM products");
}

$products = $DB->fetchAll();
$DB->closeCursor();

echo json_encode($products);
    