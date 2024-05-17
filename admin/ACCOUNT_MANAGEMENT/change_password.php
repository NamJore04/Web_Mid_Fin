<?php
session_start();

// // Kiểm tra xem người dùng đã đăng nhập chưa
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//     // Nếu chưa đăng nhập, chuyển hướng người dùng đến trang đăng nhập
//     header("Location: login.php");
//     exit();
// }

include 'db.php';
$conn = open_database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Kiểm tra xác nhận mật khẩu mới
    if ($new_password != $confirm_password) {
        $error = "Password confirmation does not match";
    } else if (strlen($new_password) < 6 || strlen($confirm_password) < 6) {
        $error = 'Password must have at least 6 characters';
    } else {
        $user = $_SESSION['user'];

        // Thay đổi mật khẩu trong cơ sở dữ liệu
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $sql_update_password = "UPDATE account SET password = '$hashed_password' WHERE username = '$user'";
        // if ($conn->query($sql_update_password) == TRUE) {
        //     // Chuyển hướng người dùng đến trang thông báo thành công
            header("Location: password_changed.php");
        //     exit();

        // } else {
        //     $error = "Error updating password: " . $conn->error;
        // }
        // echo "cc";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Change Password</h2>
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error ?>
                    </div>
                <?php endif; ?>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="new_password">New Password:</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Change Password</button>
                </form>
                <!-- <a href="<?php //echo ($_SESSION['role'] === 'admin') ? 'index.php' : 'index_employee.php'; ?>"><button class="btn btn-secondary btn-block mt-2">Thoát</button></a> -->
                <a href="<?php echo '../index.php'; ?>"><button class="btn btn-secondary btn-block mt-2">Thoát</button></a>

            </div>
        </div>
    </div>
</body>

</html>