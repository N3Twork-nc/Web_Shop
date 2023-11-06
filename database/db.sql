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
  state_discount_code ENUM('active', 'inactive', 'expire')
);
DROP TABLE IF EXISTS `Products`;

CREATE TABLE Products (
  product_code VARCHAR(50) PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description NVARCHAR(400) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  category_id INT,
  color ENUM('red', 'pink', 'yellow', 'green', 'blue', 'beige', 'white', 'black', 'brown', 'gray'),
  update_latest DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `Categories`(`category_id`)
);
DROP TABLE IF EXISTS `ProductImages`;

CREATE TABLE ProductImages(
  product_image_id INT PRIMARY KEY AUTO_INCREMENT,
  product_code VARCHAR(50),
  image VARCHAR(200),
  FOREIGN KEY (`product_code`) REFERENCES `Products`(`product_code`)
);

DROP TABLE IF EXISTS `ProductSizes`;

CREATE TABLE ProductSizes(
  product_size_id INT PRIMARY KEY AUTO_INCREMENT,
  product_code VARCHAR(50),
  size ENUM('S', 'M', 'L', 'XL', 'XXL'), 
  quantity INT DEFAULT 0,
  FOREIGN KEY (`product_code`) REFERENCES `Products`(`product_code`)
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

INSERT INTO `Categories`(`name`) VALUES ('Áo nam');
INSERT INTO `Categories`(`name`) VALUES ('Quần nam');
INSERT INTO `Categories`(`name`) VALUES ('Áo nữ');
INSERT INTO `Categories`(`name`) VALUES ('Quần nữ');
INSERT INTO `Categories`(`name`) VALUES ('Áo bé trai');
INSERT INTO `Categories`(`name`) VALUES ('Quần bé trai');
INSERT INTO `Categories`(`name`) VALUES ('Áo bé gái');
INSERT INTO `Categories`(`name`) VALUES ('Quần bé gái');

INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Áo sơ mi nam', 1);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Áo thun nam', 1);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Áo len nam', 1);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Quần jeans nam', 2);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Quần short nam', 2);

INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Áo sơ nữ', 3);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Áo thun nữ', 3);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Áo len nữ', 3);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Quần jeans nữ', 4);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Quần short nữ', 4);

INSERT INTO `Discounts`(discount_code, percent, state_discount_code) VALUES('DCODE', 0, 'active');

INSERT INTO `Products`(`product_code`, `name`, `description`, `price`, `category_id`, `color`) VALUES ('P001','Áo Sơ Mi Cổ Trái Tim','như shit', 100, 9, 'green');
INSERT INTO `Products`(`product_code`, `name`, `description`, `price`, `category_id`, `color`) VALUES ('P002','Áo Sơ Mi Lụa Cổ V','như shit', 100, 9, 'beige');
INSERT INTO `Products`(`product_code`, `name`, `description`, `price`, `category_id`, `color`) VALUES ('P003','Áo Sơ Mi Dây Rút Eo','như shit', 100, 9, 'blue');

INSERT INTO `ProductSizes`(`product_code`, `size`, `quantity`) VALUES ('P001','S',5);
INSERT INTO `ProductSizes`(`product_code`, `size`, `quantity`) VALUES ('P001','M',6);
INSERT INTO `ProductSizes`(`product_code`, `size`, `quantity`) VALUES ('P001','L',7);
INSERT INTO `ProductSizes`(`product_code`, `size`, `quantity`) VALUES ('P001','XL',8);
INSERT INTO `ProductSizes`(`product_code`, `size`, `quantity`) VALUES ('P001','XXL',9);

