<?php
session_start();

function envValue($key, $default = null)
{
    $value = getenv($key);
    if ($value === false || $value === '') {
        return $default;
    }
    return $value;
}

function envBool($key, $default = false)
{
    $value = envValue($key, null);
    if ($value === null) {
        return $default;
    }
    return filter_var($value, FILTER_VALIDATE_BOOLEAN);
}

$isDebug = envBool('DEBUG', false);

// Admin login config
$adminUser = envValue('ADMIN_USER', 'admin');
$adminPass = envValue('ADMIN_PASS', 'change-this-password');

// MySQL config (prefer env vars)
$host = envValue('DB_HOST', envValue('MYSQL_HOST', 'beranashop'));
$port = envValue('DB_PORT', envValue('MYSQL_PORT', '3306'));
$dbname = envValue('DB_NAME', envValue('MYSQL_DATABASE', 'musing_bartik'));
$username = envValue('DB_USER', envValue('MYSQL_USER', 'root'));
$password = envValue('DB_PASS', envValue('MYSQL_PASSWORD', ''));

// Optional DATABASE_URL support: mysql://user:pass@host:port/dbname
$databaseUrl = envValue('DATABASE_URL', null);
if ($databaseUrl) {
    $parts = parse_url($databaseUrl);
    if ($parts && isset($parts['scheme']) && strtolower($parts['scheme']) === 'mysql') {
        $host = $parts['host'] ?? $host;
        $port = isset($parts['port']) ? (string)$parts['port'] : $port;
        $dbname = isset($parts['path']) ? ltrim($parts['path'], '/') : $dbname;
        $username = $parts['user'] ?? $username;
        $password = $parts['pass'] ?? $password;
    }
}

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    if ($isDebug) {
        die("Database connection failed: " . $e->getMessage());
    }
    die("Database connection failed. Check DB env variables.");
}

// Create tables if they do not exist
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

function getProducts()
{
    global $pdo;
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

function addProduct($name, $price, $image)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO products (name, price, image) VALUES (?, ?, ?)");
    return $stmt->execute([$name, $price, $image]);
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

if ($action === 'admin_login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameInput = $_POST['username'] ?? '';
    $passwordInput = $_POST['password'] ?? '';

    if ($usernameInput === $adminUser && $passwordInput === $adminPass) {
        $_SESSION['is_admin'] = true;
        header('Location: index.php?action=admin');
        exit;
    }

    $_SESSION['admin_error'] = 'Invalid admin username or password.';
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
