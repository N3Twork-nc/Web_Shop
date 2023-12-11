<?php 
include_once "./mvc/models/CartItemModel/CartItemObj.php";
    class CartItem extends DB{

        function LoadProductImages($product_code){
            try {
                    $db = new DB();
                    $sql = "CALL GetImagesProduct(?)";
                    $params = array($product_code);
                    $sth = $db->select($sql, $params);
                    $images = [];
                    while($row2 = $sth->fetch()) {
                        $images[] = $row2['image'];
                    }
                return $images;
            } catch (PDOException $e) {
                return  $sql . "<br>" . $e->getMessage();
            }
        }

        function LoadCartItem($data){
                try {
                    $db = new DB();
                    $sql = "SELECT TMP.*, P.name, P.price, P.color, P.product_state FROM 
                    (
                        SELECT CI.* FROM ShoppingCart AS SC, CartItems AS CI 
                        WHERE SC.cart_code = CI.cart_code AND SC.cart_code = ?
                        ) AS TMP, Products AS P 
                        WHERE P.product_code = TMP.product_code";
                    $params = array($data['cart_code']);

                    $sth = $db->select($sql, $params);

                    $arr = [];
                    $cartItem_from_DB = $sth->fetchAll();
                   
                    $sth = null;

                    foreach ($cartItem_from_DB as $row) {

                        $obj_cartItem = new CartItemObj($row);

                        $row_product['product_code'] = $row['product_code'];
                        $row_product['name'] = $row['name'];
                        $row_product['price'] = $row['price'];
                        $row_product['color'] = $row['color'];
                        $row_product['product_state'] = $row['product_state'];

                        // tạo sản phẩm
                        $obj = new ProductObj($row_product);

                        // lấy hình

                        $images = $this->LoadProductImages($row['product_code']);
                        $obj->setImages($images);

                        $obj_cartItem->setProduct($obj);
                        
                        // thêm obj vào mảng
                        $arr[] = $obj_cartItem;
                    }
                    return $arr;
                } catch (PDOException $e) {
                    return  $sql . "<br>" . $e->getMessage();
                }
        }
    }
?>