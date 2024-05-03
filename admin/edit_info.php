<?php
session_start();
include 'db.php';
$conn = open_database();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

$sql_info_page = "SELECT dob, phone FROM info_page WHERE username = '$user'";
$result_info_page = $conn->query($sql_info_page);

$sql_account = "SELECT username, password, email FROM account WHERE username = '$user'";
$result_account = $conn->query($sql_account);

if ($result_info_page->num_rows > 0 && $result_account->num_rows > 0) {
    $row_info_page = $result_info_page->fetch_assoc();
    $dob = $row_info_page['dob'];
    $phone = $row_info_page['phone'];

    $row_account = $result_account->fetch_assoc();
    $username = $row_account['username'];
    $password = $row_account['password'];
    $email = $row_account['email'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Thông Tin</title>
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

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
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
        <h1>Chỉnh Sửa Thông Tin</h1>
        <form method="POST" action="update_info.php">
            <div class="info">
                <label for="username">Tên Đăng Nhập:</label>
                <input type="text" id="username" name="username" value="<?php echo $username; ?>" disabled>
            </div>
            <div class="info">
                <label for="password">Mật Khẩu:</label>
                <input type="password" id="password" name="password" value="<?php echo $password; ?>" disabled>
            </div>
            <div class="info">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" disabled>
            </div>
            <div class="info">
                <label for="dob">Ngày Tháng Năm Sinh:</label>
                <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>">
            </div>
            <div class="info">
                <label for="phone">Số Điện Thoại:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>">
            </div>
            <button type="submit" class="btn">Lưu Thay Đổi</button>
            <a href="info_page.php"><button type="button" class="btn btn-secondary">Trở về trang thông tin</button></a>
        </form>
    </div>
</body>

</html>
