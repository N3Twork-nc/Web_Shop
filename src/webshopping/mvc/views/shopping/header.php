<header class="myHeader">
        <label id="check" class="checkbtn"><i class="fa fa-bars" style="position: absolute; left: 12px;"></i></label>
        <div class="logo">
            <img src="/public/img/logo_shop.png" alt="">
        </div>
        <nav class="menu">
            <li class="main-menu-item"><a>NỮ</a>
                <i class="fa fa-plus plus" style="font-size: 12px; float: right; margin-top: 2%; display: none;"></i>
                <ul class="sub-menu sub-menu-1">
                    <li><a href="/Category/Show/ao-nu">ÁO</a>
                        <ul class="empty-item-1">
                            <?php foreach($data["categories"]['ao-nu'] as $key => $value): ?>
                                <li><a href="<?php echo "/Category/Show/" . $key; ?>"><?php echo $value; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li><a href="/Category/Show/quan-nu">QUẦN</a>
                        <ul>
                            <?php foreach($data["categories"]['quan-nu'] as $key => $value): ?>
                                <li><a href="<?php echo "/Category/Show/" . $key; ?>"><?php echo $value; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="main-menu-item"><a>NAM</a>
                <i class="fa fa-plus plus" style="font-size: 12px; float: right; margin-top: 2%; display: none;"></i>
                <ul class="sub-menu sub-menu-2">
                    <li><a href="/Category/Show/ao-nam">ÁO</a>
                        <ul class="empty-item-2">
                            <?php foreach($data["categories"]['ao-nam'] as $key => $value): ?>
                                <li><a href="<?php echo "/Category/Show/" . $key; ?>"><?php echo $value; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li><a href="/Category/Show/quan-nam">QUẦN</a>
                        <ul>
                            <?php foreach($data["categories"]['quan-nam'] as $key => $value): ?>
                                <li><a href="<?php echo "/Category/Show/" . $key; ?>"><?php echo $value; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="main-menu-item"><a href="">SALE</a>
                <i class="fa fa-plus plus" style="font-size: 12px; float: right; margin-top: 2%; display: none;"></i>
                <ul class="sub-menu sub-menu-4" class="empty-item-4">
                    <li><a href="" style="color: red;">Đồng giá chỉ từ 99K</a>
                    </li>
                    <li><a href="" class="lowercase">199k</a></li>
                    <li><a href="" class="lowercase">299k</a></li>
                    <li><a href="" class="lowercase">399k</a></li>
                </ul>
            </li>
            <li><a href="">THÔNG TIN</a></li>
        </nav>

        <div class="orthers">
            <li>
                <input placeholder="Search..." type="text">
                <i class="fa fa-search"></i>
            </li>
            <li><i class="fa fa-paw"></i></li>
            <li><i class="fa fa-user"></i></li>
            <li><i class="fa fa-shopping-bag"></i></li>
        </div>
    </header>