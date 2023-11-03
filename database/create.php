<?php
require("config.php");
$pdo->query("CREATE Database if not exists $dbstore");
$pdo->query("USE $dbstore");

$pdo->query("CREATE TABLE if not exists groupp(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL)
    ENGINE=INNODB DEFAULT CHARSET=utf8"); //unique can be added to name;

$pdo->query("CREATE TABLE if not exists product(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    group_id INT NOT NULL REFERENCES groupp(id),
    price DECIMAL NOT NULL,
    quantity INT NOT NULL)
    ENGINE=INNODB DEFAULT CHARSET=utf8");

$pdo->query("ALTER TABLE product ADD FOREIGN KEY (group_id) REFERENCES groupp(id)");

$pdo->query("CREATE TABLE if not exists employee_position(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL)
    ENGINE=INNODB DEFAULT CHARSET=utf8");

$pdo->query("CREATE TABLE if not exists employee(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    emplpos_id INT NOT NULL REFERENCES employee_position(id),
    phone VARCHAR(50) NOT NULL)
    ENGINE=INNODB DEFAULT CHARSET=utf8");

$pdo->query("ALTER TABLE employee ADD FOREIGN KEY (emplpos_id) REFERENCES employee_position(id)");

$pdo->query("CREATE TABLE if not exists customer(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    phone VARCHAR(50) NOT NULL)
    ENGINE=INNODB DEFAULT CHARSET=utf8");

$pdo->query("CREATE TABLE if not exists sale(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL REFERENCES product(id),
    customer_id INT NOT NULL REFERENCES customer(id),
    employee_id INT NOT NULL REFERENCES employee(id),
    sdate DATE NOT NULL,
    price DECIMAL NOT NULL)
    ENGINE=INNODB DEFAULT CHARSET=utf8");

$pdo->query("ALTER TABLE sale
    ADD FOREIGN KEY (product_id) REFERENCES product(id),
    ADD FOREIGN KEY (customer_id) REFERENCES customer(id),
    ADD FOREIGN KEY (employee_id) REFERENCES employee(id)");

$pdo->query("CREATE TABLE if not exists supplier(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    eik VARCHAR(50) NOT NULL)
    ENGINE=INNODB DEFAULT CHARSET=utf8");

$pdo->query("CREATE TABLE if not exists delivery(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL REFERENCES product(id),
    group_id INT NOT NULL REFERENCES groupp(id),
    price DECIMAL NOT NULL,
    quantity INT NOT NULL,
    supplier_id INT NOT NULL REFERENCES supplier(id))
    ENGINE=INNODB DEFAULT CHARSET=utf8");

$pdo->query("ALTER TABLE delivery
    ADD FOREIGN KEY (product_id) REFERENCES product(id),
    ADD FOREIGN KEY (group_id) REFERENCES groupp(id),
    ADD FOREIGN KEY (supplier_id) REFERENCES supplier(id)");

?>