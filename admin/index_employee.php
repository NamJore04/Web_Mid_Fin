<?php 
include 'header.php'
?>

<?php 
    session_start();
    // if (!isset($_SESSION['user'])|| $_SESSION['role'] !== 'employee') {
    //     header('Location: login.php');  
    //     exit();
    // }
?>
    <tbody>
        <section class="container_admin">
            <div class="dasboard"><a href="dashboard.html">Báo cáo và Phân tích</a></div>
            <div class="ordermanagement"><a href="productlist.php">Xem danh sách sản phẩm</a></div>
            <div class="customer_management"><a href="customer_management.php">Quản lý khách hàng, đơn hàng và thanh toán</a></div>
            <!-- <div class="orderdetail"><a href="order_management.php">Quản lý đơn hàng</a></div> -->

            
            <!-- <div class="upload_img_slide"><a href="upload_slide.php">Up Slide</a></div> -->
            <!-- <div class="ACCOUNT_MANAGEMENT"><a href="ACCOUNT_MANAGEMENT\createEmployeeAccount.php">Quản lý nhân viên</a></div> -->
            <!-- <div class="register_accout"><a href="register_Admin.php">Quản lý nhân viên</a></div> -->


        </section>
    </tbody>
    <footer></footer>
</body>
</html>