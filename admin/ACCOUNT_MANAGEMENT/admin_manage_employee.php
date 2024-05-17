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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* CSS styles */
        .profile-img {
            display: block;
            border-radius: 50%;
            object-fit: cover;
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