<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once './mvc/views/admin/libHeader.php'; ?>
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
                <table width="100%">
                    <thead>
                        <tr>
                            <th><span class="las la-sort"></span> USERNAME</th>
                            <th><span class="las la-sort"></span> PASSWORD</th>
                            <th><span class="las la-sort"></span> HỌ TÊN</th>
                            <th><span class="las la-sort"></span> EMAIL</th>
                            <th><span class="las la-sort"></span> SĐT</th>
                            <th><span class="las la-sort"></span> ĐỊA CHỈ</th>
                            <th><span class="las la-sort"></span> ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    <!-- <?php var_dump($data); ?>
                    <?php foreach($data as $category): ?>
                            <tr>
                                <td><?php echo $category->getUsername(); ?></td>
                            </tr>
                        <?php endforeach; ?> -->
                    </tbody>
                </table>
            </div>
            <div id="myModal" class="modal" style="display: none;">
                <div class="modal-content" style="border-radius: 8px;">
                    <form id="CustomerForm">
                        <label for="CustomerCode">Mã Khách hàng:</label>
                        <input style="color: black" type="text" id="MaKhachHang" name="MaKhachHang" required>

                        <label for="NameCustomer">Tên khách hàng:</label>
                        <input style="color: black" type="text" id="TenKhachHang" name="TenKhachHang" required>

                        <label for="Email">Email:</label>
                        <input style="color: black" type="text" id="Email" name="Email" required>

                        <label for="NumberPhoneCustomer">SĐT:</label>
                        <input style="color: black" type="text" id="SDT" name="SDT" required>

                        <label for="Address">Địa chỉ:</label>
                        <input style="color: black" type="text" id="DiaChi" name="DiaChi" required>
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
</body>

</html>

