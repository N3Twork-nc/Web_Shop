<!doctype html>
<html lang="en">

<head>
    <title>PTIT Shop</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PTIT-Shop</title>

    <!-- Bootstrap CSS -->
    <?php require_once './mvc/views/shopping/libcss.php'; ?>
    <link rel="stylesheet" href="/public/css/UserChangePassword.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/sweetalert2@11.0.0/dist/sweetalert2.min.css">
    <script src="https://unpkg.com/sweetalert2@11.0.0/dist/sweetalert2.min.js"></script>
</head>

<body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <?php require_once './mvc/views/shopping/header.php'; ?>

    <!--****** INFORMATION ****** -->

    <main id="main" class="site-main" style="margin-top: 50px;">
        <div class="container">
            <div class="order-wrapper mt-40 my-account">
                <div class="row">
                    <div class="col-lg-4 col-xl-auto">
                        <div class="order-sidemenu">
                            <?php require_once './mvc/views/shopping/menuUser.php'; ?>
                        </div>
                    </div>
                    <div class="col-3xl-1"></div>
                    <div class="col-lg-8 col-xl">
                        <div class="order-block__title">
                            <h2 style="margin-bottom: 40px; font-family: initial; font-size: 28px; font-weight:bold;">ĐỔI MẬT KHẨU</h2>
                        </div>
                        <div class="order-block my-account-wrapper row">
                            <div class="col-md-7">
                                <form id="changePassword">
                                    <input type="hidden" value="<?php echo $data["csrf_token_resetPassword"]; ?>" name="csrf_token_resetPassword">
                                    <div class="row form-group">
                                        <div class="col col-label">
                                            <label>Nhập mật khẩu cũ</label>
                                        </div>
                                        <div class="col col-input">
                                            <input class="form-control" type="password" name="old_password">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-label">
                                            <label>Nhập mật khẩu mới</label>
                                        </div>
                                        <div class="col col-input has-button">
                                            <input class="form-control" type="password" name="new_password">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-label">
                                            <label>Xác nhận lại mật khẩu mới</label>
                                        </div>
                                        <div class="col col-input has-button">
                                            <input class="form-control" type="password" name="retype_new_password">
                                        </div>
                                    </div>

                                    <div class="col col-label"></div>
                                    <div class="col-12 col-input form-buttons">
                                        <button class="btn btn--large">Cập nhật</button>
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
       $('#changePassword').submit(function(e){
        e.preventDefault();

        // gửi data
        var sw = showLoadingSwal();
            $.ajax({
                url:'/Customer/ChangePassword',
                method:'POST',
                data:$(this).serialize(),
                error:err=>{
                    console.log(err)
                },
                success:function(resp){
            if(resp.trim() == "done"){
            Swal.fire(
                'Completed!',
                'Bạn đã cập nhật thông tin thành công!',
                'success'
                )
            setTimeout(function() {
                location.reload();
            }, 1000);
            }else{
                sw.close();
                if (resp.includes('<!DOCTYPE html>')|| resp.lenght > 50) {
                            // Nếu có chứa HTML, điều hướng sang trang đăng nhập
                    window.location.href = '/Auth';
                } else {
                    Swal.fire(
                        'Oops...',
                        resp,
                        'error'
                    );
                }
                
            }
        }
    })
    });

    const link = document.querySelector(".ChangePassword");
    link.classList.add('active');
   
</script>