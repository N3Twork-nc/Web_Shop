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
</head>

<body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <?php require_once './mvc/views/shopping/header.php'; ?>

    <!--************* Product  ****************  -->
    <section class="product">
        <div class="container-product">
            <div class="product-top row">
                <p>Trang chủ</p><span>&#10230; </span>
                <p>Nữ</p> <span>&#10230; </span>
                <p>Hàng nữ mới về</p>
                <!-- <span>&#10230;</span>
                <p>Áo thun Baby Tee</p> -->
            </div>
            <div class="product-content row">
                <div class="product-content-left row">
                    <?php if (!empty($data["product"])): ?>
                        <?php $product = $data["product"]; ?>
                        <div class="product-content-left-big-img">
                            <img src="<?php echo $product->getImages()[0][0] === '.' ? substr($product->getImages()[0], 1) : $product->getImages()[0];  ?>" alt="">
                        </div>
                        <div class="product-content-left-small-img">
                            <?php $images = $product->getImages(); ?>
                            <?php $countImages = count($images); ?>
                            <?php for ($i = 1; $i < min(4, $countImages); $i++): ?>
                                <?php $imagePath = $images[$i][0] === '.' ? substr($images[$i], 1) : $images[$i]; ?>
                                <img src="<?php echo $imagePath; ?>" alt="">
                            <?php endfor; ?>
                        </div>

                    <?php endif; ?>
                </div>


                <div class="product-content-right">
                    <?php if (!empty($data["product"])): ?>
                    <?php $product = $data["product"]; ?>
                        <div class="product-content-right-product-name">
                            <h1 style="padding-right: 10px;"><?php echo $product->getName(); ?></h1>
                            <p><?php echo $product->getProduct_code(); ?></p>
                        </div>
                        <div class="product-content-right-product-price">
                            <p style="font-weight: bold; font-size: 24px;"><?php echo $product->getPrice(); ?><sup>đ</sup></p>
                        </div>
                        <div class="product-content-right-product-color">
                            <p style="font-weight: bold; font-size: 24px;"><?php echo $product->getColor(); ?></p>
                            <div class="product-content-right-product-color-img">
                                <img src="/public/img/<?php echo $product->getColor(); ?>.png" alt="">
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- <div class="product-content-right-product-name">
                        <h1>ÁO THUN BABY TEE</h1>
                        <p>SKU: 57B9489</p>
                    </div>
                    <div class="product-content-right-product-price">
                        <p style="font-weight: bold; font-size: 24px;">590.000<sup>đ</sup></p>
                    </div>
                    <div class="product-content-right-product-color">
                        <p style="font-weight: bold; font-size: 24px;"><span>Màu sắc</span>: Trắng ngà</p>
                        <div class="product-content-right-product-color-img">
                            <img src="/public/img/color_trang_nga.png" alt="">
                        </div>
                    </div> -->
                    <div class="product-content-right-product-size" style="margin-top: 10px;">
                        <div class="size">
                            <span>S</span>
                            <span>M</span>
                            <span>L</span>
                            <span>XL</span>
                            <span>XXL</span>
                        </div>
                    </div>
                    <div class="quantity">
                        <p style="font-weight: bold; color: #6C6D70;">Số lượng</p>
                        <input type="number" min="0" value="1" class="custom-number-input">
                    </div>
                    <p style=" color: red; display: none;">Vui lòng chọn size</p>
                    <div class="product-content-right-product-button">
                        <button><p style="margin-bottom: 1%;">THÊM VÀO GIỎ</p></button>
                        <a href="/Cart">
                            <button><i class="fa fa-shopping-cart"></i><p style="margin-bottom: 1%;">MUA HÀNG</p></button>
                        </a>
                    </div>
                    <div class="product-content-right-product-icon">
                        <div class="product-content-right-product-icon-item">
                            <i class="fa fa-phone"></i>
                            <p style="margin-bottom: 1%;">Hotline</p>
                        </div>
                        <div class="product-content-right-product-icon-item">
                            <i class="fa fa-wechat"></i>
                            <p style="margin-bottom: 1%;">Chat</p>
                        </div>
                        <div class="product-content-right-product-icon-item">
                            <i class="fa fa-envelope"></i>
                            <p style="margin-bottom: 1%;">Email</p>
                        </div>
                    </div>
                    <div class="product-content-right-bottom">
                        <div class="product-content-right-bottom-top">
                            <i class="fa fa-angle-down" style="font-size: 22px; font-weight: bold"></i>
                        </div>
                        <div class="product-content-right-bottom-content-big">
                            <div class="product-content-right-bottom-content-title row">
                                <div class="product-content-right-bottom-content-title-item introduction">
                                    <p>Giới thiệu</p>
                                </div>
                                <div class="product-content-right-bottom-content-title-item detail">
                                    <p>Chi tiết sản phẩm</p>
                                </div>
                                <div class="product-content-right-bottom-content-title-item preserve">
                                    <p>Bảo quản</p>
                                </div>
                                <div class="product-content-right-bottom-content-title-item">
                                    <p>Tham khảo Size</p>
                                </div>
                            </div>
                            <div class="product-content-right-bottom-content">
                                <div class="product-content-right-bottom-content-introduction">
                                    <p>Trẻ trung, năng động xuống phố ngày hè trong kiểu dáng thun Baby Tee đang được các bạn trẻ ưa chuộng hiện nay.</p>
                                    <p>Thiết kế áo trơn, cổ tròn, tạo điểm nhấn in chữ nổi mặt sau. Bạn có thể kết hợp áo cùng nhiều kiểu chân váy và quần khác nhau để tạo nên phong cách riêng cho mình. </p>
                                    <p style="font-weight: bold; font-size: 16px;">Thông tin mẫu:</p>
                                    <p style="font-weight: bold; font-size: 16px;">Chiều cao: <span style="font-weight: normal; font-size: 14px;">163 cm</span></p>
                                    <p style="font-weight: bold; font-size: 16px;">Cân nặng: <span style="font-weight: normal; font-size: 14px;">47kg</span></p>
                                    <p style=" font-weight: bold; font-size: 16px;">Số đo 3 vòng: <span style="font-weight: normal; font-size: 14px;">83-61-90cm</span>
                                    </p>
                                    <p>Mẫu mặc size S Lưu ý: Màu sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện ánh sáng khi chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.</p>
                                </div>
                                <div class="product-content-right-bottom-content-detail" style="display: none;">
                                    <p style="font-weight: bold;">Dòng sản phẩm: <span style="font-weight: normal;">You</span></p>
                                    <p style="font-weight: bold;">Nhóm sản phẩm: <span style="font-weight: normal;">Áo</span></p>
                                    <p style="font-weight: bold;">Cổ áo: <span style="font-weight: normal;">Cổ tròn</span></p>
                                </div>
                                <div class="product-content-right-bottom-content-preserve" style="display: none;">
                                    <p>Chi tiết bảo quản sản phẩm :</p>
                                    <p style="font-weight: bold;">* Các sản phẩm thuộc dòng cao cấp (Senora) và áo khoác (dạ, tweed, lông, phao) chỉ giặt khô, tuyệt đối không giặt ướt.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Product related -->
