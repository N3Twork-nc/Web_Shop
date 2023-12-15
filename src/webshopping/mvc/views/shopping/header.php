<link rel="stylesheet" href="/public/css/header.css">
</script>
<header class="myHeader" style="display: flex !important;">
        <label id="check" class="checkbtn"><i class="fa fa-bars" style="position: absolute; left: 12px;"></i></label>
        <div class="logo">
            <img src="/public/img/logo_shop.png" alt="">
        </div>
        <nav class="menu">
            <li class="main-menu-item"><a>NỮ</a>
                <i class="fa fa-plus plus" style="font-size: 12px; float: right; margin-top: 2%; display: none;"></i>
                <ul class="sub-menu sub-menu-1">
                    <li><a href="/Category/Show/ao-nu" style="color: black !important;">ÁO</a>
                        <ul class="empty-item-1">
                            <?php foreach($data["categories"]['ao-nu'] as $key => $value): ?>
                                <li><a href="<?php echo "/Category/Show/" . $key; ?>" style="color: black !important;"><?php echo $value; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li><a href="/Category/Show/quan-nu" style="color: black !important;">QUẦN</a>
                        <ul>
                            <?php foreach($data["categories"]['quan-nu'] as $key => $value): ?>
                                <li><a href="<?php echo "/Category/Show/" . $key; ?>" style="color: black !important;"><?php echo $value; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="main-menu-item"><a>NAM</a>
                <i class="fa fa-plus plus" style="font-size: 12px; float: right; margin-top: 2%; display: none;"></i>
                <ul class="sub-menu sub-menu-2">
                    <li><a href="/Category/Show/ao-nam" style="color: black !important;">ÁO</a>
                        <ul class="empty-item-2">
                            <?php foreach($data["categories"]['ao-nam'] as $key => $value): ?>
                                <li><a href="<?php echo "/Category/Show/" . $key; ?>" style="color: black !important;"><?php echo $value; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li><a href="/Category/Show/quan-nam" style="color: black !important;">QUẦN</a>
                        <ul>
                            <?php foreach($data["categories"]['quan-nam'] as $key => $value): ?>
                                <li><a href="<?php echo "/Category/Show/" . $key; ?>" style="color: black !important;"><?php echo $value; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="main-menu-item" style="color: black !important;"><a href="" style="color: black !important;">SALE</a>
                <i class="fa fa-plus plus" style="font-size: 12px; float: right; margin-top: 2%; display: none;"></i>
                <ul class="sub-menu sub-menu-4" class="empty-item-4">
                    <li><a href="" style="color: red;">Đồng giá chỉ từ 99K</a>
                    </li>
                    <li><a href="" class="lowercase">199k</a></li>
                    <li><a href="" class="lowercase">299k</a></li>
                    <li><a href="" class="lowercase">399k</a></li>
                </ul>
            </li>
            <li style="color: black !important;"><a href="" style="color: black !important;">THÔNG TIN</a></li>
        </nav>

        <div class="orthers">
            <li>
                <input placeholder="Search..." type="text">
                <i class="fa fa-search"></i>
            </li>
            <div class="item" style="padding-left: 12px;">
                <li><i class="fa fa-paw"></i></li>
            </div>
            <div class="item" style="padding-left: 12px; cursor: pointer;">
                <li><i class="fa fa-user" id="userIcon"></i></li>
                <?php if(isset($_SESSION['usr'])): ?>
                    <div class="sub-action" style="display: none; margin-top: 15px; margin-right: 78px">
                        <div class="top-action" style="cursor: context-menu;">
                            <a class="icon" style="text-decoration: none; cursor: context-menu;"><h3>Tài khoản của tôi</h3></a>
                        </div>
                        <ul>
                            <li><a href="/Customer/Info"><i class="fa fa-user"></i>Thông tin tài khoản</a></li>
                            <li><a href="/Customer/Order"><i class="fa fa-file"></i>Quản lý đơn hàng</a></li>
                            <li><a href="/Customer/ResetPassword"><i class="fa fa-key"></i>Đổi mật khẩu</a></li>
                            <li><a href="/Auth/Logout"><i class="fa fa-sign-out"></i>Đăng xuất</a></li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <div class="item" style="padding-left: 12px;">
                <a href="<?php echo isset($_SESSION['usr']) ? "/Cart" : "/Auth"; ?>"><li><i class="fa fa-shopping-bag" style="color: black !important;"></i></li></a>
            </div>
        </div>
    </header>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy element của icon
        var userIcon = document.getElementById('userIcon');

        // Lấy element của sub-action
        var subAction = document.querySelector('.sub-action');

        // Bắt sự kiện click vào icon
        userIcon.addEventListener('click', function() {

            if(!subAction){
                window.location.href = '/Auth';
            }
            // Kiểm tra trạng thái hiện tại của sub-action và thay đổi nó
            if (subAction.style.display === 'none' || subAction.style.display === '') {
                subAction.style.display = 'block';
            } else {
                subAction.style.display = 'none';
            }
        });
    });
</script>
