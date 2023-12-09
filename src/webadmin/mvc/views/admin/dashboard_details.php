<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <<?php require_once './mvc/views/admin/libHeader.php'; ?>
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
                    <h1>Chi tiết đơn hàng</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                Details
                            </a></li>
                        /
                        <li><a href="#" class="active">Shop</a></li>
                        <button id="addBtn" style="font-size: 14px; border: none; right: 0; position: absolute; margin-right: 26px;margin-bottom: 48px; background-color:var(--primary); color: white;; width: 150px; height: 40px;border-radius: 8px;">
                            Thêm chi tiết đơn hàng
                        </button>
                    </ul>
                </div>
            </div>

            <!--********************* Details ***********************-->
            <div style="background: var(--light);color: var(--dark);">
                <table width="100%">
                    <thead>
                        <tr>
                            <th><span class="las la-sort"></span> MÃ CHI TIẾT ĐƠN HÀNG</th>
                            <th><span class="las la-sort"></span> MÃ ĐƠN HÀNG</th>
                            <th><span class="las la-sort"></span> MÃ SẢN PHẨM</th>
                            <th><span class="las la-sort"></span> TỔNG TIỀN SẢN PHẨM</th>
                            <th><span class="las la-sort"></span> ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="tbody"></tbody>
                </table>
            </div>
            <div id="myModal" class="modal" style="display: none;">
                <div class="modal-content" style="border-radius: 8px;">
                    <form id="DetailForm">
                        <label for="DetailsCode">Mã chi tiết đơn hàng:</label>
                        <input style="color: black" type="text" id="MaChiTietDonHang" name="MaChiTietDonHang" required>

                        <label for="OrderCode">Mã đơn hàng:</label>
                        <input style="color: black" type="text" id="MaDonHang" name="MaDonHang" required>

                        <label for="ProductCode">Mã sản phẩm:</label>
                        <input style="color: black" type="text" id="MaSanPham" name="MaSanPham" required>

                        <label for="TotalMoney" style="margin-top: 8px;">Tổng tiền sản phẩm:</label>
                        <input style="color: black" type="text" id="TongTien" name="TongTien" required>
                        <br>

                        <button style="color: white; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin-right: 10px;" type="submit" id="submitBtn">Thêm</button>
                        <button style="color: white; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;" class="btnCancel" type="button" id="cancelBtn">Hủy</button>
                    </form>
                </div>
            </div>
            <!-- Confirmation Modal -->
            <div id="confirmationModal">
                <p>Bạn có chắc chắn muốn xóa dữ liệu này?</p>
                <button id="confirmDelete" style="background: var(--primary); border: none;padding: 10px 15px; color: white; border-radius: 8px; width: 60px;">Có</button>
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
    const link = document.querySelector(".slide-menu-details");
    const addBtn = document.getElementById("addBtn");
    const modal = document.getElementById("myModal");
    const cancelBtn = document.getElementById("cancelBtn");
    const btnEdit = document.getElementById("submitBtn");
    const tbody = document.getElementById("tbody");

    // Biến xác định cho biết đang thêm hay đang sửa
    let isEditing = false;

    // ************************************ THÊM DỮ LIỆU ************************************ //
    //Thêm đơn hàng
    addBtn.addEventListener('click', function() {
        isEditing = false;
        modal.style.display = "block";
        document.getElementById("MaChiTietDonHang").value = "";
        document.getElementById("MaDonHang").value = "";
        document.getElementById("MaSanPham").value = "";
        document.getElementById("TongTien").value = "";
        btnEdit.innerText = "Thêm"
    })

    //Xử lý button add
    let productList = [];

    function sortProductList() {
        productList.sort((a, b) => {
            // Sử dụng toLowerCase để so sánh không phân biệt chữ hoa, chữ thường
            const maChiTietDonHangA = a.maChiTietDonHang.toLowerCase();
            const maChiTietDonHangB = b.maChiTietDonHang.toLowerCase();

            if (maChiTietDonHangA < maChiTietDonHangB) {
                return -1;
            }
            if (maChiTietDonHangA > maChiTietDonHangB) {
                return 1;
            }
            return 0;
        });
    }

    // Xử lý sự kiện submit của form
    document.getElementById("DetailForm").addEventListener("submit", function(event) {
        event.preventDefault();

        if (isEditing == false) {
            const maChiTietDonHang = document.getElementById("MaChiTietDonHang").value;
            const maDonHang = document.getElementById("MaDonHang").value;
            const maSanPham = document.getElementById("MaSanPham").value;
            const tongTien = document.getElementById("TongTien").value;

            const newProduct = {
                maChiTietDonHang: maChiTietDonHang,
                maDonHang: maDonHang,
                maSanPham: maSanPham,
                tongTien: tongTien,
            };

            // Thêm sản phẩm mới vào đầu danh sách (kiểu stack)
            productList.unshift(newProduct);
        }
        renderTable();
        modal.style.display = "none";
    });


    //**************************** XÓA DỮ LIỆU ************************************//
    tbody.addEventListener("click", function(event) {
        if (event.target.classList.contains("fa-trash")) {
            const row = event.target.closest("tr");
            const maChiTietDonHang = row.querySelector("h4").textContent; // Lấy mã danh mục từ HTML
            showConfirmationModal(maChiTietDonHang);
        }
    });

    // Hiển thị modal xác nhận xóa
    function showConfirmationModal(maChiTietDonHang) {
        const confirmationModal = document.getElementById("confirmationModal");
        confirmationModal.style.display = "block";

        // Xác nhận xóa
        document.getElementById("confirmDelete").onclick = function() {
            // Tìm index của sản phẩm cần xóa
            const index = productList.findIndex((product) => product.maChiTietDonHang === maChiTietDonHang);

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

    // // ********************************** SỬA DỮ LIỆU **********************************
    function handleEditClick(event) {
        isEditing = true;
        const row = event.target.closest("tr");
        const maChiTietDonHang = row.querySelector("h4").textContent;
        editProduct(maChiTietDonHang);
        btnEdit.innerText = "Sửa"
    }

    // Render lại bảng
    function renderTable() {
        tbody.innerHTML = "";
        sortProductList()
        productList.forEach(function(product) {
            const newRowHTML = `
        <tr>
            <td>
                <div class="client">
                    <div class="client-info">
                        <h4>${product.maChiTietDonHang}</h4>
                    </div>
                </div>
            </td>
            <td>${product.maDonHang}</td>
            <td>${product.maSanPham}</td>
            <td>${product.tongTien}</td>
            <td>
                <i class="fa fa-trash" onclick="handleDeleteClick(event)"></i>
                <i class="fa fa-pencil" onclick="handleEditClick(event)"></i>
            </td>
        </tr>
    `;

            tbody.insertAdjacentHTML("beforeend", newRowHTML);
        });
    }

    function editProduct(maChiTietDonHang) {
        const productToEditIndex = productList.findIndex((product) => product.maChiTietDonHang === maChiTietDonHang);

        if (productToEditIndex !== -1) {
            const productToEdit = productList[productToEditIndex];
            modal.style.display = "block";
            document.getElementById("MaChiTietDonHang").value = productToEdit.maChiTietDonHang;
            document.getElementById("MaDonHang").value = productToEdit.maDonHang;
            document.getElementById("MaSanPham").value = productToEdit.maSanPham;
            document.getElementById("TongTien").value = productToEdit.tongTien;
        }
    }

    document.getElementById("DetailForm").addEventListener("submit", function(event) {
        event.preventDefault();

        if (isEditing == true) {

            const maChiTietDonHang = document.getElementById("MaChiTietDonHang").value;
            const maDonHang = document.getElementById("MaDonHang").value;
            const maSanPham = document.getElementById("MaSanPham").value;
            const tongTien = document.getElementById("TongTien").value;

            for (let i = 0; i < productList.length; i++) {
                if (productList[i].maChiTietDonHang === maChiTietDonHang) {
                    // Cập nhật thông tin của chi tiết đơn hàng
                    productList[i].maDonHang = maDonHang;
                    productList[i].maSanPham = maSanPham;
                    productList[i].tongTien = tongTien;
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