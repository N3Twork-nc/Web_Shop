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
                    <form id="ProductForm">
                        <label for="ProductName">Tên sản phẩm:</label>
                        <input style="color: black;" type="text" id="TenSanPham" name="TenSanPham" required>
                        <label for="ProductValue">Giá sản phẩm:</label>
                        <input style="color: black;" type="text" id="GiaSanPham" name="GiaSanPham" required>
                        <label for="ProductCategory" style="margin-top: 20px">Danh mục sản phẩm:</label>
                        <select name="" id="" style="width: 100%; height: 45px; margin-bottom: 20px; padding-left: 20px;">
                            <!-- Mẫu test -->
                            <option value="Nam">Nam</option>
                            <option value="Nu">Nữ</option>
                            <option value="TreEm">Trẻ em</option>
                        </select>
                        <label for="ProductColor">Chọn màu sản phẩm:</label>
                        <div class="product-detail__color">
                            <div class="product-detail__color__input">
                                <label>
                                    <input type="radio" name="color" value="red">
                                        <span>
                                            <img src="./public/img/red.jpg" style="border-radius: 50%; height:25px"/>
                                        </span>
                                </label>
                                <label>
                                    <input type="radio" name="color" value="pink">
                                        <span>
                                            <img src="./public/img/pink.jpg" style="border-radius: 50%; height:25px"/>
                                        </span>
                                </label>
                                <label>
                                    <input type="radio" name="color" value="yellow">
                                        <span>                        
                                            <img src="/public/img/yellow.png" style="border-radius: 50%; height:25px"/>
                                        </span>
                                </label>
                                <label>
                                    <input type="radio" name="color" value="green">
                                        <span>                        
                                            <img src="/public/img/green.jpg" style="border-radius: 50%; height:25px"/>
                                        </span>
                                </label>
                                <label>
                                    <input type="radio" name="color" value="blue">
                                        <span>                        
                                            <img src="/public/img/blue.jpg" style="border-radius: 50%; height:25px"/>
                                        </span>
                                </label>
                                <label>
                                    <input type="radio" name="color" value="beige">
                                        <span>                        
                                            <img src="/public/img/beige.jpg" style="border-radius: 50%; height:25px"/>
                                        </span>
                                </label>
                                <label>
                                    <input type="radio" name="color" value="white">
                                        <span>                        
                                            <img src="/public/img/white.jpg" style="border-radius: 50%; height:25px"/>
                                        </span>
                                </label>
                                <label>
                                    <input type="radio" name="color" value="black">
                                        <span>                        
                                            <img src="/public/img/black.jpg" style="border-radius: 50%; height:25px"/>
                                        </span>
                                </label>
                                <label>
                                    <input type="radio" name="color" value="brown">
                                        <span>                        
                                            <img src="/public/img/brown.jpg" style="border-radius: 50%; height:25px"/>
                                        </span>
                                </label>
                                <label>
                                    <input type="radio" name="color" value="gray">
                                        <span>                        
                                            <img src="/public/img/gray.jpg" style="border-radius: 50%; height:25px"/>
                                        </span>
                                </label>
                            </div>
                        <!-- </div> -->
                        <!-- Thêm nút button -->
                        <!-- <button id="colorPickerButton">Chọn Màu</button> -->

                        <label for="SelectImg" style="margin-top: 20px;">Chọn hình ảnh:</label>
                        <input multiple type="file" id="Img">
                        <br>
                        <label for="ProductSize" style="margin-top: 20px">Chọn size sản phẩm:</label>
                        <div class="product-detail__size" style="margin-top: 10px;">
                            <div class="product-detail__size__input">       
                                <label style="display: inline-block;">                                                                                                                                         
                                    <!-- <input type="radio" name="size" value="s"/> -->
                                    <span class="text-uppercase" style="display: inline-block;">s</span>
                                    <input style="color: black; border-radius: 3px; display: inline-block; padding-bottom: 12px; margin-left: -4px;" type="number" id="SoLuongSP_S" name="SoLuongSP_S" placeholder="Số lượng" required>
                                </label>         
                                <br>                                                                                                                                                                                                               
                                <label>                                                                                                                                         
                                    <!-- <input type="radio" name="size" value="m"/> -->
                                    <span class="text-uppercase" style="display: inline-block;">m</span>
                                    <input style="color: black; border-radius: 3px; display: inline-block; padding-bottom: 12px;" type="number" id="SoLuongSP_M" name="SoLuongSP_M" placeholder="Số lượng" required>
                                </label>   
                                <br>                                                                                                                                                                                                                    
                                <label>                                                                                                                                         
                                    <!-- <input type="radio" name="size" value="l"/> -->
                                    <span class="text-uppercase" style="display: inline-block;">l</span>
                                    <input style="color: black; border-radius: 3px; display: inline-block; padding-bottom: 12px;" type="number" id="SoLuongSP_L" name="SoLuongSP_L" placeholder="Số lượng" required>
                                </label>
                                <br>                                                                                                                                                                                                                
                                <label>                                                                                                                                         
                                    <!-- <input type="radio" name="size" value="xl"/> -->
                                    <span class="text-uppercase" style="display: inline-block;">xl</span>
                                    <input style="color: black; border-radius: 3px; display: inline-block; padding-bottom: 12px;" type="number" id="SoLuongSP_XL" name="SoLuongSP_XL" placeholder="Số lượng" required>
                                </label>
                                <br>
                                <label>                                                                                                                                         
                                    <!-- <input type="radio" name="size" value="xxl"/> -->
                                    <span class="text-uppercase" style="display: inline-block;">xxl</span>
                                    <input style="color: black; border-radius: 3px; display: inline-block; padding-bottom: 12px;" type="number" id="SoLuongSP_XXL" name="SoLuongSP_XXL" placeholder="Số lượng" required>
                                </label>
                             </div>
                        </div>
                        <!-- <label for="ProductNumber">Số lượng:</label>
                        <input style="color: black; width: 100%; height: 45px; border-radius: 3px;" type="number" id="SoLuongSP" name="SoLuongSP" required>
                        <button id="save" style="margin-top: 15px">Lưu</button> -->
                        <label for="ProductColor" style="margin-top: 20px">Mô tả sản phẩm:</label>
                        <textarea name="MoTa" id="MoTa" cols="30" rows="5" style="width: 100%; margin-bottom: 20px;" placeholder="Mô tả sản phẩm"></textarea>
                        <button style="color: white; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin-right: 10px;" type="submit" id="submitBtn">Thêm</button>
                        <button style="color: white; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;" class="btnCancel" type="button" id="cancelBtn">Hủy</button>
                    </form>
                </div>
            </div>
            <!-- Dialog chọn màu -->
            <!-- <div id="colorPickerDialog" style="display:none; position: fixed; z-index: 10;">
                <div class="product-detail__color">
                    <div class="product-detail__color__input_dialog">
                    </div>
                </div>
                <button id="confirmColor_confirm">Xác nhận</button>
                <button id="confirmColor_cancel">Hủy</button>
            </div> -->
        </main>
    </div>

    </main>

    </div>

    <script src="/public/js/dashboard.js"></script>
