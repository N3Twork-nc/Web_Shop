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
  category_id INT NOT NULL,
  color ENUM('red', 'pink', 'yellow', 'green', 'blue', 'beige', 'white', 'black', 'brown', 'gray'),
  update_latest DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  product_state ENUM('active', 'disabled') NOT NULL,
  FOREIGN KEY (`category_id`) REFERENCES `Categories`(`category_id`)
);
DROP TABLE IF EXISTS `ProductImages`;

CREATE TABLE ProductImages(
  product_code VARCHAR(50),
  ordinal_number VARCHAR(50),
  image VARCHAR(200) NOT NULL,
  PRIMARY KEY (product_code, ordinal_number),
  FOREIGN KEY (`product_code`) REFERENCES `Products`(`product_code`) ON DELETE CASCADE
);

DROP TABLE IF EXISTS `ProductSizes`;

CREATE TABLE ProductSizes(
  product_code VARCHAR(50),
  size ENUM('S', 'M', 'L', 'XL', 'XXL'), 
  quantity INT DEFAULT 0,
  PRIMARY KEY (product_code, size),
  FOREIGN KEY (`product_code`) REFERENCES `Products`(`product_code`) ON DELETE CASCADE
);
DROP TABLE IF EXISTS `Customers`;

CREATE TABLE Customers (
  username VARCHAR(100) PRIMARY KEY,
  password VARCHAR(100) NOT NULL,
  full_name NVARCHAR(150) NOT NULL,
  address NVARCHAR(150) NOT NULL,
  phone VARCHAR(20),
  email VARCHAR(100) NOT NULL,
  random_code VARCHAR(20),
  token VARCHAR(255)
);
DROP TABLE IF EXISTS `ShoppingCart`;

CREATE TABLE ShoppingCart (
  cart_code VARCHAR(150) PRIMARY KEY,
  username VARCHAR(100) NOT NULL,
  total_price DECIMAL(10,2) DEFAULT 0,
  update_latest DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`username`) REFERENCES `Customers`(`username`) ON DELETE CASCADE
);
DROP TABLE IF EXISTS `CartItems`;

CREATE TABLE CartItems (
  cart_item_id INT PRIMARY KEY AUTO_INCREMENT,
  cart_code VARCHAR(150),
  product_code VARCHAR(50),
  quantity INT NOT NULL,
  size ENUM('S', 'M', 'L', 'XL', 'XXL'),
  total_price DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (`cart_code`) REFERENCES `ShoppingCart`(`cart_code`) ON DELETE CASCADE,
  FOREIGN KEY (`product_code`) REFERENCES `Products`(`product_code`) ON DELETE CASCADE
);

DROP TABLE IF EXISTS `Orders`;

CREATE TABLE Orders (
  order_code VARCHAR(100) PRIMARY KEY,
  order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  state ENUM('pending', 'delivered','delivering', 'cancelled') DEFAULT 'pending',
  total_price DECIMAL(10,2) DEFAULT 0,
  username VARCHAR(100),
  FOREIGN KEY (`username`) REFERENCES `Customers`(`username`) ON DELETE CASCADE
);
DROP TABLE IF EXISTS `OrderItems`;

CREATE TABLE OrderItems (
  order_item_id INT PRIMARY KEY AUTO_INCREMENT,
  order_code VARCHAR(100),
  product_code VARCHAR(50),
  quantity INT NOT NULL,
  size ENUM('S', 'M', 'L', 'XL', 'XXL'),
  total_price DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (`order_code`) REFERENCES `Orders`(`order_code`) ON DELETE CASCADE,
  FOREIGN KEY (`product_code`) REFERENCES `Products`(`product_code`) ON DELETE CASCADE
);

DROP TABLE IF EXISTS `Payment`;

CREATE TABLE Payment (
  payment_code VARCHAR(50) PRIMARY KEY,
  payment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  order_code VARCHAR(100),
  type ENUM('cash', 'bank_transfer'),
  FOREIGN KEY (`order_code`) REFERENCES `Orders`(`order_code`) ON DELETE CASCADE
); 

