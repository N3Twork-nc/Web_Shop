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
                    <h1>Nhân viên</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                Staff
                            </a></li>
                        /
                        <li><a href="#" class="active">Shop</a></li>
                        <?php if($_SESSION['role'] == 'admin'): ?>
                            <button id="addBtn" style="font-size: 14px; border: none; right: 0; position: absolute; margin-right: 26px;margin-bottom: 48px; background-color:var(--primary); color: white;; width: 150px; height: 40px;border-radius: 8px;">
                            Thêm staff
                        </button>
                            <?php endif; ?>
                    </ul>
                </div>
            </div>

            <!--********************* Customer ***********************-->
            <div style="background: var(--light);color: var(--dark);">
                <table id="myTable" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 30%;"><span class="las la-sort"></span> USERNAME</th>
                            <th style="width: 30%;"><span class="las la-sort"></span> ROLE</th>
                            <?php if($_SESSION['role'] == 'admin'): ?>
                                <th style="width: 30%;"><span class="las la-sort"></span> ACTION</th>
                            <?php endif; ?>
                            <th></th>  
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php foreach($data as $staff): ?>
                            <tr>
                                <td><?php echo $staff->getUsername(); ?></td>
                                <td><?php echo $staff->getRole(); ?></td>
                                <?php if ($staff->getRole() != "admin" ): ?> 
                                <td>
                                    <?php if($_SESSION['role'] == 'admin'): ?>
                                        <button class="btnResetPW" style="color: white; padding:10px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; background-color: var(--primary); ">Reset Password</button>
                                    <i class="fa fa-trash"></i>
                                    <i class="fa fa-pencil editBtn"></i>
                                    <?php endif; ?>
                                </td>
                                <?php endif; ?>
                               
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div id="myModal" class="modal" style="display: none;">
                <div class="modal-content" style="border-radius: 8px;">
                    <form id="StaffForm">
                        <label for="UsernameID" id = "labelUsernameID">Username</label>
                        <input style="color: black" type="text" id="username" name="username">

                        <label for="PasswordID" id= "labelPasswordID">Password</label>
                        <input style="color: black ; width: 100%;
                        padding: 12px 20px;margin: 8px 0;box-sizing: border-box;border: 2px solid #ccc; border-radius: 4px;background-color: #f8f8f8; font-size: 16px;" type="password" id="password" name="password">

                        <label for="Role" id= "LabelRole" style="margin-top: 20px">Role:</label>
                        <select name="role" id= "role" style="width: 100%; height: 45px; margin-bottom: 20px; padding-left: 20px;" required>
                            <option value="staff">staff</option>
                            <option value="manager">manager</option>
                        </select>   

                        <button style="color: white; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin-right: 10px;" type="submit" id="submitBtn">Thêm</button>
                        <button style="color: white; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;" class="btnCancel" type="button" id="cancelBtn">Hủy</button>
                    </form>
                </div>
            </div>
            <!-- Confirmation Modal -->
            <div id="confirmationModal">
                <p>Bạn có chắc chắn muốn xóa dữ liệu này?</p>
                <button id="confirmDelete" onclick="deleteData()" style="background: var(--primary); border: none;padding: 10px 15px; color: white; border-radius: 8px; width: 60px;">Xóa</button>
                <button id="cancelDelete" onclick="closeConfirmationModal()" style="background: var(--dark-grey); border: none;padding: 10px 10px; color: white; border-radius: 8px; width: 60px;">Không</button>
            </div>
        </main>
    </div>

    </main>

    </div>

    <script src="/public/js/dashboard.js"></script>
    <script src="/public/js/pagination.js"></script>
</body>

</html>

