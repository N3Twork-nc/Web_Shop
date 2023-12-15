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
    <link rel="stylesheet" href="/public/css/informationUser.css">

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
                        <?php require_once './mvc/views/shopping/menuUser.php'; ?>
                    </div>
                    <div class="col-3xl-1"></div>
                    <div class="col-lg-8 col-xl">
                        <div class="order-block__title">
                            <h2 style="font-family: initial; font-size: 28px; font-weight:bold;">TÀI KHOẢN CỦA TÔI</h2>
                        </div>
                        <div class="order-block my-account-wrapper row">
                            <p class="alert alert-primary">"Vì chính sách an toàn thẻ, bạn không thể thay đổi gmail."</p>
                            <div class="col-md-7">
                                <form id="infoForm">
                                    <div class="row form-group">
                                        <div class="col col-label">
                                            <label>Họ tên</label>
                                        </div>
                                        <div class="col col-input">
                                            <input class="form-control" value="<?php echo $data['info']->getFull_name(); ?>" name="fullName" type="text" required>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-label">
                                            <label>Số điện thoại</label>
                                        </div>
                                        <div class="col col-input has-button">
                                            <input value="<?php echo $data['info']->getPhone(); ?>" class="form-control" type="text" name="phone" id="customer_phone" required>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-label">
                                            <label>Email</label>
                                        </div>
                                        <div class="col col-input has-button">
                                            <input class="form-control" type="text" value="<?php echo $data['info']->getEmail(); ?>" id="customer_email" name="customer_email" disabled="disabled">
                                        </div>
                                    </div>

                                    <div class="col col-label"></div>
                                    <div class="col-12 col-input form-buttons">
                                        <button class="btn btn--large" type="submit">Cập nhật</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- <?php require_once './mvc/views/shopping/footer.php'; ?> -->

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
       $('#infoForm').submit(function(e){
        e.preventDefault();

        // gửi data
        var sw = showLoadingSwal();
            $.ajax({
                url:'/Customer/EditInfo',
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
                Swal.fire(
                    'Oops...',
                    resp,
                    'error'
                )
            }
        }
    })
    });
   
</script>