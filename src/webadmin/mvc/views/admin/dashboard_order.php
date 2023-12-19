<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once 'libHeader.php'; ?>
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
                    <h1>Đơn hàng</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                Order
                            </a></li>
                        /
                        <li><a href="#" class="active">Shop</a></li>

                        <?php if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'manager'): ?>
                            <button id="addBtn" style="font-size: 14px; border: none; right: 0; position: absolute; margin-right: 26px;margin-bottom: 48px; background-color:var(--primary); color: white; width: 120px; height: 40px;border-radius: 8px;">
                                Thêm sản phẩm
                            </button> 
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <!--********************* Order ***********************-->
            <div style="background: var(--light);color: var(--dark);">
                <table id="myTable" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 120px;"><span class="las la-sort"></span> MÃ ĐƠN</th>
                            <th style="width: 120px;"><span class="las la-sort"></span> NGÀY ĐẶT</th>
                            <th style="width: 80px;"><span class="las la-sort"></span> T.THÁI</th>
                            <th style="width: 80px;"><span class="las la-sort"></span> T.TIỀN</th>
                            <th style="width: 300px;"><span class="las la-sort"></span> EMAIL</th>
                            <th style="width: 120px;"><span class="las la-sort"></span> MÃ TT</th>
                            <th style="width: 120px;"><span class="las la-sort"></span> NGÀY TT</th>
                            <th style="width: 120px;"><span class="las la-sort"></span> LOẠI TT</th>
                            <th style="width: 180px;"><span class="las la-sort"></span> ĐỊA CHỈ</th>
                            <th style="width: 120px;"><span class="las la-sort"></span> SĐT</th>
                            <?php if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'manager'): ?>
                                <th><span class="las la-sort"></span> ACTION</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <!-- Dữ liệu mẫu -->
                        <!-- <tr>
                            <td>1</td>
                            <td>
                                <div class="client">
                                    <div class="client-info">
                                        <h4>PTITATB019</h4>
                                    </div>
                                </div>
                            </td>
                            <td>Captain-Monkey</td>
                            <td>19 April, 2022</td>
                            <td>Còn hàng</td>
                            <td>790.000đ</td>
                            <td><i class="fa fa-file"></i>
                                <i class="fa fa-truck"></i>
                                <i class="fa fa-paypal"></i>
                            </td>
                        </tr> -->
                        <?php foreach($data as $order): ?>
                            <tr>
                                <td data-label="MaDon"><?php echo $order->getOrder_code(); ?></td>
                                <td data-label="NgayDat"><?php echo $order->getOrder_date(); ?></td>
                                <td data-label="TrangThai"><?php echo $order->getState(); ?></td>
                                <td data-label="TongTien"><?php echo $order->getTotal_price(); ?></td>
                                <td data-label="Username"><?php echo $order->getCustomer()->getEmail(); ?></td>
                                <td data-label="MaThanhToan"><?php echo $order->getPayment_code() == null ? "NONE": $order->getPayment_code(); ?></td>
                                <td data-label="NgayThanhToan"><?php echo $order->getPayment_date() == null ? "NONE": $order->getPayment_date(); ?></td>
                                <td data-label="LoaiThanhToan"><?php echo $order->getType() == null ? "NONE" : $order->getType(); ?></td>
                                <td data-label="DiaChi"><?php echo $order->getAddress(); ?></td>
                                <td data-label="SDT"><?php echo $order->getCustomer()->getPhone(); ?></td>
                                <?php if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'manager'): ?>
                                    <td>
                                    <i id="showDetailIcon" style="background: #16bb5e; border: 2px solid #16bb5e !important; margin-left: 5px; margin-top: 5px" class="fa fa-file xemChiTietOrder" title="Xem chi tiết"></i>
                                    <?php
                                        if ($order->getState() == 'pending') {
                                            echo '<i style="background: #db7419; border: 2px solid #db7419 !important; margin-top: 5px" class="fa fa-truck deliveryOrder active" title="Vận chuyển"></i>';
                                            echo '<i style="background: #c11515; border: 2px solid #c11515 !important; margin-left: 5px; margin-top: 5px" class="fa fa-times cancelOrder active" title="Hủy đơn hàng"></i>';
                                        } else {
                                            echo '<i style="background: #c11515; border: 2px solid #c11515 !important; pointer-events: none; margin-top: 5px" class="fa fa-truck disabled" title="Vận chuyển"></i>';
                                            echo '<i style="background: #c11515; border: 2px solid #c11515 !important; margin-left: 5px; margin-top: 5px" class="fa fa-times disabled" title="Hủy đơn hàng"></i>';
                                        }
                                    ?>
                                    <?php
                                        if ($order->getState() == 'delivering') {
                                            if($order->getPayment_code() == null && 
                                            $order->getPayment_date() == null &&
                                            $order->getType() == null) {
                                                echo '<i style="margin-top: 5px" class="fa fa-paypal payOrder active" title="Thanh toán"></i>';
                                            }else {
                                                echo '<i style="margin-top: 5px; pointer-events: none;" class="fa fa-paypal disabled" title="Thanh toán"></i>';
                                            }
                                        }else {
                                            echo '<i style="margin-top: 5px; pointer-events: none;" class="fa fa-paypal disabled" title="Thanh toán"></i>';
                                        }
                                    ?>
                                    <?php 
                                        if($order->getState() == 'delivering' && $order->getPayment_code() != null) {
                                            echo('<i style="margin-top: 5px; margin-left: 5px;" class="fa fa-check confirmDelivery active" title="Xác nhận giao hàng"></i>');
                                        }else {
                                            echo('<i style="margin-top: 5px; margin-left: 5px;" class="fa fa-check disabled" title="Xác nhận giao hàng"></i>');
                                        }
                                    ?>
                                </td>                 
                                <td data-label="ChiTietOrder" style="color: var(--dark); display: none;">
                                    <?php $order_items = $order->getOrder_items(); ?>
                                        <?php foreach ($order_items as $order_item) : ?> 
                                            <p class="order-data" data-label="MaDonCT" ><?php echo $order_item->getOrder_code(); ?></p>
                                            <p class="order-data" data-label="MaSPCT" ><?php echo $order_item->getProduct_code(); ?></p>
                                            <p class="order-data" data-label="SoLuong" ><?php echo $order_item->getQuantity(); ?></p>
                                            <p class="order-data" data-label="Size" ><?php echo $order_item->getSize(); ?></p> 
                                            <p class="order-data" data-label="TongTien" ><?php echo $order_item->getTotal_price(); ?></p>                                                    
                                        <?php endforeach; ?>
                                </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div id="myModal" class="modal" style="display: none;">
                <div class="modal-content" style="border-radius: 8px;">
                    <form id="OrderForm">
                        <label for="OrderCode">Mã đơn:</label>
                        <input style="color: black" type="text" id="MaDonHang" name="MaDonHang" required>

                        <label for="NameCustomer">Tên khách hàng:</label>
                        <input style="color: black" type="text" id="TenKhachHang" name="TenKhachHang" required>

                        <label for="OrderDate">Ngày đặt:</label>
                        <input style="height: 47px; width:100%;" type="date" id="NgayDat" name="NgayDat" required>

                        <label for="OrderStatus" style="width: 100%; margin-top: 8px;">Trạng thái:</label>
                        <select style="height: 47px; width:100%;" id="TrangThai" name="TrangThai" required>
                            <option value="ConHang">Còn hàng</option>
                            <option value="HetHang">Hết hàng</option>
                        </select>

                        <label for="TotalMoney" style="margin-top: 8px;">Tổng tiền:</label>
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
                <button id="confirmDelete" onclick="deleteData()" style="background: var(--primary); border: none;padding: 10px 15px; color: white; border-radius: 8px; width: 60px;">Có</button>
                <button id="cancelDelete" onclick="closeConfirmationModal()" style="background: var(--dark-grey); border: none;padding: 10px 10px; color: white; border-radius: 8px; width: 60px;">Không</button>
            </div>
            
            <div id="formChiTietOrder" class="XemChiTiet" style="display:none; border-radius: 12px; background: var(--light); width: 80% !important;">
                <table width="100%">
                    <thead>
                        <tr style="background: none !important;">
                            <th style="width: 120px;"><span class="las la-sort"></span>Mã đơn</th>
                            <th style="width: 120px;"><span class="las la-sort"></span>Mã SP</th>
                            <th style="width: 120px;"><span class="las la-sort"></span>Số Lượng</th>
                            <th style="width: 120px;"><span class="las la-sort"></span>Size</th>
                            <th style="width: 120px;"><span class="las la-sort"></span>Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_2">
                        <tr></tr>
                    </tbody>
                </table>                            
                <button id="cancelXemChiTietOrder" style="font-size: 14px;border: none;background-color: red;margin-top: 21px; color: white; width: 120px; height: 30px;border-radius: 1px;">Cancel</button>
            </div>
        </main>
    </div>

    </main>

    </div>

    <script src="/public/js/dashboard.js"></script>
