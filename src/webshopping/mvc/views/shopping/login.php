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

</head>

<body>
    <section class="container forms">
        <div class="form login">
            <div class="form-content">
                <header>Đăng nhập</header>
                <form action="#">
                    <div class="field input-field">
                        <input type="email" placeholder="Email" class="input">
                    </div>

                    <div class="field input-field">
                        <input type="password" placeholder="Password" class="password">
                        <i class='bx bx-hide eye-icon'></i>
                    </div>

                    <div class="form-link">
                        <a href="#" class="forgot-pass">Quên mật khẩu?</a>
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
                <form action="#">
                    <div class="field input-field">
                        <label for="full-name">Họ Tên</label>
                        <input type="text" id="full-name" placeholder="Enter Full Name" class="input">
                    </div>
                    <div class="field input-field">
                        <label for="username">Tạo tài khoản</label>
                        <input type="text" id="username" placeholder="Enter Username" class="input">
                    </div>
                    <div class="field input-field">
                        <label for="username">Nhập email</label>
                        <input type="email" id="username" placeholder="Enter Email" class="input">
                    </div>
                    <div class="field input-field">
                        <label for="password">Tạo password</label>
                        <input type="password" id="password" placeholder="Enter Password" class="password">
                    </div>
                    <div class="field input-field">
                        <label for="confirm-password">Xác thực password</label>
                        <input type="password" id="confirm-password" placeholder="Confirm Password" class="password">
                        <i style="margin-top: 24px;" class='bx bx-hide eye-icon'></i>
                    </div>
                    <div class="field input-field">
                        <label for="phone-number">Nhập số điện thoại</label>
                        <input type="text" id="phone-number" placeholder="Enter Mobile Number" class="input">
                    </div>
                    <div class="field button-field">
                        <button>Đăng ký</button>
                    </div>
                </form>


                <div class="form-link">
                    <span>Bạn đã có tài khoản? <a href="#" class="link login-link">Đăng nhập</a></span>
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
                forms.classList.toggle("show-signup");
            })
        })
</script>