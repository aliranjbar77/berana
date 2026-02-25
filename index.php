<?php
session_start();

// Admin login config (set these as environment variables in hosting)
$adminUser = getenv('ADMIN_USER') ?: 'admin';
$adminPass = getenv('ADMIN_PASS') ?: 'change-this-password';

const PRODUCT_CATEGORIES = [
    'women' => 'کتونی زنانه',
    'men' => 'کتونی مردانه',
    'set' => 'کتونی ست',
    'sport' => 'کتونی ورزشی',
];

// MySQL connection (Liara-safe defaults + ENV override)
$host = getenv('DB_HOST') ?: 'beranashop';
$port = getenv('DB_PORT') ?: '3306';
$dbname = getenv('DB_NAME') ?: 'musing_bartik';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: 'fHtN4xVh7LI99F6PRSYoO5xB';

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Create tables if they do not exist
$pdo->exec("
    CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(200) NOT NULL,
        price INT NOT NULL,
        image VARCHAR(500),
        category VARCHAR(30) NOT NULL DEFAULT 'women',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
");

$categoryColumn = $pdo->query("SHOW COLUMNS FROM products LIKE 'category'");
if (!$categoryColumn || $categoryColumn->rowCount() === 0) {
    $pdo->exec("ALTER TABLE products ADD COLUMN category VARCHAR(30) NOT NULL DEFAULT 'women' AFTER image");
}

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

function getCategories()
{
    return PRODUCT_CATEGORIES;
}

function normalizeCategory($category)
{
    $category = strtolower(trim((string)$category));
    return array_key_exists($category, PRODUCT_CATEGORIES) ? $category : 'women';
}

function productImagePath($filename)
{
    $safe = basename((string)$filename);
    if ($safe === '') {
        return '';
    }
    return __DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $safe;
}

function productImageUrl($filename)
{
    $safe = basename((string)$filename);
    if ($safe === '') {
        return '';
    }
    return 'index.php?action=image&file=' . rawurlencode($safe);
}

function getProducts($category = null)
{
    global $pdo;
    if ($category !== null && array_key_exists($category, PRODUCT_CATEGORIES)) {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE category = ? ORDER BY created_at DESC");
        $stmt->execute([$category]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    $stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getOrders()
{
    global $pdo;
    $stmt = $pdo->query("
        SELECT o.*, p.name as product_name
        FROM orders o
        JOIN products p ON o.product_id = p.id
        ORDER BY o.created_at DESC
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addProduct($name, $price, $image, $category = 'women')
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO products (name, price, image, category) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$name, $price, $image, normalizeCategory($category)]);
}

function addOrder($name, $phone, $address, $product_id)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO orders (name, phone, address, product_id) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$name, $phone, $address, $product_id]);
}

function deleteProduct($id)
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    return $stmt->execute([$id]);
}

function deleteOrder($id)
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
    return $stmt->execute([$id]);
}

$action = $_GET['action'] ?? 'home';

if ($action === 'image') {
    $file = $_GET['file'] ?? '';
    $path = productImagePath($file);

    if ($path === '' || !is_file($path)) {
        http_response_code(404);
        exit;
    }

    $mime = mime_content_type($path) ?: 'application/octet-stream';
    header('Content-Type: ' . $mime);
    header('Content-Length: ' . filesize($path));
    header('Cache-Control: public, max-age=86400');
    readfile($path);
    exit;
}

if ($action === 'admin_login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameInput = $_POST['username'] ?? '';
    $passwordInput = $_POST['password'] ?? '';

    if ($usernameInput === $adminUser && $passwordInput === $adminPass) {
        $_SESSION['is_admin'] = true;
        header('Location: index.php?action=admin');
        exit;
    }

    $_SESSION['admin_error'] = 'نام کاربری یا رمز عبور اشتباه است.';
    header('Location: index.php?action=admin');
    exit;
}

if ($action === 'admin_logout') {
    unset($_SESSION['is_admin']);
    header('Location: index.php');
    exit;
}

switch ($action) {
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
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
            include 'views/admin_login.php';
            break;
        }
        include 'views/admin.php';
        break;
    default:
        include 'views/home.php';
}
?>
