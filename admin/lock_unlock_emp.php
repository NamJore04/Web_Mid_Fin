<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Kiểm tra vai trò của người dùng
if ($_SESSION['role'] !== 'admin') {
    header("Location: unauthorized.php");
    exit();
}

$conn = open_database();

// Kiểm tra xem có thông tin về username được gửi từ trang trước không
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Truy vấn để lấy thông tin của nhân viên dựa trên username
    $sql = "SELECT * FROM account WHERE username = '$username' AND role = 'employee'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();

        // Kiểm tra xem tài khoản đang bị khóa hay không
        if ($employee['locked'] == 1) {
            // Mở khóa tài khoản
            $sql_update = "UPDATE account SET locked = 0 WHERE username = '$username'";
            if ($conn->query($sql_update) === TRUE) {
                // Đã mở khóa thành công, chuyển hướng về trang quản lý nhân viên
                header("Location: admin_manage_employee.php");
                exit();
            } else {
                // Nếu có lỗi xảy ra trong quá trình mở khóa, có thể xử lý ở đây
                echo "Error: " . $conn->error;
            }
        } else {
            // Khóa tài khoản
            $sql_update = "UPDATE account SET locked = 1 WHERE username = '$username'";
            if ($conn->query($sql_update) === TRUE) {
                // Đã khóa thành công, chuyển hướng về trang quản lý nhân viên
                header("Location: admin_manage_employee.php");
                exit();
            } else {
                // Nếu có lỗi xảy ra trong quá trình khóa, có thể xử lý ở đây
                echo "Error: " . $conn->error;
            }
        }
    } else {
        // Không tìm thấy thông tin về nhân viên, chuyển hướng về trang quản lý nhân viên
        header("Location: admin_manage_employee.php");
        exit();
    }
} else {
    // Nếu không có thông tin về username, chuyển hướng về trang quản lý nhân viên
    header("Location: admin_manage_employee.php");
    exit();
}
?>
