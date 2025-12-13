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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            margin-bottom: 15px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .col-md-6 {
            flex: 0 0 48%;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        p {
            margin: 10px 0;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        a.btn {
            text-decoration: none;
            color: inherit;
        }
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