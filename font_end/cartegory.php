<?php
include 'sections/header.php';
$sql = "SELECT * FROM tbl_product";
$result = $conn->query($sql);
?>


<!-- Cartegory -->
<section class="cartegory">
    <div class="container">
        <div class="cartegory-top">
            <p>Trang chủ</p> <span>&#10230;</span>
            <p>Nữ</p> <span>&#10230;</span>
            <p>Hàng nữ mới về</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="cartegory-left">
                <ul>
                    <li class="cartegory-left-li block">Nữ
                        <ul>
                            <li><a href="">Hàng nữ mới về</a></li>
                            <li><a href="">Beyond Trendy</a></li>
                            <li><a href="">Jeans For Joy</a></li>
                            <li><a href="">Hướng dương đón nắng</a></li>
                        </ul>
                    </li>
                    <li class="cartegory-left-li">Nam
                        <ul>
                            <li><a href="">Hàng nam mới về</a></li>
                            <li><a href="">Beyond Trendy</a></li>
                            <li><a href="">Jeans For Joy</a></li>
                            <li><a href="">Hướng dương đón nắng</a></li>
                        </ul>
                    </li>
                    <li class="cartegory-left-li">Trẻ em</li>
                    <li class="cartegory-left-li">Bộ sưu tập</li>

                </ul>
            </div>

            <div class="cartegory-right">
                <div class="cartegory-right-top-item">
                    <p>Hàng nữ mới về</p>

                    <button><span>Bộ lọc</span><i class="fa-solid fa-angle-down"></i></button>

                    <select name="" id="">
                        <option value="">Sắp xếp</option>
                        <option value="">Giá cao đến thấp</option>
                        <option value="">Giá thấp đến cao</option>
                    </select>
                </div>
                <div class="cartegory-right-content">

                    <?php
                    // Hiển thị danh sách sản phẩm
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <div class="cartegory-right-content-item"> 
                                <a href="product.php">
                                    <img src="<?php echo '/Web2/admin/uploads/' . $row['product_img']; ?>" alt="">
                                    <h3><?php echo $row['product_name']; ?></h3>
                                    <p><?php echo $row['product_price']; ?> <sup>đ</sup></p>
                                </a>
                            </div>
                    <?php
                        }
                    } else {
                        echo "Không có sản phẩm nào";
                    }
                    ?>
                    <!-- <div class="cartegory-right-content-item">
                            <img src="img/nu1.jpg" alt="">
                            <h3>QUẦN SOOC PHỐI ĐAI</h3>
                            <p>790.000 <sup>đ</sup></p>
                        </div>

                        <div class="cartegory-right-content-item">
                            <img src="img/nu2.jpg" alt="">
                            <h3>QUẦN SOOC PHỐI ĐAI</h3>
                            <p>790.000 <sup>đ</sup></p>
                        </div>

                        <div class="cartegory-right-content-item">
                            <img src="img/nu3.jpg" alt="">
                            <h3>QUẦN SOOC PHỐI ĐAI</h3>
                            <p>790.000 <sup>đ</sup></p>
                        </div>

                        <div class="cartegory-right-content-item">
                            <img src="img/nu4.jpg" alt="">
                            <h3>QUẦN SOOC PHỐI ĐAI</h3>
                            <p>790.000 <sup>đ</sup></p>
                        </div>

                        <div class="cartegory-right-content-item">
                            <img src="img/nu5.jpg" alt="">
                            <h3>QUẦN SOOC PHỐI ĐAI</h3>
                            <p>790.000 <sup>đ</sup></p>
                        </div>

                        <div class="cartegory-right-content-item">
                            <img src="img/nu6.jpg" alt="">
                            <h3>QUẦN SOOC PHỐI ĐAI</h3>
                            <p>790.000 <sup>đ</sup></p>
                        </div>

                        <div class="cartegory-right-content-item">
                            <img src="img/nu7.jpg" alt="">
                            <h3>QUẦN SOOC PHỐI ĐAI</h3>
                            <p>790.000 <sup>đ</sup></p>
                        </div>

                        <div class="cartegory-right-content-item">
                            <img src="img/nu8.jpg" alt="">
                            <h3>QUẦN SOOC PHỐI ĐAI</h3>
                            <p>790.000 <sup>đ</sup></p>
                        </div> -->
                </div>
                <div class="cartegory-right-bottom row">
                    <div class="cartegory-right-bottom-items">
                        <p>Hiển thị 2 <span>|</span> 4 sản phẩm</p>
                    </div>
                    <div class="cartegory-right-bottom-items">
                        <p> <sup>&#171;</sup> <span>1 2 3 4 5</span><sup>&#187;</sup>Trang cuối</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- App-container
<section class="app-container">
    <p>Tải ứng dụng</p>
    <div class="app-google">
        <img src="img/googleplay.png" alt="">
        <img src="img/appstore.png" alt="">
    </div>
    <p>Nhận bản tin</p>
    <input type="text" placeholder="Nhập Email của bạn...">

</section> -->

<?php
include 'sections/footer.php';
?>