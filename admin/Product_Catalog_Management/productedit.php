<?php
include "header.php";
include "slider.php";
include "class/product_class.php";

// Khởi tạo đối tượng product
$product = new product();

// Lấy product_id từ URL
$product_id = $_GET['product_id'];

// Lấy thông tin sản phẩm từ cơ sở dữ liệu
$get_product = $product->get_product($product_id);
if ($get_product) {
    $result_product = $get_product->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $product_name = $_POST['product_name'];
    $cartegory_id = $_POST['cartegory_id'];
    $product_price = $_POST['product_price'];
    $product_price_new = $_POST['product_price_new'];
    $product_desc = $_POST['product_desc'];
    $product_img = $_FILES["product_img"]['name'];
    $filetarget = basename($_FILES['product_img']['name']);
    $fileStype = strtolower(pathinfo($product_img, PATHINFO_EXTENSION));

    // Kiểm tra định dạng file ảnh
    if ($fileStype != "jpg" && $fileStype != "jpeg" && $fileStype != "png") {
        $alert_wrong = 'Chỉ cho phép định dạng .jpg, .png, .jpeg';
    } else {
        $update_product = $product->update_product(
            $product_name,
            $product_id,
            $product_price,
            $product_price_new,
            $product_desc,
            $product_img,
            $filetarget,
            $fileStype
        );

        if($update_product){
            echo "<script>alert('Sửa sản phẩm thành công.')</script>";
            echo "<script>window.location = 'productlist.php'</script>";
        } else {
            echo "<script>alert('Sửa sản phẩm không thành công.')</script>";
            echo "<script>window.location = 'productlist.php'</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
    <style>
        select {
            height: 30px;
            width: 200px;
        }

        .admin-content-right-product-add {
            margin: 6px;
        }
    </style>
</head>

<body>
    <div class="admin-content-right">
        <div class="admin-content-right-product-add">
            <h1>Sửa sản phẩm</h1>

            <form action="" method="post" enctype="multipart/form-data">
                <label for="">Nhập tên sản phẩm <span style="color: red;">*</span></label>
                <input required type="text" name="product_name" value="<?php echo $result_product['product_name'] ?>">

                <label for="">Chọn danh mục<span style="color: red;">*</span></label>
                <select name="cartegory_id" id="cartegory_id">
                    <option value="">--Chọn--</option>
                    <?php
                    $showcartegory = $product->show_cartegory();
                    if ($showcartegory) {
                        while ($result = $showcartegory->fetch_assoc()) {
                            $selected = $result['cartegory_id'] == $result_product['cartegory_id'] ? 'selected' : '';
                            echo "<option value='{$result['cartegory_id']}' {$selected}>{$result['cartegory_name']}</option>";
                        }
                    }
                    ?>
                </select>

                <label for="">Giá sản phẩm<span style="color: red;">*</span></label>
                <input required type="text" name="product_price" value="<?php echo $result_product['product_price'] ?>">

                <label for="">Giá khuyến mãi<span style="color: red;">*</span></label>
                <input required type="text" name="product_price_new" value="<?php echo $result_product['product_price_new'] ?>">

                <label for="">Mô tả sản phẩm<span style="color: red;">*</span></label><br>
                <textarea name="product_desc" class="editor" cols="30" rows="10"><?php echo $result_product['product_desc'] ?></textarea><br>

                <label for="">Ảnh sản phẩm<span style="color: red;">*</span></label>
                <input multiple name="product_img" type="file">

                <label for="">Ảnh mô tả<span style="color: red;">*</span></label>
                <input name="product_img_desc[]" multiple type="file">

                <button type="submit">Sửa</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#cartegory_id').change(function() {
                var x = $(this).val();
                $.get('productadd_ajax.php', {
                    cartegory_id: x
                }, function(data) {
                    // $('#brand_id').html(data);
                });
            });
        });
    </script>
    <script src="ckeditor5_col/ckeditor.js"></script>
    <script src="ckeditor5_col/script.js"></script>
</body>

</html>