DROP TABLE IF EXISTS `OrdersHistory`;

CREATE TABLE OrdersHistory (
  history_id INT PRIMARY KEY AUTO_INCREMENT,
  payment_code VARCHAR(50),
  payment_date DATETIME,
  payment_type ENUM('cash', 'bank_transfer'),
  order_code VARCHAR(100),
  state ENUM('pending', 'delivered','delivering', 'cancelled'),
  username VARCHAR(100),
  address NVARCHAR(150),
  phone VARCHAR(20),
  total_price DECIMAL(10,2)
); 

DROP TABLE IF EXISTS `OrdersHistoryItems`;

CREATE TABLE OrdersHistoryItems (
  history_detail_id INT PRIMARY KEY AUTO_INCREMENT,
  history_id INT,
  product_code VARCHAR(50),
  quantity INT,
  size ENUM('S', 'M', 'L', 'XL', 'XXL'),
  total_price DECIMAL(10,2),
  FOREIGN KEY (`history_id`) REFERENCES `OrdersHistory`(`history_id`)
); 
DROP TABLE IF EXISTS `AdminAccounts`;

CREATE TABLE AdminAccounts (
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

INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Áo sơ mi nữ', 3);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Áo thun nữ', 3);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Áo len nữ', 3);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Quần jeans nữ', 4);
INSERT INTO `Categories`(`name`, `parent_category_id`) VALUES ('Quần short nữ', 4);

INSERT INTO `Discounts`(discount_code, percent, state_discount_code) VALUES('DCODE', 0, 'active');

INSERT INTO `Products`(`product_code`, `name`, `description`, `price`, `category_id`, `color`, `product_state`) VALUES ('P001','Áo Sơ Mi Cổ Trái Tim','như shit', 100, 9, 'green', 'active');
INSERT INTO `Products`(`product_code`, `name`, `description`, `price`, `category_id`, `color`, `product_state`) VALUES ('P002','Áo Sơ Mi Lụa Cổ V','như shit', 100, 9, 'beige', 'active');
INSERT INTO `Products`(`product_code`, `name`, `description`, `price`, `category_id`, `color`, `product_state`) VALUES ('P003','Áo Sơ Mi Dây Rút Eo','như shit', 100, 9, 'blue', 'active');

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

INSERT INTO `ProductImages`(`product_code`, `ordinal_number`, `image`) VALUES ('P001', 'first', '/public/products/2023/11/06/img1699259052.jpeg');
INSERT INTO `ProductImages`(`product_code`, `ordinal_number`, `image`) VALUES ('P001', 'second', '/public/products/2023/11/06/img1699259053.jpeg');
INSERT INTO `ProductImages`(`product_code`, `ordinal_number`, `image`) VALUES ('P001', 'third', '/public/products/2023/11/06/img1699259054.jpeg');
INSERT INTO `ProductImages`(`product_code`, `ordinal_number`, `image`) VALUES ('P001', 'fourth', '/public/products/2023/11/06/img1699259055.jpeg');

INSERT INTO `ProductImages`(`product_code`, `ordinal_number`, `image`) VALUES ('P002', 'first','/public/products/2023/11/06/img1699259052.jpeg');
INSERT INTO `ProductImages`(`product_code`, `ordinal_number`, `image`) VALUES ('P002', 'second', '/public/products/2023/11/06/img1699259053.jpeg');
INSERT INTO `ProductImages`(`product_code`, `ordinal_number`, `image`) VALUES ('P002', 'third', '/public/products/2023/11/06/img1699259054.jpeg');
INSERT INTO `ProductImages`(`product_code`, `ordinal_number`, `image`) VALUES ('P002', 'fourth', '/public/products/2023/11/06/img1699259055.jpeg');

