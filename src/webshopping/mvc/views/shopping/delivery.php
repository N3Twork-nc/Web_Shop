<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PTIT-Shop</title>

    <!-- Bootstrap CSS -->
    <?php require_once './mvc/views/shopping/libcss.php'; ?>

    <link rel="stylesheet" href="/public/css/product.css">
    <link rel="stylesheet" href="/public/css/cart.css">
    <link rel="stylesheet" href="/public/css/delivery.css">
</head>

<body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <?php require_once './mvc/views/shopping/header.php'; ?>

    <!--************* Delivery ***************-->
    <section class="delivery">
        <div class="lifcycle-delivery">
            <p>Giỏ hàng</p>
            <p>Địa chỉ giao hàng</p>
            <p>Thanh toán</p>
        </div>
        <div class="container-delivery">
            <div class="delivery-top-wrap">
                <div class="cart-top">
                    <div class="delivery-top-delivery delivery-top-item">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="delivery-top-address delivery-top-item">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <div class="delivery-top-payment delivery-top-item">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-delivery">
            <div class="delivery-content row">
                <div class="delivery-content-left">
                    <p>Địa chỉ giao hàng</p>
                    <div class="delivery-content-user row">
                        <div class="delivery-content-left-login">
                            <button class="btn-login">ĐĂNG NHẬP</button>
                        </div>
                        <div class="delivery-content-left-register">
                            <button class="btn-register">ĐĂNG KÝ</button>
                        </div>
                    </div>
                    <p style="font-weight: normal; margin-top: 10px;">Đăng nhập/ Đăng ký tài khoản để được tích điểm và nhận thêm nhiều ưu đãi từ PTIT-Shop.</p>

                    <div class="delivery-content-left-input-top row">
                        <div class="delivery-content-left-input-top-item">
                            <input class="form-control" type="text" value="" name="name" placeholder="Họ tên">
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <input class="form-control" type="text" value="" name="number-phone" placeholder="Số điện thoại">
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <input class="form-control" type="text" value="" name="city" placeholder="Tỉnh/Thành phố">
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <input class="form-control" type="text" value="" name="district" placeholder="Quận/Huyện">
                        </div>
                    </div>
                    <div class="delivery-content-left-input-bottom">
                        <div class="delivery-content-left-input-bottom-item">
                            <input class="form-control" type="text" value="" name="commune" placeholder="Phường xã">
                        </div>
                        <div class="delivery-content-left-input-bottom-item">
                            <input class="form-control" type="text" value="" name="address" placeholder="Địa chỉ">
                        </div>
                    </div>
                    <div class="delivery-content-left-button row">
                        <a href="/Cart"><span>&#171;</span><p>Quay lại giỏ hàng</p></a>
                        <a href="/Payment">
                            <button><p>THANH TOÁN VÀ GIAO HÀNG</p></button>
                        </a>
                    </div>
                </div>
                <div class="delivery-content-right">
                    <table>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Giảm giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                        <tr>
                            <td>Áo thun baby tee SKU 57B9489</td>
                            <td>-25%</td>
                            <td>1</td>
                            <td>
                                <p>590.000 đ</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Áo cổ viền đen SKU 54B8352</td>
                            <td>-15%</td>
                            <td>1</td>
                            <td>
                                <p>790.000 đ</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;" colspan="3">Tạm tính</td>
                            <td style="font-weight: bold;">
                                <p>1.380.000 đ</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;" colspan="3">Thuế VAT</td>
                            <td style="font-weight: bold;">
                                <p>50.000 đ</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;" colspan="3">Tổng tiền</td>
                            <td style="font-weight: bold;">
                                <p>1.430.000 đ</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <?php require_once './mvc/views/shopping/footer.php'; ?>
    
</body>

</html>
<script src="/public/js/sroll.js "></script>
<script src="/public/js/responsiveMenu.js "></script>