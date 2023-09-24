<!doctype html>
<html lang="en">

<head>
    <title>PTIT Shop</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PTIT-Shop</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./view/shopping/css/trangchu.css">
    <link rel="stylesheet" href="./view/shopping/css/responsive.css">
</head>

<body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <?php require_once 'header.php'; ?>

    <!--****** SLIDER ****** -->

    <div class="slider">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="imageTrain" src="./view/shopping/img/home_fashion1.png" alt="Hình ảnh 1">
                    <div class="carousel-caption">
                        <h3></h3>
                        <p></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="imageTrain" src="./view/shopping/img/home_fashion2.png" alt="Hình ảnh 2">
                    <div class="carousel-caption">
                        <h3></h3>
                        <p></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="imageTrain" src="./view/shopping/img/home_fashion3.png" alt="Hình ảnh 3">
                    <div class="carousel-caption">
                        <h3></h3>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'footer.php'; ?>
    
</body>


</html>
<script src="./view/shopping/js/sroll.js"></script>
<script src="./view/shopping/js/responsiveMenu.js"></script>