<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت - کفش‌فروشی برانا</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-bag"></i> کفش‌فروشی برانا
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="bi bi-house"></i> ویترین فروشگاه
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=order">
                            <i class="bi bi-cart-plus"></i> ثبت سفارش
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=about">
                            <i class="bi bi-info-circle"></i> درباره ما
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=contact">
                            <i class="bi bi-telephone"></i> تماس با ما
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=admin">
                            <i class="bi bi-gear"></i> مدیریت
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="fade-in">
                <h1 class="hero-title">
                    <i class="bi bi-gear"></i> پنل مدیریت
                </h1>
                <p class="hero-subtitle">مدیریت کامل فروشگاه آنلاین</p>
            </div>
        </div>
    </section>

    <!-- Admin Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- مدیریت محصولات -->
                <div class="col-lg-6 mb-4">
                    <div class="fade-in">
                        <div class="card">
                            <div class="card-body p-4">
                                <h4 class="card-title text-center mb-4">
                                    <i class="bi bi-box"></i> مدیریت محصولات
                                </h4>
                                
                                <!-- افزودن محصول -->
                                <div class="mb-4">
                                    <h5 class="fw-bold mb-3">➕ افزودن محصول جدید</h5>
                                    <?php
                                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
                                        $name = $_POST['product_name'] ?? '';
                                        $price = $_POST['product_price'] ?? '';
                                        
                                        if ($name && $price) {
                                            // آپلود عکس
                                            $image = '';
                                            if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === 0) {
                                                $upload_dir = 'uploads/';
                                                if (!is_dir($upload_dir)) {
                                                    mkdir($upload_dir, 0777, true);
                                                }
                                                $image = time() . '_' . $_FILES['product_image']['name'];
                                                move_uploaded_file($_FILES['product_image']['tmp_name'], $upload_dir . $image);
                                            }
                                            
                                            if (addProduct($name, $price, $image)) {
                                                echo '<div class="alert alert-success fade-in">';
                                                echo '<strong>✅ موفقیت:</strong> محصول با موفقیت اضافه شد!';
                                                echo '</div>';
                                            } else {
                                                echo '<div class="alert alert-danger fade-in">';
                                                echo '<strong>❌ خطا:</strong> مشکلی در افزودن محصول پیش آمد.';
                                                echo '</div>';
                                            }
                                        } else {
                                            echo '<div class="alert alert-danger fade-in">';
                                            echo '<strong>⚠️ خطا:</strong> لطفاً نام و قیمت محصول را وارد کنید.';
                                            echo '</div>';
                                        }
                                    }
                                    ?>
                                    
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="add_product" value="1">
                                        <div class="mb-3">
                                            <label for="product_name" class="form-label fw-bold">
                                                <i class="bi bi-tag"></i> نام کفش
                                            </label>
                                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="نام محصول را وارد کنید" required>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="product_price" class="form-label fw-bold">
                                                <i class="bi bi-currency-dollar"></i> قیمت (تومان)
                                            </label>
                                            <input type="number" class="form-control" id="product_price" name="product_price" placeholder="مثال: 250000" required>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="product_image" class="form-label fw-bold">
                                                <i class="bi bi-image"></i> عکس محصول
                                            </label>
                                            <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*">
                                        </div>
                                        
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary-custom">
                                                <i class="bi bi-plus-circle"></i> افزودن محصول
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                
                                <!-- لیست محصولات -->
                                <div class="mt-4">
                                    <h5 class="fw-bold mb-3">📦 لیست محصولات</h5>
                                    <?php
                                    $products = getProducts();
                                    if (count($products) > 0) {
                                        echo '<div class="table-responsive">';
                                        echo '<table class="table table-striped">';
                                        echo '<thead><tr>';
                                        echo '<th>نام محصول</th>';
                                        echo '<th>قیمت</th>';
                                        echo '<th>عکس</th>';
                                        echo '<th>عملیات</th>';
                                        echo '</tr></thead><tbody>';
                                        
                                        foreach ($products as $product) {
                                            echo '<tr>';
                                            echo '<td>' . $product['name'] . '</td>';
                                            echo '<td>' . number_format($product['price']) . ' تومان</td>';
                                            echo '<td>';
                                            if ($product['image']) {
                                                echo '<img src="uploads/' . $product['image'] . '" alt="' . $product['name'] . '" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">';
                                            } else {
                                                echo '<i class="bi bi-bag" style="font-size: 2rem; color: #667eea;"></i>';
                                            }
                                            echo '</td>';
                                            echo '<td>';
                                            echo '<a href="index.php?action=admin&delete_product=' . $product['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'مطمئن به حذف این محصول هستید؟\')">';
                                            echo '<i class="bi bi-trash"></i> حذف';
                                            echo '</a>';
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                        
                                        echo '</tbody></table>';
                                        echo '</div>';
                                    } else {
                                        echo '<p class="text-muted">محصولی برای نمایش وجود ندارد.</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- مدیریت سفارشات -->
                <div class="col-lg-6 mb-4">
                    <div class="fade-in">
                        <div class="card">
                            <div class="card-body p-4">
                                <h4 class="card-title text-center mb-4">
                                    <i class="bi bi-list-check"></i> مدیریت سفارشات
                                </h4>
                                
                                <?php
                                // حذف محصول
                                if (isset($_GET['delete_product'])) {
                                    $product_id = $_GET['delete_product'];
                                    if (deleteProduct($product_id)) {
                                        echo '<div class="alert alert-success fade-in">';
                                        echo '<strong>✅ موفقیت:</strong> محصول با موفقیت حذف شد!';
                                        echo '</div>';
                                    } else {
                                        echo '<div class="alert alert-danger fade-in">';
                                        echo '<strong>❌ خطا:</strong> مشکلی در حذف محصول پیش آمد.';
                                        echo '</div>';
                                    }
                                }
                                
                                // حذف سفارش
                                if (isset($_GET['delete_order'])) {
                                    $order_id = $_GET['delete_order'];
                                    if (deleteOrder($order_id)) {
                                        echo '<div class="alert alert-success fade-in">';
                                        echo '<strong>✅ موفقیت:</strong> سفارش با موفقیت حذف شد!';
                                        echo '</div>';
                                    } else {
                                        echo '<div class="alert alert-danger fade-in">';
                                        echo '<strong>❌ خطا:</strong> مشکلی در حذف سفارش پیش آمد.';
                                        echo '</div>';
                                    }
                                }
                                
                                $orders = getOrders();
                                if (count($orders) > 0) {
                                    echo '<div class="table-responsive">';
                                    echo '<table class="table table-striped">';
                                    echo '<thead><tr>';
                                    echo '<th>نام مشتری</th>';
                                    echo '<th>تلفن</th>';
                                    echo '<th>محصول</th>';
                                    echo '<th>تاریخ</th>';
                                    echo '<th>عملیات</th>';
                                    echo '</tr></thead><tbody>';
                                    
                                    foreach ($orders as $order) {
                                        echo '<tr>';
                                        echo '<td>' . $order['name'] . '</td>';
                                        echo '<td>' . $order['phone'] . '</td>';
                                        echo '<td>' . $order['product_name'] . '</td>';
                                        echo '<td>' . date('Y/m/d H:i', strtotime($order['created_at'])) . '</td>';
                                        echo '<td>';
                                        echo '<a href="index.php?action=admin&delete_order=' . $order['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'مطمئن به حذف این سفارش هستید؟\')">';
                                        echo '<i class="bi bi-trash"></i> حذف';
                                        echo '</a>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                    
                                    echo '</tbody></table>';
                                    echo '</div>';
                                } else {
                                    echo '<p class="text-muted">سفارشی برای نمایش وجود ندارد.</p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="bi bi-bag"></i> کفش‌فروشی برانا</h5>
                    <p>بهترین کیفیت و طراحی برای شما</p>
                </div>
                <div class="col-md-4">
                    <h5><i class="bi bi-link-45deg"></i> لینک‌های سریع</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-white text-decoration-none">ویترین فروشگاه</a></li>
                        <li><a href="index.php?action=order" class="text-white text-decoration-none">ثبت سفارش</a></li>
                        <li><a href="index.php?action=admin" class="text-white text-decoration-none">پنل مدیریت</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5><i class="bi bi-telephone"></i> تماس با ما</h5>
                    <p>تلفن: 021-12345678</p>
                    <p>موبایل: 0912-3456789</p>
                    <p>ایمیل: info@boranashoes.ir</p>
                </div>
            </div>
            <hr class="bg-white">
            <div class="text-center">
                <p>&copy; 2025 کفش‌فروشی برانا. تمامی حقوق محفوظ است.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
