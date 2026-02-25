<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت | کفش فروشی برانا</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="bi bi-bag"></i> کفش فروشی برانا</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="bi bi-house"></i> ویترین</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?action=order"><i class="bi bi-cart-plus"></i> ثبت سفارش</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?action=about"><i class="bi bi-info-circle"></i> درباره ما</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?action=contact"><i class="bi bi-telephone"></i> تماس با ما</a></li>
                    <li class="nav-item"><a class="nav-link active" href="index.php?action=admin"><i class="bi bi-gear"></i> مدیریت</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container">
            <div class="fade-in">
                <h1 class="hero-title"><i class="bi bi-gear"></i> پنل مدیریت فروشگاه</h1>
                <p class="hero-subtitle">ثبت محصول، دسته بندی و کنترل سفارش ها</p>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card fade-in">
                        <div class="card-body p-4">
                            <h4 class="card-title text-center mb-4"><i class="bi bi-box"></i> افزودن محصول</h4>

                            <?php
                            $categories = getCategories();

                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
                                $name = trim($_POST['product_name'] ?? '');
                                $price = (int)($_POST['product_price'] ?? 0);
                                $category = $_POST['product_category'] ?? 'women';

                                if ($name !== '' && $price > 0) {
                                    $image = '';
                                    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === 0) {
                                        $uploadDir = 'uploads/';
                                        if (!is_dir($uploadDir)) {
                                            mkdir($uploadDir, 0777, true);
                                        }
                                        $safeName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $_FILES['product_image']['name']);
                                        $image = time() . '_' . $safeName;
                                        move_uploaded_file($_FILES['product_image']['tmp_name'], $uploadDir . $image);
                                    }

                                    if (addProduct($name, $price, $image, $category)) {
                                        echo '<div class="alert alert-success"><strong>موفق:</strong> محصول ثبت شد.</div>';
                                    } else {
                                        echo '<div class="alert alert-danger"><strong>خطا:</strong> ثبت محصول انجام نشد.</div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-danger"><strong>خطا:</strong> نام و قیمت معتبر لازم است.</div>';
                                }
                            }
                            ?>

                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="add_product" value="1">

                                <div class="mb-3">
                                    <label for="product_name" class="form-label fw-bold"><i class="bi bi-tag"></i> نام محصول</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="product_price" class="form-label fw-bold"><i class="bi bi-cash"></i> قیمت (تومان)</label>
                                    <input type="number" class="form-control" id="product_price" name="product_price" min="1" required>
                                </div>

                                <div class="mb-3">
                                    <label for="product_category" class="form-label fw-bold"><i class="bi bi-grid"></i> دسته بندی</label>
                                    <select class="form-control" id="product_category" name="product_category" required>
                                        <?php foreach ($categories as $key => $label): ?>
                                            <option value="<?php echo htmlspecialchars($key); ?>"><?php echo htmlspecialchars($label); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="product_image" class="form-label fw-bold"><i class="bi bi-image"></i> عکس محصول</label>
                                    <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*">
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary-custom"><i class="bi bi-plus-circle"></i> افزودن محصول</button>
                                </div>
                            </form>

                            <hr class="my-4">

                            <h5 class="fw-bold mb-3">لیست محصولات</h5>
                            <?php
                            $products = getProducts();
                            if (count($products) > 0) {
                                echo '<div class="table-responsive">';
                                echo '<table class="table table-striped align-middle">';
                                echo '<thead><tr><th>نام</th><th>دسته</th><th>قیمت</th><th>عکس</th><th>عملیات</th></tr></thead><tbody>';

                                foreach ($products as $product) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($product['name']) . '</td>';
                                    echo '<td><span class="badge">' . htmlspecialchars($categories[$product['category']] ?? 'عمومی') . '</span></td>';
                                    echo '<td>' . number_format((int)$product['price']) . ' تومان</td>';
                                    echo '<td>';
                                    if (!empty($product['image'])) {
                                        echo '<img src="uploads/' . htmlspecialchars($product['image']) . '" alt="" style="width:48px;height:48px;object-fit:cover;border-radius:10px;">';
                                    } else {
                                        echo '<i class="bi bi-image text-muted" style="font-size:1.4rem;"></i>';
                                    }
                                    echo '</td>';
                                    echo '<td><a href="index.php?action=admin&delete_product=' . (int)$product['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'از حذف محصول مطمئن هستید؟\')"><i class="bi bi-trash"></i></a></td>';
                                    echo '</tr>';
                                }

                                echo '</tbody></table></div>';
                            } else {
                                echo '<p class="text-muted">محصولی ثبت نشده است.</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card fade-in">
                        <div class="card-body p-4">
                            <h4 class="card-title text-center mb-4"><i class="bi bi-list-check"></i> مدیریت سفارش ها</h4>

                            <?php
                            if (isset($_GET['delete_product'])) {
                                $productId = (int)$_GET['delete_product'];
                                if (deleteProduct($productId)) {
                                    echo '<div class="alert alert-success"><strong>موفق:</strong> محصول حذف شد.</div>';
                                } else {
                                    echo '<div class="alert alert-danger"><strong>خطا:</strong> حذف محصول انجام نشد.</div>';
                                }
                            }

                            if (isset($_GET['delete_order'])) {
                                $orderId = (int)$_GET['delete_order'];
                                if (deleteOrder($orderId)) {
                                    echo '<div class="alert alert-success"><strong>موفق:</strong> سفارش حذف شد.</div>';
                                } else {
                                    echo '<div class="alert alert-danger"><strong>خطا:</strong> حذف سفارش انجام نشد.</div>';
                                }
                            }

                            $orders = getOrders();
                            if (count($orders) > 0) {
                                echo '<div class="table-responsive">';
                                echo '<table class="table table-striped align-middle">';
                                echo '<thead><tr><th>نام مشتری</th><th>تلفن</th><th>محصول</th><th>تاریخ</th><th>عملیات</th></tr></thead><tbody>';

                                foreach ($orders as $order) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($order['name']) . '</td>';
                                    echo '<td>' . htmlspecialchars($order['phone']) . '</td>';
                                    echo '<td>' . htmlspecialchars($order['product_name']) . '</td>';
                                    echo '<td>' . date('Y/m/d H:i', strtotime($order['created_at'])) . '</td>';
                                    echo '<td><a href="index.php?action=admin&delete_order=' . (int)$order['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'از حذف سفارش مطمئن هستید؟\')"><i class="bi bi-trash"></i></a></td>';
                                    echo '</tr>';
                                }

                                echo '</tbody></table></div>';
                            } else {
                                echo '<p class="text-muted">سفارشی برای نمایش وجود ندارد.</p>';
                            }
                            ?>
                        </div>
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
