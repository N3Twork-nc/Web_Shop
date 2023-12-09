<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require_once './mvc/views/shopping/libcss.php'; ?>
    <link rel="stylesheet" href="/src/webshopping/public/css/confirmUser.css">
</head>

<body>
    <?php require_once './mvc/views/shopping/header.php'; ?>
    <main id="main" class="site-main" style="margin-top: 8%;">
        <div class="container">
            <div class="auth auth-forgotpass">
                <div class="auth-container">
                    <div class="auth-forgotpass">
                        <div class="auth__login auth__block">
                            <h3 class="auth__title">
                                Nhập mật khẩu mới
                            </h3>
                            <div class="auth__login__content">
                                <p class="auth__description">
                                    (Tiến hành thay đổi mật khẩu mới của bạn)
                                </p>
                                <form class="auth__form" role="login" enctype="application/x-www-form-urlencoded" name="frm_register" method="post" action="">
                                    <div class="form-group">
                                        <input class="form-control" type="text" value="" name="Enter_Password" placeholder="Nhập mật khẩu">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="text" value="" name="Confirm_Password" placeholder="Xác nhận lại mật khẩu">
                                    </div>
                                    <div class="auth__form__buttons">
                                        <button type="submit" class="btn btn--large">Xác nhận thay đổi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php require_once './mvc/views/shopping/footer.php'; ?>
</body>

</html>