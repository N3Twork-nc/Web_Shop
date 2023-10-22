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
                    <form id="ProductForm" enctype="multipart/form-data">
                        <label for="ProductName">Tên Sản phẩm:</label>
                        <input style="color: black;" type="text" id="TenSanPham" name="TenSanPham" required>
                        <label for="ProductValue">Giá Sản phẩm:</label>
                        <input style="color: black;" type="text" id="GiaSanPham" name="GiaSanPham" required>
                        <label for="ProductValue">Giá khuyến mãi(%):</label>
                        <input style="color: black; margin-bottom: 20px;" type="text" id="GiaKhuyenMai" name="GiaKhuyenMai" required>
                        <label for="ProductColor">Chọn màu sản phẩm:</label>
                        <div class="product-detail__color">
                            <div class="product-detail__color__input"></div>
                        </div>
                        <!-- Thêm nút button -->
                        <button id="colorPickerButton">Chọn Màu</button>

                        <label for="ProductValue" style="margin-top: 20px;">Chọn hình ảnh:</label>
                        <input multiple name="fileUpLoad[]" type="file" id="ProductValue">
                        <label for="ProductSize" style="margin-top: 20px">Chọn size sản phẩm:</label>
                        <div class="product-detail__size" style="margin-top: 10px;">
                            <div class="product-detail__size__input">                                                                                                                                                <label>
                                <input type="radio" name="size" value="s"/>
                                    <span class="text-uppercase" style="">s</span>
                                </label>                                                                                                                                                                                                                        <label>
                                    <input type="radio" name="size" value="m"/>
                                    <span class="text-uppercase">m</span>
                                </label>                                                                                                                                                                                                                        <label>
                                    <input type="radio" name="size" value="l"/>
                                    <span class="text-uppercase">l</span>
                                </label>                                                                                                                                                                                                                        <label>
                                    <input type="radio" name="size" value="xl"/>
                                    <span class="text-uppercase">xl</span>
                                </label>
                                </label>                                                                                                                                                                                                                        <label>
                                    <input type="radio" name="size" value="xxl"/>
                                    <span class="text-uppercase">xxl</span>
                                </label>
                             </div>
                        </div>
                        <label for="ProductNumber">Số lượng:</label>
                        <input style="color: black; width: 100%; height: 45px; border-radius: 3px;" type="number" id="SoLuongSP" name="SoLuongSP" required>
                        <button id="save" style="margin-top: 15px">Lưu</button>
                        <label for="ProductColor" style="margin-top: 20px">Mô tả sản phẩm:</label>
                        <textarea name="MoTa" id="MoTa" cols="30" rows="5" style="width: 100%; margin-bottom: 20px;" placeholder="Mô tả sản phẩm"></textarea>
                        <label for="ProductCategory" style="margin-top: 20px">Danh mục sản phẩm:</label>
                        <select name="" id="" style="width: 100%; height: 45px; margin-bottom: 20px; padding-left: 20px;">
                            <!-- Mẫu test -->
                            <option value="Nam">Nam</option>
                            <option value="Nu">Nữ</option>
                            <option value="TreEm">Trẻ em</option>
                        </select>
                        <label for="TotalProduct">Tổng số lượng:</label>
                        <input style="color: black; background-color: #ddd; width: 100%; height: 45px; border-radius: 3px;" type="number" id="TongSP" name="TongSP" required readonly>
                        <button style="color: white; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin-right: 10px;" type="submit" id="submitBtn">Thêm</button>
                        <button style="color: white; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;" class="btnCancel" type="button" id="cancelBtn">Hủy</button>
                    <!-- </form> -->
                </div>
            </div>
            <!-- Dialog chọn màu -->
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
                <button type="submit" id="confirmColor_confirm">Xác nhận</button>
                <button id="confirmColor_cancel">Hủy</button>
            </div>
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
    cancelBtn.addEventListener('click', function() {
        modal.style.display = "none";
    })

    //ckeditor
    CKEDITOR.replace('MoTa', {
        filebrowserBrowseUrl: '/public/ckfinder/ckfinder.html',
        filebrowserUploadUrl: '/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });

    // Dialog color
    const colorPickerButton = document.getElementById("colorPickerButton")
    const colorPickerDialog = document.getElementById("colorPickerDialog")
    const confirmCancel = document.getElementById("confirmColor_cancel")
   // Xử lý sự kiện click trên nút button chọn màu
   colorPickerButton.addEventListener('click', () => {
    // Hiển thị dialog chọn màu
    colorPickerDialog.style.display = 'block';

    // Thêm một lớp overlay để tạo hiệu ứng modal
    const overlay = document.createElement('div');
    overlay.id = 'overlay';
    document.body.appendChild(overlay);
});

// // Xử lý thêm màu vào 
// $(document).ready(function () {
//     var selectedColors = []; 

//     // Sự kiện khi thay đổi checkbox màu
//     $(document).on('change', '#colorPickerDialog input[type="checkbox"]', function () {
//         var colorName = $(this).attr('name');
//         var colorValue = $(this).closest('label').find('img').attr('src');

//         // Kiểm tra xem màu đã được chọn hay chưa
//         if ($(this).prop('checked') && selectedColors.indexOf(colorName) === -1) {
//             selectedColors.push({
//                 name: colorName,
//                 value: colorValue
//             }); // Thêm màu vào mảng nếu chưa tồn tại
//         } else {
//             // Xóa màu khỏi mảng nếu đã được chọn trước đó
//             selectedColors = selectedColors.filter(function (color) {
//                 return color.name !== colorName;
//             });
//         }
//     });

//     // Sự kiện khi nhấn nút Xác nhận
//     $(document).on('click', '#confirmColor_confirm', function () {
//         for (var i = 0; i < selectedColors.length; i++) {
//             var clonedColor = $('<label><input type="radio" name="color" data-color-name="' + selectedColors[i].name + '"><span><img src="' + selectedColors[i].value + '" style="border-radius: 50%; height: 26px"></span></label>');
//             $('.product-detail__color__input').append(clonedColor);
//         }
//         $('#colorPickerDialog').hide();
//     });

//     // Sự kiện khi nhấn nút Hủy
//     $('#confirmColor_cancel').on('click', function () {
//         $('#colorPickerDialog').hide();
//     });
// })

$(document).ready(function () {
    var selectedColors = [];

    // Sự kiện khi thay đổi checkbox màu
    $(document).on('change', '#colorPickerDialog input[type="checkbox"]', function () {
        var colorName = $(this).attr('name');
        var colorValue = $(this).closest('label').find('img').attr('src');

        // Kiểm tra xem màu đã được chọn hay chưa
        var index = selectedColors.findIndex(color => color.name === colorName);

        if ($(this).prop('checked') && index === -1) {
            selectedColors.push({
                name: colorName,
                value: colorValue
            }); // Thêm màu vào mảng nếu chưa tồn tại
        } else if (!$(this).prop('checked') && index !== -1) {
            // Xóa màu khỏi mảng nếu không được chọn và tồn tại trong mảng
            selectedColors.splice(index, 1);
        }
    });

    // Sự kiện khi nhấn nút Xác nhận
    $(document).on('click', '#confirmColor_confirm', function () {
        // Xóa tất cả màu hiện có
        $('.product-detail__color__input').empty();

        // Thêm lại các màu đã chọn
        for (var i = 0; i < selectedColors.length; i++) {
            var clonedColor = $('<label><input type="radio" name="color" data-color-name="' + selectedColors[i].name + '"><span><img src="' + selectedColors[i].value + '" style="border-radius: 50%; height: 26px"></span></label>');
            $('.product-detail__color__input').append(clonedColor);
        }

        $('#colorPickerDialog').hide();
    });

    // Sự kiện khi nhấn nút Hủy
    $('#confirmColor_cancel').on('click', function () {
        $('#colorPickerDialog').hide();
    });
});



//******************* */ Xử lý số lượng của size và màu
var data = {};

// function addData(color, "Size", size, quantity) {
//     if (!data[color]) {
//         data[color] = color
//     }
// } 

$(document).ready(function () {
    var selectedColors = "";
    var selectedSize = "";
    var fileName = document.getElementById("ProductValue");
    
    var data = {}

    function addData(color, size, nameFile, quantity){
        // if (!data[color]) {
        //     data[color] = {};
        // }

        // // Kiểm tra xem size đã tồn tại chưa
        // if (!data[color].size) {
        //     data[color].size = {};
        // }

        // // Thêm hoặc cập nhật số lượng cho size
        // data[color].size[size] = quantity;
        if (!data[color]) {
            data[color] = {};
        }

    // Kiểm tra xem size đã tồn tại chưa
        if (!data[color].size) {
            data[color].size = {};
        }

    // Thêm hoặc cập nhật số lượng cho size
        data[color].size[size] = quantity;

    // Kiểm tra xem "Img" đã tồn tại chưa
        if (!data[color].Img) {
            data[color].Img = {};
        }

    // Thêm tên file vào dữ liệu "Img"
        data[color].Img = {
            "img": nameFile
        };
    }

    $(document).on('change', '.product-detail__color__input input[type="radio"]', function () {
        // var colorName = $(this).data('color-name');
        // var colorValue = $(this).closest('label').find('img').attr('src');

        // if ($(this).prop('checked') && selectedColors.findIndex(color => color.name === colorName) === -1) {
        //     selectedColors.push({
        //         name: colorName,
        //         value: colorValue
        //     });
        // } else {
        //     selectedColors = selectedColors.filter(function (color) {
        //         return color.name !== colorName;
        //     });
        // }
        // console.log("Selected Colors:", selectedColors);
        selectedColors = $(this).data('color-name');
        // console.log("color: ", selectedColors);  
    });

    $('input[name="size"]').on('change', function () {
        selectedSize = $(this).val();
        // console.log("Selected Size:", selectedSize);
    });

    $('#save').on('click', function () {
        event.preventDefault();
        if (selectedColors.length !== "" && selectedSize !== "") {
            var quantity = $('#SoLuongSP').val();
            var nameFile = []
            for(var i = 0; i < 4; i++) {
                nameFile.push(fileName.files[i].name)
            }

            if (quantity !== "" && !isNaN(quantity) && parseInt(quantity) > 0) {
                // for (var i = 0; i < selectedColors.length; i++) {
                //     console.log("Color: " + selectedColors[i].name);
                    
                // }
                console.log("Color: " + selectedColors);
                console.log("Size: " + selectedSize);
                console.log("Quantity: " + quantity);
                console.log("Name FIle: " + nameFile);

                addData(selectedColors, selectedSize, nameFile, quantity);
            } else {
                alert("Vui lòng nhập số lượng hợp lệ.");
            }
            console.log(data);
        } else {
            alert("Vui lòng chọn ít nhất một màu và một size.");
        }
    });
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