INSERT INTO `ProductSizes`(`product_code`, `size`, `quantity`) VALUES ('P002','S',5);
INSERT INTO `ProductSizes`(`product_code`, `size`, `quantity`) VALUES ('P002','M',6);
INSERT INTO `ProductSizes`(`product_code`, `size`, `quantity`) VALUES ('P002','L',7);
INSERT INTO `ProductSizes`(`product_code`, `size`, `quantity`) VALUES ('P002','XL',8);
INSERT INTO `ProductSizes`(`product_code`, `size`, `quantity`) VALUES ('P002','XXL',9);

INSERT INTO `ProductSizes`(`product_code`, `size`, `quantity`) VALUES ('P003','S',5);
INSERT INTO `ProductSizes`(`product_code`, `size`, `quantity`) VALUES ('P003','M',6);
INSERT INTO `ProductSizes`(`product_code`, `size`, `quantity`) VALUES ('P003','L',7);
INSERT INTO `ProductSizes`(`product_code`, `size`, `quantity`) VALUES ('P003','XL',8);
INSERT INTO `ProductSizes`(`product_code`, `size`, `quantity`) VALUES ('P003','XXL',9);

INSERT INTO `ProductImages`(`product_code`, `image`) VALUES ('P001','./public/products/2023/11/06/img1699259052.jpeg');
INSERT INTO `ProductImages`(`product_code`, `image`) VALUES ('P001','./public/products/2023/11/06/img1699259053.jpeg');
INSERT INTO `ProductImages`(`product_code`, `image`) VALUES ('P001','./public/products/2023/11/06/img1699259054.jpeg');
INSERT INTO `ProductImages`(`product_code`, `image`) VALUES ('P001','./public/products/2023/11/06/img1699259055.jpeg');

INSERT INTO `ProductImages`(`product_code`, `image`) VALUES ('P002','./public/products/2023/11/06/img1699259052.jpeg');
INSERT INTO `ProductImages`(`product_code`, `image`) VALUES ('P002','./public/products/2023/11/06/img1699259053.jpeg');
INSERT INTO `ProductImages`(`product_code`, `image`) VALUES ('P002','./public/products/2023/11/06/img1699259054.jpeg');
INSERT INTO `ProductImages`(`product_code`, `image`) VALUES ('P002','./public/products/2023/11/06/img1699259055.jpeg');

INSERT INTO `ProductImages`(`product_code`, `image`) VALUES ('P003','./public/products/2023/11/06/img1699259052.jpeg');
INSERT INTO `ProductImages`(`product_code`, `image`) VALUES ('P003','./public/products/2023/11/06/img1699259053.jpeg');
INSERT INTO `ProductImages`(`product_code`, `image`) VALUES ('P003','./public/products/2023/11/06/img1699259054.jpeg');
INSERT INTO `ProductImages`(`product_code`, `image`) VALUES ('P003','./public/products/2023/11/06/img1699259055.jpeg');

-- SP LOAD PRODUCT
DROP PROCEDURE IF EXISTS `GetProducts`;

DELIMITER //
CREATE PROCEDURE GetProducts()
BEGIN
  SELECT P.*, C.name AS 'category_name' FROM Products AS P, Categories AS C 
  WHERE P.category_id = C.category_id;
END;
//
DELIMITER ;

-- CALL GetProducts();
DROP PROCEDURE IF EXISTS `GetSizesProduct`;

DELIMITER //
CREATE PROCEDURE GetSizesProduct(IN product_code VARCHAR(50))
BEGIN
  SELECT PS.* FROM Products AS P, ProductSizes AS PS
  WHERE P.product_code = PS.product_code AND P.product_code = product_code;
END;
//
DELIMITER ;

-- CALL GetSizesProduct('P001');
DROP PROCEDURE IF EXISTS `GetImagesProduct`;

DELIMITER //
CREATE PROCEDURE GetImagesProduct(IN product_code VARCHAR(50))
BEGIN
  SELECT PI.* FROM Products AS P, ProductImages AS PI 
  WHERE P.product_code = PI.product_code AND P.product_code = product_code;
END;
//
DELIMITER ;

-- CALL GetImagesProduct('P001');