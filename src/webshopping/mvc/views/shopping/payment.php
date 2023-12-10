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
    <link rel="stylesheet" href="/public/css/payment.css">
</head>

<body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <?php require_once './mvc/views/shopping/header.php'; ?>

    <!--************* Payment ***************-->
    <section class="payment">
        <div class="lifcycle-payment">
            <p>Giỏ hàng</p>
            <p>Địa chỉ giao hàng</p>
            <p>Thanh toán</p>
        </div>
        <div class="container-payment">
            <div class="payment-top-wrap">
                <div class="cart-top">
                    <div class="payment-top-cart payment-top-item">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="payment-top-address payment-top-item">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <div class="payment-top-payment payment-top-item">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-payment">
            <div class="payment-content row">
                <div class="payment-content-left">
                    <div class="payment-content-left-method-payment">
                        <p style="font-weight: bold; font-size: 16px;">Phương thức thanh toán</p>
                        <div class="payment-content-left-method-payment-item">
                            <input name="payment" type="radio">
                            <label for="">Thanh toán bằng thẻ Visa</label>
                        </div>
                        <div class="payment-content-left-method-payment-item-img">
                            <img src="/public/img/visa.png" alt="" style="width: 15%;">
                        </div>
                        <div class="payment-content-left-method-payment-item">
                            <input name="payment" type="radio">
                            <label for="">Thu tiền khi nhận hàng</label>
                        </div>
                    </div>
                </div>
                <div class="payment-content-right">
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
                                <p style="padding-top: 2%;">590.000 đ</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Áo cổ viền đen SKU 54B8352</td>
                            <td>-15%</td>
                            <td>1</td>
                            <td>
                                <p style="padding-top: 2%;">790.000 đ</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">Tạm tính</td>
                            <td>
                                <p style="padding-top: 2%;">1.380.000 đ</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">Giao hành nhanh</td>
                            <td>
                                <p style="padding-top: 2%;">50.000 đ</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;" colspan="3">Tiền thanh toán</td>
                            <td style="font-weight: bold;">
                                <p style="padding-top: 2%;">1.430.000 đ</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="payment-content-right-payment">
                <button>THANH TOÁN ĐƠN HÀNG</button>
            </div>
        </div>
    </section>

    <?php require_once './mvc/views/shopping/footer.php'; ?>
    
</body>

</html>
<script src="/public/js/sroll.js "></script>
<script src="/public/js/responsiveMenu.js "></script>