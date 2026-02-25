<?php

$host = getenv('DB_HOST') ?: '127.0.0.1';
$port = (int)(getenv('DB_PORT') ?: 3306);
$dbname = getenv('DB_NAME') ?: 'borana_shoes';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: '';

const PRODUCT_CATEGORIES = [
    'women' => 'کتونی زنانه',
    'men' => 'کتونی مردانه',
    'set' => 'کتونی ست',
    'sport' => 'کتونی ورزشی',
];

try {
    $databaseUrl = getenv('DATABASE_URL') ?: getenv('JAWSDB_URL') ?: '';

    if ($databaseUrl !== '') {
        $parts = parse_url($databaseUrl);
        if ($parts !== false) {
            $host = $parts['host'] ?? $host;
            $port = isset($parts['port']) ? (int)$parts['port'] : $port;
            $username = $parts['user'] ?? $username;
            $password = $parts['pass'] ?? $password;
            if (!empty($parts['path'])) {
                $dbname = ltrim($parts['path'], '/');
            }
        }
    }

    $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

$pdo->exec("
    CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(200) NOT NULL,
        price INT NOT NULL,
        image VARCHAR(500),
        category VARCHAR(30) NOT NULL DEFAULT 'women',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
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
    ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
");

function getCategories(): array
{
    return PRODUCT_CATEGORIES;
}

function normalizeCategory(?string $category): string
{
    $category = strtolower(trim((string)$category));
    return array_key_exists($category, PRODUCT_CATEGORIES) ? $category : 'women';
}

function getProducts(?string $category = null): array
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

function getOrders(): array
{
    global $pdo;
    $stmt = $pdo->query("
        SELECT o.*, p.name AS product_name
        FROM orders o
        JOIN products p ON o.product_id = p.id
        ORDER BY o.created_at DESC
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addProduct(string $name, int $price, string $image, string $category): bool
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO products (name, price, image, category) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$name, $price, $image, normalizeCategory($category)]);
}

function addOrder(string $name, string $phone, string $address, int $product_id): bool
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO orders (name, phone, address, product_id) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$name, $phone, $address, $product_id]);
}

function deleteProduct(int $id): bool
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    return $stmt->execute([$id]);
}

function deleteOrder(int $id): bool
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
    return $stmt->execute([$id]);
}

$action = $_GET['action'] ?? 'home';

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
        include 'views/admin.php';
        break;
    default:
        include 'views/home.php';
}
