<?php

// کانکشن به دیتابیس MySQL
$host = 'beranashop';
$port = '3306';
$dbname = 'musing_bartik';
$username = 'root';
$password = 'fHtN4xVh7LI99F6PRSYoO5xB';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// ایجاد جداول (اگر وجود نداشته باشند)
$pdo->exec("
    CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(200) NOT NULL,
        price INT NOT NULL,
        image VARCHAR(500),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
");

$pdo->exec("
    CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(200) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        address TEXT NOT NULL,
        product_id INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        is_processed BOOLEAN DEFAULT 0,
        FOREIGN KEY (product_id) REFERENCES products(id)
    )
");

// دریافت محصولات
function getProducts() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// دریافت سفارشات
function getOrders() {
    global $pdo;
    $stmt = $pdo->query("
        SELECT o.*, p.name as product_name 
        FROM orders o 
        JOIN products p ON o.product_id = p.id 
        ORDER BY o.created_at DESC
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// افزودن محصول
function addProduct($name, $price, $image) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO products (name, price, image) VALUES (?, ?, ?)");
    return $stmt->execute([$name, $price, $image]);
}

// افزودن سفارش
function addOrder($name, $phone, $address, $product_id) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO orders (name, phone, address, product_id) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$name, $phone, $address, $product_id]);
}

// حذف محصول
function deleteProduct($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    return $stmt->execute([$id]);
}

// حذف سفارش
function deleteOrder($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
    return $stmt->execute([$id]);
}

// پردازش درخواست‌ها
$action = $_GET['action'] ?? 'home';

switch($action) {
    case 'home':
        include 'views/home.php';
        break;
    case 'product_detail':
        include 'views/product_detail.php';
        break;
    case 'order':
        include 'views/order.php';
        break;
    case 'about':
        include 'views/about.php';
        break;
    case 'contact':
        include 'views/contact.php';
        break;
    case 'admin':
        include 'views/admin.php';
        break;
    default:
        include 'views/home.php';
}
?>
