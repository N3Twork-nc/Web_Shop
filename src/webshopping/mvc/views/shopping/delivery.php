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
                        <?php $province = $data['province'] ?>
                        <div class="delivery-content-left-input-top-item">
                            <select id="province" style="width: 733px; padding-left: 10px;margin-left: 12px;height: 39px;background-color: white;margin-bottom: 12px; border-radius: 5px" onchange="loadDistricts()">
                                <option>Thành phố/ Tỉnh</option>
                                <option value="1">Hồ Chí Minh</option>
                                <option value="2">Thủ Đức</option>
                            </select>
                        </div>
                        <div class="delivery-content-left-input-top-item">
                        <select id="district" style="width: 733px; padding-left: 10px; margin-left: 12px; height: 39px; background-color: white; margin-bottom: 12px; border-radius: 5px" onchange="loadWards()">
                            <option>Quận/Huyện</option>
                         </select>
                        </div>
                    </div>
                    <div class="delivery-content-left-input-bottom">
                        <div class="delivery-content-left-input-bottom-item">
                        <select id="ward" style="width: 733px; padding-left: 10px; margin-left: -3px; height: 39px; background-color: white; margin-bottom: 12px; border-radius: 5px">
                            <option>Phường/Xã</option>
                         </select>
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

<script>
    function loadDistricts() {
        var provinceSelect = document.getElementById("province");
        var districtSelect = document.getElementById("district");
        districtSelect.innerHTML = "<option>Quận/Huyện</option>";
        if (provinceSelect.value == "1") {
            var districts = ["Quận 7", "Quận 5"];
        } else if (provinceSelect.value == "2") {
            var districts = ["Quận 9", "Quận 2"];
        }
        for (var i = 0; i < districts.length; i++) {
            var option = document.createElement("option");
            option.value = i + 1;
            option.text = districts[i];
            districtSelect.add(option);
        }
    }

    function loadWards() {
        var districtSelect = document.getElementById("district");
        var wardSelect = document.getElementById("ward");
        wardSelect.innerHTML = "<option>Phường/Xã</option>";
        var selectedDistrict = districtSelect.options[districtSelect.selectedIndex].text;
        console.log(selectedDistrict);
        if (selectedDistrict == "Quận 7") {
            var wards = ["Phường Phú Mỹ", "Phường Tân Quy"];
        } else if (selectedDistrict == "Quận 5") {
            var wards = ["Phường 5", "Phường 6"];
        } else if (selectedDistrict == "Quận 9") {
            var wards = ["Phường Hiệp Phú", "Phường Tăng Nhơn Phú A"];
        } else if (selectedDistrict == "Quận 2") {
            var wards = ["Phường Thảo Điền", "Phường An Phú"];
        }
        for (var i = 0; i < wards.length; i++) {
            var option = document.createElement("option");
            option.value = i + 1;
            option.text = wards[i];
            wardSelect.add(option);
        }
    }
</script>