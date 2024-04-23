<?php 
include 'header.php'; 
?>
    <header>
        <h1>Quản lý đơn hàng</h1>
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
                <h1>Danh sách đơn hàng</h1>
                <table style="width: 100%;     text-align: center; margin-top: 20px;">
                    <tr>
                        <th>ID</th>
                        <th>Tên khách hàng</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Ghi chú</th>
                        <th>Chi tiết</th>
                        <th>Ngày</th>
                        <th>Trạng thái</th>
                        <th>Tùy biến</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Huỳnh Nam</td>
                        <td>08088508</td>
                        <td>abc@gmail.com</td>
                        <td>Việt Nam</td>
                        <td>Giao nhanh</td>
                        <td><button style="background: aqua; border: none; line-height: 10px; padding:6px;"><a href="order_details.php">Chi tiết</a></button></td>
                        <td>12/12/2012</td>
                        <td><span style="background-color: green; color:aliceblue;">Đã xác nhận</span></td>
                        <td><button style="background: rgb(231, 101, 101); border: none; line-height: 10px; padding:6px;"><a href="">Xóa</a></button></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Huỳnh Nam</td>
                        <td>08088508</td>
                        <td>abc@gmail.com</td>
                        <td>Việt Nam</td>
                        <td>Giao nhanh</td>
                        <td><button style="background: aqua; border: none; line-height: 10px; padding:6px;"><a href="order_details.php">Chi tiết</a></button></td>
                        <td>12/12/2012</td>
                        <td><span style="background-color:  rgb(231, 101, 101); color:aliceblue;">Chưa xác nhận</span></td>
                        <td><button style="background: rgb(231, 101, 101); border: none; line-height: 10px; padding:6px;"><a href="">Xóa</a></button></td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
    
</body>
</html>