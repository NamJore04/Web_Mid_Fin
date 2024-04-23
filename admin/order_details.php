
<?php 
include 'header.php'; 
?>
    <header>
        <h1>Chi tiết đơn hàng</h1>
    </header>

    <section class="admin-content">
        <!-- <div class="admin-content-left">
            <ul>
                <li><a href="">Danh mục</a>
                    <ul>
                        <li><a href="cartegoryAdd.php">Thêm danh mục</a></li>
                        <li><a href="cartegorylist.php">Danh sách danh mục</a></li>
                    </ul>
                </li>
                <li><a href="">Loại sản phẩm</a>
                    <ul>
                        <li><a href="">Thêm loại sản phẩm</a></li>
                        <li><a href="">Danh sách loại sản phẩm </a></li>
                    </ul>
                </li>
                <li><a href="">Sản phẩm</a>
                    <ul>
                        <li><a href="">Thêm sản phẩm</a></li>
                        <li><a href="">Danh sách sản phẩm</a></li>
                    </ul>
                </li>
            </ul>
        </div> -->

        <div class="admin-content-right">
            <div class="admin-content-right-cartegory-list">
                <h1>Chi tiết</h1>
                <table style="width: 100%;     text-align: center; margin-top: 20px;">
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td><img style="height: 100px;" src="uploads/2022-09-05 (1).png" alt=""></td>
                        <td>Áo thung</td>
                        <td>100.000đ</td>
                        <td>1</td>
                        <td>100.000đ</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td><img style=" height: 100px;" src="uploads/2022-09-05 (6).png" alt=""></td>
                        <td>Áo thung</td>
                        <td>100.000đ</td>
                        <td>1</td>
                        <td>100.000đ</td>
                    </tr>
                    <tr>
                        <th colspan="5">Tổng cộng</th>
                        <th >200.000đ</th>
                    </tr>
                </table>
            </div>
        </div>
    </section>
    
</body>
</html>