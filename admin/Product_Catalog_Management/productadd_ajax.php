<?php 
    // include "header.php";
    // include "slider.php";
    include "class/product_class.php";
    $product = new product;
    $cartegory_id = $_GET['cartegory_id'];
?>


<?php 
    $showbrand_ajax = $product ->show_brand_ajax($cartegory_id);
    if($showbrand_ajax) {
        while($result = $showbrand_ajax ->fetch_assoc()) {

?>
<option value="<?php echo $result['brand_id'] ?>"><?php echo $result['brand_name'] ?></option>

<?php 
        }
    }
?>