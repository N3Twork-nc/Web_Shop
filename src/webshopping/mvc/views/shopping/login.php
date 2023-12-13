<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Responsive Login and Signup Form </title>

    <!-- CSS -->
    <link rel="stylesheet" href="/public/css/login_user.css">

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/sweetalert2@11.0.0/dist/sweetalert2.min.css">
    <script src="https://unpkg.com/sweetalert2@11.0.0/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>

<body>
    <section class="container forms">
        <div class="form login">
            <div class="form-content">
                <header>Đăng nhập</header>
                <form id="loginForm" action="/Auth/Login" method="POST">
                    <?php if(isset($_SESSION['message'])): ?>
                        <div class="custom" style="width: 100%; text-align: center;">
                            <div class="custom-alert custom-alert-error" role="alert" style="display: block !important"><i class="fa fa-times-circle"></i><?php echo $_SESSION['message']; ?></div>
                        </div>
                        <?php unset($_SESSION['message']); ?>
                    <?php endif; ?>
                    <div class="field input-field">
                        <input type="email" name="email" placeholder="Email" class="input">
                    </div>

                    <div class="field input-field">
                        <input type="password" name="password" placeholder="Password" class="password">
                        <i class='bx bx-hide eye-icon'></i>
                    </div>

                    <div class="form-link">
                        <a href="#" class="forgot-pass" id="forgotPasswordLink">Quên mật khẩu?</a>
                    </div>

                    <div class="field button-field">
                        <button>Đăng nhập</button>
                    </div>
                </form>

                <div class="form-link">
                    <span>Bạn chưa có tài khoản? <a href="#" class="link signup-link">Đăng ký ngay</a></span>
                </div>
            </div>

            <div class="line"></div>

            <div class="media-options">
                <a href="#" class="field facebook">
                    <i class='bx bxl-facebook facebook-icon'></i>
                    <span>Đăng nhập bằng Facebook</span>
                </a>
            </div>

            <div class="media-options">
                <a style="margin-top: 25px !important;" href="#" class="field google">
                    <img src="/public/img/google.png" alt="" class="google-img">
                    <span>Đăng nhập bằng Google</span>
                </a>
            </div>

        </div>

        <!-- Signup Form -->

        <div class="form signup">
            <div class="form-content">
                <header>Đăng ký tài khoản</header>
                <form id="RegisterForm">
                    <div class="field input-field">
                        <label for="full-name">Nhập họ Tên</label>
                        <input type="text" id="full-name" name="fullname" placeholder="Enter Full Name" class="input">
                    </div>
                    <div class="field input-field">
                        <label for="username">Nhập email</label>
                        <input type="text" id="email" name="email" placeholder="Enter Email" class="input">
                    </div>
                    <div class="field input-field">
                        <label for="password">Nhập password</label>
                        <input type="password" id="password" name="password" placeholder="Enter Password" class="password">
                    </div>
                    <div class="field input-field">
                        <label for="confirm-password">Xác thực password</label>
                        <input type="password" id="confirm-password" name="retype_password" placeholder="Confirm Password" class="password">
                        <i style="margin-top: 24px;" class='bx bx-hide eye-icon'></i>
                    </div>
                    <div class="field input-field">
                        <label for="phone-number">Nhập số điện thoại</label>
                        <input type="text" id="phone-number" name="phone" placeholder="Enter Mobile Number" class="input">
                    </div>
                    <div class="field button-field">
                        <button type="submit">Đăng ký</button>
                    </div>
                </form>


                <div class="form-link">
                    <span>Bạn đã có tài khoản? <a href="#" class="link login-link">Đăng nhập</a></span>
                </div>
            </div>
        </div>

        <div class="form forgetpassword" style="display: none;">
            <div class="form-content">
                <header>Quên mật khẩu</header>
                <form id="ForgotPasswordForm">
                    <div class="field input-field">
                        <label for="username">Nhập email</label>
                        <input type="text" id="email" name="email" placeholder="Enter Email" class="input">
                    </div>
                    <div class="field button-field">
                        <button type="submit">Send</button>
                    </div>
                </form>
                <div class="LoginForm">
                    <span>Bạn đã có tài khoản? <a href="#" class="login">Đăng nhập</a></span>
                </div>
            </div>
        </div>
    </section>
