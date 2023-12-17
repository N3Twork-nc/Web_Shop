<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once './mvc/views/admin/libHeader.php'; ?>

    <!-- <script src="/public/ckeditor/ckeditor.js"></script>
    <script src="/public/ckfinder/ckfinder.js"></script> -->
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
            <table width="100%" id="myTable">
                <div style="background: var(--light);color: var(--dark);">
                    <thead>
                        <tr>
                            <th style="width: 150px;"><span class="las la-sort"></span> MÃ SP</th>
                            <th style="width: 220px;"><span class="las la-sort"></span> TÊN SP</th>
                            <th style="width: 150px;"><span class=" las la-sort "></span> Giá</th>
                            <th style="width: 100px;"><span class="las la-sort "></span> Màu</th>
                            <!-- <th style="width: 150px;"><span class="las la-sort "></span> Size</th> -->
                            <th style="width: 220px;"><span class="las la-sort "></span> Mô tả</th>
                            <!-- <th style="width: 150px;"><span class="las la-sort "></span> Ảnh</th> -->
                            <th style="width: 200px;"><span class="las la-sort "></span> DMSP</th>
                            <th style="width: 80px;"><span class="las la-sort "></span> SL</th>
                            <th style="width: 120px;"><span class="las la-sort "></span> Last Updated</th>
                            <th style="width: 100px;"><span class="las la-sort "></span>Trạng thái</th>
                            <th><span class="las la-sort "></span> ACTION</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <!-- Đổ dữ liệu ra table -->
                        <?php foreach($data["products"] as $product): ?>
                            <tr>                               
                                <td data-label="MaSP" style="color: var(--primary);"><?php echo $product->getProduct_code(); ?></td>
                                <td data-label="TenSP" style="color: var(--dark);"><?php echo $product->getName(); ?></td>
                                <td data-label="GiaSP" style="color: var(--dark);"><?php echo $product->getPrice(); ?></td>
                                <td data-label="MauSP"><img src="/public/img/<?php echo $product->getColor(); ?>.jpg" style="border-radius: 50%; height: 20px; width: 22px;"/></td>
                                <td data-label="SizeSP" style="color: var(--dark); display: none;">
                                    <?php 
                                        $sizes = $product->getSizes();
                                    ?>
                                    <?php $i = 0; ?>
                                    <?php foreach ($sizes as $size): ?>
                                        <!-- Mục đích nhầm xử lý hiển thị lên form sửa dữ liệu -->
                                        <p data-label="SizeS" style="display: none;"><?php if($i == 0){ echo $size; }?></p>
                                        <p data-label="SizeM" style="display: none;"><?php if($i == 1){ echo $size; }?></p>
                                        <p data-label="SizeL" style="display: none;"><?php if($i == 2){ echo $size; }?></p>
                                        <p data-label="SizeXL" style="display: none;"><?php if($i == 3){ echo $size; }?></p>
                                        <p data-label="SizeXXL" style="display: none;"><?php if($i == 4){ echo $size; }?></p>
                                        <!-- End -->
                                        <?php 
                                            switch ($i) {
                                                case 0:
                                                    echo "S: $size, ";
                                                    break;
                                                case 1:
                                                    echo "M: $size, ";
                                                    break;
                                                case 2:
                                                    echo "L: $size<br>";
                                                    break;
                                                case 3:
                                                    echo "XL: $size, ";
                                                    break;
                                                default:
                                                    echo "XXL: $size";
                                                    $i = -1;
                                                    break;
                                            }
                                            $i++;
                                        ?>
                                    <?php endforeach; ?>
                                </td>
                                <td data-label="MoTaSP" style="color: var(--dark);"><?php echo $product->getDescription(); ?></td>                                
                                <td data-label="DMSP" style="color: var(--dark);"><?php echo $product->getCategoryObj()->getName(); ?></td>
                                <td data-label="SLSP" style="color: var(--dark);"><?php echo $product->getQuantity(); ?></td>  
                                <td data-label="UpdateSP" style="color: var(--dark);"><?php echo $product->getUpdate_lastest(); ?></td>
                                <td data-label="TrangThaiSP" style="color: var(--dark);"><?php echo $product->getProduct_state(); ?></td>
                                <!-- Dùng để xử lý chọn img trên form sửa data -->
                                <td data-label="HinhSP" style="display: none;"><img src="<?php echo $product->getImages()[0][0] === '.' ? substr($product->getImages()[0], 1) : $product->getImages()[0];  ?>" /></td>
                                <td data-label="HinhSP2" style="display: none;"><img src="<?php echo $product->getImages()[1][0] === '.' ? substr($product->getImages()[1], 1) : $product->getImages()[1]; ?>"/></td>
                                <td data-label="HinhSP3" style="display: none;"><img src="<?php echo $product->getImages()[2][0] === '.' ? substr($product->getImages()[2], 1) : $product->getImages()[2]; ?>"/></td>
                                <td data-label="HinhSP4" style="display: none;"><img src="<?php echo $product->getImages()[3][0] === '.' ? substr($product->getImages()[3], 1) : $product->getImages()[3]; ?>"/></td>
                                <td> 
                                    <i class="fa fa-trash"></i>
                                    <i class="fa fa-pencil editBtn"></i>
                                </td>
                                <td><button class="xemChiTietBtn" style="font-size: 14px; border: none;background-color:var(--primary); color: white; width: 120px; height: 30px;border-radius: 8px;">Xem chi tiết</button></td>
                                <!-- Dữ liệu để lấy từng size ra đưa lên form -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </div>
            </table>

            <!-- Xử lý cho Form sửa data -->
            

            <div id="myModal" class="modal" style="display: none;">
                <div class="modal-content" style="border-radius: 8px;">
                    <form id="ProductForm" enctype="multipart/form-data">
                        <label for="ProductName">Tên sản phẩm:</label>
                        <input style="color: black;" type="text" id="TenSanPham" name="TenSanPham" required>
                        <label for="ProductValue">Giá sản phẩm:</label>
                        <input style="color: black;" type="text" id="GiaSanPham" name="GiaSanPham" required>
                        <label for="ProductCategory" style="margin-top: 20px">Danh mục sản phẩm:</label>
                        <select name="DanhMucSanPham" id="DMSP" style="width: 100%; height: 45px; margin-bottom: 20px; padding-left: 20px;" required>
                            <!-- Mẫu test -->
                            <?php foreach($data["categories"] as $each): ?>
                                <?php if($each->getParent_category_id() != null): ?>
                                    <option value="<?php echo $each->getCategory_id(); ?>"><?php echo $each->getName(); ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </select>
                        <label for="ProductColor">Chọn màu sản phẩm:</label>
                        <div class="product-detail__color">
                            <div class="product-detail__color__input">
                                <label>
                                    <input type="radio" name="color" value="red">
                                        <span>
                                            <img src="/public/img/red.jpg" style="border-radius: 50%; height:25px"/>
                                        </span>
                                </label>
                                <label>
                                    <input type="radio" name="color" value="pink">
                                        <span>
                                            <img src="/public/img/pink.jpg" style="border-radius: 50%; height:25px"/>
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
                        <input multiple type="file" name="fileToUpload[]" id="Img" >
                        <br>
                        <label for="ProductSize" style="margin-top: 20px">Chọn size sản phẩm:</label>
                        <div class="product-detail__size" style="margin-top: 10px;">
                            <div class="product-detail__size__input">       
                                <label style="display: inline-block;">                                                                                                                                         
                                    <!-- <input type="radio" name="size" value="s"/> -->
                                    <span class="text-uppercase" style="display: inline-block;">s</span>
                                    <input style="color: black; border-radius: 3px; display: inline-block; padding-bottom: 12px; margin-left: -4px;" type="number" id="SoLuongSP_S" name="SoLuongSP_S" placeholder="Số lượng" min="0" required>
                                </label>         
                                <br>                                                                                                                                                                                                               
                                <label>                                                                                                                                         
                                    <!-- <input type="radio" name="size" value="m"/> -->
                                    <span class="text-uppercase" style="display: inline-block;">m</span>
                                    <input style="color: black; border-radius: 3px; display: inline-block; padding-bottom: 12px;" type="number" id="SoLuongSP_M" name="SoLuongSP_M" placeholder="Số lượng" min="0" required>
                                </label>   
                                <br>                                                                                                                                                                                                                    
                                <label>                                                                                                                                         
                                    <!-- <input type="radio" name="size" value="l"/> -->
                                    <span class="text-uppercase" style="display: inline-block;">l</span>
                                    <input style="color: black; border-radius: 3px; display: inline-block; padding-bottom: 12px;" type="number" id="SoLuongSP_L" name="SoLuongSP_L" placeholder="Số lượng" min="0" required>
                                </label>
                                <br>                                                                                                                                                                                                                
                                <label>                                                                                                                                         
                                    <!-- <input type="radio" name="size" value="xl"/> -->
                                    <span class="text-uppercase" style="display: inline-block;">xl</span>
                                    <input style="color: black; border-radius: 3px; display: inline-block; padding-bottom: 12px;" type="number" id="SoLuongSP_XL" name="SoLuongSP_XL" placeholder="Số lượng" min="0" required>
                                </label>
                                <br>
                                <label>                                                                                                                                         
                                    <!-- <input type="radio" name="size" value="xxl"/> -->
                                    <span class="text-uppercase" style="display: inline-block;">xxl</span>
                                    <input style="color: black; border-radius: 3px; display: inline-block; padding-bottom: 12px;" type="number" id="SoLuongSP_XXL" name="SoLuongSP_XXL" placeholder="Số lượng" min="0" required>
                                </label>
                             </div>
                        </div>
                        <!-- <label for="ProductNumber">Số lượng:</label>
                        <input style="color: black; width: 100%; height: 45px; border-radius: 3px;" type="number" id="SoLuongSP" name="SoLuongSP" required>
                        <button id="save" style="margin-top: 15px">Lưu</button> -->
                        <label for="ProductColor" style="margin-top: 20px">Mô tả sản phẩm:</label>
                        <textarea name="MoTa" id="MoTa" cols="30" rows="5" style="width: 100%; margin-bottom: 20px;" placeholder="Mô tả sản phẩm" required></textarea>
                        <label for="ProductCategory" style="margin-top: 20px">Trạng thái sản phẩm:</label>
                        <select name="ProductState" id="ProductState" style="width: 100%; height: 45px; margin-bottom: 20px; padding-left: 20px;" required>
                            <option value="disabled">Disabled</option>
                            <option value="active">Active</option>
                        </select>
                        <button style="color: white; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin-right: 10px;" type="submit" id="submitBtn">Thêm</button>
                        <button style="color: white; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;" class="btnCancel" type="button" id="cancelBtn">Hủy</button>
                    </form>
                </div>
            </div>

        </div>
        <div id="formChiTietSP" class="XemChiTiet" style="display:none; border-radius: 12px;">
                <h2 style="font-size:20px;margin-bottom: 10px;">Size:</h2>
                <div class="product_select_size">
                    <p id="size_S">S</p><br>
                    <p id="size_M">M</p><br>
                    <p id="size_L">L</p><br>
                    <p id="size_XL">XL</p><br>
                    <p id="size_XXL">XXL</p><br>
                </div>
                <h2 style="font-size:20px;margin-bottom: 10px;">Image:</h2>
                <div class="product_select_img">
                    <img id="product_image1" src="image1.jpg" alt="Product Image 1" style="width: 150px; height: 150px">
                    <img id="product_image2" src="image2.jpg" alt="Product Image 2" style="width: 150px; height: 150px">
                    <img id="product_image3" src="image3.jpg" alt="Product Image 3" style="width: 150px; height: 150px">
                    <img id="product_image4" src="image4.jpg" alt="Product Image 4" style="width: 150px; height: 150px">
                </div>
                <button id="cancelXemChiTietSP" style="font-size: 14px;border: none;background-color: red;margin-top: 21px; color: white; width: 120px; height: 30px;border-radius: 1px;">Cancel</button>
        </div>
        </main>
    </div>

    <script src="/public/js/dashboard.js"></script>
