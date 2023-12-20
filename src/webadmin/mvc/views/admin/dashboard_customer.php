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
                    <h1>Khách hàng</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                Customer
                            </a></li>
                        /
                        <li><a href="#" class="active">Shop</a></li>
                        <!-- <button id="addBtn" style="font-size: 14px; border: none; right: 0; position: absolute; margin-right: 26px;margin-bottom: 48px; background-color:var(--primary); color: white;; width: 150px; height: 40px;border-radius: 8px;">
                            Thêm khách hàng
                        </button> -->
                    </ul>
                </div>
            </div>

            <!--********************* Customer ***********************-->
            <div style="background: var(--light);color: var(--dark);">
                <table width="100%" id="myTable">
                    <thead>
                        <tr>
                            <th><span class="las la-sort"></span> EMAIL</th>
                            <th><span class="las la-sort"></span> HỌ TÊN</th>
                            <th><span class="las la-sort"></span> SĐT</th>
                            <?php if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'manager'): ?>
                                <th><span class="las la-sort"></span> ACTION</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php foreach($data as $customer): ?>
                            <tr>
                                <td data-label="Username"><?php echo $customer->getEmail(); ?></td>
                                <td data-label="HoTen"><?php echo $customer->getFull_name(); ?></td>
                                <td data-label="SDT"><?php echo $customer->getPhone(); ?></td>
                                <td data-label="Action">
                                    <?php if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'manager'): ?>
                                        <i class="fa fa-pencil editBtn"></i>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
            </div>
            <div id="myModal" class="modal" style="display: none;">
                <div class="modal-content" style="border-radius: 8px;">
                    <form id="CustomerForm">

                        <input style="color: black" type="text" id="Email" name="Email" hidden>

                        <label for="NameCustomer">Tên khách hàng:</label>
                        <input style="color: black" type="text" id="TenKhachHang" name="TenKhachHang">

                        <label for="NumberPhoneCustomer">SĐT:</label>
                        <input style="color: black" type="text" id="SDT" name="SDT">
                        <br>

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
    const link = document.querySelector(".slide-menu-customer");
    const modal = document.getElementById("myModal");
    const btnEdit = document.getElementById("submitBtn");
    const cancelBtn = document.getElementById("cancelBtn");
    const tbody = document.getElementById("tbody");

    const table2 = document.querySelector('#myTable');
    const hoTen = modal.querySelector('#TenKhachHang');
    const email = modal.querySelector('#Email');
    const sdt = modal.querySelector('#SDT');

    let isEditing = false

    
    // ********************************** SỬA DỮ LIỆU ************************************
    table2.addEventListener('click', function(event) {
    if (event.target.classList.contains('fa-pencil')) {
        action = 'edit';
        submitBtn.innerText = "Lưu";
        const row = event.target.closest('tr');
        const email_in_table = row.cells[0].textContent.trim();
        const hoTen_in_table = row.cells[1].textContent.trim();
        const sdt_in_table = row.cells[2].textContent.trim();
        
        // Điền dữ liệu vào form
        hoTen.value = hoTen_in_table;
        email.value = email_in_table;
        sdt.value = sdt_in_table;
        // Hiển thị form
        modal.style.display = "block";
        
    }
    });

    //Xử lý button cancel
    cancelBtn.addEventListener('click', function() {
        modal.style.display = "none";
        $('#CustomerForm').find('.custom-alert-error').remove();
    })

    // Active
    link.classList.add('active');

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
    $('#CustomerForm').submit(function(e){
        e.preventDefault();

        // gửi data
        var sw = showLoadingSwal();
            $.ajax({
                url:'/Dashboard_customer/Edit',
                method:'POST',
                data: $(this).serialize(),
                error:err=>{
                    // console.log(err)
                },
                success:function(resp){
                if(resp.trim() == "done"){
                Swal.fire(
                    'Completed!',
                    'Bạn đã sửa thông tin khách hàng thành công!',
                    'success'
                    )
                setTimeout(function() {
                    location.reload();
                }, 1000);
                $('#myModal').hide();
                }
                else{
                    sw.close();

                    $('#CustomerForm').find('.custom-alert-error').remove();
                    if (resp.includes('<!DOCTYPE html>')|| resp.lenght > 50) {
                                // Nếu có chứa HTML, điều hướng sang trang đăng nhập
                        window.location.href = '/Auth';
                    } else {
                        $('#CustomerForm').prepend('<div class="custom-alert custom-alert-error" role="alert" style="display: block !important"><i class="fa fa-times-circle"></i>' + resp + '</div>');
                    }
                    //nhớ thêm cái này cho mấy trang kia
                }
            }
        })
    });
</script>