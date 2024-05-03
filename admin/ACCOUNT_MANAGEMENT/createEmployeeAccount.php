<?php
session_start();
include "class/employee_class.php"
?>

<?php

// Hàm tạo tài khoản cho nhân viên bán hàng
function createEmployeeAccount($employee_name, $employee_email)
{

    $employee = new Employee(); // Tạo một đối tượng của lớp Employee
    $token = bin2hex(random_bytes(16));
    $result = $employee->insert_employee($employee_name, $employee_email, $token, 0); 

    // // Tạo một mã token ngẫu nhiên
    // $token = bin2hex(random_bytes(16));

    // // Lưu thông tin tài khoản vào cơ sở dữ liệu với trạng thái chưa kích hoạt
    // $sql = "INSERT INTO tbl_employees (employee_name, employee_email, token, activated) VALUES ('$employee_name', '$employee_email', '$token', 0)";
    // $result = $db->query($sql);

    if ($result) {
        // Gửi employee_email chứa liên kết kích hoạt tài khoản
        $to = $employee_email;
        $subject = "Kích hoạt tài khoản nhân viên";
        $message = "Xin chào $employee_name,\n\n";
        $message .= "Bạn đã được tạo một tài khoản nhân viên mới.\n";
        $message .= "Vui lòng nhấp vào liên kết sau để kích hoạt tài khoản của bạn:\n";
        $message .= "http://yourdomain.com/activate.php?token=$token\n\n";
        $message .= "Liên kết này chỉ có hiệu lực trong 1 phút.\n";
        $message .= "Nếu bạn không yêu cầu tạo tài khoản, vui lòng bỏ qua employee_email này.\n\n";
        $message .= "Trân trọng,\n";
        $message .= "Quản trị viên";

        $headers = "From: yourdomain@example.com\r\n";
        $headers .= "Reply-To: yourdomain@example.com\r\n";
        $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

        if (mail($to, $subject, $message, $headers)) {
            echo "Một employee_email đã được gửi đến $employee_email với hướng dẫn kích hoạt tài khoản.";
        } else {
            echo "Có lỗi xảy ra khi gửi employee_email kích hoạt.";
        }
    } else {
        echo "Có lỗi xảy ra khi tạo tài khoản.";
    }
}

// Xử lý khi nhấn nút "Tạo tài khoản nhân viên"
if (isset($_POST['create_employee'])) {
    $employee_name = $_POST['employee_name'];
    $employee_email = $_POST['employee_email'];

    createEmployeeAccount($employee_name, $employee_email);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tài khoản</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        h3 {
            color: #555;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="employee_email"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: #ff0000;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if ($_SESSION['role'] === 'admin') : ?>
            <h2>Quản lý tài khoản</h2>
            <h3>Tạo tài khoản nhân viên bán hàng</h3>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="employee_name">Họ và tên:</label>
                <input type="text" id="employee_name" name="employee_name" required>
                <label for="employee_email">Địa chỉ Gmail:</label>
                <input type="employee_email" id="employee_email" name="employee_email" required>
                <input type="submit" name="create_employee" value="Tạo tài khoản">
            </form>
        <?php else : ?>
            <p>Bạn không có quyền truy cập vào trang này.</p>
        <?php endif; ?>
    </div>
</body>

</html>