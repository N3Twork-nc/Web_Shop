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
    <link rel="stylesheet" href="/public/css/orderManagement.css">
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
                    <div class="col-lg-8 col-xl col-account-content">
                        <div class="order-block__title">
                            <h2 style="font-family: initial; font-size: 28px; font-weight:bold;">QUẢN LÝ ĐƠN HÀNG</h2>
                        </div>
                        <div class="order-block">
                        <p class="alert alert-primary">"Nếu bạn muốn hủy đơn hàng vui lòng liên hệ hotline."</p>
                            <table class="order-block__table">
                                <thead>
                                    <tr>
                                        <th>MÃ ĐƠN HÀNG</th>
                                        <th>NGÀY</th>
                                        <th style="width: 210px">TRẠNG THÁI</th>
                                        <!-- <th>SẢN PHẨM</th> -->
                                        <th>TỔNG TIỀN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php //var_dump($data['order'][0]);  ?>
                                    <?php foreach($data['order'] as $order): ?>
                                        <tr ng-repeat="item in list_order track by $index" class="ng-scope">
                                            <td>
                                                <a href="<?php echo "/Customer/OrderDetail/" . $order->getOrder_code(); ?>" class="ng-binding" style="color: #6c6d70; text-decoration: underline;"><?php echo $order->getOrder_code(); ?></a>
                                            </td>
                                            <td class="ng-binding"><?php echo $order->getOrder_date(); ?></td>
                                            <td>
                                                <div class="order__status">
                                                    <span class="icon-ic_reload"></span>
                                                    <span class="ng-binding"><?php echo $order->getStateVnText(); ?></span>
                                                </div>
                                            </td>
                                            <td><span class="price ng-binding"><?php echo $order->getTotal_price() . " đ"; ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php foreach($data['orderHistory'] as $order): ?>
                                        <tr ng-repeat="item in list_order track by $index" class="ng-scope">
                                            <td>
                                                <a href="<?php echo "/Customer/OrderDetail/" . $order->getOrder_code(); ?>" class="ng-binding" style="color: #6c6d70; text-decoration: underline;"><?php echo $order->getOrder_code(); ?></a>
                                            </td>
                                            <td class="ng-binding"><?php echo $order->getOrder_date(); ?></td>
                                            <td>
                                                <div class="order__status">
                                                    <span class="icon-ic_reload"></span>
                                                    <span class="ng-binding"><?php echo $order->getStateVnText(); ?></span>
                                                </div>
                                            </td>
                                            <td><span class="price ng-binding"><?php echo $order->getTotal_price() . " đ"; ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once './mvc/views/shopping/footer.php'; ?>

</body>

</html>