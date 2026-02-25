<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت سفارش - کفش‌فروشی برانا</title>
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
                    <i class="bi bi-cart-plus"></i> فرم خرید سریع
                </h1>
                <p class="hero-subtitle">سفارش خود را در کمتر از 2 دقیقه ثبت کنید</p>
            </div>
        </div>
    </section>

    <!-- Order Form Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="fade-in">
                        <div class="card">
                            <div class="card-body p-4">
                                <h4 class="card-title text-center mb-4">
                                    <i class="bi bi-info-circle"></i> اطلاعات سفارش
                                </h4>
                                
                                <?php
                                $products = getProducts();
                                if (count($products) > 0) {
                                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                        $name = $_POST['name'] ?? '';
                                        $phone = $_POST['phone'] ?? '';
                                        $address = $_POST['address'] ?? '';
                                        $product_id = $_POST['product_id'] ?? '';
                                        
                                        if ($name && $phone && $address && $product_id) {
                                            if (addOrder($name, $phone, $address, $product_id)) {
                                                echo '<div class="alert alert-success fade-in">';
                                                echo '<strong>✅ موفقیت:</strong> ' . $name . ' عزیز، سفارش شما با موفقیت ثبت شد!';
                                                echo '</div>';
                                            } else {
                                                echo '<div class="alert alert-danger fade-in">';
                                                echo '<strong>❌ خطا:</strong> مشکلی در ثبت سفارش پیش آمد. لطفاً دوباره تلاش کنید.';
                                                echo '</div>';
                                            }
                                        } else {
                                            echo '<div class="alert alert-danger fade-in">';
                                            echo '<strong>⚠️ خطا:</strong> لطفاً تمام فیلدها را کامل کنید.';
                                            echo '</div>';
                                        }
                                    }
                                ?>
                                
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="name" class="form-label fw-bold">
                                            <i class="bi bi-person"></i> نام و نام خانوادگی
                                        </label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="نام کامل خود را وارد کنید" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="phone" class="form-label fw-bold">
                                            <i class="bi bi-telephone"></i> شماره تماس (موبایل)
                                        </label>
                                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="09xxxxxxxxx" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="product_id" class="form-label fw-bold">
                                            <i class="bi bi-bag"></i> انتخاب کفش
                                        </label>
                                        <select class="form-control" id="product_id" name="product_id" required>
                                            <option value="">محصول مورد نظر را انتخاب کنید</option>
                                            <?php
                                            foreach ($products as $product) {
                                                echo '<option value="' . $product['id'] . '">' . $product['name'] . ' - ' . number_format($product['price']) . ' تومان</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="address" class="form-label fw-bold">
                                            <i class="bi bi-geo-alt"></i> آدرس جهت ارسال
                                        </label>
                                        <textarea class="form-control" id="address" name="address" rows="4" placeholder="آدرس دقیق پستی خود را وارد کنید" required></textarea>
                                    </div>
                                    
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary-custom btn-lg">
                                            <i class="bi bi-check-circle"></i> ثبت نهایی سفارش
                                        </button>
                                    </div>
                                </form>
                                <?php
                                } else {
                                    echo '<div class="text-center py-4">';
                                    echo '<i class="bi bi-exclamation-triangle" style="font-size: 3rem; color: #ffc107;"></i>';
                                    echo '<h5 class="mt-3">محصولی برای نمایش وجود ندارد</h5>';
                                    echo '<p class="text-muted">لطفاً ابتدا از بخش مدیریت محصولات را اضافه کنید.</p>';
                                    echo '<a href="index.php?action=admin" class="btn btn-primary-custom mt-3">';
                                    echo '<i class="bi bi-plus-circle"></i> افزودن محصول';
                                    echo '</a>';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 mb-4">
                    <div class="fade-in">
                        <div class="card bg-primary text-white">
                            <div class="card-body p-4">
                                <h4 class="card-title text-center mb-4">
                                    <i class="bi bi-shield-check"></i> خرید آسان و سریع
                                </h4>
                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-check-circle-fill me-2"></i>
                                        <span>ارسال رایگان برای سفارشات بالای 500 هزار تومان</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-check-circle-fill me-2"></i>
                                        <span>پرداخت امن در محل</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-check-circle-fill me-2"></i>
                                        <span>7 روز ضمانت بازگشت کالا</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-check-circle-fill me-2"></i>
                                        <span>پشتیبانی 24 ساعته</span>
                                    </div>
                                </div>
                                
                                <div class="text-center mt-4">
                                    <img src="https://img.freepik.com/free-vector/shopping-cart-with-bags-concept-illustration_114360-1277.jpg" 
                                         alt="خرید آنلاین" class="img-fluid rounded" style="max-height: 200px;">
                                </div>
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
