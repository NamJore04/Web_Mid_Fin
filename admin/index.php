<?php
include 'header.php'
?>

<?php


// session_start();

// // Kiểm tra xem người dùng đã đăng nhập chưa
// if (!isset($_SESSION['user'])) {
//     // Nếu chưa, chuyển hướng về trang đăng nhập
//     header('Location: login.php');
//     exit();
// }

// // Kiểm tra vai trò của người dùng và chuyển hướng tới trang phù hợp
// if ($_SESSION['role'] === 'admin') {
//     header('Location: index.php');
// } else if ($_SESSION['role'] === 'employee') {
//     header('Location: index_employee.php');
// } else {
//     // Nếu vai trò không được xác định, có thể xử lý ở đây
//     // Ví dụ: Hiển thị thông báo lỗi và đăng xuất người dùng
//     echo "Unknown role. Please contact administrator.";
//     // Xóa phiên làm việc và chuyển hướng về trang đăng nhập
//     session_unset();
//     session_destroy();
//     header('Location: login.php');
//     exit();
// }

session_start();
// // Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user']) || $_SESSION['role'] === 'employee') {
    // Nếu không, chuyển hướng về trang đăng nhập
    header('Location: login.php');
    exit();
}
?>
<tbody>
    <section class="container_admin">
        <div class="dasboard"><a href="dashboard.html">Báo cáo và thống kê</a></div>
        <div class="ordermanagement"><a href="productAdd.php">Quản lý sản phẩm</a></div>
        <div class="orderdetail"><a href="order_management.php">Quản lý đơn hàng</a></div>
        <div class="upload_img_slide"><a href="upload_slide.php">Up Slide</a></div>
        <!-- <div class="ACCOUNT_MANAGEMENT"><a href="ACCOUNT_MANAGEMENT\createEmployeeAccount.php">Quản lý nhân viên</a></div> -->
        <div class="admin_manage_employee"><a href="admin_manage_employee.php">Quản lý nhân viên</a></div>

    </section>
</tbody>
<footer></footer>
</body>

</html>