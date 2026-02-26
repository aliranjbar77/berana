CREATE DATABASE IF NOT EXISTS musing_bartik
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE musing_bartik;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    price INT NOT NULL,
    image VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address TEXT NOT NULL,
    product_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_processed BOOLEAN DEFAULT 0,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

INSERT INTO products (name, price, image) VALUES
('Nike Air Black', 2500000, 'shoe1.jpg'),
('Oxford Formal', 1800000, 'shoe2.jpg'),
('Women Comfort', 1200000, 'shoe3.jpg'),
('Casual Sneaker', 990000, 'shoe4.jpg'),
('Leather Boot', 3200000, 'shoe5.jpg');
