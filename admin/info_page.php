<?php
// Kết nối đến cơ sở dữ liệu
include 'db.php';
$conn = open_database();
session_start();
// Query để lấy thông tin cá nhân của người dùng
$error = '';
$user = $_SESSION['user'];
$sql_info_page = "SELECT dob, phone FROM info_page WHERE username = '$user'"; // Giả sử id của người dùng là 1
$sql_account = "SELECT username, password, email FROM account WHERE username = '$user'"; // Giả sử id của người dùng là 1

$result_info_page = $conn->query($sql_info_page);
$result_account = $conn->query($sql_account);

if ($result_info_page->num_rows > 0 && $result_account->num_rows > 0) {
    while ($row = $result_info_page->fetch_assoc()) {
        $dob = $row['dob'];
        $phone = $row['phone'];
    }
    while ($row = $result_account->fetch_assoc()) {
        $username = $row['username'];
        $password = $row['password'];
        $email = $row['email'];
    }
} else {
    $error = "Không có dữ liệu. Vui lòng nhập thông tin của bạn vào.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Cá Nhân</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        .profile-img {
            display: block;
            margin: 20px auto;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }

        .info {
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-mk {
            padding: 10px 20px;
            border: none;
            background-color: #f39c12;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-secondary {
            background-color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Thông Tin Cá Nhân</h1>
        <img class="profile-img" src="avatar.jpg" alt="Ảnh Đại Diện">
        <div class="info">
            <label for="username">Tên Đăng Nhập:</label>
            <div id="username"><?php echo $username; ?></div>
        </div>
        <div class="info">
            <label for="password">Mật Khẩu:</label>
            <div id="password">********</div>
        </div>
        <div class="info">
            <label for="email">Email:</label>
            <div id="email"><?php echo $email; ?></div>
        </div>
        <div class="info">
            <label for="dob">Ngày Tháng Năm Sinh:</label>
            <div id="dob"><?php echo $dob; ?></div>
        </div>
        <div class="info">
            <label for="phone">Số Điện Thoại:</label>
            <div id="phone"><?php echo $phone; ?></div>
        </div>
        <div class="btn-container">
            <a href="edit_info.php"><button class="btn">Chỉnh Sửa Tài Khoản</button></a>
            <a href="change_password.php"><button class="btn-mk">Đổi mật khẩu</button></a>

            <a href="<?php echo ($_SESSION['role'] === 'admin') ? 'index.php' : 'index_employee.php'; ?>"><button class="btn btn-secondary">Thoát</button></a>

        </div>
        <p style="color: red;"><?php echo $error ?></p>
    </div>
</body>

</html>