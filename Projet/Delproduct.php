<?php 

require 'database.php';

$DB = new Database();

if (isset($_GET['id'])) {
    $DB->query("DELETE FROM products WHERE product_id =:id LIMIT 1");
    $DB->bindParam(':id', $_GET['id']);
    $DB->execute();

    $DB->closeCursor();
} else {
    die('Pas suppp');
}