</body>

</html>
<script>
    const action = '';
    const link = document.querySelector(".slide-menu-product");
    const addBtn = document.getElementById("addBtn");
    const modal = document.getElementById("myModal");
    const cancelBtn = document.getElementById("cancelBtn");
    const submitBtn = document.getElementById("submitBtn");
    link.classList.add('active');

    //Thêm đơn hàng
    addBtn.addEventListener('click', function() {
        modal.style.display = "block";
         // Reset giá trị của các trường input
        document.getElementById("MaSanPham").value = "";
        document.getElementById("TenSanPham").value = "";
        document.getElementById("GiaSanPham").value = "";
        document.getElementById("ProductValuePromotion").value = "";
        document.querySelector('input[name="color"]:checked').checked = false;
        document.getElementById("SoLuongSP_S").value = "";
        document.getElementById("SoLuongSP_M").value = "";
        document.getElementById("SoLuongSP_L").value = "";
        document.getElementById("SoLuongSP_XL").value = "";
        document.getElementById("SoLuongSP_XXL").value = "";
        CKEDITOR.instances.MoTa.setData(""); // Reset CKEditor
        document.querySelector("#ProductForm select").value = "";
        document.getElementById("TongSP").value = "";
        document.getElementById("Img").value = ""; // Reset input file
        action = 'create';
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
//     const colorPickerButton = document.getElementById("colorPickerButton")
//     const colorPickerDialog = document.getElementById("colorPickerDialog")
//     const confirmCancel = document.getElementById("confirmColor_cancel")
//    // Xử lý sự kiện click trên nút button chọn màu
//    colorPickerButton.addEventListener('click', () => {
//     // Hiển thị dialog chọn màu
//     colorPickerDialog.style.display = 'block';

//     // Thêm một lớp overlay để tạo hiệu ứng modal
//     const overlay = document.createElement('div');
//     overlay.id = 'overlay';
//     document.body.appendChild(overlay);
// });

// // Xử lý thêm màu vào 
// $(document).ready(function () {
//     var selectedColors = [];

//     // Sự kiện khi thay đổi checkbox màu
//     $(document).on('change', '#colorPickerDialog input[type="checkbox"]', function () {
//         var colorName = $(this).attr('name');
//         var colorValue = $(this).closest('label').find('img').attr('src');

//         // Kiểm tra xem màu đã được chọn hay chưa
//         var index = selectedColors.findIndex(color => color.name === colorName);

//         if ($(this).prop('checked') && index === -1) {
//             selectedColors.push({
//                 name: colorName,
//                 value: colorValue
//             }); // Thêm màu vào mảng nếu chưa tồn tại
//         } else if (!$(this).prop('checked') && index !== -1) {
//             // Xóa màu khỏi mảng nếu không được chọn và tồn tại trong mảng
//             selectedColors.splice(index, 1);
//         }
//     });

//     // Sự kiện khi nhấn nút Xác nhận
//     $(document).on('click', '#confirmColor_confirm', function () {
//         // Xóa tất cả màu hiện có
//         $('.product-detail__color__input').empty();

//         // Thêm lại các màu đã chọn
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
// });

        // function handleColorChange(colorName) {
        //     // Get all radio buttons with the specified name
        //     var radios = document.getElementsByName('color');

        //     // Loop through all radio buttons
        //     for (var i = 0; i < radios.length; i++) {
        //         // Uncheck all radio buttons except the selected one
        //         if (radios[i].value !== colorName) {
        //             radios[i].checked = false;
        //         }
        //     }
        // }



// Xử lý submit sản phẩm
// Đợi cho trang web được tải hoàn toàn
// document.addEventListener("DOMContentLoaded", function () {
//     // Lấy tham chiếu đến nút "Thêm"

//     var addButton = document.getElementById("submitBtn");

//     // Thêm sự kiện click cho nút "Thêm"
//     addButton.addEventListener("click", function () {
//         event.preventDefault();
//         // Lấy giá trị từ các trường input
//         var maSanPham = document.getElementById("MaSanPham").value;
//         var tenSanPham = document.getElementById("TenSanPham").value;
//         var giaSanPham = document.getElementById("GiaSanPham").value;
//         var selectedValue = document.getElementById("ProductValuePromotion").value;
//         var selectedColor = document.querySelector('input[name="color"]:checked').value;
//         var selectedSizeS = document.getElementById("SoLuongSP_S").value;
//         var selectedSizeM = document.getElementById("SoLuongSP_M").value;
//         var selectedSizeL = document.getElementById("SoLuongSP_L").value;
//         var selectedSizeXL = document.getElementById("SoLuongSP_XL").value;
//         var selectedSizeXXL = document.getElementById("SoLuongSP_XXL").value;
//         //Lấy giá trị của ckeditor
//         var moTaValue = CKEDITOR.instances.MoTa.getData();
//         var parser = new DOMParser();
//         var doc = parser.parseFromString(moTaValue, 'text/html');
//         var moTaText = doc.body.textContent || "";
//         var danhMuc = document.querySelector("#ProductForm select").value;
//         var tongSP = document.getElementById("TongSP").value;
//         var selectedFiles = document.getElementById("Img").files;
//         if (selectedFiles.length !== 4) {
//             alert("Vui lòng chọn đủ 4 hình ảnh.");
//             return; // Dừng xử lý nếu không đủ 4 ảnh
//         }

//         // In giá trị ra console
//         console.log("Mã sản phẩm:", maSanPham);
//         console.log("Tên sản phẩm:", tenSanPham);
//         console.log("Giá sản phẩm:", giaSanPham);
//         console.log("Giá khuyến mãi: " + selectedValue);
//         for (var i = 0; i < selectedFiles.length; i++) {
//             console.log("Hình ảnh " + (i + 1) + ": " + selectedFiles[i].name);
//         }
//         console.log("Màu sản phẩm:", selectedColor);
//         console.log("Số lượng SP S:", selectedSizeS);
//         console.log("Số lượng SP M:", selectedSizeM);
//         console.log("Số lượng SP L:", selectedSizeL);
//         console.log("Số lượng SP XL:", selectedSizeXL);
//         console.log("Số lượng SP XXL:", selectedSizeXXL);
//         console.log("Mô tả sản phẩm:", moTaText);
//         console.log("Danh mục sản phẩm:", danhMuc);
//         console.log("Tổng số lượng:", tongSP);
//         modal.style.display = "none";
//     });
// });

function showLoadingSwal() {
  return Swal.fire({
    title: 'Loading...',
    text: 'Vui lòng chờ trong giây lát!',
    timer: 2000,
    showConfirmButton: false,
    imageUrl: '/public/img/gif/loading.gif',
    onBeforeOpen: function() {
      Swal.showLoading();
    },
    allowOutsideClick: false // Không cho phép đóng khi click ra ngoài
  });
}
$('#ProductForm').submit(function(e){
	e.preventDefault();
    var $form = $(this);
    var selectedFiles = document.getElementById("Img").files;
    if (selectedFiles.length !== 4) {
        Swal.fire({
            icon: 'error',
            title: 'Lỗi',
            text: 'Cần nhập đủ 4 hình'
        })
        return; // Dừng xử lý nếu không đủ 4 ảnh
    }
    var sw = showLoadingSwal();
		$.ajax({
			url:'/Dashboard_product/AddProduct',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
			},
			success:function(resp){
        var actionText = action == 'create' ? 'thêm' : 'sửa';
		if(resp.trim() == "done"){
          Swal.fire(
              'Completed!',
              'Bạn đã '+ actionText +' sản phẩm thành công!',
              'success'
            )
          setTimeout(function() {
              location.reload();
          }, 1000);
          $('#myModal').hide();
          $('#ProductForm input[type=text]').removeAttr('readonly').removeClass('readonly'); 
		}else{
            sw.close();

            //nhớ thêm cái này cho mấy trang kia
            $('#ProductForm').find('.alert-danger').remove();
            $('#ProductForm').prepend('<div class="alert alert-danger">'+ resp + '</div>');
          }
				}
		})
	});


//******************* */ Xử lý số lượng của size và màu
// var data = {};

// $(document).ready(function () {
//     var selectedColors = "";
//     var selectedSize = "";
//     var fileName = document.getElementById("ProductValue");
    
//     var data = {}

//     function addData(color, size, nameFile, quantity){

//         if (!data[color]) {
//             data[color] = {};
//         }
//         if (!data[color].size) {
//             data[color].size = {};
//         }
//         data[color].size[size] = quantity;
//         if (!data[color].Img) {
//             data[color].Img = {};
//         }
//         data[color].Img = {
//             "img": nameFile
//         };
//     }

//     $(document).on('change', '.product-detail__color__input input[type="radio"]', function () {
//         selectedColors = $(this).data('color-name');
//     });

//     $('input[name="size"]').on('change', function () {
//         selectedSize = $(this).val();
//     });

//     // $('#save').on('click', function () {
//     //     event.preventDefault();
//     //     if (selectedColors.length !== "" && selectedSize !== "") {
//     //         var quantity = $('#SoLuongSP').val();
//     //         var nameFile = []
//     //         for(var i = 0; i < 4; i++) {
//     //             nameFile.push(fileName.files[i].name);
//     //         }

//     //         if (quantity !== "" && !isNaN(quantity) && parseInt(quantity) > 0) {
//     //             console.log("Color: " + selectedColors);
//     //             console.log("Size: " + selectedSize);
//     //             console.log("Quantity: " + quantity);
//     //             console.log("Name FIle: " + nameFile);

//     //             addData(selectedColors, selectedSize, nameFile, quantity);
//     //         } else {
//     //             alert("Vui lòng nhập số lượng hợp lệ.");
//     //         }
//     //         console.log(data);
//     //     } else {
//     //         alert("Vui lòng chọn ít nhất một màu và một size.");
//     //     }
//     // });
//     // ...

//     // in hết form ra 
// $('#submitBtn').on('click', function () {
//     event.preventDefault();
//     if (selectedColors.length !== "" && selectedSize !== "") {
//         var quantity = $('#SoLuongSP').val();
//         var nameFile = [];
//         for(var i = 0; i < 4; i++) {
//             nameFile.push(fileName.files[i].name);
//         }

//         var maSanPham = $('#MaSanPham').val();
//         var tenSanPham = $('#TenSanPham').val();
//         var giaSanPham = $('#GiaSanPham').val();
//         var giaKhuyenMai = $('#GiaKhuyenMai').val();
//         var moTaValue = CKEDITOR.instances.MoTa.getData();
//         // Chuyển mota -> thuần html 
//         // var parser = new DOMParser();
//         // var doc = parser.parseFromString(moTaValue, 'text/html');
//         // var moTaText = doc.body.textContent || "";

//         if (quantity !== "" && !isNaN(quantity) && parseInt(quantity) > 0) {
//             console.log("Mã sản phẩm: " + maSanPham);
//             console.log("Tên sản phẩm: " + tenSanPham);
//             console.log("Giá sản phẩm: " + giaSanPham);
//             console.log("Giá khuyến mãi: " + giaKhuyenMai);
//             console.log("Color: " + selectedColors);
//             console.log("Size: " + selectedSize);
//             console.log("Quantity: " + quantity);
//             console.log("Name File: " + nameFile);
//             console.log("Mô tả: " + moTaValue);
//             console.log("Danh mục: " + $('select').val());
//             console.log("Tổng số lượng: " + $('#TongSP').val());

//         } else {
//             alert("Vui lòng nhập số lượng hợp lệ.");
//         }
//     } else {
//         alert("Vui lòng chọn ít nhất một màu và một size.");
//     }
// });

// });


</script>