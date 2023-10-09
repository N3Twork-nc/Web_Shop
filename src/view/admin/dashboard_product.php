<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once 'libHeader.php'; ?>
    <script src="./view/admin/ckeditor/ckeditor.js"></script>
    <script src="./view/admin/ckfinder/ckfinder.js"></script>
    <title>PTITShop</title>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>PTIT</span>Shop</div>
        </a>
        <ul class="side-menu">
            <li class="slide-menu-product"><a href="#"><i class='bx bxs-dashboard'></i>Sản phẩm</a></li>
            <li class="slide-menu-category"><a href="/?page=dashboard_category"><i class='bx bx-store-alt'></i>Danh mục sản phẩm</a></li>
            <li class="slide-menu-order"><a href="/?page=dashboard_order"><i class='bx bx-analyse'></i>Đơn hàng</a></li>
            <li class="slide-menu-details"><a href="/?page=dashboard_details"><i class='bx bx-message-square-dots'></i>Chi tiết đơn hàng</a></li>
            <li class="slide-menu-customer"><a href="/?page=dashboard_customer"><i class='bx bx-group'></i>Khách hàng</a></li>
            <li><a href="#"><i class='bx bx-cog'></i>Settings</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="/?page=login.html" class="logout">
                    <i class='bx bx-log-out-circle'></i> Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="profile">
                <img src="./view/admin/img/user.jpg">
            </a>
        </nav>

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
                    <form id="ProductForm">
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
                        <input type="file">
                        <label for="ProductManyValue" style="margin-top: 20px;">Chọn ảnh liên quan (có thể chọn nhiều ảnh):</label>
                        <input multiple type="file" style="margin-bottom: 20px;">
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

    <script src="./view/admin/js/dashboard.js"></script>
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
        filebrowserBrowseUrl: './view/admin/ckfinder/ckfinder.html',
        filebrowserUploadUrl: './view/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });
</script>