<section class="product-related">
    <div class="product-related-title">
        <p>Sản phẩm tương tự</p>
    </div>
    <div class="product-content-row-items" style="padding-right: 10px;">
        <?php if (!empty($data["related_products"]) && is_array($data["related_products"])): ?>
            <?php 
                // Lấy mã sản phẩm đã tìm kiếm
                $searchedProductCode = !empty($data["product"]) ? $data["product"]->getProduct_code() : null;

                // Lọc bỏ sản phẩm đã tìm kiếm
                $filteredProducts = array_filter($data["related_products"], function($relatedProduct) use ($searchedProductCode) {
                    return strcasecmp($relatedProduct->getProduct_code(), $searchedProductCode) !== 0;
                });
                //Chọn tối đa được 4
                $maxProductsToShow = 4;
                $filteredProducts = array_slice($filteredProducts, 0, $maxProductsToShow);

                if (empty($filteredProducts)) {
                    echo '<p class="no-related-products">KHÔNG CÓ SẢN PHẨM NÀO LIÊN QUAN!!!</p>';
                }   
            ?>
            <?php foreach ($filteredProducts as $relatedProduct): ?>
                <div class="product-related-item">
                    <a href="/Product/Show/<?php echo $relatedProduct->getProduct_code(); ?>">
                        <img src="<?php echo $relatedProduct->getImages()[0][0] === '.' ? substr($relatedProduct->getImages()[0], 1) : $relatedProduct->getImages()[0]; ?>" alt="">
                        <p style="font-size: 14px;"><?php echo $relatedProduct->getName(); ?></p>
                        <p><?php echo $relatedProduct->getPrice(); ?><sup>đ</sup></p>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

    <?php require_once './mvc/views/shopping/footer.php'; ?>
    
</body>

</html>
<script src="/public/js/sroll.js "></script>
<script src="/public/js/responsiveMenu.js "></script>
<script src="/public/js/product.js "></script>