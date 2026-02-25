<?php
echo "PHP کار می‌کنه!";
echo "<br>";
echo "ورژن PHP: " . phpversion();
echo "<br>";
echo "MySQL اتصال: ";
try {
    $pdo = new PDO("mysql:host=beranashop;port=3306;dbname=musing_bartik;charset=utf8mb4", "root", "fHtN4xVh7LI99F6PRSYoO5xB");
    echo "✅ موفق";
} catch(PDOException $e) {
    echo "❌ خطا: " . $e->getMessage();
}
?>
