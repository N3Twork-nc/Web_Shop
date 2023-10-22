<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once './mvc/views/admin/libHeader.php'; ?>

    <script src="/public/ckeditor/ckeditor.js"></script>
    <script src="/public/ckfinder/ckfinder.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
                <form id="ProductForm" action="/submit_product" method="post" enctype="multipart/form-data">
                    <label for="TenSanPham">Tên Sản phẩm:</label>
                    <input type="text" id="TenSanPham" name="TenSanPham" required>
                    <label for="GiaSanPham">Giá Sản phẩm:</label>
                    <input type="text" id="GiaSanPham" name="GiaSanPham" required>

                    <label for="DanhMuc">Danh mục sản phẩm:</label>
                    <select name="DanhMuc" id="DanhMuc">
                        <option value="Nam">Nam</option>
                        <option value="Nu">Nữ</option>
                        <option value="TreEm">Trẻ em</option>
                    </select>

                    <div id="ColorsSection">
                        <label>Chọn màu sắc:</label>
                        
                        <button type="button" id="AddColorButton">Thêm Màu</button>
                        <div id="colorPickerDialog" style="display:none; position: fixed; z-index: 10;">
                <div class="product-detail__color">
                    <div class="product-detail__color__input_dialog">
                        <label>
                            <input type="checkbox" name="red">
                                <span>
                                    <img src="/public/img/red.jpg" style="border-radius: 50%;"/>
                                </span>
                        </label>
                        <label>
                            <input type="checkbox" name="pink" >
                                <span>
                                    <img src="/public/img/pink.jpg" style="border-radius: 50%;"/>
                                </span>
                        </label>
                        <label>
                            <input type="checkbox" name="yellow" >
                                <span>                        
                                    <img src="/public/img/yellow.png" style="border-radius: 50%;"/>
                                </span>
                        </label>
                        <label>
                            <input type="checkbox" name="green" >
                                <span>                        
                                    <img src="/public/img/green.jpg" style="border-radius: 50%;"/>
                                </span>
                        </label>
                        <label>
                            <input type="checkbox" name="blue" >
                                <span>                        
                                    <img src="/public/img/blue.jpg" style="border-radius: 50%;"/>
                                </span>
                        </label>
                        <label>
                            <input type="checkbox" name="beige" >
                                <span>                        
                                    <img src="/public/img/beige.jpg" style="border-radius: 50%;"/>
                                </span>
                        </label>
                        <label>
                            <input type="checkbox" name="white" >
                                <span>                        
                                    <img src="/public/img/white.jpg" style="border-radius: 50%;"/>
                                </span>
                        </label>
                        <label>
                            <input type="checkbox" name="black" >
                                <span>                        
                                    <img src="/public/img/black.jpg" style="border-radius: 50%;"/>
                                </span>
                        </label>
                        <label>
                            <input type="checkbox" name="brown" >
                                <span>                        
                                    <img src="/public/img/brown.jpg" style="border-radius: 50%;"/>
                                </span>
                        </label>
                        <label>
                            <input type="checkbox" name="gray" >
                                <span>                        
                                    <img src="/public/img/gray.jpg" style="border-radius: 50%;"/>
                                </span>
                        </label>
                    </div>
                </div>
                    </div>

                    <button type="submit">Lưu</button>
                </form>

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
    // cancelBtn.addEventListener('click', function() {
    //     modal.style.display = "none";
    // })

    //ckeditor
    CKEDITOR.replace('MoTa', {
        filebrowserBrowseUrl: '/public/ckfinder/ckfinder.html',
        filebrowserUploadUrl: '/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });

document.getElementById("AddColorButton").addEventListener("click", function() {
            // Tạo giao diện để người dùng chọn màu sắc
            var colorContainer = document.getElementById("ColorsSection");
            var colorInput = document.createElement("input");
            colorInput.type = "color";
            colorInput.name = "Mau[]";
            colorContainer.appendChild(colorInput);

            // Tạo phần nhập size và số lượng cho màu này
            var sizeContainer = document.createElement("div");
            sizeContainer.className = "SizeContainer";
            var sizes = ["S", "M", "L", "XL", "XXL"];
            for (var i = 0; i < sizes.length; i++) {
                var sizeLabel = document.createElement("label");
                sizeLabel.innerHTML = sizes[i] + ": ";
                var sizeInput = document.createElement("input");
                sizeInput.type = "number";
                sizeInput.name = "Size[" + sizes[i] + "][]";
                sizeLabel.appendChild(sizeInput);
                sizeContainer.appendChild(sizeLabel);
            }
            colorContainer.appendChild(sizeContainer);
        });


$('#ProductForm').submit(function(e){
    e.preventDefault();

    var formData = new FormData(this);  // Tạo đối tượng FormData chứa dữ liệu biểu mẫu và tệp tải lên
    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }
    // $.ajax({
    //     url: '/Dashboard_product/AddProduct',  // Đặt URL để gửi yêu cầu
    //     method: 'POST',  // Phương thức POST
    //     data: formData,  // Dữ liệu sử dụng FormData
    //     processData: false,  // Ngăn jQuery xử lý dữ liệu
    //     contentType: false,  // Ngăn jQuery đặt tiêu đề 'Content-Type'
    //     error: function(err) {
    //         console.log(err);
    //     },
    //     success: function(resp) {
    //         var actionText = 'thêm';  // Thay đổi actionText nếu cần
    //         if (resp.trim() == 'done') {
    //             Swal.fire(
    //                 'Completed!',
    //                 'Bạn đã ' + actionText + ' sản phẩm thành công!',
    //                 'success'
    //             )
    //             setTimeout(function() {
    //                 location.reload();
    //             }, 1000);
    //             $('#myModal').hide();
    //             $('#ProductForm input[type="text"]').removeAttr('readonly').removeClass('readonly');
    //         } else {
    //             // Xử lý lỗi ở đây
    //             console.log(resp);
    //         }
    //     }
    // });
});
</script>
