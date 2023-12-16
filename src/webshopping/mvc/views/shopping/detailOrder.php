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
    <link rel="stylesheet" href="/public/css/detailOrder.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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
                    <div class="col-lg col-account-content">
                        <div class="order-block__title">
                            <h2>
                                <span class="icon-ic_back"></span>CHI TIẾT ĐƠN HÀNG
                                <b><?php echo $data['order']->getOrder_code(); ?></b>
                            </h2>
                            <div class="order__status order--cancel">
                                <div style="margin-right: 15px">
                                </div>
                                <span style="margin-right: 5px" class="icon-ic_reload"></span>
                                <span><?php echo $data['order']->getStateVnText(); ?></span>
                            </div>
                        </div>
                        <div class="order-block row">
                            <div class="col-xl">
                                <div class="order-block__products checkout-my-cart">
                                    <table class="cart__tables">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <?php foreach($data['order']->getOrder_items() as $each): ?>
                                                    <div class="cart__product-item">
                                                        <div class="cart__product-item__img">
                                                            <img src="<?php echo substr($each->getProduct()[0]->getImages()[0], 1);  ?>" alt="">
                                                        </div>
                                                        <div class="cart__product-item__content">
                                                            <h3 class="cart__product-item__title">
                                                                <?php echo $each->getProduct()[0]->getName();  ?>
                                                            </h3>
                                                            <!-- <div class="cart__product-item__properties">
                                                                <p>Màu sắc: <span>Đen </span></p>
                                                            </div> -->
                                                            <div class="product-content-right-product-color">
                                                                <p style="font-weight: bold; font-size: 24px;">Màu sắc: <?php echo $each->getProduct()[0]->getColor(); ?></p>
                                                                <div class="product-content-right-product-color-img">
                                                                    <img style="border-radius: 50%; height: 20px; width: 22px; important!" src="/public/img/<?php echo $each->getProduct()[0]->getColor(); ?>.png" alt="">
                                                                </div>
                                                            </div> 
                                                            <div class="cart__product-item__properties">
                                                                <p>Size: <span style="text-transform: uppercase"><?php echo $each->getSize(); ?></span></p>
                                                            </div>
                                                            <div class="cart__product-item__properties">
                                                                <p>Số lượng: <span><?php echo $each->getQuantity(); ?></span></p>
                                                            </div>
                                                            <div class="cart__product-item__properties">
                                                                <p><span><?php echo $each->getProduct_code(); ?></span></p>
                                                            </div>
                                                            <div class="cart__product-item__btn--save">
                                                                <a class="btn btn--outline btn--large repurchase-product" href="<?php echo '/Product/Show/' . $each->getProduct_code() ?>">Mua lại</a>
                                                            </div>
                                                        </div>
                                                        <div class="cart__product-item__price">
                                                            <?php echo $each->getTotal_price(); ?>
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-xl-1"></div>
                            <div class="col-xl-4">
                                <div class="cart-summary">
                                    <div class="cart-summary__overview">
                                        <h3>Tóm tắt đơn hàng</h3>
                                        <div class="cart-summary__overview__item">
                                            <p>Ngày tạo đơn</p>
                                            <p><span><?php echo $data['order']->getOrder_date(); ?></span></p>
                                        </div>
                                        <div class="cart-summary__overview__item">
                                            <p>Tổng tiền</p>
                                            <p><b><?php echo $data['order']->getTotal_price(); ?><sup>đ</sup></b></p>
                                        </div>
                                    </div>
                                    <div class="cart-summary__payment">
                                        <h4>Hình thức thanh toán</h4>
                                        <div class="cart-summary__overview__item">
                                            <p><?php echo $data['order']->getTypeVnText(); ?></p>
                                            <div class="order__status">
                                                <span class="icon-ic_radio_active">
                                                    <div class="path1"></div>
                                                    <div class="path2"></div>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="cart-summary__address">
                                        <h4>Địa chỉ</h4>
                                        <div class="cart-summary__overview__item">
                                            <p> <?php echo $data['order']->getCustomer()->getFull_name(); ?> </p>
                                        </div>
                                        <div class="cart-summary__overview__item">
                                            <p>
                                                <?php echo $data['order']->getAddress(); ?><br>
                                            </p>
                                        </div>
                                        <div class="cart-summary__overview__item">
                                            <p>
                                            <?php echo "SĐT: " . $data['order']->getCustomer()->getPhone(); ?>
                                            </p>
                                        </div>
                                    </div>
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