</body>

</html>
<script>
    let action = '';
    const link = document.querySelector(".slide-menu-product");
    const addBtn = document.getElementById("addBtn");
    const modal = document.getElementById("myModal");
    const cancelBtn = document.getElementById("cancelBtn");
    const submitBtn = document.getElementById("submitBtn");

    const table2 = document.querySelector('#myTable');
    const inputFiles = document.getElementById("Img");
    // Dùng để check là đang vào sửa hay là thêm
    var check = 0;
    link.classList.add('active');

    //Thêm đơn hàng
    addBtn.addEventListener('click', function() {
        action = 'create';
        modal.style.display = "block";
         // Reset giá trị của các trường input
        if(check > 0){
            var inputElement = document.getElementById('MaSanPham');
            var labelElement = document.getElementById('MaSP');
            inputElement.remove();
            labelElement.remove();
        }
        document.getElementById("TenSanPham").value = "";
        document.getElementById("GiaSanPham").value = "";
        if(document.querySelector('input[name="color"]:checked'))
            document.querySelector('input[name="color"]:checked').checked = false;
        document.getElementById("SoLuongSP_S").value = "";
        document.getElementById("SoLuongSP_M").value = "";
        document.getElementById("SoLuongSP_L").value = "";
        document.getElementById("SoLuongSP_XL").value = "";
        document.getElementById("SoLuongSP_XXL").value = "";
        document.getElementById("MoTa").value="";
        document.getElementById("DMSP").value="";
        document.getElementById("ProductState").value="";
        document.getElementById("Img").value="";
        $('#ProductForm').find('.custom-alert-error').remove();
        submitBtn.innerText = "Thêm";
    })

    // Xử lý nút cancel
    cancelBtn.addEventListener('click', function() {
        modal.style.display = "none";
    })


