CREATE DATABASE IF NOT EXISTS ptit_shop;

USE ptit_shop;
DROP TABLE IF EXISTS `Categories`;

CREATE TABLE Categories (
  category_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  parent_category_id INT,
  FOREIGN KEY (`parent_category_id`) REFERENCES `Categories`(`category_id`)
);
DROP TABLE IF EXISTS `Discounts`;

CREATE TABLE Discounts (
  discount_code VARCHAR(30) PRIMARY KEY,
  percent INT NOT NULL,
  state ENUM('active', 'inactive', 'expire')
);
DROP TABLE IF EXISTS `Products`;

CREATE TABLE Products (
  product_code VARCHAR(50) PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description NVARCHAR(400) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  discount_code VARCHAR(30),
  category_id INT,
  quantity INT DEFAULT 0,
  update_latest DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`discount_code`) REFERENCES `Discounts`(`discount_code`),
  FOREIGN KEY (`category_id`) REFERENCES `Categories`(`category_id`)
);
DROP TABLE IF EXISTS `ProductColors`;

CREATE TABLE ProductColors(
  product_colors_id INT PRIMARY KEY AUTO_INCREMENT,
  product_code VARCHAR(50),
  color ENUM('Đỏ', 'Hồng', 'Vàng', 'Xanh lá', 'Xanh lam', 'Be', 'Trắng', 'Đen', 'Nâu', 'Xám'), 
  FOREIGN KEY (`product_code`) REFERENCES `Products`(`product_code`)
);
DROP TABLE IF EXISTS `ProductImages`;

CREATE TABLE ProductImages(
  product_image_id INT PRIMARY KEY AUTO_INCREMENT,
  product_colors_id INT,
  image VARCHAR(200),
  FOREIGN KEY (`product_colors_id`) REFERENCES `ProductColors`(`product_colors_id`)
);
DROP TABLE IF EXISTS `ProductSizes`;

CREATE TABLE ProductSizes(
  product_size_id INT PRIMARY KEY AUTO_INCREMENT,
  product_colors_id INT,
  size ENUM('S', 'M', 'L', 'XL', 'XXL'), 
  quantity INT DEFAULT 0,
  FOREIGN KEY (`product_colors_id`) REFERENCES `ProductColors`(`product_colors_id`)
);
DROP TABLE IF EXISTS `Customers`;

CREATE TABLE Customers (
  customer_id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(200) NOT NULL,
  password VARCHAR(255) NOT NULL,
  full_name NVARCHAR(200) NOT NULL,
  address NVARCHAR(255) NOT NULL,
  phone VARCHAR(20),
  email VARCHAR(255),
  random_code VARCHAR(20),
  token VARCHAR(255)
);
DROP TABLE IF EXISTS `ShoppingCart`;

CREATE TABLE ShoppingCart (
  cart_id INT PRIMARY KEY AUTO_INCREMENT,
  customer_id INT,
  product_code VARCHAR(50),
  quantity INT NOT NULL,
  total_price DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (`customer_id`) REFERENCES `Customers`(`customer_id`),
  FOREIGN KEY (`customer_id`) REFERENCES `Customers`(`customer_id`)
);
DROP TABLE IF EXISTS `Orders`;

CREATE TABLE Orders (
  order_code VARCHAR(50) PRIMARY KEY,
  cart_id INT,
  order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  state ENUM('pending', 'processing', 'delivered'),
  total_price DECIMAL(10,2),
  payment_code VARCHAR(50),
  FOREIGN KEY (`cart_id`) REFERENCES `ShoppingCart`(`cart_id`)
);
DROP TABLE IF EXISTS `OrderDetails`;

CREATE TABLE OrderDetails (
  order_detail_id INT PRIMARY KEY AUTO_INCREMENT,
  order_code VARCHAR(50),
  product_code VARCHAR(50),
  quantity INT NOT NULL,
  total_price DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (`order_code`) REFERENCES `Orders`(`order_code`),
  FOREIGN KEY (`product_code`) REFERENCES `Products`(`product_code`)
);
DROP TABLE IF EXISTS `Payment`;