</body>

</html>
<script>
    //Khai báo biến tổng quát dùng mọi chỗ
    const link = document.querySelector(".slide-menu-order");
    const modal = document.getElementById("myModal");
    const btnEdit = document.getElementById("submitBtn");
    const cancelBtn = document.getElementById("cancelBtn");
    const tbody = document.getElementById("tbody");

    const table2 = document.querySelector('#myTable');
    let isEditing = false;

    function showLoadingSwal() {
    return Swal.fire({
        title: 'Loading...',
        text: 'Vui lòng chờ trong giây lát!',
        showConfirmButton: false,
        imageUrl: '/public/img/gif/loading.gif',
        allowOutsideClick: false // Không cho phép đóng khi click ra ngoài
    });
    }

    function popUp(title, icon, confirmText, cancelText, method, successText){
            const row = event.target.closest('tr');
            const order_code = row.cells[0].textContent.trim();
            Swal.fire({
                title: title,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmText,
                cancelButtonText: cancelText
            }).then((result) => {
                if (result.isConfirmed) {
                var sw = showLoadingSwal();
                $.ajax({
                    url: '/Dashboard_order/' + method,
                    type: 'POST',
                    data: { order_code: order_code },
                    success: function(response) {
                    if (response.trim() == "done") {
                        Swal.fire(
                        'Completed!',
                        successText,
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

    //Thanh toán
    table2.addEventListener('click', function(event) {
        if (event.target.classList.contains('payOrder')) {
            let title = 'Thanh toán cho đơn hàng này?';
            let icon = 'question';
            let confirmText = 'Thanh toán';
            let cancelText = 'Hủy';
            let method = 'Pay';
            let successText = 'Thanh toán thành công!';
            popUp(title, icon, confirmText, cancelText, method, successText);
        }
    })

    //Hủy đơn

    table2.addEventListener('click', function(event) {
        if (event.target.classList.contains('cancelOrder')) {
            let title = 'Bạn muốn hủy đơn hàng này?';
            let icon = 'warning';
            let confirmText = 'Hủy đơn';
            let cancelText = 'Không';
            let method = 'Cancel';
            let successText = 'Hủy đơn thành công!';
            popUp(title, icon, confirmText, cancelText, method, successText);
        }
    })
    
    // Vận chuyển
    table2.addEventListener('click', function(event) {
        if (event.target.classList.contains('deliveryOrder')) {
            let title = 'Vận chuyển đơn hàng này?';
            let icon = 'question';
            let confirmText = 'Vận chuyển';
            let cancelText = 'Hủy';
            let method = 'Delivery';
            let successText = 'Đơn hàng đang được vận chuyển!';
            popUp(title, icon, confirmText, cancelText, method, successText);
        }
    })

    // Xác nhận giao hàng
    table2.addEventListener('click', function(event) {
        if (event.target.classList.contains('confirmDelivery')) {
            let title = 'Đơn này đã giao thành công?';
            let icon = 'question';
            let confirmText = 'Xác nhận';
            let cancelText = 'Hủy';
            let method = 'ConfirmDelivery';
            let successText = 'Đã chuyển trạng thái đơn hàng!';
            popUp(title, icon, confirmText, cancelText, method, successText);
        }
    })

    cancelBtn.addEventListener('click', function() {
            modal.style.display = "none";
        })
        //Active
    link.classList.add('active');

    //Code js mới: 26/11/2023
    //--------------------------HIỂN THỊ CHI TIẾT CÁC SẢN PHẨM TRONG ĐƠN------------------------------------
    var formChiTietSP = document.getElementById('formChiTietOrder');
    document.querySelectorAll('.xemChiTietOrder').forEach(function(button) {
        button.addEventListener('click', function() {
            formChiTietSP.style.display = 'block';
        });
    });

    document.getElementById("cancelXemChiTietOrder").addEventListener("click", function() {
        var formChiTiet = document.getElementById("formChiTietOrder");
        formChiTiet.style.display = (formChiTiet.style.display === "block" || formChiTiet.style.display === "") ? "none" : "block";
    });

    // Đoạn code này để check thử xem là có lấy được dữ liệu không á
    document.querySelectorAll('.xemChiTietOrder').forEach(function(button) {
    button.addEventListener('click', function() {
        var formChiTiet = document.getElementById("formChiTietOrder");
        formChiTiet.style.display = 'block';
        var row = this.closest('tr');
        var orderItemsData = row.querySelector('td[data-label="ChiTietOrder"]').querySelectorAll('p');
        orderItemsData.forEach(function(p) {
            var label = p.getAttribute('data-label');
            var value = p.textContent;
            console.log("Label: " + label + ", Value: " + value);
        });
    });
});

document.querySelectorAll('.xemChiTietOrder').forEach(function(button) {
    button.addEventListener('click', function() {
        var formChiTiet = document.getElementById("formChiTietOrder");
        formChiTiet.style.display = 'block';
        var row = this.closest('tr');       
        var orderItemsData = row.querySelector('td[data-label="ChiTietOrder"]').querySelectorAll('p');

        var tbody2 = document.getElementById('tbody_2');
        tbody2.innerHTML = "";
        var newRow;
        orderItemsData.forEach(function(p) {
            var label = p.getAttribute('data-label');
            var value = p.textContent;

            // Nếu chưa có dòng mới hoặc là order mới, tạo dòng mới
            if (!newRow || label === "MaDonCT") {
                newRow = tbody2.insertRow();
            }

            var newCell = newRow.insertCell();
            newCell.textContent = value;
            newCell.setAttribute('data-label', label);
        });

        // // Hiển thị dữ liệu chi tiết lên formChiTietOrder (nếu cần)
        // orderItemsData.forEach(function(p) {
        //     var label = p.getAttribute('data-label');
        //     var value = p.textContent;
        //     // Do something with label and value
        //     console.log("Label: " + label + ", Value: " + value);
        // });
    });
});
</script>
