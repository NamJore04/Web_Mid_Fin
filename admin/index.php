<link rel="stylesheet" href="css/style_admin.css">
<link rel="stylesheet" href="css/style.css">

<?php
include 'header.php';
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user'])) {
    // Nếu chưa, chuyển hướng về trang đăng nhập
    header('Location: Account_management/login.php');
    exit();
}

// Kiểm tra vai trò của người dùng và hiển thị nội dung tương ứng
if ($_SESSION['role'] === 'admin') {
?>
    <tbody>
        <section class="container_admin">
            <div class="dasboard"><a href="Reporting_and_Analytics/dashboard.php">Báo cáo và thống kê</a></div>
            <div class="ordermanagement"><a href="Product_Catalog_Management/productAdd.php">Quản lý sản phẩm</a></div>
            <div class="customer_management"><a href="Customer_Management_Transaction_Processing/customer_management.php">Quản lý khách hàng, đơn hàng và thanh toán</a></div>

            <!-- <div class="orderdetail"><a href="Customer_Management_Transaction_Processing/order_management.php">Quản lý đơn hàng</a></div> -->
            <!-- <div class="upload_img_slide"><a href="Upslide/upload_slide.php">Up Slide</a></div> -->
            <div class="admin_manage_employee"><a href="Account_management/admin_manage_employee.php">Quản lý nhân viên</a></div>
        </section>
    </tbody>
<?php
} else if ($_SESSION['role'] === 'employee') {
?>
    <tbody>
        <section class="container_admin">
            <div class="dasboard"><a href="Reporting_and_Analytics/dashboard.php">Báo cáo và thống kê</a></div>
            <div class="ordermanagement"><a href="Product_Catalog_Management/productlist.php">Xem danh sách sản phẩm</a></div>
            <div class="customer_management"><a href="Customer_Management_Transaction_Processing/customer_management.php">Quản lý khách hàng, đơn hàng và thanh toán</a></div>
        </section>
    </tbody>
<?php
} else {
    // Nếu vai trò không được xác định, có thể xử lý ở đây
    // Ví dụ: Hiển thị thông báo lỗi và đăng xuất người dùng
    echo "Unknown role. Please contact administrator.";
    // Xóa phiên làm việc và chuyển hướng về trang đăng nhập
    session_unset();
    session_destroy();
    header('Location: Account_management/login.php');
    exit();
}
?>
<footer></footer>
</body>

</html>