<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once './mvc/views/admin/libHeader.php'; ?>

    <script src="/public/ckeditor/ckeditor.js"></script>
    <script src="/public/ckfinder/ckfinder.js"></script>
    <title>PTITShop</title>
</head>

<body>

    <?php require_once './mvc/views/admin/sideBar.php'; ?>

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <?php require_once './mvc/views/admin/navBar.php'; ?>

        <!-- End of Navbar -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Sản phẩm</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                Product
                            </a></li>
                        /
                        <li><a href="#" class="active">Shop</a></li>
                        <button id="addBtn" style="font-size: 14px; border: none; right: 0; position: absolute; margin-right: 26px;margin-bottom: 48px; background-color:var(--primary); color: white; width: 120px; height: 40px;border-radius: 8px;">
                            Thêm sản phẩm
                        </button>
                    </ul>
                </div>
            </div>

            <!--********************* Product ***********************-->
            <div style="background: var(--light);color: var(--dark);">
                <table width="100%">
                    <thead>
                        <tr>
                            <th style="width: 130px;"><span class="las la-sort"></span> MÃ SP</th>
                            <th style="width: 150px;"><span class="las la-sort"></span> TÊN SP</th>
                            <th style="width: 100px;"><span class=" las la-sort "></span> Giá</th>
                            <th style="width: 100px;"><span class="las la-sort "></span> % Giảm</th>
                            <th style="width: 100px;"><span class="las la-sort "></span> Màu</th>
                            <th style="width: 60px;"><span class="las la-sort "></span> Size</th>
                            <th style="width: 180px;"><span class="las la-sort "></span> Mô tả</th>
                            <th style="width: 150px;"><span class="las la-sort "></span> Ảnh</th>
                            <th style="width: 120px;"><span class="las la-sort "></span> DMSP</th>
                            <th style="width: 60px;"><span class="las la-sort "></span> SL</th>
                            <th><span class="las la-sort "></span> ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                </table>
            </div>
            <div id="myModal" class="modal" style="display: none;">
                <div class="modal-content" style="border-radius: 8px;">
                    <form id="ProductForm" action="/Dashboard_product/AddProduct" method="post" enctype="multipart/form-data">
                        <label for="ProductCode">Mã Sản phẩm:</label>
                        <input style="color: black;" type="text" id="MaSanPham" name="MaSanPham" required>
                        <label for="ProductName">Tên Sản phẩm:</label>
                        <input style="color: black;" type="text" id="TenSanPham" name="TenSanPham" required>
                        <label for="ProductValue">Giá Sản phẩm:</label>
                        <input style="color: black;" type="text" id="GiaSanPham" name="GiaSanPham" required>
                        <label for="ProductValue">Giá khuyến mãi(%):</label>
                        <input style="color: black; margin-bottom: 20px;" type="text" id="GiaKhuyenMai" name="GiaKhuyenMai" required>
                        <label for="ProductColor">Chọn màu sản phẩm:</label>
                        <select name="" id="" style="width: 100%; height: 45px; margin-bottom: 20px; padding-left: 20px;">
                            <!-- Mẫu test -->
                            <option value="Đỏ">Đỏ</option>
                            <option value="Cam">Cam</option>
                            <option value="Vàng">Vàng</option>
                            <option value="Lục">Lục</option>
                            <option value="Lam">Lam</option>
                            <option value="Chàm">Chàm</option>
                            <option value="Tím">Tím</option>
                        </select>
                        <label for="ProductSize">Chọn size sản phẩm:</label>
                        <select name="" id="" style="width: 100%; height: 45px; margin-bottom: 20px; padding-left: 20px;">
                            <!-- Mẫu test -->
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                        </select>
                        <label for="ProductColor">Mô tả sản phẩm:</label>
                        <textarea name="MoTa" id="MoTa" cols="30" rows="5" style="width: 100%; margin-bottom: 20px;" placeholder="Mô tả sản phẩm"></textarea>
                        <label for="ProductValue" style="margin-top: 20px;">Chọn hình ảnh:</label>
                        <input multiple type="file" name="fileToUpload[]" id="fileToUpload">
                        <label for="ProductCategory">Danh mục sản phẩm:</label>
                        <select name="" id="" style="width: 100%; height: 45px; margin-bottom: 20px; padding-left: 20px;">
                            <!-- Mẫu test -->
                            <option value="Nam">Nam</option>
                            <option value="Nu">Nữ</option>
                            <option value="TreEm">Trẻ em</option>
                        </select>
                        <label for="ProductColor">Số lượng:</label>
                        <input style="color: black; width: 100%; height: 45px; border-radius: 3px;" type="number" id="TenSanPham" name="TenSanPham" required>
                        <button style="color: white; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin-right: 10px;" type="submit" id="submitBtn">Thêm</button>
                        <button style="color: white; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;" class="btnCancel" type="button" id="cancelBtn">Hủy</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    </main>

    </div>

    <script src="/public/js/dashboard.js"></script>
</body>

</html>
<script>
    const link = document.querySelector(".slide-menu-product");
    const addBtn = document.getElementById("addBtn");
    const modal = document.getElementById("myModal");
    const cancelBtn = document.getElementById("cancelBtn");
    link.classList.add('active');

    //Thêm đơn hàng
    addBtn.addEventListener('click', function() {
        modal.style.display = "block";
    })


    // Xử lý nút cancel
    cancelBtn.addEventListener('click', function() {
        modal.style.display = "none";
    })

    //ckeditor
    CKEDITOR.replace('MoTa', {
        filebrowserBrowseUrl: '/public/ckfinder/ckfinder.html',
        filebrowserUploadUrl: '/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });
</script>