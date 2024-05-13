<?php
    include "header.php";
    include "slider.php";
    include "class/product_class.php";

?>

<?php 
    $product = new product;
    if($_SERVER["REQUEST_METHOD"] === 'POST') {

        // var_dump($_POST, $_FILES);
        // echo '<pre>';
        // print_r($_FILES['product_img_desc']['name']);
        // echo '</pre>';

        $insert_product = $product -> insert_product($_POST,$_FILES);
    }
?>



<div class="admin-content-right">
<div class="admin-content-right-product-add">
                <h1>Quản lý sản phẩm</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="">Nhập tên sản phẩm <span style="color: red;">*</span></label>
                    <input required type="text" name="product_name" placeholder="">
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
                    
                    <!-- <label for="">Chọn loại sản phẩm<span style="color: red;">*</span></label>
                    <select name="brand_id" id="brand_id">
                        <option value="">--Chọn--</option> -->

                    </select>
                    <label for="">Giá sản phẩm<span style="color: red;">*</span></label>
                    <input required type="text" name="product_price" placeholder="">
                    <label for="">Giá khuyến mãi<span style="color: red;">*</span></label>
                    <input required type="text" name="product_price_new" placeholder="">
                    <label for="">Mô tả sản phẩm<span style="color: red;">*</span></label> <br>
                    <textarea name="product_desc" class="editor" cols="30" rows="10" placeholder=""></textarea> <br>
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
<script src="ckeditor5_col/ckeditor.js"></script>
<script src="ckeditor5_col/script.js"></script>

<!-- <script src="https://example.com/ckfinder/ckfinder.js"></script> -->
<!-- <script>
        ClassicEditor
            .create( document.querySelector( '#editor1' ) )
            .catch( error => {
                console.error( error );
            } ); -->

<!-- //             var editor = CKEDITOR.replace( 'editor1' );
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
// } ); -->
<!-- </script> -->
<!-- <script>
    $(document).ready(function() {
        $('#cartegory_id').change(function(){
            // alert($(this).val());
            var x =  $(this).val(); 
            $.get('productadd_ajax.php',{cartegory_id:x}, function(data){
                $('#brand_id').html(data);
            });
        });
    });
</script> -->


</html>