CREATE TABLE Payment (
  payment_code VARCHAR(50) PRIMARY KEY,
  payment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  order_code VARCHAR(50),
  type ENUM('cash', 'bank_transfer'),
  FOREIGN KEY (`order_code`) REFERENCES `Orders`(`order_code`)
); 
DROP TABLE IF EXISTS `ProductReviews`;

CREATE TABLE ProductReviews (
  review_id INT PRIMARY KEY AUTO_INCREMENT,
  product_code VARCHAR(50),
  customer_id INT,
  rating TINYINT NOT NULL,
  comment TEXT,
  FOREIGN KEY (`product_code`) REFERENCES `Products`(`product_code`),
  FOREIGN KEY (`customer_id`) REFERENCES `Customers`(`customer_id`)
);
DROP TABLE IF EXISTS `AdminAccounts`;

CREATE TABLE AdminAccounts (
  admin_id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL, 
  role ENUM('admin', 'manager', 'staff') NOT NULL
);

INSERT INTO AdminAccounts (username, password, role) VALUES('moros', '123', 'admin');
INSERT INTO AdminAccounts (username, password, role) VALUES('teo', '123', 'staff');

INSERT INTO `Categories`(`name`) VALUES ('Nam');
INSERT INTO `Categories`(`name`) VALUES ('Nữ');
INSERT INTO `Categories`(`name`) VALUES ('Bé gái');
INSERT INTO `Categories`(`name`) VALUES ('Bé trai');

INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Áo bé gái', 3);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Quần bé gái', 3);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Áo bé trai', 4);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Quần bé trai', 4);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Áo nam', 1);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Quần nam', 1);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Áo nữ', 2);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Quần nữ', 2);

INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Áo sơ nam', 9);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Áo thun nam', 9);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Áo len nam', 9);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Quần jeans nam', 10);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Quần short nam', 10);

INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Áo sơ nữ', 11);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Áo thun nữ', 11);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Áo len nữ', 11);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Quần jeans nữ', 12);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Quần short nữ', 12);

INSERT INTO `Discounts`(discount_code, percent, state) VALUES('DCODE', 0, 'active');

INSERT INTO `Products`(`product_code`, `name`, `description`, `price`, `discount_code`,`category_id`, `quantity`) VALUES ('P001','Áo Sơ Mi Cổ Trái Tim','như shit',100,'DCODE',13,105);

INSERT INTO `ProductColors`(`product_code`, `color`) VALUES ('P001','Xanh lá');
INSERT INTO `ProductColors`(`product_code`, `color`) VALUES ('P001','Xanh lam');
INSERT INTO `ProductColors`(`product_code`, `color`) VALUES ('P001','Be');

INSERT INTO `ProductSizes`(`product_colors_id`, `size`, `quantity`) VALUES (1,'S',5);
INSERT INTO `ProductSizes`(`product_colors_id`, `size`, `quantity`) VALUES (1,'M',6);
INSERT INTO `ProductSizes`(`product_colors_id`, `size`, `quantity`) VALUES (1,'L',7);
INSERT INTO `ProductSizes`(`product_colors_id`, `size`, `quantity`) VALUES (1,'XL',8);
INSERT INTO `ProductSizes`(`product_colors_id`, `size`, `quantity`) VALUES (1,'XXL',9);

INSERT INTO `ProductSizes`(`product_colors_id`, `size`, `quantity`) VALUES (2,'S',5);
INSERT INTO `ProductSizes`(`product_colors_id`, `size`, `quantity`) VALUES (2,'M',6);
INSERT INTO `ProductSizes`(`product_colors_id`, `size`, `quantity`) VALUES (2,'L',7);
INSERT INTO `ProductSizes`(`product_colors_id`, `size`, `quantity`) VALUES (2,'XL',8);
INSERT INTO `ProductSizes`(`product_colors_id`, `size`, `quantity`) VALUES (2,'XXL',9);

