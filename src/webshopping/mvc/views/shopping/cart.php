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

    <!-- Cart -->
    <section class="cart">
        <div class="lifcycle-cart">
            <p>Giỏ hàng</p>
            <!-- <p>Địa chỉ giao hàng</p> -->
            <p>Thanh toán</p>
        </div>
        <div class="container-cart">
            <div class="cart-top-wrap">
                <div class="cart-top">
                    <div class="cart-top-cart cart-top-item">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <!-- <div class="cart-top-address cart-top-item">
                        <i class="fa fa-map-marker"></i>
                    </div> -->
                    <div class="cart-top-payment cart-top-item">
                        <i class="fa fa-map-marker"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-cart">
            <div class="cart-content row">
                <div class="cart-content-left">
                    <table>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Màu</th>
                            <th>Size</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Xóa</th>
                        </tr>
                        <?php if (!empty($data['cartItem'])): ?>
                            <?php foreach($data['cartItem'] as $cart): ?>
                                <tr>
                                    <td><img src="<?php echo $cart->getProduct()->getImages()[0][0] === '.' ? substr($cart->getProduct()->getImages()[0], 1) : $cart->getProduct()->getImages()[0];  ?>" alt=""></td>
                                    <td>
                                        <p><?php echo $cart->getProduct()->getName(); ?></p>
                                        <p><?php echo $cart->getProduct()->getProduct_code(); ?></p>
                                    </td>
                                    <td>
                                        <p><img src="/public/img/<?php echo $cart->getProduct()->getColor(); ?>.png" alt=""></p>
                                    </td>
                                    <td>
                                        <p><?php echo $cart->getSize(); ?></p>
                                    </td>
                                    <td>
                                        <div class="quantity-container">
                                            <button class="decrement quantity-update" style="width: 30px;border-radius: 5px;background: #f9f5f3;"
                                                data-id="<?php echo $cart->getProduct()->getProduct_code(); ?>"
                                                csrf-token="<?php echo $data["csrf_token_cart"]; ?>"
                                                data-size="<?php echo $cart->getSize(); ?>">-</button>
                                            <div class="quantity"
                                                id="quantity_<?php echo $cart->getProduct()->getProduct_code(); ?>_<?php echo $cart->getSize(); ?>">
                                                <?php echo $cart->getQuantity(); ?>
                                            </div>
                                            <button class="increment quantity-update" style="width: 30px;border-radius: 5px;background: #f9f5f3;"
                                                data-id="<?php echo $cart->getProduct()->getProduct_code(); ?>"
                                                csrf-token="<?php echo $data["csrf_token_cart"]; ?>"
                                                data-size="<?php echo $cart->getSize(); ?>">+</button>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="total-price"><?php echo $cart->getPrice(); ?></p>
                                    </td>
                                    <td class="delete-button-cell">
                                       <p> <button class="deleteProduct quantity-update" style="font-size: 14px;font-weight: bold;padding: 5px 10px;background: #f00b0b;color: white;border-radius: 4px;border: red;"
                                        data-id="<?php echo $cart->getProduct()->getProduct_code(); ?>"
                                        csrf-token="<?php echo $data["csrf_token_cart"]; ?>"
                                        data-size="<?php echo $cart->getSize(); ?>">X</button></p>
                                    </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <!-- <tr>
                            <td><img src="/public/img/aothun_co_vien_den.jpg" alt=""></td>
                            <td>
                                <p>Áo cổ viền đen SKU 54B8352</p>
                            </td>
                            <td><img src="/public/img/color_black.png" alt=""></td>
                            <td>
                                <p>M</p>
                            </td>
                            <td><input type="number" value="1" min="1"></td>
                            <td>
                                <p>790.000 đ</p>
                            </td>
                            <td><span>X</span></td>
                        </tr> -->
                    </table>
                </div>
                <div class="cart-content-right">
                    <table>
                        <tr>
                            <th colspan="2">TỔNG TIỀN GIỎ HÀNG</th>
                        </tr>

                        <tr>
                            <td>TỔNG SẢN PHẨM</td>
                            <td id="total-quantity"></td>
                        </tr>
                        <tr>
                            <td>TỔNG TIỀN HÀNG</td>
                            <td id="total-amount">
                                <p style="font-size: 15px;"><sup>đ</sup></p>
                            </td>
                        </tr>
                        <tr>
                            <td>TẠM TÍNH</td>
                            <td id="sub-total">
                                <p style="color: black; font-weight: bold; font-size: 15px;"><sup>đ</sup></p>
                            </td>
                        </tr>

                    </table>
                    <div class="cart-content-right-text">
                        <p>Đơn hàng sẽ được freeship có giá trị từ 399.000 đ</p>
                    </div>
                    <div class="cart-content-right-button">
                        <a href="/Category">
                            <button>TIẾP TỤC MUA SẮM</button>
                        </a>
                        <a id="paymentLink" status="<?php echo $data['countItemInCart'] > 0 ? 1 : 0; ?>">
                            <button>THANH TOÁN</button>
                        </a>
                    </div>
                    <!-- <div class="cart-content-right-login">
                        <p>TÀI KHOẢN PTIT-SHOP</p>
                        <p>Hãy <a href="" style="color: #DDC488; font-weight: bold;">Đăng nhập </a>tài khoản của bạn để tích điểm thành viên</p>
                    </div> -->
                </div>
            </div>
        </div>
    </section>

    <?php require_once './mvc/views/shopping/footer.php'; ?>
    
