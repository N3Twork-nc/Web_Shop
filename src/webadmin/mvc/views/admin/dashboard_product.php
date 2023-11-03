<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chọn Màu và Hình Ảnh</title>
</head>
<body>
    <form id="colorImageForm">
        <label for="colors">Chọn màu:</label>
        <div id="colorSelection">
            <label>
                <input type="checkbox" name="colors" value="red"> Đỏ
            </label>
            <label>
                <input type="checkbox" name="colors" value="blue"> Xanh
            </label>
            <!-- Thêm checkboxes cho các màu khác ở đây -->
        </div>

        <div id="sizeAndQuantity">
            <!-- Chổ để hiển thị size và nhập số lượng sẽ được thêm vào đây -->
        </div>

        <div id="imageUploads">
            <!-- Các nút "Chọn File" sẽ được thêm vào đây -->
        </div>

        <div id="imagePreviews">
            <!-- Hình ảnh được chọn sẽ được hiển thị ở đây -->
        </div>

        <button type="submit">Submit</button>
    </form>

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
                        <label for="ProductValuePromotion">Giá khuyến mãi(%):</label>
                        <input style="color: black; margin-bottom: 20px;" type="text" id="GiaKhuyenMai" name="GiaKhuyenMai" required>
                        <!-- <label for="ProductColor">Chọn màu sản phẩm:</label>
                        <div class="product-detail__color">
                            <div class="product-detail__color__input">
                                <label>
                                    <input type="radio" name="color" value="red" onclick="handleColorChange('red')">
                                        <span>
                                            <img src="./public/img/red.jpg" style="border-radius: 50%; height:25px"/>
                                        </span>
                                </label>
                                <label>
                                    <input type="radio" name="color" value="pink" onclick="handleColorChange('pink')">
                                        <span>
                                            <img src="./public/img/pink.jpg" style="border-radius: 50%; height:25px"/>
                                        </span>
                                </label>
                                <label>
                                    <input type="radio" name="color" value="yellow" onclick="handleColorChange('yellow')">
                                        <span>                        
                                            <img src="/public/img/yellow.png" style="border-radius: 50%; height:25px"/>
                                        </span>
                                </label>
                                <label>
                                    <input type="radio" name="color" value="green" onclick="handleColorChange('green')">
                                        <span>                        
                                            <img src="/public/img/green.jpg" style="border-radius: 50%; height:25px"/>
                                        </span>
                                </label>
                                <label>
                                    <input type="radio" name="color" value="blue" onclick="handleColorChange('blue')">
                                        <span>                        
                                            <img src="/public/img/blue.jpg" style="border-radius: 50%; height:25px"/>
                                        </span>
                                </label>
                                <label>
                                    <input type="radio" name="color" value="beige" onclick="handleColorChange('beige')">
                                        <span>                        
                                            <img src="/public/img/beige.jpg" style="border-radius: 50%; height:25px"/>
                                        </span>
                                </label>
                                <label>
                                    <input type="radio" name="color" value="white" onclick="handleColorChange('white')">
                                        <span>                        
                                            <img src="/public/img/white.jpg" style="border-radius: 50%; height:25px"/>
                                        </span>
                                </label>
                                <label>
                                    <input type="radio" name="color" value="black" onclick="handleColorChange('black')">
                                        <span>                        
                                            <img src="/public/img/black.jpg" style="border-radius: 50%; height:25px"/>
                                        </span>
                                </label>
                                <label>
                                    <input type="radio" name="color" value="brown" onclick="handleColorChange('brown')">
                                        <span>                        
                                            <img src="/public/img/brown.jpg" style="border-radius: 50%; height:25px"/>
                                        </span>
                                </label>
                                <label>
                                    <input type="radio" name="color" value="gray" onclick="handleColorChange('gray')">
                                        <span>                        
                                            <img src="/public/img/gray.jpg" style="border-radius: 50%; height:25px"/>
                                        </span>
                                </label>
                            </div> -->
                        <!-- </div> -->
                        <!-- Thêm nút button -->
                        <!-- <button id="colorPickerButton">Chọn Màu</button> -->

                        <label for="SelectImg" style="margin-top: 20px;">Chọn hình ảnh:</label>
                        <input multiple type="file" id="Img">
                        <label for="ProductSize" style="margin-top: 20px">Chọn size sản phẩm:</label>
                        <div class="product-detail__size" style="margin-top: 10px;">
                            <div class="product-detail__size__input">       
                                <label style="display: inline-block;">                                                                                                                                         
                                    <!-- <input type="radio" name="size" value="s"/> -->
                                    <span class="text-uppercase" style="display: inline-block;">s</span>
                                    <input style="color: black; border-radius: 3px; display: inline-block; padding-bottom: 12px;" type="number" id="SoLuongSP_S" name="SoLuongSP_S" placeholder="Số lượng" required>
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

                        // Hiển thị size và chỗ nhập số lượng
                        if (colorValue === 'red' || colorValue === 'blue') {
                            sizeAndQuantity.innerHTML = `
                                <label for="sizes">Nhập số lượng cho từng size size:</label><br/>
                                <label for=""> Size S
                                    <input type="text">
                                </label><br/>
                                <label for=""> Size L
                                    <input type="text">
                                </label><br/>
                                <label for=""> Size M
                                    <input type="text">
                                </label><br/>
                                <label for=""> Size L
                                    <input type="text">
                                </label><br/>
                                <label for=""> Size XL
                                    <input type="text">
                                </label><br/>
                                <label for=""> Size XXL
                                    <input type="text">
                                </label><br/>
                            `;
                        } else {
                            sizeAndQuantity.innerHTML = ''; // Xóa nếu không phải là red hoặc blue.
                        }
                    } else {
                        // Nếu màu không được chọn, xóa nút "Chọn File" tương ứng (nếu có).
                        const existingFileInput = imageUploads.querySelector(`input[name="image-${colorValue}[]`);
                        if (existingFileInput) {
                            imageUploads.removeChild(existingFileInput);
                        }
                        // Xóa size và chỗ nhập số lượng
                        sizeAndQuantity.innerHTML = '';
                    }
                }
            });

            // Event listener for form submission.
            const form = document.getElementById('colorImageForm');
            form.addEventListener('submit', (event) => {
                event.preventDefault();
                // Thu thập dữ liệu từ form
                const formData = new FormData(form);

                // In ra toàn bộ dữ liệu trong formData
                for (const [name, value] of formData) {
                    console.log(`${name}: ${value}`);
                }
            });
        });
    </script>
