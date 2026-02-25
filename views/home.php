<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>کفش‌فروشی برانا - جدیدترین مدل‌های روز</title>
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
                    <i class="bi bi-bag"></i> جدیدترین مدل‌های روز
                </h1>
                <p class="hero-subtitle">بهترین کیفیت و طراحی برای شما</p>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-5">
        <div class="container">
            <?php
            $products = getProducts();
            if (count($products) > 0) {
                echo '<div class="row">';
                foreach ($products as $index => $product) {
                    echo '<div class="col-lg-4 col-md-6 mb-4">';
                    echo '<div class="product-card fade-in">';
                    echo '<div class="position-relative overflow-hidden">';
                    
                    if ($product['image']) {
                        echo '<img src="uploads/' . $product['image'] . '" alt="' . $product['name'] . '" class="product-image">';
                    } else {
                        echo '<div class="product-image d-flex align-items-center justify-content-center bg-light">';
                        echo '<i class="bi bi-bag" style="font-size: 3rem; color: #667eea;"></i>';
                        echo '</div>';
                    }
                    
                    echo '<div class="position-absolute top-0 start-0 m-2">';
                    echo '<span class="badge">جدید</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="p-3">';
                    echo '<h5 class="fw-bold mb-3">' . $product['name'] . '</h5>';
                    echo '<div class="d-flex justify-content-between align-items-center mb-3">';
                    echo '<p class="price-tag mb-0">' . number_format($product['price']) . ' تومان</p>';
                    echo '<div class="bg-light rounded px-2 py-1">';
                    echo '<span class="text-warning"><i class="bi bi-star-fill"></i> 4.8</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="d-grid gap-2">';
                    echo '<a href="index.php?action=product_detail&id=' . $product['id'] . '" class="btn btn-primary-custom text-white">';
                    echo '<i class="bi bi-eye"></i> جزئیات و خرید';
                    echo '</a>';
                    echo '<a href="index.php?action=order" class="btn btn-outline-primary w-100">';
                    echo '<i class="bi bi-cart-plus"></i> ثبت سفارش سریع';
                    echo '</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
            } else {
                echo '<div class="text-center py-5">';
                echo '<div class="fade-in">';
                echo '<i class="bi bi-bag" style="font-size: 4rem; color: #667eea;"></i>';
                echo '<h3 class="mt-3">فروشگاه در حال آماده‌سازی</h3>';
                echo '<p class="text-muted">فروشگاه در حال حاضر خالی است. به زودی محصولات جدید اضافه می‌شوند.</p>';
                echo '<a href="index.php?action=admin" class="btn btn-primary-custom mt-3">';
                echo '<i class="bi bi-plus-circle"></i> افزودن محصول';
                echo '</a>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="feature-box fade-in">
                        <div class="feature-icon">
                            <i class="bi bi-truck"></i>
                        </div>
                        <h5>ارسال رایگان</h5>
                        <p class="text-muted">برای سفارشات بالای 500 هزار تومان</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="feature-box fade-in">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h5>پرداخت امن</h5>
                        <p class="text-muted">پرداخت امن در محل</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="feature-box fade-in">
                        <div class="feature-icon">
                            <i class="bi bi-arrow-repeat"></i>
                        </div>
                        <h5>7 روز ضمانت</h5>
                        <p class="text-muted">بازگشت کالا تا 7 روز</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="feature-box fade-in">
                        <div class="feature-icon">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h5>پشتیبانی 24/7</h5>
                        <p class="text-muted">همیشه در کنار شما هستیم</p>
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