</body>

</html>
<script src="/public/js/sroll.js "></script>
<script src="/public/js/responsiveMenu.js "></script>
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
    function submitForm(data){
        var sw = showLoadingSwal();
            $.ajax({
                url:'/Cart/ProductInCart',
                method:'POST',
                data:data,
                error:err=>{
                    // console.log(err)
                },
                success:function(resp){
                    if(resp.trim() == "done"){
                    Swal.fire(
                        'Completed!',
                        'Thao tác thành công!',
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
            });
    }
    document.addEventListener('DOMContentLoaded', function () {
        var quantityButtons = document.querySelectorAll('.quantity-update');

        quantityButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var productCode = button.getAttribute('data-id');
                var size = button.getAttribute('data-size');
                var csrf_token_cart = button.getAttribute('csrf-token');

                if (button.classList.contains('increment')) {
                      // Điền dữ liệu vào form
                    let actionWithProduct = 'increase';
                    let data = {
                        product_code: productCode,
                        sizeOfProduct: size,
                        actionWithProduct: actionWithProduct,
                        csrf_token_cart: csrf_token_cart
                    };
                    submitForm(data);
                } else if (button.classList.contains('decrement')) {
                    // Điền dữ liệu vào form
                    let actionWithProduct = 'decrease';
                    let data = {
                        product_code: productCode,
                        sizeOfProduct: size,
                        actionWithProduct: actionWithProduct,
                        csrf_token_cart: csrf_token_cart
                    };
                    submitForm(data);
                } else if(button.classList.contains('deleteProduct')){
                    let actionWithProduct = 'delete';
                    let data = {
                        product_code: productCode,
                        sizeOfProduct: size,
                        actionWithProduct: actionWithProduct,
                        csrf_token_cart: csrf_token_cart
                    };
                    submitForm(data);
                }
            });
        });

        function updateCartTotal() {
            const totalPrices = document.querySelectorAll('.total-price');
            const quantities = document.querySelectorAll('.quantity');

            let totalAmount = 0;
            let totalQuantity = 0;

            totalPrices.forEach(function (priceElement, index) {
                const price = parseFloat(priceElement.textContent.replace(/\D/g, ''));
                const quantity = parseInt(quantities[index].textContent);

                totalAmount += price * quantity;
                totalQuantity += quantity;
            });

            document.getElementById('total-quantity').textContent = totalQuantity;
            document.getElementById('total-amount').innerHTML = `<p style="font-size: 15px;">${totalAmount.toLocaleString()} <sup>đ</sup></p>`;
            document.getElementById('sub-total').innerHTML = `<p style="color: black; font-weight: bold; font-size: 15px;">${totalAmount.toLocaleString()} <sup>đ</sup></p>`;
        }

        updateCartTotal();
    });

    document.getElementById('paymentLink').addEventListener('click', function() {
    var status = parseInt(this.getAttribute('status'));

    if (status === 0) {
        Swal.fire(
                'Oops...',
                "Vui lòng thêm sản phẩm vào giỏ hàng trước khi tiến hành thanh toán",
                'error'
                );
    } else if(status === 1){
        window.location.href = '/Payment/';
    }
});
</script>

</script>