<script>
    // Khai báo biến
    const link = document.querySelector(".slide-menu-staff");
    const addBtn = document.getElementById("addBtn");
    const modal = document.getElementById("myModal");
    const btnEdit = document.getElementById("submitBtn");
    const cancelBtn = document.getElementById("cancelBtn");
    const username = document.getElementById("username");
    const password = document.getElementById("password");
    const role = document.getElementById("role");
    const tbody = document.getElementById("tbody");;              
    let isEditing = false
    let action = '';

    const table2 = document.querySelector('#myTable');
        //xóa nv
    table2.addEventListener('click', function(event) {
        if (event.target.classList.contains('fa-trash')) {
            const row = event.target.closest('tr');
            const username = row.cells[0].textContent.trim();
            Swal.fire({
                title: 'Bạn có chắc là muốn xóa nhân viên này không?',
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
                    url: '/Dashboard_staff/DeleteStaff',
                    type: 'POST',
                    data: { username: username },
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
    })
    //Sua du lieu 
    table2.addEventListener('click', function(event) {
    if (event.target.classList.contains('fa-pencil')) {
        action = 'edit';
        document.getElementById("labelUsernameID").style.display = "block";
        document.getElementById("username").style.display = "block";
        document.getElementById("labelPasswordID").style.display = "none";
        document.getElementById("labelPasswordID").innerText = "none";
        document.getElementById("password").style.display = "none";
        document.getElementById("LabelRole").style.display = "block";
        document.getElementById("role").style.display = "block";
        username.setAttribute("readonly", true);
        submitBtn.innerText = "Lưu";
        const row = event.target.closest('tr');
        const username_in_table = row.cells[0].textContent.trim();
        const role_in_table = row.cells[1].textContent.trim();
        // Điền dữ liệu vào form
        role.value = role_in_table;
        username.value = username_in_table;
        $('#StaffForm').find('.custom-alert-error').remove();
        // Hiển thị form
        modal.style.display = "block";   
    }
    });

    //reset password
    table2.addEventListener('click', function(event) {
    if (event.target.classList.contains('btnResetPW')) {
        action = 'editPassword';
        document.getElementById("labelUsernameID").style.display = "block";
        document.getElementById("username").style.display = "block";
        document.getElementById("labelPasswordID").style.display = "block";
        document.getElementById("labelPasswordID").innerText = "New Password";
        document.getElementById("password").style.display = "block";
        document.getElementById("LabelRole").style.display = "none";
        document.getElementById("role").style.display = "none";
        username.setAttribute("readonly", true);
        submitBtn.innerText = "Lưu";
        const row = event.target.closest('tr');
        const username_in_table = row.cells[0].textContent.trim();
        // Điền dữ liệu vào form
        username.value = username_in_table;
        password.value = '';
        $('#StaffForm').find('.custom-alert-error').remove();
        // Hiển thị form
        modal.style.display = "block";   
    }
    });

    addBtn.addEventListener('click', function() {
        action = "add";
        modal.style.display = "block";
        document.getElementById("labelUsernameID").style.display = "block";
        document.getElementById("username").style.display = "block";
        document.getElementById("labelPasswordID").style.display = "block";
        document.getElementById("labelPasswordID").innerText = "Password";
        document.getElementById("password").style.display = "block";
        document.getElementById("LabelRole").style.display = "block";
        document.getElementById("role").style.display = "block";
        username.removeAttribute("readonly");
        username.value = '';
        password.value = '';
        role.value = '';
        $('#StaffForm').find('.custom-alert-error').remove();
        BtnEdit.innerText = "Thêm";
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
    $('#StaffForm').submit(function(e){
        let method = '';
        if(action == 'add'){
            method = "AddStaff";
        }
        else if(action == 'edit'){
            method = "EditStaff";
        }
        else if(action == 'editPassword'){
            method = "ResetPassword";
        }
        else {
            Swal.fire(
                'Oops...',
                'Lỗi',
                'error'
            );
        }
        e.preventDefault();

        // gửi data
        var sw = showLoadingSwal();
            $.ajax({
                url:'/Dashboard_staff/' + method,
                method:'POST',
                data: $(this).serialize(),
                error:err=>{
                    // console.log(err)
                },
                success:function(resp){
                if(resp.trim() == "done"){
                Swal.fire(
                    'Completed!',
                    'Thao tác thành công!',
                    'success'
                    )
                setTimeout(function() {
                    location.reload();
                }, 1000);
                $('#myModal').hide();
                }
                else{
                    sw.close();

                    $('#StaffForm').find('.custom-alert-error').remove();
                    if (resp.includes('<!DOCTYPE html>')|| resp.lenght > 50) {
                                // Nếu có chứa HTML, điều hướng sang trang đăng nhập
                        window.location.href = '/Auth';
                    } else {
                        $('#StaffForm').prepend('<div class="custom-alert custom-alert-error" role="alert" style="display: block !important"><i class="fa fa-times-circle"></i>' + resp + '</div>');
                    }
                    //nhớ thêm cái này cho mấy trang kia
                }
            }
        })
    });

    //Xử lý button cancel
    cancelBtn.addEventListener('click', function() {
        modal.style.display = "none";
    })

    // Active
    link.classList.add('active');
</script>