INSERT INTO `ProductImages`(`product_code`, `ordinal_number`, `image`) VALUES ('P003', 'first', '/public/products/2023/11/06/img1699259052.jpeg');
INSERT INTO `ProductImages`(`product_code`, `ordinal_number`, `image`) VALUES ('P003', 'second', '/public/products/2023/11/06/img1699259053.jpeg');
INSERT INTO `ProductImages`(`product_code`, `ordinal_number`, `image`) VALUES ('P003', 'third', '/public/products/2023/11/06/img1699259054.jpeg');
INSERT INTO `ProductImages`(`product_code`, `ordinal_number`, `image`) VALUES ('P003', 'fourth', '/public/products/2023/11/06/img1699259055.jpeg');

INSERT INTO `Customers`(`username`, `password`, `full_name`, `address`, `phone`, `email`) VALUES ('tuatua','123','Lê Văn Tèo','Phường Phú Thạnh, Quận Gò Vấp, Thành phố Hồ Chí Minh','0707888555','n20dcat011@student.ptithcm.edu.vn');
INSERT INTO `Customers`(`username`, `password`, `full_name`, `address`, `phone`, `email`) VALUES ('sieunhan','123','Lê Siêu Nhân','Phường Phú Thạnh, Quận Gò Vấp, Thành phố Hồ Chí Minh','0707888555','n20dcat011@student.ptithcm.edu.vn');

INSERT INTO `ShoppingCart`(`cart_code`, `username`) VALUES ('tuatua_cart_edc3d04ab475f595df9592f977d8dab95a085a53','tuatua');
INSERT INTO `ShoppingCart`(`cart_code`, `username`) VALUES ('sieunhan_cart_a535da5f10c0d335cad1b6450dfa9737c74bd47a','sieunhan');

INSERT INTO `Orders`(`order_code`, `state`, `total_price`, `username`) VALUES ('order_1','delivered',400,'tuatua');
INSERT INTO `Orders`(`order_code`, `state`, `total_price`, `username`) VALUES ('order_2','pending',600,'sieunhan');
INSERT INTO `Orders`(`order_code`, `state`, `total_price`, `username`) VALUES ('order_3','cancelled',400,'sieunhan');

INSERT INTO `OrderItems`(`order_code`, `product_code`, `quantity`, `size`, `total_price`) VALUES ('order_1','P001',2,'S',200);
INSERT INTO `OrderItems`(`order_code`, `product_code`, `quantity`, `size`, `total_price`) VALUES ('order_1','P002',2,'L',200);
INSERT INTO `OrderItems`(`order_code`, `product_code`, `quantity`, `size`, `total_price`) VALUES ('order_2','P002',3,'L',300);
INSERT INTO `OrderItems`(`order_code`, `product_code`, `quantity`, `size`, `total_price`) VALUES ('order_2','P003',3,'M',300);
INSERT INTO `OrderItems`(`order_code`, `product_code`, `quantity`, `size`, `total_price`) VALUES ('order_3','P003',4,'L',400);

INSERT INTO `Payment`(`payment_code`, `order_code`, `type`) VALUES ('payment_1','order_1','bank_transfer');

INSERT INTO `OrdersHistory`(`payment_code`, `payment_date`, `payment_type`, `order_code`, `state`, `username`, `address`, `phone`, `total_price`) VALUES ('payment_1',CURRENT_TIMESTAMP,'bank_transfer','order_1','delivered','tuatua','Phường Phú Thạnh, Quận Gò Vấp, Thành phố Hồ Chí Minh','0707888555',400);
INSERT INTO `OrdersHistory`(`order_code`, `state`, `username`, `address`, `phone`, `total_price`) VALUES ('order_3','cancelled','sieunhan','Phường Phú Thạnh, Quận Gò Vấp, Thành phố Hồ Chí Minh','0707888555',400);

INSERT INTO `OrdersHistoryItems`(`history_id`, `product_code`, `quantity`, `size`, `total_price`) VALUES (1,'P001',2,'S', 200);
INSERT INTO `OrdersHistoryItems`(`history_id`, `product_code`, `quantity`, `size`, `total_price`) VALUES (1,'P002',2,'L', 200);
INSERT INTO `OrdersHistoryItems`(`history_id`, `product_code`, `quantity`, `size`, `total_price`) VALUES (2,'P003',4,'L', 400);

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