function showLoadingSwal() {
  return Swal.fire({
    title: 'Loading...',
    text: 'Vui lòng chờ trong giây lát!',
    showConfirmButton: false,
    imageUrl: '/public/img/gif/loading.gif',
    allowOutsideClick: false // Không cho phép đóng khi click ra ngoài
  });
}

// bấm submit
$('#ProductForm').submit(function(e){
	e.preventDefault();

    var formData = new FormData(this);

    // check số lượng hình
    var selectedFiles = document.getElementById("Img").files;
    if (selectedFiles.length !== 4) {
        Swal.fire({
            icon: 'error',
            title: 'Lỗi',
            text: 'Cần nhập đủ 4 hình'
        })
        return; // Dừng xử lý nếu không đủ 4 ảnh
    }

    var selectedColor = document.querySelector('input[name="color"]:checked');
    if (!selectedColor) {
        Swal.fire({
            icon: 'error',
            title: 'Lỗi',
            text: 'Cần chọn 1 màu'
        });
        return;
    }

    let method = '';
    if(action == 'create'){
        method = "AddProduct";
    }
    else if(action == 'edit'){
        method = "EditProduct";
    }

    // gửi data
    var sw = showLoadingSwal();
		$.ajax({
			url:'/Dashboard_product/' + method,
			method:'POST',
			data: formData,
            processData: false,  // Ngăn jQuery xử lý dữ liệu
            contentType: false,  // Ngăn jQuery đặt tiêu đề 'Content-Type'
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
            //   $('#ProductForm input[type=text]').removeAttr('readonly').removeClass('readonly'); 
                }else if(resp.trim() == "reload"){
                        Swal.fire(
                            'ERROR!',
                            'Có lỗi xảy ra hoặc bạn đã uploads file có dung lượng quá lớn, website sẽ tự reload!',
                            'error'
                        )
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                        $('#myModal').hide();
                    }
                    else {
                        sw.close();
                        $('#ProductForm').find('.custom-alert-error').remove();
                        if (resp.includes('<!DOCTYPE html>')|| resp.lenght > 50) {
                                    // Nếu có chứa HTML, điều hướng sang trang đăng nhập
                            window.location.href = '/Auth';
                        } else {
                            $('#ProductForm').prepend('<div class="custom-alert custom-alert-error" role="alert" style="display: block !important"><i class="fa fa-times-circle"></i>' + resp + '</div>');
                        }
                        //nhớ thêm cái này cho mấy trang kia
                    }
            }
		})
    });


