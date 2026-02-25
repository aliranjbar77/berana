<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تماس با ما - کفش‌فروشی برانا</title>
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
                    <i class="bi bi-telephone"></i> تماس با ما
                </h1>
                <p class="hero-subtitle">با ما در ارتباط باشید، ما همیشه آماده کمک به شما هستیم</p>
            </div>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="fade-in">
                        <div class="card">
                            <div class="card-body p-4">
                                <h4 class="card-title text-center mb-4">
                                    <i class="bi bi-envelope"></i> ارسال پیام
                                </h4>
                                <form>
                                    <div class="mb-3">
                                        <label for="name" class="form-label fw-bold">
                                            <i class="bi bi-person"></i> نام و نام خانوادگی
                                        </label>
                                        <input type="text" class="form-control" id="name" placeholder="نام کامل خود را وارد کنید" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-bold">
                                            <i class="bi bi-envelope"></i> ایمیل
                                        </label>
                                        <input type="email" class="form-control" id="email" placeholder="ایمیل خود را وارد کنید" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="subject" class="form-label fw-bold">
                                            <i class="bi bi-chat-text"></i> موضوع پیام
                                        </label>
                                        <input type="text" class="form-control" id="subject" placeholder="موضوع پیام خود را وارد کنید" required>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="message" class="form-label fw-bold">
                                            <i class="bi bi-chat-dots"></i> متن پیام
                                        </label>
                                        <textarea class="form-control" id="message" rows="5" placeholder="پیام خود را اینجا بنویسید..." required></textarea>
                                    </div>
                                    
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary-custom btn-lg">
                                            <i class="bi bi-send"></i> ارسال پیام
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 mb-4">
                    <div class="fade-in">
                        <div class="card bg-primary text-white">
                            <div class="card-body p-4">
                                <h4 class="card-title text-center mb-4">
                                    <i class="bi bi-info-circle"></i> اطلاعات تماس
                                </h4>
                                
                                <div class="mb-4">
                                    <h5 class="fw-bold mb-3">
                                        <i class="bi bi-geo-alt"></i> آدرس
                                    </h5>
                                    <p class="mb-0">
                                        تهران، خیابان ولیعصر، خیابان فاطمی، پلاک 123<br>
                                        طبقه دوم، واحد 5
                                    </p>
                                </div>
                                
                                <div class="mb-4">
                                    <h5 class="fw-bold mb-3">
                                        <i class="bi bi-telephone"></i> شماره‌های تماس
                                    </h5>
                                    <p class="mb-1">
                                        <strong>تلفن:</strong> 021-12345678
                                    </p>
                                    <p class="mb-0">
                                        <strong>موبایل:</strong> 0912-3456789
                                    </p>
                                </div>
                                
                                <div class="mb-4">
                                    <h5 class="fw-bold mb-3">
                                        <i class="bi bi-envelope"></i> ایمیل
                                    </h5>
                                    <p class="mb-0">
                                        <strong>ایمیل اصلی:</strong> info@boranashoes.ir<br>
                                        <strong>پشتیبانی:</strong> support@boranashoes.ir
                                    </p>
                                </div>
                                
                                <div class="mb-4">
                                    <h5 class="fw-bold mb-3">
                                        <i class="bi bi-clock"></i> ساعات کاری
                                    </h5>
                                    <p class="mb-1">
                                        <strong>شنبه تا چهارشنبه:</strong> 9 صبح تا 6 عصر
                                    </p>
                                    <p class="mb-1">
                                        <strong>پنجشنبه:</strong> 9 صبح تا 4 عصر
                                    </p>
                                    <p class="mb-0">
                                        <strong>جمعه:</strong> تعطیل
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Map Section -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <h4 class="card-title text-center p-3">
                                <i class="bi bi-map"></i> موقعیت ما روی نقشه
                            </h4>
                            <div class="ratio ratio-16x9">
                                <iframe 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d219.123456!2d51.123456!3d35.123456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1sen!2sir!4v1234567890!5m2!1sen!2sir" 
                                    width="600" 
                                    height="450" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy"
                                    class="rounded">
                                </iframe>
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
