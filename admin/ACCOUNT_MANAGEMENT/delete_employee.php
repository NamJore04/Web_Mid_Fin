
<?php
session_start();
include 'db.php';

// Kiểm tra đăng nhập
// if (!isset($_SESSION['user'])) {
//     header("Location: login.php");
//     exit();
// }

// Kiểm tra quyền truy cập
// if ($_SESSION['role'] !== 'admin') {
//     header("Location: login.php");
//     exit();
// }

// Mở kết nối đến cơ sở dữ liệu
$conn = open_database();

// Lấy thông tin về nhân viên cần xóa từ yêu cầu
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Xóa nhân viên khỏi cơ sở dữ liệu
    $sql_delete_employee = "DELETE FROM account WHERE username = ?";
    $stmt_delete_employee = $conn->prepare($sql_delete_employee);
    $stmt_delete_employee->bind_param("s", $username);

    $sql_delete_employee_info = "DELETE FROM info_page WHERE username = ?";
    $stmt_delete_employee_info = $conn->prepare($sql_delete_employee_info);
    $stmt_delete_employee_info->bind_param("s", $username);
    $stmt_delete_employee->execute();
    $stmt_delete_employee_info->execute();

    // Kiểm tra xem xóa có thành công không
    $success_delete_employee_info = $stmt_delete_employee_info->affected_rows > 0;
    $success_delete_employee = $stmt_delete_employee->affected_rows > 0;

    // Nếu xóa thành công ở cả hai bảng, chuyển hướng người dùng trở lại trang quản lý nhân viên
    if ($success_delete_employee_info || $success_delete_employee) {
        header("Location: admin_manage_employee.php");
        exit();
    } else {
        echo "Xóa nhân viên không thành công.";
    }
} else {
    // Nếu không có thông tin về nhân viên trong yêu cầu, hiển thị thông báo lỗi
    echo "Không có thông tin nhân viên để xóa.";
}

?>
