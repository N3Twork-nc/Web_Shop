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
            </div>
        </div>
        <div class="container-category" style="margin-left: 5% !important;">
            <div class="category-fix row">
                <div class="category-left">
                    <ul>
                        <!-- <li class="category-left-li"><a href="#">NỮ</a>
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
                        <li class="category-left-li"><a href="#">SALE</a></li> -->
                    </ul>
                </div>
                <div class="category-right row">
                    <div class="category-right-top-item">
                        <p>
                            <?php
                                if(isset($data['name'])){
                                    if($data['name'] != "None"){
                                        echo "Đây là các sản phẩm " . mb_strtolower($data['name'], "UTF-8") . " mới nhất";
                                    }
                                    else {
                                        echo "Đây là các sản phẩm mới nhất";
                                    }
                                
                                }
                                else{
                                    if($data['findName']){
                                        echo "Kết quả tìm kiếm theo '" . $data['findName'] . "'";
                                    }
                                }
                            ?>
                        </p>
                    </div>
                    <br>
                    <div id="myTable" class="category-right-content row" style="width: 100%;">
                       <?php $checkNone = 0; ?>
                       <?php if (count($data["products"]) > 0): ?>
                            <?php foreach($data["products"] as $product): ?>    
                                <div class="category-right-content-item">
                                    <a href="/Product/Show/<?php echo $product->getProduct_code(); ?>">
                                        <img src="<?php echo $product->getImages()[0][0] === '.' ? substr($product->getImages()[0], 1) : $product->getImages()[0];  ?>" alt="">
                                        <p style="font-size:14px;"><?php echo $product->getName(); ?></p>
                                        <p><?php echo $product->getPrice(); ?><sup>đ</sup></p>
                                    </a>
                                </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <div class="category-right-content-item" style="width:100%;">                          
                                    <img style= "width: 30%" src="/public/img/searchfail.png" alt="">
                                    <p style="font-size: 1.125rem">Hiện không có sản phẩm</p>
                            </div>
                        <?php endif; ?>
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
<script src="/public/js/pagination.js"></script>


<script>
//    var p = document.getElementById("noneProduct");
//    p.classList.remove("category-right-content");

</script>