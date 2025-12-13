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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .text-center {
            text-align: center;
        }

        .mb-4 {
            margin-bottom: 20px;
        }

        .mt-5 {
            margin-top: 50px;
        }

        .alert {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
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
            display: block;
            width: 100%;
            text-align: center;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-block {
            display: block;
            width: 100%;
        }

        .mt-2 {
            margin-top: 10px;
        }
    </style>
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
                <!-- <a href="<?php //echo ($_SESSION['role'] === 'admin') ? 'index.php' : 'index_employee.php'; 
                                ?>"><button class="btn btn-secondary btn-block mt-2">Thoát</button></a> -->
                <a href="<?php echo '../index.php'; ?>"><button class="btn btn-secondary btn-block mt-2">Thoát</button></a>

            </div>
        </div>
    </div>
</body>

</html>