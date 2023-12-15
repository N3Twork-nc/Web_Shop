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
            <p>Thanh toán</p>
        </div>
        <div class="container-delivery" style="padding-left: 0% !important;">
            <div class="delivery-top-wrap">
                <div class="cart-top">
                    <div class="delivery-top-delivery delivery-top-item">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="delivery-top-address delivery-top-item">
                        <i class="fa fa-map-marker"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-delivery">
            <div class="delivery-content row" style="margin-right: 0px !important;">
                <div class="delivery-content-left">
                    <p>Địa chỉ giao hàng</p>
                    
                    <div class="delivery-content-left-input-top row">
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
                    <div class="delivery-content-left-payment">
                        <input name="payment" type="radio" style="display: inline !important;" checked>
                        <label for="">Thu tiền khi nhận hàng</label>
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
                            <th>Số lượng</th>
                            <th></th>
                            <th>Thành tiền</th>
                        </tr>
                        <?php $total = 0; ?>
                        <?php foreach ($data['cartItem'] as $cartItem): ?>
                            <tr>
                                <td data-label="ProductName"><?php echo $cartItem->getProduct()->getName(); ?></td>
                                <td data-label="ProductNumber"><?php echo $cartItem->getQuantity(); ?></td>
                                <td></td>
                                <td>
                                    <p data-label="ProductMoney"><?php echo $cartItem->getTotal_price(); ?></p>
                                    <?php $total = $total +  $cartItem->getTotal_price();?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td style="font-weight: bold;" colspan="3">Tổng tiền</td>
                            <td style="font-weight: bold;">
                               <p data-label="TotalPrice"><?php echo $total . '.000 đ'; ?></p> 
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