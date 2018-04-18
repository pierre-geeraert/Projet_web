<?php
    require('database.php');

   
        // Request in order to display th best 3 of purchased product

    $DB = new Database;

    $DB->query("SELECT * from products order by number_of_sales desc limit 3");
    $bestsell = $DB->fetchAll();
    $DB->closeCursor();

    echo json_encode($bestsell);
?>   
