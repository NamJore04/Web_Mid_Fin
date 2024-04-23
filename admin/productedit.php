<?php
    include "header.php";
    include "slider.php";
    include "class/product_class.php"

?>

<?php 
    $product = new product();

    // if(!isset($_GET['cartegory_id']) || $_GET['cartegory_id'] == NULL){ 
    //     echo "<script>window.location = 'cartegorylist.php'</script>"; 
    // } else {
    $product_id = $_GET['product_id'];
    // }
    $get_product = $product -> get_product($product_id);
    if($get_product) {
        $result_product = $get_product -> fetch_assoc();

    }




    if($_SERVER["REQUEST_METHOD"] === 'POST') {
        $product_name = $_POST[ 'product_name' ];
        $cartegory_id  = $_POST['cartegory_id'];
        $brand_id   	= $_POST['brand_id'];
        $product_price    = $_POST['product_price'];
        $product_price_new    = $_POST['product_price_new'];
        $product_desc    = $_POST['product_desc'];
        $product_img    = $_FILES["product_img"]['name'];
        $filetarget = basename($_FILES['product_img']['name']);
        $fileStype = strtolower(pathinfo($product_img,  PATHINFO_EXTENSION));
        if(file_exists("uploads/$filetarget")) {
            $alert_null = 'File has exited.'; 
            return $alert_null;
        }
    
        if($fileStype != "jpg" && $fileStype != "jpeg" && $fileStype != "png"){
            $alert_wrong = 'Only .jpg .png .jpeg'; 
            return $alert_wrong;  
        }
        $update_product = $product -> update_product($product_name,
                                                    $product_id,  
                                                    $product_price,
                                                    $product_price_new,
                                                    $product_desc,
                                                    $product_img,
                                                    $filetarget,
                                                    $fileStype);
    }
?>
<style>
    select {
        height: 30px;
        width: 200px;
    }

    .admin-content-right-product-add {
        margin: 6px;
    }
</style>

<div class="admin-content-right-product-add">
                <h1>Sửa sản phẩm</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="">Nhập tên sản phẩm <span style="color: red;">*</span></label>
                    <input required type="text" name="product_name" placeholder="" value="<?php echo $result_product['product_name'] ?>">
                    <!-- ajax -->
                    <label for="">Chọn danh mục<span style="color: red;">*</span></label>
                    <select name="cartegory_id" id="cartegory_id">
                        <option value="">--Chọn--</option>

                        <?php 
                            $showcartegory = $product ->show_cartegory();
                            if($showcartegory) {
                                while($result = $showcartegory ->fetch_assoc()) {


                        ?>
                        <option value="<?php echo $result['cartegory_id'] ?>"><?php echo $result['cartegory_name'] ?></option>

                        <?php 
                                }
                            }
                        ?>
                    </select>
                    
                    <label for="">Chọn loại sản phẩm<span style="color: red;">*</span></label>
                    <select name="brand_id" id="brand_id">
                        <option value="">--Chọn--</option>

                    </select>
                    <label for="">Giá sản phẩm<span style="color: red;">*</span></label>
                    <input required type="text" name="product_price" placeholder="" value="<?php echo $result_product['product_price'] ?>">
                    <label for="">Giá khuyến mãi<span style="color: red;">*</span></label>
                    <input required type="text" name="product_price_new" placeholder="" value="<?php echo $result_product['product_price_new'] ?>">
                    <label for="">Mô tả sản phẩm<span style="color: red;">*</span></label> <br>
                    <textarea name="product_desc" id="editor1" cols="30" rows="10" placeholder="" value="<?php echo $result_product['product_desc'] ?>"></textarea> 
                    <br>
                    <label for="">Ảnh sản phẩm<span style="color: red;">*</span></label>
                    <span style="color: red;"><?php if(isset($insert_product)) {
                        echo $insert_product;
                    } ?></span>
                    <input required multiple name="product_img" type="file">
                    <label for="">Ảnh mô tả<span style="color: red;">*</span></label>
                    <input required name="product_img_desc[]" multiple type="file">
                    <button type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>
    
</body>
<!-- <script src="https://example.com/ckfinder/ckfinder.js"></script> -->
<script>
        ClassicEditor
            .create( document.querySelector( '#editor1' ) )
            .catch( error => {
                console.error( error );
            } );

//             var editor = CKEDITOR.replace( 'editor1' );
// CKFinder.setupCKEditor( editor );

    // CKEDITOR.replace( 'editor', {
    // filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
    // filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    // filebrowserWindowWidth: '1000',
    // filebrowserWindowHeight: '700'
// } );


//             import { CKFinder } from '@ckeditor/ckeditor5-ckfinder';

// ClassicEditor
//     .create( document.querySelector( '#editor' ), {
//         plugins: [ CKFinder, /* ... */ ],
//         toolbar: [ 'ckfinder', /* ... */ ]
//         ckfinder: {
//             // Open the file manager in the pop-up window.
//             openerMethod: 'popup'
//         }
//     } )
//     .then( /* ... */ )
//     .catch( /* ... */ );
//     KEDITOR.replace( 'editor', {
//     filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
//     filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
//     filebrowserWindowWidth: '1000',
//     filebrowserWindowHeight: '700'
// } );
</script>
<script>
    $(document).ready(function() {
        $('#cartegory_id').change(function(){
            // alert($(this).val());
            var x =  $(this).val(); 
            $.get('productadd_ajax.php',{cartegory_id:x}, function(data){
                $('#brand_id').html(data);
            });
        });
    });
</script>
</html>