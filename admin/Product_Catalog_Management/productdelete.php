
<?php
    include "class/product_class.php";
    $product = new product();

    if(!isset($_GET['product_id']) || $_GET['product_id'] == NULL){ 
        echo "<script>window.location = 'productlist.php'</script>"; 
    } else {
        $product_id = $_GET['product_id'];
        $delete_product = $product->delete_product($product_id);

        if($delete_product){
            echo "<script>alert('Xóa sản phẩm thành công.')</script>";
            echo "<script>window.location = 'productlist.php'</script>";
        } else {
            echo "<script>alert('Xóa sản phẩm không thành công. Vì đã có đơn đặt hàng sản phẩm.')</script>";
            echo "<script>window.location = 'productlist.php'</script>";
        }
    }
?>
