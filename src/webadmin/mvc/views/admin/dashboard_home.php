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
                    <h1>Trang chủ</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                Home
                            </a></li>
                        /
                        <li><a href="#" class="active">Shop</a></li>
                        <button id="addBtn" style="font-size: 14px; border: none; right: 0; position: absolute; margin-right: 26px;margin-bottom: 48px; background-color:var(--primary); color: white;; width: 120px; height: 40px;border-radius: 8px;">
                            Thêm dữ liệu
                        </button>
                    </ul>
                </div>
            </div>

            <!--********************* Category ***********************-->
            <div style="background: var(--light);color: var(--dark);">
                <h1><?php echo  "Xin chào, " . $_SESSION['usr']; ?></h1>
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
</body>

</html>
<script src="/public/js/dashboard.js"></script>
<script>
    // Khai báo biến
    const link = document.querySelector(".slide-menu-home");

    const addBtn = document.getElementById("addBtn");
    const modal = document.getElementById("myModal");
    const cancelBtn = document.getElementById("cancelBtn");
    const BtnEdit = document.getElementById("submitBtn")
    const tbody = document.getElementById("tbody");
    let isEditing = false;

    // ************************************ THÊM DỮ LIỆU ************************************ //
    //Thêm đơn hàng
    addBtn.addEventListener('click', function() {
        isEditing = false;
        document.getElementById("MaDanhMuc").value = "";
        document.getElementById("TenDanhMuc").value = "";
        modal.style.display = "block";
        BtnEdit.innerText = "Thêm";
    })

    //Xử lý button add
    let productList = [];

    // Sắp xếp theo mảng lại theo mã khách hàng
    function sortProductList() {
        productList.sort((a, b) => {
            // Sử dụng toLowerCase để so sánh không phân biệt chữ hoa, chữ thường
            const maDanhMucA = a.maDanhMuc.toLowerCase();
            const maDanhMucB = b.maDanhMuc.toLowerCase();

            if (maDanhMucA < maDanhMucB) {
                return -1;
            }
            if (maDanhMucA > maDanhMucB) {
                return 1;
            }
            return 0;
        });
    }

    // Xử lý sự kiện submit của form
    document.getElementById("CategoryForm").addEventListener("submit", function(event) {
        event.preventDefault();

        if (isEditing == false) {
            const maDanhMuc = document.getElementById("MaDanhMuc").value;
            const tenDanhMuc = document.getElementById("TenDanhMuc").value;

            const newProduct = {
                maDanhMuc: maDanhMuc,
                tenDanhMuc: tenDanhMuc,
            };

            // Thêm sản phẩm mới vào đầu danh sách (kiểu stack)
            productList.unshift(newProduct);
            productList.forEach((product, index) => {
                product.id = index + 1;
            });
        }
        renderTable();
        modal.style.display = "none";
    });

    // Hàm để render lại bảng
    // function renderTable() {
    //     tbody.innerHTML = "";

    //     productList.forEach(function(product) {
    //         const newRowHTML = `
    //         <tr>
    //             <td>
    //                 <div class="client">
    //                     <div class="client-info">
    //                         <h4>${product.maDanhMuc}</h4>
    //                     </div>
    //                 </div>
    //             </td>
    //             <td>${product.tenDanhMuc}</td>
    //             <td>
    //                 <i class="fa fa-trash"></i>
    //                 <i class="fa fa-pencil"></i>
    //             </td>
    //         </tr>
    //     `;

    //         tbody.insertAdjacentHTML("beforeend", newRowHTML);
    //     });
    // }


    //**************************** XÓA DỮ LIỆU ************************************//
    tbody.addEventListener("click", function(event) {
        if (event.target.classList.contains("fa-trash")) {
            const row = event.target.closest("tr");
            const maDanhMuc = row.querySelector("h4").textContent; // Lấy mã danh mục từ HTML
            showConfirmationModal(maDanhMuc);
        }
    });

    // Hiển thị modal xác nhận xóa
    function showConfirmationModal(maDanhMuc) {
        const confirmationModal = document.getElementById("confirmationModal");
        confirmationModal.style.display = "block";

        // Xác nhận xóa
        document.getElementById("confirmDelete").onclick = function() {
            // Tìm index của sản phẩm cần xóa
            const index = productList.findIndex((product) => product.maDanhMuc === maDanhMuc);

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

    // ************************************ SỬA DỮ LIỆU ************************************ //
    function handleEditClick(event) {
        isEditing = true;
        const row = event.target.closest("tr");
        const maDanhMuc = row.querySelector("h4").textContent;
        BtnEdit.innerText = "Sửa";
        editProduct(maDanhMuc);
    }

    // Render lại bảng đã cập nhật code mới nhất    
    function renderTable() {
        tbody.innerHTML = "";
        sortProductList()
        productList.forEach(function(product) {
            const newRowHTML = `
        <tr>
            <td>
                <div class="client">
                    <div class="client-info">
                        <h4>${product.maDanhMuc}</h4>
                    </div>
                </div>
            </td>
            <td>${product.tenDanhMuc}</td>
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
            document.getElementById("MaDanhMuc").value = productToEdit.maDanhMuc;
            document.getElementById("TenDanhMuc").value = productToEdit.tenDanhMuc;
        }
    }

    document.getElementById("CategoryForm").addEventListener("submit", function(event) {
        event.preventDefault();

        if (isEditing == true) {

            const maDanhMuc = document.getElementById("MaDanhMuc").value;
            const tenDanhMuc = document.getElementById("TenDanhMuc").value;

            for (let i = 0; i < productList.length; i++) {
                if (productList[i].maDanhMuc === maDanhMuc) {
                    // Cập nhật thông tin của chi tiết đơn hàng
                    productList[i].tenDanhMuc = tenDanhMuc;
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
