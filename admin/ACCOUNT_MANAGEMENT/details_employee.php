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

// Lấy thông tin nhân viên từ tham số truyền vào
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Truy vấn để lấy thông tin của nhân viên dựa trên username từ bảng account và info_page
    $sql = "SELECT acc.*, info.dob, info.phone, info.id 
            FROM account AS acc 
            LEFT JOIN info_page AS info ON acc.username = info.username 
            WHERE acc.username = '$username' AND acc.role = 'employee'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
    } else {
        // Không tìm thấy nhân viên, chuyển hướng về trang quản lý nhân viên
        header("Location: admin_manage_employee.php");
        exit();
    }
} else {
    // Nếu không có thông tin về username, chuyển hướng về trang quản lý nhân viên
    header("Location: admin_manage_employee.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* CSS styles */
    </style>
</head>

<body>
    <div class="container">
        <h1>Employee Details</h1>
        <div class="row">
            <div class="col-md-6">
                <h2>Personal Information</h2>
                <p><strong>Username:</strong> <?php echo $employee['username']; ?></p>
                <p><strong>Full Name:</strong> <?php echo $employee['firstname'] . ' ' . $employee['lastname']; ?></p>
                <p><strong>Email:</strong> <?php echo $employee['email']; ?></p>
                <p><strong>Date of Birth:</strong> <?php echo $employee['dob']; ?></p>
                <p><strong>Phone:</strong> <?php echo $employee['phone']; ?></p>
            </div>
            <div class="col-md-6">
                <h2>Account Status</h2>
                <p><strong>Status:</strong>
                    <?php if ($employee['activated'] == 0) : ?>
                        Inactive
                    <?php elseif ($employee['locked'] == 1) : ?>
                        Locked
                    <?php else : ?>
                        Active
                    <?php endif; ?>
                </p>
            </div>
        </div>
        <br>
        <a href="admin_manage_employee.php" class="btn btn-secondary">Back to User Management</a>
    </div>
</body>

</html>
