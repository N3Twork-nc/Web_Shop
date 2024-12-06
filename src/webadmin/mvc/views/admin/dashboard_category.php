
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once './mvc/views/admin/libHeader.php'; ?>
    
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
                    <h1>Danh mục sản phẩm</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                Category
                            </a></li>
                        /
                        <li><a href="#" class="active">Shop</a></li>
                        <?php if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'manager'): ?>
                            <button id="addBtn" style="font-size: 14px; border: none; right: 0; position: absolute; margin-right: 26px;margin-bottom: 48px; background-color:var(--primary); color: white;; width: 180px; height: 40px;border-radius: 8px;">
                            Thêm danh mục sản phẩm
                        </button>
                            <?php endif; ?>
                        
                    </ul>
                </div>
            </div>

            <!--********************* Category ***********************-->
            <div style="background: var(--light);color: var(--dark);">
                <table width="100%" id="myTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><span class="las la-sort"></span> TÊN DANH MỤC</th>
                            <th><span class="las la-sort"></span> TÊN DANH MỤC CHA</th>
                            <?php if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'manager'): ?>
                                <th><span class="las la-sort"></span> ACTION</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php if (!empty($data['categories']) && (is_array($data['categories']) || is_object($data['categories']))): ?>
                    <?php foreach ($data['categories'] as $category): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($category->getCategory_id()); ?></td>
                            <td><?php echo htmlspecialchars($category->getName()); ?></td>
                            <td value="<?php echo htmlspecialchars($category->getParent_category_id() === null ? "none" : $category->getParent_category_id()); ?>">
                                <?php echo htmlspecialchars($category->getParent_category_id() === null ? "none" : $category->getParent_category_name()); ?>
                            </td>
                            <td>
                                <?php if (isset($_SESSION['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'manager')): ?>
                                    <i class="fa fa-trash"></i>
                                    <i class="fa fa-pencil editBtn"></i>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div id="myModal" class="modal" style="display: none;">
                <div class="modal-content" style="border-radius: 8px;">
                    <form id="CategoryForm">
                        <input type="hidden" id="csrf_token_category" name="csrf_token_category" value="<?php echo $data["csrf_token_category"]; ?>">
                        <label for="CategoryID" id="labelCategoryID" style="display: none;">ID danh mục:</label>
                        <input style="color: black" type="text" id="CategoryID" name="CategoryID" required disabled hidden readonly>
                        
                        <label for="CategoryName">Tên danh mục:</label>
                        <input style="color: black" type="text" id="CategoryName" name="CategoryName" required>

                        <label for="OrderName">Tên danh mục cha:</label>
                        <select name="CategoryParentID" id="CategoryParentID" style="width: 100%; height: 45px; margin-bottom: 20px; padding-left: 20px;" required>
                            <?php foreach($data['categories'] as $each): ?>
                                <?php if($each->getParent_category_id() == null): ?>
                                    <option value="<?php echo $each->getCategory_id(); ?>"><?php echo $each->getName(); ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <button style="color: white; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin-right: 10px;" type="submit" id="submitBtn">Thêm</button>
                        <button style="color: white; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;" class="btnCancel" type="button" id="cancelBtn">Hủy</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    </main>

    </div>
</body>

</html>
<script src="/public/js/dashboard.js"></script>
<script src="/public/js/pagination.js"></script>
<script>
    // Khai báo biến
    const link = document.querySelector(".slide-menu-category");
    const addBtn = document.getElementById("addBtn");
    const modal = document.getElementById("myModal");
    const cancelBtn = document.getElementById("cancelBtn");
    const BtnEdit = document.getElementById("submitBtn")
    const tbody = document.getElementById("tbody");
    
    const table2 = document.querySelector('#myTable');
    const category_id = modal.querySelector('#CategoryID');
    const category_name = modal.querySelector('#CategoryName');
    const csrf_token_category_form = modal.querySelector('#csrf_token_category');

    const category_parent_id = modal.querySelector('#CategoryParentID');
    const optionCategoryParentID = category_parent_id.querySelectorAll('option');
    let action = ''

    // ************************************ THÊM DỮ LIỆU ************************************ //
    //Thêm danh mục
    addBtn.addEventListener('click', function() {
        document.getElementById("labelCategoryID").style.display = 'none';
        document.getElementById("CategoryID").value = "";
        document.getElementById("CategoryID").setAttribute("hidden", true);
        document.getElementById("CategoryID").setAttribute("disabled", true);
        document.getElementById("CategoryID").setAttribute("readonly", true);
        document.getElementById("CategoryName").value = "";
        document.getElementById("CategoryParentID").value = "";
        let newCategoryName = document.getElementById("CategoryName").value;
        let CategoryParentName = document.getElementById("CategoryParentID").value;
        modal.style.display = "block";
        BtnEdit.innerText = "Thêm";
        action = "create";
    })

    // ************************************ SỬA DỮ LIỆU ************************************ //
    // khi nhấn sửa

    table2.addEventListener('click', function(event) {
    if (event.target.classList.contains('fa-pencil')) {
        action = 'edit';
        document.getElementById("labelCategoryID").style.display = 'block';
        document.getElementById("CategoryID").removeAttribute("hidden");
        document.getElementById("CategoryID").removeAttribute("disabled");
        document.getElementById("CategoryID").style.background = "#eee";
        
        $('#CategoryForm #submitBtn').text('Lưu');
        $('#CategoryForm').find('.custom-alert-error').remove();
        const row = event.target.closest('tr');
        const category_id_in_table = row.cells[0].textContent.trim();
        const category_name_in_table = row.cells[1].textContent.trim();
        const category_parent_name_in_table = row.cells[2].textContent.trim();
        const category_parent_id_in_table = row.cells[2].getAttribute('value').trim();
        

        // // Điền dữ liệu vào form
        category_id.value = category_id_in_table;
        category_name.value = category_name_in_table;
        //Không chỉnh sửa danh mục cha
        if(category_parent_id_in_table == "none"){
                Swal.fire({
                title: 'Bạn không thể chỉnh sửa danh mục này',
                icon: 'error'
            })
        }
        else{
            for (let i = 0; i < optionCategoryParentID.length; i++) {
            if (optionCategoryParentID[i].value === category_parent_id_in_table) {
                optionCategoryParentID[i].selected = true;
            }
        }
            // Hiển thị form
            modal.style.display = "block";
        }
    }
    });

    //Xử lý button cancel
    cancelBtn.addEventListener('click', function() {
        modal.style.display = "none";
        $('#CategoryForm').find('.custom-alert-error').remove();
    })

    // Active
    link.classList.add('active');

    // code submit danh mục
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
    $('#CategoryForm').submit(function(e){
        e.preventDefault();

        let method = '';

        if(action == "create"){
            method = "AddCategory";
        }
        else if(action == "edit"){
            method = "EditCategory";
        }

        // gửi data
        var sw = showLoadingSwal();
            $.ajax({
                url:'/Dashboard_category/' + method,
                method:'POST',
                data:$(this).serialize(),
                error:err=>{
                    // console.log(err)
                },
                success:function(resp){
            var actionText = action == 'create' ? 'thêm' : 'sửa';
            if(resp.trim() == "done"){
            Swal.fire(
                'Completed!',
                'Bạn đã '+ actionText +' danh mục thành công!',
                'success'
                )
            setTimeout(function() {
                location.reload();
            }, 1000);
            $('#myModal').hide();
            }else{
                sw.close();

                $('#CategoryForm').find('.custom-alert-error').remove();
                if (resp.includes('<!DOCTYPE html>')|| resp.lenght > 50) {
                            // Nếu có chứa HTML, điều hướng sang trang đăng nhập
                    window.location.href = '/Auth';
                } else {
                    $('#CategoryForm').prepend('<div class="custom-alert custom-alert-error" role="alert" style="display: block !important"><i class="fa fa-times-circle"></i>'+ resp + '</div>');
                }
            }
        }
    })
    });

//**************************** XÓA DỮ LIỆU ************************************//
table2.addEventListener('click', function(event) {
  if (event.target.classList.contains('fa-trash')) {
    const row = event.target.closest('tr');
    const category_id = row.cells[0].textContent.trim();
    const parent_name = row.cells[2].textContent.trim();
    const csrf_token_category = csrf_token_category_form.value;
    if(parent_name === 'none'){
        Swal.fire({
            title: 'Bạn không thể xóa danh mục này',
            icon: 'error'
        })
    }else{
        Swal.fire({
      title: 'Bạn có chắc là muốn xóa danh mục này không?',
      text: "Bạn sẽ không thể hoàn tác sau khi hoàn tất!",
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
        url: '/Dashboard_category/DeleteCategory',
        type: 'POST',
        data: { category_id: category_id,
            csrf_token_category: csrf_token_category
        },
        success: function(response) {
          if (response.trim() == "done") {
            Swal.fire(
              'Completed!',
              'Bạn đã xóa danh mục thành công!',
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
  
}
});
</script>