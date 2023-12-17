<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require_once './mvc/views/shopping/libcss.php'; ?>
    <link rel="stylesheet" href="/public/css/confirmUser.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/sweetalert2@11.0.0/dist/sweetalert2.min.css">
    <script src="https://unpkg.com/sweetalert2@11.0.0/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
                                <form id="ResetPasswordForm" class="auth__form" role="login">
                                    <input id="token" type="hidden" value="<?php echo $data['token']; ?>">
                                    <div class="form-group">
                                        <input class="form-control" type="password" value="" name="password" placeholder="Nhập mật khẩu">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="password" value="" name="retype_password" placeholder="Xác nhận lại mật khẩu">
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
<script>
    const token = document.getElementById("token");
    function showLoadingSwal() {
        return Swal.fire({
            title: 'Loading...',
            text: 'Vui lòng chờ trong giây lát!',
            showConfirmButton: false,
            imageUrl: '/public/img/gif/loading.gif',
            allowOutsideClick: false // Không cho phép đóng khi click ra ngoài
        });
    }

    // bấm submit
    $('#ResetPasswordForm').submit(function(e){
        e.preventDefault(); 
        // gửi data
        var sw = showLoadingSwal();
            $.ajax({
                url:'/Auth/ResetPassword/' + token.value,
                method:'POST',
                data:$(this).serialize(),
                error:err=>{
                    console.log(err)
                },
                success:function(resp){
            if(resp.trim() == "done"){
            Swal.fire(
                'Completed!',
                'Bạn đã đổi mật khẩu thành công!',
                'success'
                )
            setTimeout(function() {
                location.reload();
            }, 1000);
            }else{
                sw.close();
                $('#ResetPasswordForm').find('.custom-alert-error').remove();
                if (resp.includes('<!DOCTYPE html>')|| resp.lenght > 50) {
                            // Nếu có chứa HTML, điều hướng sang trang đăng nhập
                    window.location.href = '/Auth';
                } else {
                    $('#ResetPasswordForm').prepend('<div class="custom-alert custom-alert-error" role="alert" style="display: block !important"><i class="fa fa-times-circle"></i>'+ resp + '</div>');
                }
            }
        }
    })
    });
</script>