</body>

</html>

<script>
        const forms = document.querySelector(".forms"),
                pwShowHide = document.querySelectorAll(".eye-icon"),
                links = document.querySelectorAll(".link");
        
        pwShowHide.forEach(eyeIcon => {
            eyeIcon.addEventListener("click", () => {
            let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");

            pwFields.forEach(password => {
                if (password.type === "password") {
                    password.type = "text";
                    eyeIcon.classList.replace("bx-hide", "bx-show");
                    return;
                }
            password.type = "password";
            eyeIcon.classList.replace("bx-show", "bx-hide");})})})

        links.forEach(link => {
            link.addEventListener("click", e => {
                e.preventDefault(); //preventing form submit
                $('#RegisterForm').find('.custom-alert-error').remove();
                $('#loginForm').find('.custom-alert-error').remove();
                 // Ẩn tất cả các form
                 forms.classList.toggle("show-signup");
            })
        })

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
    $('#RegisterForm').submit(function(e){
        e.preventDefault();

        // gửi data
        var sw = showLoadingSwal();
            $.ajax({
                url:'/Auth/Register',
                method:'POST',
                data:$(this).serialize(),
                error:err=>{
                    console.log(err)
                },
                success:function(resp){
                let token = resp.trim().split(":")[1];
                if(resp.trim().split(":")[0] == "token" && token != '' && token != null){
                    $('#RegisterForm').find('.custom-alert-error').remove();
                    let url = "http://localhost:8092/Auth/Verify/" + token;
                    
                    window.location = url;
                }else{
                    sw.close();

                    //nhớ thêm cái này cho mấy trang kia
                    $('#RegisterForm').find('.custom-alert-error').remove();
                    $('#RegisterForm').prepend('<div class="custom-alert custom-alert-error" role="alert" style="display: inline-block !important; text-align: center; height: auto !important;"><i class="fa fa-times-circle"></i>'+ resp + '</div>');
                }
            }
        })
    });

    $('#ForgotPasswordForm').submit(function(e){
        e.preventDefault();

        // gửi data
        var sw = showLoadingSwal();
            $.ajax({
                url:'/Auth/ForgotPassword',
                method:'POST',
                data:$(this).serialize(),
                error:err=>{
                    console.log(err)
                },
                success:function(resp){
                let token = resp.trim().split(":")[1];
                if(resp.trim().split(":")[0] == "token" && token != '' && token != null){
                    $('#RegisterForm').find('.custom-alert-error').remove();
                    let url = "http://localhost:8092/Auth/CheckCodeForChangePassword/" + token;
                    
                    window.location = url;
                }else{
                    sw.close();

                    //nhớ thêm cái này cho mấy trang kia
                    $('#ForgotPasswordForm').find('.custom-alert-error').remove();
                    $('#ForgotPasswordForm').prepend('<div class="custom-alert custom-alert-error" role="alert" style="display: inline-block !important; text-align: center; height: auto !important;"><i class="fa fa-times-circle"></i>'+ resp + '</div>');
                }
            }
        })
    });

    document.getElementById("forgotPasswordLink").addEventListener("click", function (e) {
        e.preventDefault(); // Ngăn chặn hành động mặc định của liên kết

        // Ẩn form đăng nhập và hiển thị form quên mật khẩu
        forms.querySelector(".login").style.display = "none";
        forms.querySelector(".forgetpassword").style.display = "block";
    });

    document.querySelector(".LoginForm a.login").addEventListener("click", function (e) {
    e.preventDefault(); // Ngăn chặn hành động mặc định của liên kết

    // Ẩn form đăng nhập và hiển thị form quên mật khẩu
    forms.querySelector(".login").style.display = "block";
    $('#loginForm').find('.custom-alert-error').remove();
    forms.querySelector(".forgetpassword").style.display = "none";
});

    
</script>