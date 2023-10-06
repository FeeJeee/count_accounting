    DROP DATABASE IF EXISTS cost_accounting_db;
    CREATE DATABASE cost_accounting_db;

    use cost_accounting_db;

    DROP TABLE IF EXISTS products;
    CREATE TABLE products(
        id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
        title varchar(100) NOT NULL
    ) engine InnoDB default charset= utf8mb4;

    DROP TABLE IF EXISTS materials;
    CREATE TABLE materials(
        id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
        title varchar(100) NOT NULL
    ) engine InnoDB default charset= utf8mb4;

    DROP TABLE IF EXISTS product_material;
    CREATE TABLE product_material(
        id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
        product_id int NOT NULL,
        material_id int NOT NULL,
        FOREIGN KEY (product_id) REFERENCES products(id),
        FOREIGN KEY (material_id) REFERENCES materials(id)
    ) engine InnoDB default charset= utf8mb4;

    DROP TABLE IF EXISTS purchases;
    CREATE TABLE purchases(
        purchase_id int NOT NULL,
        cost int NOT NULL,
        purchase_date DATE NOT NULL,
        FOREIGN KEY (purchase_id) REFERENCES product_material(id)
    ) engine InnoDB default charset= utf8mb4;

    INSERT INTO products (title) VALUES
        ('product_1'),
        ('product_2'),
        ('product_3');

    INSERT INTO materials (title) VALUES
        ('material_1'),
        ('material_2'),
        ('material_3'),
        ('material_4'),
        ('material_5'),
        ('material_6'),
        ('material_7');

    INSERT INTO product_material (product_id, material_id) VALUES
        (1, 1),
        (1, 2),
        (1, 3),
        (2, 1),
        (2, 2),
        (2, 3),
        (2, 4),
        (2, 5),
        (3, 1),
        (3, 2),
        (3, 3),
        (3, 4),
        (3, 6),
        (3, 7);

    INSERT INTO purchases (purchase_id, cost, purchase_date) VALUES
        (1, 100, '2000-12-12'),
        (2, 200, '2000-12-12'),
        (3, 300, '2000-12-12'),
        (4, 100, '2000-12-12'),
        (5, 200, '2000-12-12'),
        (6, 300, '2000-12-12'),
        (7, 400, '2000-12-12'),
        (8, 500, '2000-12-12'),
        (9, 100, '2000-12-12'),
        (10, 200, '2000-12-12'),
        (11, 300, '2000-12-12'),
        (12, 500, '2000-12-12'),
        (13, 600, '2000-12-12'),
        (14, 700, '2000-12-12'),
        (1, 200, '2001-12-12'),
        (2, 300, '2001-12-12'),
        (3, 400, '2001-12-12'),
        (4, 200, '2001-12-12'),
        (5, 300, '2001-12-12'),
        (6, 400, '2001-12-12'),
        (7, 400, '2001-12-12'),
        (8, 600, '2001-12-12'),
        (9, 200, '2001-12-12'),
        (10, 300, '2001-12-12'),
        (11, 400, '2001-12-12'),
        (12, 500, '2001-12-12'),
        (13, 700, '2001-12-12'),
        (14, 800, '2001-12-12'),
        (1, 300, '2002-12-12'),
        (2, 400, '2002-12-12'),
        (3, 500, '2002-12-12'),
        (4, 300, '2002-12-12'),
        (5, 400, '2002-12-12'),
        (6, 500, '2002-12-12'),
        (7, 600, '2002-12-12'),
        (8, 700, '2002-12-12'),
        (9, 300, '2002-12-12'),
        (10, 400, '2002-12-12'),
        (11, 500, '2002-12-12'),
        (12, 700, '2002-12-12'),
        (13, 800, '2002-12-12'),
        (14, 900, '2002-12-12');