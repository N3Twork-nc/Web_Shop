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

    <link rel="stylesheet" href="/public/css/category.css">
</head>

<body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <?php require_once './mvc/views/shopping/header.php'; ?>

    <!--************* Category ***************-->
    <section class="category">
        <div class="container-category" style="margin-left: 4% !important;">
            <div class="category-top row">
                <p>Trang chủ</p><span>&#10230; </span>
                <p>Nữ</p> <span>&#10230; </span>
                <p>Hàng nữ mới về</p>
            </div>
        </div>
        <div class="container-category" style="margin-left: 5% !important;">
            <div class="category-fix row">
                <div class="category-left">
                    <ul>
                        <li class="category-left-li"><a href="#">NỮ</a>
                            <ul>
                                <li>
                                    <a href=""></a>HÀNG NỮ MỚI VỀ</li>
                                <li>
                                    <a href=""></a>ÁO +</li>
                                <li>
                                    <a href=""></a>QUẦN +</li>
                            </ul>
                        </li>
                        <li class="category-left-li"><a href="#">NAM</a>
                            <ul>
                                <li>
                                    <a href=""></a>HÀNG NAM MỚI VỀ</li>
                                <li>
                                    <a href=""></a>ÁO +</li>
                                <li>
                                    <a href=""></a>QUẦN +</li>
                            </ul>
                        </li>
                        <li class="category-left-li"><a href="#">TRẺ EM</a></li>
                        <li class="category-left-li"><a href="#">SALE</a></li>
                    </ul>
                </div>
                <div class="category-right row">
                    <div class="category-right-top-item">
                        <p>HÀNG NỮ MỚI VỀ</p>
                    </div>
                    <div class="category-right-top-item">
                        <button id="filterButton"><span>Bộ lọc</span> <i class="fa fa-sort-down"></i></button>
                    </div>
                    <div class="category-right-top-item">
                        <select name="" id="">
                            <option value="">Sắp xếp</option>
                            <option value="">Giá cao đến thấp</option>
                            <option value="">Giá thấp đến cao</option>
                        </select>
                    </div>

                    <div class="category-right-content row">
                        <div class="category-right-filter" id="filterDiv" style="display: none;">
                            <div class="filter-row">
                                <div class="filter-row-title">
                                    <h4>Size</h4>
                                </div>
                                <div class="filter-row-title">
                                    <h4>Màu sắc</h4>
                                </div>
                                <div class="filter-row-title">
                                    <h4>Còn hàng</h4>
                                </div>
                            </div>
                            <div class="filter-row">
                                <div class="filter-row-section size-section">
                                    <ul class="custom-squares">
                                        <li><label for="sizeS"><span class="custom-square">S</span></label></li>
                                        <li><label for="sizeM"><span class="custom-square">M</span></label></li>
                                        <li><label for="sizeL"><span class="custom-square">L</span></label></li>
                                        <li><label for="sizeXL"><span class="custom-square">XL</span></label></li>
                                        <li><label for="sizeXXL"><span class="custom-square">XXL</span></label></li>
                                    </ul>
                                </div>
                                <div class="filter-row-section second">
                                    <ul>
                                        <li><label for="colorXanh"><span class="square" style="background-color: rgb(44, 44, 84);"></span></label></li>
                                        <li><label for="colorDo"><span class="square" style="background-color: rgb(106, 30, 30);"></span></label></li>
                                        <li><label for="colorTim"><span class="square" style="background-color: rgb(187, 110, 187);"></span></label></li>
                                        <li><label for="colorVang"><span class="square" style="background-color: rgb(195, 195, 92);"></span></label></li>
                                        <li><label for="colorLuc"><span class="square" style="background-color: rgb(8, 129, 8);"></span></label></li>
                                        <li><label for="colorLam"><span class="square" style="background-color: rgb(49, 49, 157);"></span></label></li>
                                        <li><label for="colorCham"><span class="square" style="background-color: rgb(225, 170, 66);"></span></label></li>
                                        <li><label for="colorTia"><span class="square" style="background-color: rgb(79, 32, 79);"></span></label></li>
                                    </ul>
                                </div>
                                <div class="filter-row-section">
                                    <ul>
                                        <li><input type="checkbox" id="inStock"></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="filter-row">
                                <div class="filter-row-button">
                                    <button id="applyFilterButton">Lọc</button>
                                </div>
                            </div>
                        </div>
                        <?php foreach($data["products"] as $product): ?>
                        <div class="category-right-content-item">
                            <a href="/Product/Show/<?php echo $product->getProduct_code(); ?>">
                                <img src="<?php echo $product->getImages()[0][0] === '.' ? substr($product->getImages()[0], 1) : $product->getImages()[0];  ?>" alt="">
                                <p style="font-size:14px;"><?php echo $product->getName(); ?></p>
                                <p><?php echo $product->getPrice(); ?><sup>đ</sup></p>
                            </a>
                        </div>
                        <?php endforeach; ?>
                        <!-- <div class="category-right-content-item">
                            <a href="/Product">
                                <img src="/public/img/aothun_babytee.jpg" alt="">
                                <p style="font-size:14px;">Lace skirt - Áo thun baby tee</p>
                                <p>590.000<sup>đ</sup></p>
                            </a>
                        </div>
                        <div class="category-right-content-item">
                            <a href="/Product">
                                <img src="/public/img/aothun_babytee.jpg" alt="">
                                <p style="font-size:14px;">Lace skirt - Áo thun baby tee</p>
                                <p>590.000<sup>đ</sup></p>
                            </a>
                        </div>
                        <div class="category-right-content-item">
                            <a href="/Product">
                                <img src="/public/img/aothun_babytee.jpg" alt="">
                                <p style="font-size:14px;">Lace skirt - Áo thun baby tee</p>
                                <p>590.000<sup>đ</sup></p>
                            </a>
                        </div>
                        <div class="category-right-content-item">
                            <a href="/Product">
                                <img src="/public/img/aothun_babytee.jpg" alt="">
                                <p style="font-size:14px;">Lace skirt - Áo thun baby tee</p>
                                <p>590.000<sup>đ</sup></p>
                            </a>
                        </div>
                        <div class="category-right-content-item">
                            <a href="/Product">
                                <img src="/public/img/aothun_babytee.jpg" alt="">
                                <p style="font-size:14px;">Lace skirt - Áo thun baby tee</p>
                                <p>590.000<sup>đ</sup></p>
                            </a>
                        </div>
                        <div class="category-right-content-item">
                            <a href="/Product">
                                <img src="/public/img/aothun_babytee.jpg" alt="">
                                <p style="font-size:14px;">Lace skirt - Áo thun baby tee</p>
                                <p>590.000<sup>đ</sup></p>
                            </a>
                        </div>
                        <div class="category-right-content-item">
                            <a href="/Product">
                                <img src="/public/img/aothun_babytee.jpg" alt="">
                                <p style="font-size:14px;">Lace skirt - Áo thun baby tee</p>
                                <p>590.000<sup>đ</sup></p>
                            </a>
                        </div> -->
                    </div>

                    <div class="category-right-bottom row">
                        <div class="category-center-bottom-items">
                            <ul class="pagination">
                                <li><a href="#">&laquo;</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">&raquo;</a></li>
                                <li><a href="#">Trang cuối</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php require_once './mvc/views/shopping/footer.php'; ?>
    
</body>

</html>
<script src="/public/js/sroll.js"></script>
<script src="/public/js/responsiveMenu.js"></script>
<script src="/public/js/category.js"></script>