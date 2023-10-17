CREATE DATABASE IF NOT EXISTS ptit_shop;

USE ptit_shop;
DROP TABLE IF EXISTS `Products`;

CREATE TABLE Products (
  product_code VARCHAR(20) PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description TEXT,
  price DECIMAL(10,2) NOT NULL,
  discount_code VARCHAR(10),
  size_id INT,
  type ENUM('nam', 'nữ', 'bé trai', 'bé gái'), 
  category_id INT,
  color_id INT,
  image VARCHAR(255),
  quantity INT DEFAULT 0,
  update_lastest DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS `Categories`;

CREATE TABLE Categories (
  category_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  parent_category_id INT
);

DROP TABLE IF EXISTS `Customers`;

CREATE TABLE Customers (
  customer_id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  full_name VARCHAR(100),
  address VARCHAR(255),
  phone VARCHAR(20),
  email VARCHAR(255),
  random_code VARCHAR(20),
  token VARCHAR(255)
);
DROP TABLE IF EXISTS `Orders`;

CREATE TABLE Orders (
  order_code VARCHAR(20) PRIMARY KEY,
  customer_id INT,
  order_date DATETIME,
  state ENUM('pending', 'processing', 'delivered'),
  total_price DECIMAL(10,2) NOT NULL,
  payment_code VARCHAR(50)
);
DROP TABLE IF EXISTS `OrderDetails`;

CREATE TABLE OrderDetails (
  order_detail_id INT PRIMARY KEY AUTO_INCREMENT,
  order_code VARCHAR(20),
  product_code VARCHAR(20),
  quantity INT NOT NULL,
  total_price DECIMAL(10,2) NOT NULL
); 
DROP TABLE IF EXISTS `Discounts`;

CREATE TABLE Discounts (
  discount_code VARCHAR(10) PRIMARY KEY,
  percent INT NOT NULL,
  state ENUM('active', 'inactive', 'expire')
);
DROP TABLE IF EXISTS `Payment`;

CREATE TABLE Payment (
  payment_code VARCHAR(50) PRIMARY KEY,
  payment_date DATETIME NOT NULL,
  type ENUM('cash', 'bank_transfer')
);
DROP TABLE IF EXISTS `ProductReviews`;

CREATE TABLE ProductReviews (
  review_id INT PRIMARY KEY AUTO_INCREMENT,
  product_code VARCHAR(20),
  customer_id INT,
  rating TINYINT NOT NULL,
  comment TEXT
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