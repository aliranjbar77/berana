<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>کفش فروشی برانا | فروشگاه کتونی</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-bag"></i> کفش فروشی برانا
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php"><i class="bi bi-house"></i> ویترین</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?action=order"><i class="bi bi-cart-plus"></i> ثبت سفارش</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?action=about"><i class="bi bi-info-circle"></i> درباره ما</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?action=contact"><i class="bi bi-telephone"></i> تماس با ما</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?action=admin"><i class="bi bi-gear"></i> مدیریت</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container">
            <div class="fade-in">
                <h1 class="hero-title"><i class="bi bi-stars"></i> جدیدترین مدل های روز</h1>
                <p class="hero-subtitle">فروشگاه حرفه ای، سریع و ریسپانسیو</p>
            </div>
        </div>
    </section>

    <section class="py-4">
        <div class="container">
            <?php
            $categories = getCategories();
            $selectedCategory = $_GET['category'] ?? 'all';
            if ($selectedCategory !== 'all' && !array_key_exists($selectedCategory, $categories)) {
                $selectedCategory = 'all';
            }

            $products = $selectedCategory === 'all' ? getProducts() : getProducts($selectedCategory);
            ?>

            <div class="category-menu fade-in">
                <a href="index.php?category=all" class="category-chip <?php echo $selectedCategory === 'all' ? 'is-active' : ''; ?>">همه محصولات</a>
                <?php foreach ($categories as $key => $label): ?>
                    <a href="index.php?category=<?php echo urlencode($key); ?>" class="category-chip <?php echo $selectedCategory === $key ? 'is-active' : ''; ?>">
                        <?php echo htmlspecialchars($label); ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <?php if (count($products) > 0): ?>
                <div class="products-grid">
                    <?php foreach ($products as $index => $product): ?>
                        <article class="product-item">
                            <div class="product-card fade-in" style="animation-delay: <?php echo ($index % 8) * 0.06; ?>s;">
                                <div class="product-media">
                                    <?php if (!empty($product['image'])): ?>
                                        <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">
                                    <?php else: ?>
                                        <div class="product-image d-flex align-items-center justify-content-center bg-light">
                                            <i class="bi bi-bag" style="font-size:2.5rem;color:#2a6f97;"></i>
                                        </div>
                                    <?php endif; ?>
                                    <span class="product-category-badge">
                                        <?php echo htmlspecialchars($categories[$product['category']] ?? 'عمومی'); ?>
                                    </span>
                                </div>

                                <div class="product-content">
                                    <h3 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h3>
                                    <p class="price-tag"><?php echo number_format((int)$product['price']); ?> تومان</p>
                                    <div class="d-grid gap-2">
                                        <a href="index.php?action=product_detail&id=<?php echo (int)$product['id']; ?>" class="btn btn-primary-custom text-white">
                                            <i class="bi bi-eye"></i> جزئیات و خرید
                                        </a>
                                        <a href="index.php?action=order" class="btn btn-outline-primary w-100">
                                            <i class="bi bi-cart-plus"></i> سفارش سریع
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-5 fade-in empty-state">
                    <i class="bi bi-search"></i>
                    <h3 class="mt-3">محصولی در این دسته ثبت نشده است</h3>
                    <p class="text-muted">از منوی بالا دسته دیگری را انتخاب کنید یا از مدیریت محصول جدید اضافه کنید.</p>
                    <a href="index.php?action=admin" class="btn btn-primary-custom mt-2">
                        <i class="bi bi-plus-circle"></i> افزودن محصول
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="feature-box fade-in">
                        <div class="feature-icon"><i class="bi bi-truck"></i></div>
                        <h5>ارسال سریع</h5>
                        <p class="text-muted">تحویل سریع به سراسر کشور</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="feature-box fade-in">
                        <div class="feature-icon"><i class="bi bi-shield-check"></i></div>
                        <h5>پرداخت امن</h5>
                        <p class="text-muted">فرآیند خرید مطمئن و ساده</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="feature-box fade-in">
                        <div class="feature-icon"><i class="bi bi-arrow-repeat"></i></div>
                        <h5>ضمانت تعویض</h5>
                        <p class="text-muted">مهلت تست و تعویض کالا</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="feature-box fade-in">
                        <div class="feature-icon"><i class="bi bi-headset"></i></div>
                        <h5>پشتیبانی</h5>
                        <p class="text-muted">پاسخگویی سریع به سفارش ها</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="bi bi-bag"></i> کفش فروشی برانا</h5>
                    <p>تجربه خرید حرفه ای و مدرن</p>
                </div>
                <div class="col-md-4">
                    <h5><i class="bi bi-link-45deg"></i> لینک سریع</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-white text-decoration-none">ویترین</a></li>
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
                <p>&copy; 2026 کفش فروشی برانا. تمامی حقوق محفوظ است.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
