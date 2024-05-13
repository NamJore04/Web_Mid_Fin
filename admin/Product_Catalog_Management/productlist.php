<?php
include "../header.php";

// include "class/brand_class.php";
include "class/product_class.php"


?>

<?php
// $brand = new brand;
$product = new product;
// if($_SERVER["REQUEST_METHOD"] === 'POST') {
//     $cartegory_name = $_POST['cartegory_name'];
//     $insert_cartegory = $cartegory -> insert_cartegory($cartegory_name);
// }

// $show_brand = $brand ->show_brand();
$show_product = $product->show_product();
session_start();

$role = $_SESSION['role'];

if ($role === 'admin') :
    include "slider.php";

endif;




?>
<div class="admin-content-right">
    <div class="admin-content-right-cartegory-list">
        <h1>Danh sách sản phẩm</h1>
        <table style="width:100%; text-align: center;">
            <tr>
                <th>STT</th>
                <th>Product_ID</th>
                <th>Product_Name</th>
                <th>Loại sản phẩm</th>
                <!-- <th>Danh mục</th> -->
                <th>Product_DESC</th>

                <th>Ảnh mô tả</th>
                <th>Product_Price_New</th>

                <?php if ($role === 'admin') : ?>
                    <th>Product_Price</th>

                    <th>Tùy biến</th>
                <?php endif; ?>
            </tr>

            <?php
            // Nếu là admin, hiển thị tùy chọn sửa và xóa sản phẩm
            if ($show_product) {
                $i = 0;
                while ($result = $show_product->fetch_assoc()) {
                    $i++;
            ?>

                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['product_id'] ?></td>
                        <td><?php echo $result['product_name'] ?></td>
                        <td><?php echo $result['cartegory_id'] ?></td>
                        <!-- <td><?php //echo $result['brand_id']
                                    ?></td> -->

                        <td><?php echo $result['product_desc'] ?></td>
                        <td><?php echo $result['product_img'] ?></td>
                        <td><?php echo $result['product_price_new'] ?></td>

                        <?php if ($role === 'admin') : ?>
                            <td><?php echo $result['product_price'] ?></td>
                            <td>
                                <a href="productedit.php?product_id=<?php echo $result['product_id'] ?>">Sửa</a>
                                | <a href="productdelete.php?product_id=<?php echo $result['product_id'] ?>">Xóa</a>
                            </td>
                        <?php endif; ?>
                    </tr>

            <?php
                }
            }
            ?>
        </table>
    </div>
</div>
</section>
</body>

</html>