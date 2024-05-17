<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// // Kiểm tra vai trò của người dùng
// if ($_SESSION['role'] !== 'admin') {
//     header("Location: unauthorized.php");
//     exit();
// }

$conn = open_database();

// Lấy danh sách nhân viên từ cơ sở dữ liệu
// $sql = "SELECT * FROM account WHERE role = 'employee'";
// $sql = "SELECT acc.*, info.dob, info.phone, info.id 
// FROM account AS acc 
// LEFT JOIN info_page AS info ON acc.username = info.username 
// WHERE acc.username = '$username' AND acc.role = 'employee'";
$username = $_SESSION['user'];
$sql = "SELECT acc.*, info.dob, info.phone, info.img 
        FROM account AS acc 
        LEFT JOIN info_page AS info ON acc.username = info.username 
        WHERE acc.role = 'employee'";

$result = $conn->query($sql);
// $result = $conn->query($sql);

// Kiểm tra xem có nhân viên nào hay không
$employees = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1,
        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .profile-img {
            display: block;
            border-radius: 50%;
            object-fit: cover;
            width: 50px;
            height: 50px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            margin: 2px;
        }

        .btn-info {
            background-color: #17a2b8;
            color: #fff;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>User Management</h1>
        <div class="row">
            <div class="col-md-12">
                <h2>Staff List</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Full Name</th>
                            <th>Status</th>
                            <th>Re-login</th>
                            <th>Unlock/Lock Account</th>
                            <th>Details</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employees as $employee) : ?>
                            <tr>
                                <td>
                                    <img style="width: 50px; height: 50px;" class="profile-img" src="<?php echo $employee['img'] != null ? $employee['img'] : 'uploads/avatar_default.png'; ?>" alt="Ảnh Đại Diện" />


                                </td>
                                <td><?php echo $employee['firstname'] . ' ' . $employee['lastname']; ?></td>
                                <td>
                                    <?php if ($employee['activated'] == 0) : ?>
                                        Inactive
                                    <?php elseif ($employee['locked'] == 1) : ?>
                                        Locked
                                    <?php else : ?>
                                        Active
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="resend_login_email.php?username=<?php echo $employee['username']; ?>" class="btn btn-info">Resend Login Email</a>

                                    <!-- <a href="view_sales_info.php?username=<?php echo $employee['username']; ?>" class="btn btn-primary">View Sales Info</a> -->
                                </td>
                                <td>
                                    <?php if ($employee['locked'] == 1) : ?>
                                        <a href="lock_unlock_emp.php?username=<?php echo $employee['username']; ?>" class="btn btn-success">Unlock Account</a>
                                    <?php else : ?>
                                        <a href="lock_unlock_emp.php?username=<?php echo $employee['username']; ?>" class="btn btn-warning">Lock Account</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="details_employee.php?username=<?php echo $employee['username']; ?>" class="btn btn-primary">View Details</a>

                                </td>
                                <td>
                                    <a href="delete_employee.php?username=<?php echo $employee['username']; ?>" class="btn btn-danger">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>



        </div>
        <br>
        <a href="../index.php" class="btn btn-secondary">Back to home</a>
        <a href="register_Admin.php" class="btn btn-primary">Thêm nhân viên</a>
    </div>
</body>

</html>