</body>
</html>
<script>
    const link = document.querySelector(".slide-menu-product");
    const addBtn = document.getElementById("addBtn");
    const modal = document.getElementById("myModal");
    const cancelBtn = document.getElementById("cancelBtn");
    const submitBtn = document.getElementById("submitBtn");
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
document.addEventListener("DOMContentLoaded", function () {
    // Lấy tham chiếu đến nút "Thêm"

    var addButton = document.getElementById("submitBtn");

    // Thêm sự kiện click cho nút "Thêm"
    addButton.addEventListener("click", function () {
        event.preventDefault();
        // Lấy giá trị từ các trường input
        var maSanPham = document.getElementById("MaSanPham").value;
        var tenSanPham = document.getElementById("TenSanPham").value;
        var giaSanPham = document.getElementById("GiaSanPham").value;
        var giaKhuyenMai = document.getElementById("GiaKhuyenMai").value;
        // var selectedColor = document.querySelector('input[name="color"]:checked').value;
        var selectedSizeS = document.getElementById("SoLuongSP_S").value;
        var selectedSizeM = document.getElementById("SoLuongSP_M").value;
        var selectedSizeL = document.getElementById("SoLuongSP_L").value;
        var selectedSizeXL = document.getElementById("SoLuongSP_XL").value;
        var selectedSizeXXL = document.getElementById("SoLuongSP_XXL").value;
        //Lấy giá trị của ckeditor
        var moTaValue = CKEDITOR.instances.MoTa.getData();
        var parser = new DOMParser();
        var doc = parser.parseFromString(moTaValue, 'text/html');
        var moTaText = doc.body.textContent || "";
        var danhMuc = document.querySelector("#ProductForm select").value;
        var tongSP = document.getElementById("TongSP").value;
        var selectedFiles = document.getElementById("Img").files;
        if (selectedFiles.length !== 4) {
            alert("Vui lòng chọn đủ 4 hình ảnh.");
            return; // Dừng xử lý nếu không đủ 4 ảnh
        }

        // In giá trị ra console
        console.log("Mã Sản phẩm:", maSanPham);
        console.log("Tên Sản phẩm:", tenSanPham);
        console.log("Giá Sản phẩm:", giaSanPham);
        console.log("Giá khuyến mãi(%):", giaKhuyenMai);
        for (var i = 0; i < selectedFiles.length; i++) {
            console.log("Hình ảnh " + (i + 1) + ": " + selectedFiles[i].name);
        }
        console.log("Số lượng SP S:", selectedSizeS);
        console.log("Số lượng SP M:", selectedSizeM);
        console.log("Số lượng SP L:", selectedSizeL);
        console.log("Số lượng SP XL:", selectedSizeXL);
        console.log("Số lượng SP XXL:", selectedSizeXXL);
        console.log("Mô tả sản phẩm:", moTaText);
        console.log("Danh mục sản phẩm:", danhMuc);
        console.log("Tổng số lượng:", tongSP);
        modal.style.display = "none";
    });
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