INSERT INTO `ProductSizes`(`product_colors_id`, `size`, `quantity`) VALUES (3,'S',5);
INSERT INTO `ProductSizes`(`product_colors_id`, `size`, `quantity`) VALUES (3,'M',6);
INSERT INTO `ProductSizes`(`product_colors_id`, `size`, `quantity`) VALUES (3,'L',7);
INSERT INTO `ProductSizes`(`product_colors_id`, `size`, `quantity`) VALUES (3,'XL',8);
INSERT INTO `ProductSizes`(`product_colors_id`, `size`, `quantity`) VALUES (3,'XXL',9);

INSERT INTO `ProductImages`(`product_colors_id`, `image`) VALUES (1,'img.jpg');
INSERT INTO `ProductImages`(`product_colors_id`, `image`) VALUES (1,'img1.jpg');
INSERT INTO `ProductImages`(`product_colors_id`, `image`) VALUES (1,'img3.jpg');

INSERT INTO `ProductImages`(`product_colors_id`, `image`) VALUES (2,'img.jpg');
INSERT INTO `ProductImages`(`product_colors_id`, `image`) VALUES (2,'img1.jpg');
INSERT INTO `ProductImages`(`product_colors_id`, `image`) VALUES (2,'img3.jpg');

INSERT INTO `ProductImages`(`product_colors_id`, `image`) VALUES (3,'img.jpg');
INSERT INTO `ProductImages`(`product_colors_id`, `image`) VALUES (3,'img1.jpg');
INSERT INTO `ProductImages`(`product_colors_id`, `image`) VALUES (3,'img3.jpg');

-- SP LOAD PRODUCT
DROP PROCEDURE IF EXISTS `GetProducts`;

DELIMITER //
CREATE PROCEDURE GetProducts()
BEGIN
    SELECT P.*, D.percent AS discount_percent, D.state
    FROM Products AS P, Discounts AS D
    WHERE P.discount_code = D.discount_code;
END;
//
DELIMITER ;

--CALL GetProducts();
DROP PROCEDURE IF EXISTS `GetColorsProduct`;

DELIMITER //
CREATE PROCEDURE GetColorsProduct(IN product_code VARCHAR(50))
BEGIN
  SELECT P.product_code, PC.product_colors_id, PC.color 
  FROM Products AS P, ProductColors AS PC 
  WHERE P.product_code = PC.product_code AND P.product_code = product_code;
END;
//
DELIMITER ;

--CALL GetColorsProduct('P001');
DROP PROCEDURE IF EXISTS `GetSizesProduct`;

DELIMITER //
CREATE PROCEDURE GetSizesProduct(IN product_code VARCHAR(50))
BEGIN
  SELECT TMP.*, PS.size, PS.quantity 
  FROM (
    SELECT P.product_code, PC.product_colors_id, PC.color 
    FROM Products AS P, ProductColors AS PC 
    WHERE P.product_code = PC.product_code AND P.product_code = product_code
  ) AS TMP,  ProductSizes AS PS
  WHERE TMP.product_colors_id = PS.product_colors_id;
END;
//
DELIMITER ;

--CALL GetSizesProduct('P001');
DROP PROCEDURE IF EXISTS `GetImagesProduct`;

DELIMITER //
CREATE PROCEDURE GetImagesProduct(IN product_code VARCHAR(50))
BEGIN
  SELECT TMP.*, PI.image 
  FROM (
    SELECT P.product_code, PC.product_colors_id, PC.color 
    FROM Products AS P, ProductColors AS PC 
    WHERE P.product_code = PC.product_code AND P.product_code = product_code
  ) AS TMP,  ProductImages AS PI
  WHERE TMP.product_colors_id = PI.product_colors_id;
END;
//
DELIMITER ;

--CALL GetImagesProduct('P001');