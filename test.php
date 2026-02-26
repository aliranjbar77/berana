<?php
function envValue($key, $default = null)
{
    $value = getenv($key);
    if ($value === false || $value === '') {
        return $default;
    }
    return $value;
}

$host = envValue('DB_HOST', envValue('MYSQL_HOST', 'beranashop'));
$port = envValue('DB_PORT', envValue('MYSQL_PORT', '3306'));
$dbname = envValue('DB_NAME', envValue('MYSQL_DATABASE', 'musing_bartik'));
$username = envValue('DB_USER', envValue('MYSQL_USER', 'root'));
$password = envValue('DB_PASS', envValue('MYSQL_PASSWORD', ''));

echo "PHP is running!";
echo "<br>PHP version: " . phpversion();
echo "<br>MySQL connection: ";

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );
    echo "OK";
} catch (PDOException $e) {
    echo "FAILED: " . $e->getMessage();
}
?>
