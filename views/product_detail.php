<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جزئیات محصول - کفش‌فروشی برانا</title>
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

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-2">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="index.php">ویترین فروشگاه</a>
                </li>
                <li class="breadcrumb-item active">جزئیات محصول</li>
            </ol>
        </div>
    </nav>

    <!-- Product Detail Section -->
    <section class="py-5">
        <div class="container">
            <?php
            $product_id = $_GET['id'] ?? 0;
            $products = getProducts();
            $product = null;
            $related_products = [];
            
            foreach ($products as $p) {
                if ($p['id'] == $product_id) {
                    $product = $p;
                } else {
                    $related_products[] = $p;
                }
            }
            
            if ($product) {
                $related_products = array_slice($related_products, 0, 4);
            ?>
            
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="fade-in">
                        <div class="card">
                            <div class="card-body p-0">
                                <?php
                                if ($product['image']) {
                                    echo '<img src="uploads/' . $product['image'] . '" alt="' . $product['name'] . '" class="img-fluid">';
                                } else {
                                    echo '<div class="d-flex align-items-center justify-content-center bg-light" style="height: 400px;">';
                                    echo '<i class="bi bi-bag" style="font-size: 5rem; color: #667eea;"></i>';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 mb-4">
                    <div class="fade-in">
                        <div class="card">
                            <div class="card-body p-4">
                                <h1 class="card-title fw-bold mb-3"><?php echo $product['name']; ?></h1>
                                
                                <div class="d-flex align-items-center mb-4">
                                    <span class="price-tag"><?php echo number_format($product['price']); ?> تومان</span>
                                    <div class="ms-auto">
                                        <span class="text-warning">
                                            <i class="bi bi-star-fill"></i> 4.8
                                        </span>
                                        <small class="text-muted">(128 نظر)</small>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <h5 class="fw-bold mb-3">
                                        <i class="bi bi-info-circle"></i> توضیحات محصول
                                    </h5>
                                    <p class="text-muted">
                                        این محصول با بهترین کیفیت و طراحی مدرن تولید شده است. 
                                        مناسب برای استفاده روزمره و فعالیت‌های ورزشی می‌باشد.
                                    </p>
                                </div>
                                
                                <div class="mb-4">
                                    <h5 class="fw-bold mb-3">
                                        <i class="bi bi-check-circle"></i> ویژگی‌ها
                                    </h5>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="bi bi-check text-success"></i> کیفیت بالا و دوام فوق‌العاده
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-success"></i> طراحی ارگونومیک و راحت
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-success"></i> مناسب برای تمام فصول
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-success"></i> ضمانت اصالت کالا
                                        </li>
                                    </ul>
                                </div>
                                
                                <div class="d-grid gap-2">
                                    <a href="index.php?action=order" class="btn btn-primary-custom btn-lg">
                                        <i class="bi bi-cart-plus"></i> ثبت سفارش
                                    </a>
                                    <button class="btn btn-outline-primary w-100">
                                        <i class="bi bi-heart"></i> افزودن به علاقه‌مندی‌ها
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Related Products -->
                <?php
                if (count($related_products) > 0) {
                    echo '<div class="mt-5">';
                    echo '<h3 class="text-center mb-4 fade-in">';
                    echo '<i class="bi bi-bag"></i> محصولات مرتبط';
                    echo '</h3>';
                    echo '<div class="row">';
                    
                    foreach ($related_products as $related_product) {
                        echo '<div class="col-lg-3 col-md-6 mb-4">';
                        echo '<div class="product-card fade-in">';
                        echo '<div class="position-relative overflow-hidden">';
                        
                        if ($related_product['image']) {
                            echo '<img src="uploads/' . $related_product['image'] . '" alt="' . $related_product['name'] . '" class="product-image">';
                        } else {
                            echo '<div class="product-image d-flex align-items-center justify-content-center bg-light">';
                            echo '<i class="bi bi-bag" style="font-size: 2rem; color: #667eea;"></i>';
                            echo '</div>';
                        }
                        
                        echo '</div>';
                        echo '<div class="p-3">';
                        echo '<h6 class="fw-bold mb-2">' . $related_product['name'] . '</h6>';
                        echo '<p class="price-tag mb-2">' . number_format($related_product['price']) . ' تومان</p>';
                        echo '<a href="index.php?action=product_detail&id=' . $related_product['id'] . '" class="btn btn-sm btn-outline-primary w-100">';
                        echo '<i class="bi bi-eye"></i> مشاهده';
                        echo '</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            <?php
            } else {
                echo '<div class="text-center py-5">';
                echo '<div class="fade-in">';
                echo '<i class="bi bi-exclamation-triangle" style="font-size: 4rem; color: #ffc107;"></i>';
                echo '<h3 class="mt-3">محصول یافت نشد</h3>';
                echo '<p class="text-muted">محصول مورد نظر در فروشگاه وجود ندارد.</p>';
                echo '<a href="index.php" class="btn btn-primary-custom mt-3">';
                echo '<i class="bi bi-arrow-left"></i> بازگشت به فروشگاه';
                echo '</a>';
                echo '</div>';
                echo '</div>';
            }
            ?>
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
