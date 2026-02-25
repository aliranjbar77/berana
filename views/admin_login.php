<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود مدیریت</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <h4 class="text-center mb-4">ورود مدیریت</h4>

                            <?php if (isset($_SESSION['admin_error'])): ?>
                                <div class="alert alert-danger">
                                    <?php
                                    echo $_SESSION['admin_error'];
                                    unset($_SESSION['admin_error']);
                                    ?>
                                </div>
                            <?php endif; ?>

                            <form method="POST" action="index.php?action=admin_login">
                                <div class="mb-3">
                                    <label class="form-label">نام کاربری</label>
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">رمز عبور</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">ورود</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
