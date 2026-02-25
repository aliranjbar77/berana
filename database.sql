-- ساخت دیتابیس
CREATE DATABASE IF NOT EXISTS borana_shoes;

-- استفاده از دیتابیس
USE borana_shoes;

-- ساخت جدول محصولات
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    price INT NOT NULL,
    image VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ساخت جدول سفارشات
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

-- افزودن چند محصول نمونه
INSERT INTO products (name, price, image) VALUES
('کفش ورزشی مردانه مدل Nike Air', 2500000, 'shoe1.jpg'),
('کفش رسمی مردانه مدل Oxford', 1800000, 'shoe2.jpg'),
('کفش روزمره زنانه مدل Comfort', 1200000, 'shoe3.jpg'),
('کفش کتانی مدل Casual', 990000, 'shoe4.jpg'),
('کفش بوت مردانه مدل Leather', 3200000, 'shoe5.jpg');