// Hiển thị dữ liệu cần sửa lên form
$(document).ready(function () {
        var productForm = document.getElementById("ProductForm");
	    var newInput = document.createElement("input");
        var newLabel = document.createElement("label");
        // Sự kiện click vào biểu tượng bút chì
        $('.editBtn').on('click', function () {
            // Lấy dữ liệu từ hàng tương ứng để điền vào form
            action = 'edit';
            submitBtn.innerText = "Lưu";
            var row = $(this).closest('tr');
            var maSP = row.find('td[data-label="MaSP"]').text();
            var tenSP = row.find('td[data-label="TenSP"]').text();
            var giaSP = row.find('td[data-label="GiaSP"]').text();
            var sizeS = row.find('p[data-label="SizeS"]').text();
            var sizeM = row.find('p[data-label="SizeM"]').text();
            var sizeL = row.find('p[data-label="SizeL"]').text();
            var sizeXL = row.find('p[data-label="SizeXL"]').text();
            var sizeXXL = row.find('p[data-label="SizeXXL"]').text();
            var moTaSP = row.find('td[data-label="MoTaSP"]').text();
            var hinhSP =  row.find('td[data-label="HinhSP"]').find('img').attr('src');
            var hinhSP2 = row.find('td[data-label="HinhSP2"]').find('img').attr('src');
            var hinhSP3 = row.find('td[data-label="HinhSP3"]').find('img').attr('src');
            var hinhSP4 = row.find('td[data-label="HinhSP4"]').find('img').attr('src');
            setFiles(hinhSP, hinhSP2, hinhSP3, hinhSP4);
            var danhMucSP = row.find('td[data-label="DMSP"]').text();
            var TrangThaiSP = row.find('td[data-label="TrangThaiSP"]').text();

            var mauSP = row.find('td[data-label="MauSP"]').find('img').attr('src').split('/')[3].split('.')[0];
            // Thêm các dữ liệu vào form
            $('#TenSanPham').val(tenSP);
            $('#GiaSanPham').val(giaSP);
            $('input[name="color"][value="' + mauSP + '"]').prop('checked', true);
            $('#MoTa').val(moTaSP);
            $('#SoLuongSP_S').val(sizeS);
            $('#SoLuongSP_M').val(sizeM);
            $('#SoLuongSP_L').val(sizeL);
            $('#SoLuongSP_XL').val(sizeXL);
            $('#SoLuongSP_XXL').val(sizeXXL);
            // Chọn danh mục sản phẩm trong dropdown
            $('#DMSP option').filter(function () {
                return $(this).text() == danhMucSP;
            }).prop('selected', true);

            // chọn trạng thái
            $('#ProductState option').filter(function () {
                return $(this).val() == TrangThaiSP;
            }).prop('selected', true);

            //Hiển thị mã sản phẩm nhưng disable ko cho thao tác
             // Tạo label mới
            newLabel.setAttribute("for", "MaSP");
            newLabel.setAttribute("id", "MaSP")
            newLabel.textContent = "Mã sản phẩm:";

            // Tạo input mới
            newInput.setAttribute("type", "text");
            newInput.setAttribute("id", "MaSanPham");
            newInput.setAttribute("name", "MaSanPham");
            newInput.readOnly = true;
            newInput.style.background = "#eee"
            productForm.insertBefore(newInput, productForm.firstChild);
            productForm.insertBefore(newLabel, productForm.firstChild);
            $('#MaSanPham').val(maSP);
            // Hiển thị form
            $('#ProductForm').find('.custom-alert-error').remove();
            $('#myModal').show();
            check++;
        });

        // Sự kiện click nút Hủy
        $('#cancelBtn').on('click', function () {
            // Ẩn form
            $('#myModal').hide();
        });
    });

        function setFiles(img1, img2, img3, img4) { // khi nào lỗi hình thì xóa dấu . trước đường dẫn
              // Tạo một input file mới
              const imageURLs = [];
              imageURLs.push(img1);
              imageURLs.push(img2);
              imageURLs.push(img3);
              imageURLs.push(img4);

              const blobs = [];
              // blob là data dạng bin
              // hàm map là hàm duyệt từng phần tử trong arr
              // ý nghĩa đoạn code là duyệt từng phần tử gán vào biến url
              // mỗi url gọi hàm fetch(url), đây là hàm tải data từ url này
              // hàm fetch sẽ trả về một Promise chứa response từ URL đó
              // sau đó ta gọi .then() để xử lý data trả về
              // tương tự lấy giá trị trả về từ hàm fetch gán vào biến response
              // và thực thi  blobs.push(response.blob());
              const promises = imageURLs.map((url) =>
                    fetch(url).then((response) =>  response.blob()).then((blob) => {
                        let tmp_arr = []
                        tmp_arr["data"] = blob;
                        tmp_arr["url"] = url;

                        let tmp = tmp_arr["url"].split(".");
                        let extension = tmp[tmp.length - 1];

                        if(extension === "jpeg"){
                            tmp_arr["extension"] = 'image/jpeg';
                        }
                        else if(extension === "png"){
                            tmp_arr["extension"] = 'image/png';
                        }
                        blobs.push(tmp_arr);
                    })
              );

                Promise.all(promises).then(() => {
                    const newFileList = new DataTransfer();

                    blobs.forEach((blob) => {
                        const file = new File([blob["data"]], blob["url"], { type: blob["extension"]});
                        //console.log([blob["data"]]);
                        newFileList.items.add(file);
                    });

                    inputFiles.files = newFileList.files;
                });
        }


    //Xem chi tiết sản phẩm bao gồm ảnh và size
    var formChiTietSP = document.getElementById('formChiTietSP');
    var cancelXemChiTiet = document.getElementById('cancelXemChiTietSP');

    document.querySelectorAll('.xemChiTietBtn').forEach(function(button) {
        button.addEventListener('click', function() {
            formChiTietSP.style.display = 'block';
            var row = $(this).closest('tr');
            var sizeS = row.find('p[data-label="SizeS"]').text();
            var sizeM = row.find('p[data-label="SizeM"]').text();
            var sizeL = row.find('p[data-label="SizeL"]').text();
            var sizeXL = row.find('p[data-label="SizeXL"]').text();
            var sizeXXL = row.find('p[data-label="SizeXXL"]').text();
            var hinhSP =  row.find('td[data-label="HinhSP"]').find('img').attr('src');
            var hinhSP2 = row.find('td[data-label="HinhSP2"]').find('img').attr('src');
            var hinhSP3 = row.find('td[data-label="HinhSP3"]').find('img').attr('src');
            var hinhSP4 = row.find('td[data-label="HinhSP4"]').find('img').attr('src');
            //Size
            document.getElementById('size_S').innerHTML = 'S: ' + sizeS;
            document.getElementById('size_M').innerHTML = 'M: ' + sizeM;
            document.getElementById('size_L').innerHTML = 'L: ' + sizeL;
            document.getElementById('size_XL').innerHTML = 'XL: ' + sizeXL;
            document.getElementById('size_XXL').innerHTML = 'XXL: ' + sizeXXL;
            //Img
            document.getElementById('product_image1').src = hinhSP;
            document.getElementById('product_image2').src = hinhSP2;
            document.getElementById('product_image3').src = hinhSP3;
            document.getElementById('product_image4').src = hinhSP4;

        });
    });

    // xóa sản phẩm

    table2.addEventListener('click', function(event) {
    if (event.target.classList.contains('fa-trash')) {
        const row = event.target.closest('tr');
        const product_code = row.cells[0].textContent.trim();

        Swal.fire({
            title: 'Bạn có chắc là muốn xóa sản phẩm này không?',
            text: "Mọi đơn hàng và thanh toán liên quan cũng sẽ bị xóa. Bạn sẽ không thể hoàn tác sau khi hoàn tất!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Vẫn xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
        if (result.isConfirmed) {
        var sw = showLoadingSwal();
        $.ajax({
            url: '/Dashboard_product/DeleteProduct',
            type: 'POST',
            data: { product_code: product_code },
            success: function(response) {
            if (response.trim() == "done") {
                Swal.fire(
                'Completed!',
                'Bạn đã xóa sản phẩm thành công!',
                'success'
                )
                // sau 2 giây sẽ tải lại trang
                setTimeout(function() {
                    location.reload();
                }, 1000); 
            } else {
                sw.close();
                // Nếu có lỗi thì hiển thị thông báo lỗi

                if (response.includes('<!DOCTYPE html>')|| response.lenght > 50) {
                            // Nếu có chứa HTML, điều hướng sang trang đăng nhập
                    window.location.href = '/Auth';
                } else {
                    Swal.fire(
                        'Oops...',
                        response,
                        'error'
                    );
                }
            }
            },
        });
        }
    })
    }
    
    });

    cancelXemChiTiet.addEventListener('click', function() {
        formChiTietSP.style.display = 'none';
    });

</script>