<script>
    // Khai báo biến
    const link = document.querySelector(".slide-menu-customer");
    const addBtn = document.getElementById("addBtn");
    const modal = document.getElementById("myModal");
    const btnEdit = document.getElementById("submitBtn");
    const cancelBtn = document.getElementById("cancelBtn");
    const tbody = document.getElementById("tbody");

    let isEditing = false

    // ************************************ THÊM DỮ LIỆU ************************************ //
    //Thêm đơn hàng
    addBtn.addEventListener('click', function() {
        modal.style.display = "block";
        isEditing = false;
        btnEdit.innerText = "Thêm";
        document.getElementById("MaKhachHang").value = "";
        document.getElementById("TenKhachHang").value = "";
        document.getElementById("Email").value = "";
        document.getElementById("SDT").value = "";
        document.getElementById("DiaChi").value = "";
    })

    //Xử lý button add
    let productList = [];

    // Sắp xếp theo mảng lại theo mã khách hàng
    function sortProductList() {
        productList.sort((a, b) => {
            // Sử dụng toLowerCase để so sánh không phân biệt chữ hoa, chữ thường
            const maKhachHangA = a.maKhachHang.toLowerCase();
            const maKhachHangB = b.maKhachHang.toLowerCase();

            if (maKhachHangA < maKhachHangB) {
                return -1;
            }
            if (maKhachHangA > maKhachHangB) {
                return 1;
            }
            return 0;
        });
    }

    // Xử lý sự kiện submit của form
    document.getElementById("CustomerForm").addEventListener("submit", function(event) {
        event.preventDefault();

        const maKhachHang = document.getElementById("MaKhachHang").value;
        const tenKhachHang = document.getElementById("TenKhachHang").value;
        const email = document.getElementById("Email").value;
        const sdt = document.getElementById("SDT").value;
        const diaChi = document.getElementById("DiaChi").value;

        const newProduct = {
            maKhachHang: maKhachHang,
            tenKhachHang: tenKhachHang,
            email: email,
            sdt: sdt,
            diaChi: diaChi,
        };

        // Thêm sản phẩm mới vào đầu danh sách (kiểu stack)
        productList.unshift(newProduct);
        renderTable();
        // Xóa dữ liệu trong form
        document.getElementById("MaKhachHang").value = "";
        document.getElementById("TenKhachHang").value = "";
        document.getElementById("Email").value = "";
        document.getElementById("SDT").value = "";
        document.getElementById("DiaChi").value = "";
        modal.style.display = "none";
    });

    //**************************** XÓA DỮ LIỆU ************************************//
    tbody.addEventListener("click", function(event) {
        if (event.target.classList.contains("fa-trash")) {
            const row = event.target.closest("tr");
            const maKhachHang = row.querySelector("h4").textContent; // Lấy mã danh mục từ HTML
            showConfirmationModal(maKhachHang);
        }
    });

    // Hiển thị modal xác nhận xóa
    function showConfirmationModal(maKhachHang) {
        const confirmationModal = document.getElementById("confirmationModal");
        confirmationModal.style.display = "block";

        // Xác nhận xóa
        document.getElementById("confirmDelete").onclick = function() {
            // Tìm index của sản phẩm cần xóa
            const index = productList.findIndex((product) => product.maKhachHang === maKhachHang);

            if (index !== -1) {
                productList.splice(index, 1);
                renderTable();
            }

            closeConfirmationModal();
        };

        // Hủy xóa
        document.getElementById("cancelDelete").onclick = function() {
            closeConfirmationModal();
        };
    }

    function closeConfirmationModal() {
        const confirmationModal = document.getElementById("confirmationModal");
        confirmationModal.style.display = "none";
    }

    // ********************************** SỬA DỮ LIỆU ************************************
    function handleEditClick(event) {
        isEditing = true;
        const row = event.target.closest("tr");
        const maKhachHang = row.querySelector("h4").textContent;
        BtnEdit.innerText = "Sửa";
        editProduct(maKhachHang);
    }

    // Render lại bảng đã cập nhật code mới nhất    
    function renderTable() {
        tbody.innerHTML = "";
        sortProductList();
        productList.forEach(function(product) {
            const newRowHTML = `
        <tr>
            <td>
                <div class="client">
                    <div class="client-info">
                        <h4>${product.maKhachHang}</h4>
                    </div>
                </div>
            </td>
            <td>${product.tenKhachHang}</td>
            <td>${product.email}</td>
            <td>${product.sdt}</td>
            <td>${product.diaChi}</td>
            <td>
                <i class="fa fa-trash" onclick="handleDeleteClick(event)"></i>
                <i class="fa fa-pencil" onclick="handleEditClick(event)"></i>
            </td>
        </tr>
    `;

            tbody.insertAdjacentHTML("beforeend", newRowHTML);
        });
    }

    function editProduct(maDanhMuc) {
        const productToEditIndex = productList.findIndex((product) => product.maDanhMuc === maDanhMuc);

        if (productToEditIndex !== -1) {
            const productToEdit = productList[productToEditIndex];
            modal.style.display = "block";
            document.getElementById("MaKhachHang").value = productToEdit.maKhachHang;
            document.getElementById("TenKhachHang").value = productToEdit.tenKhachHang;
            document.getElementById("Email").value = productToEdit.email;
            document.getElementById("SDT").value = productToEdit.sdt;
            document.getElementById("DiaChi").value = productToEdit.diaChi;
        }
    }

    document.getElementById("CustomerForm").addEventListener("submit", function(event) {
        event.preventDefault();

        if (isEditing == true) {

            const maKhachHang = document.getElementById("MaKhachHang").value;
            const tenKhachHang = document.getElementById("TenKhachHang").value;
            const email = document.getElementById("Email").value;
            const sdt = document.getElementById("SDT").value;
            const diaChi = document.getElementById("DiaChi").value;

            for (let i = 0; i < productList.length; i++) {
                if (productList[i].maKhachHang === maKhachHang) {
                    // Cập nhật thông tin của chi tiết đơn hàng
                    productList[i].tenKhachHang = tenKhachHang;
                    productList[i].email = email;
                    productList[i].sdt = sdt;
                    productList[i].diaChi = diaChi;
                    break; // Dừng vòng lặp khi tìm thấy và cập nhật
                }
            }
            renderTable();
        }
        modal.style.display = "none";
    });

    //Xử lý button cancel
    cancelBtn.addEventListener('click', function() {
        modal.style.display = "none";
    })

    // Active
    link.classList.add('active');
</script>