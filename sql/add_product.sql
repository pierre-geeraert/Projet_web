DELIMITER |

CREATE PROCEDURE add_product(IN name_in VARCHAR(250), IN description_in VARCHAR(250),IN price_in INT, IN url_in VARCHAR(250), IN category_in VARCHAR(250))      
BEGIN

INSERT INTO products (name, description, price, url)
VALUES (name_in,description_in,price_in,url_in);

INSERT INTO have(product_id, category_id)
VALUES (
    (
   
        SELECT product_id
        FROM products
        WHERE name = name_in
    
    ),
    (
        SELECT category_id
        FROM category
        WHERE `category` = category_in
    )

);


END |