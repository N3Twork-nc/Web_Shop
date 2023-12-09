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
                    <h1>Lịch sử đơn hàng</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                Order Histtory
                            </a></li>
                        /
                        <li><a href="#" class="active">Shop</a></li>

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
                            <th style="width: 90px;"><span class="las la-sort"></span> T.THÁI</th>
                            <th style="width: 80px;"><span class="las la-sort"></span> T.TIỀN</th>
                            <th style="width: 300px;"><span class="las la-sort"></span> EMAIL</th>
                            <th style="width: 120px;"><span class="las la-sort"></span> MÃ TT</th>
                            <th style="width: 120px;"><span class="las la-sort"></span> NGÀY TT</th>
                            <th style="width: 120px;"><span class="las la-sort"></span> LOẠI TT</th>
                            <th style="width: 180px;"><span class="las la-sort"></span> ĐỊA CHỈ</th>
                            <th style="width: 120px;"><span class="las la-sort"></span> SĐT</th>
                            <th><span class="las la-sort"></span> ACTION</th>
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
                                <td>
                                    <i id="showDetailIcon" style="background: #16bb5e; border: 2px solid #16bb5e !important; margin-left: 5px; margin-top: 5px" class="fa fa-file xemChiTietOrder" title="Xem chi tiết"></i>
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
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Confirmation Modal -->
            
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
    // const cancelBtn = document.getElementById("cancelBtn");
    const tbody = document.getElementById("tbody");

    const table2 = document.querySelector('#myTable');
    let isEditing = false;

    // cancelBtn.addEventListener('click', function() {
    //         modal.style.display = "none";
    // })
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
