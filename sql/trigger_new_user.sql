CREATE TRIGGER after_insert_animal AFTER INSERT

ON users FOR EACH ROW

INSERT INTO order(order_date, paid, user_id
VALUES;