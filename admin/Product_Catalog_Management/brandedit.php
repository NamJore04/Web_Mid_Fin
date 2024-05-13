<?php
    include "../header.php";
    include "slider.php";
    include "class/brand_class.php"

?>

<?php 
    $brand = new brand();

    // if(!isset($_GET['cartegory_id']) || $_GET['cartegory_id'] == NULL){ 
    //     echo "<script>window.location = 'cartegorylist.php'</script>"; 
    // } else {
    $brand_id = $_GET['brand_id'];
    // }
    $get_brand = $brand -> get_brand($brand_id);
    if($get_brand) {
        $result_brand = $get_brand -> fetch_assoc();

    }




    if($_SERVER["REQUEST_METHOD"] === 'POST') {
        $cartegory_id = $_POST['cartegory_id'];
        $brand_name = $_POST['brand_name'];
        $update_brand = $brand -> update_brand($cartegory_id,$brand_name,$brand_id);
    }
?>
<style>
    select {
        height: 30px;
        width: 200px;
    }
</style>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1>Sửa loại sản phẩm</h1>
                <form action="" method="post">
                    <select name="cartegory_id" id="">
                        <option value="#">Chọn danh mục</option>
                        <?php 
                        $show_cartegory = $brand -> show_cartegory();

                        if($show_cartegory) {
                            while ($result = $show_cartegory -> fetch_assoc()) {

                        ?>
                        <option <?php if($result_brand['cartegory_id'] == $result['cartegory_id']) { echo "SELECTED";} ?> value="<?php echo $result['cartegory_id']?>"><?php echo $result['cartegory_name']?></option>
                        
                        <?php 
                                
                            }
                        }
                        ?>


                    </select> <br>
                    <input require name="brand_name" type="text" placeholder="Nhập tên loại sản phẩm" value="<?php echo $result_brand['brand_name'] ?>">

                    <button>Sửa</button>
                </form>
            </div>
        </div>
    </section>
    
</body>
</html>