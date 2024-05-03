<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include 'db.php';
session_start();
require 'vendor\autoload.php';


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// // Kiểm tra vai trò của người dùng
// if ($_SESSION['role'] !== 'admin') {
//     header("Location: unauthorized.php");
//     exit();
// }

// Xử lý logic khi nhấn vào nút Resend Login Email
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Tìm thông tin của nhân viên trong cơ sở dữ liệu
    $conn = open_database();
    $sql = "SELECT * FROM account WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
        $last_name = $row['lastname'];

        // Chuyển trạng thái của tài khoản về 0 (chưa kích hoạt)
        $sql_update = "UPDATE account SET activated = 0 WHERE username = '$username'";
        $conn->query($sql_update);



        // Gửi email kích hoạt tài khoản
        try {
            $mail = new PHPMailer(true);
            // $mail = new PHPMailer\PHPMailer\PHPMailer(true);
            // Cấu hình SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'namhuynhfree@gmail.com'; // Thay bằng địa chỉ email của bạn
            $mail->Password   = 'zbvn whtw giaa hwpn'; // Thay bằng mật khẩu email của bạn
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption

            // $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 465;

            // Thiết lập thông tin người gửi
            $mail->setFrom('namhuynhfree@gmail.com', 'Nam Jore'); // Thay bằng địa chỉ email và tên của bạn

            // Thêm người nhận
            $mail->addAddress($email, $last_name);
            $mail->addReplyTo('namhuynhfree@gmail.com', 'Nam Jore');

            // Thiết lập nội dung email
            $mail->isHTML(true);
            $rand = random_int(0, 1000);
            $activate_token = md5($username . '+' . $rand);
            $activation_link = "http://localhost:8080/web2/admin/active.php?code=$activate_token";

            $mail->Subject = 'Re-activate your account';
            $mail->Body    = "Click the following link to activate your account: <a href='$activation_link'>$activation_link</a>";
            $mail->AltBody = "Please copy and paste the following URL into your browser's address bar to activate your account: $activation_link";

            $mail->send();

            if (empty($error)) {
                try {
                    // Mở kết nối đến cơ sở dữ liệu
                    $conn = open_database();

                    // Kiểm tra xem kết nối đã mở thành công hay không
                    if ($conn) {
                        // Tạo truy vấn SQL để cập nhật dữ liệu mới
                        $sql = "UPDATE account SET activate_token = '$activate_token' WHERE username = '$username'";


                        // Thực thi truy vấn SQL
                        if ($conn->query($sql) === TRUE) {
                            // Điều hướng người dùng đến trang xác minh
                            header("Location: admin_manage_employee.php");
                            exit(); // Dừng việc thực thi mã PHP tiếp theo
                        } else {
                            // Nếu có lỗi trong quá trình thực thi truy vấn, hiển thị thông báo lỗi
                            echo "Error updating record: " . $conn->error;
                        }

                        // Đóng kết nối đến cơ sở dữ liệu
                        $conn->close();
                    } else {
                        // Nếu không thể mở kết nối đến cơ sở dữ liệu, hiển thị thông báo lỗi
                        echo "Could not connect to the database.";
                    }
                } catch (Exception $e) {
                    // Nếu có lỗi trong quá trình thực thi, hiển thị thông báo lỗi
                    echo "Error: " . $e->getMessage();
                }
            }



            // Chuyển hướng về trang quản lý nhân viên
            header("Location: admin_manage_employee.php");
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        // Nếu không tìm thấy thông tin của nhân viên, chuyển hướng về trang quản lý nhân viên
        header("Location: admin_manage_employee.php");
        exit();
    }
} else {
    // Nếu không có username được cung cấp, chuyển hướng về trang quản lý nhân viên
    header("Location: admin_manage_employee.php");
    exit();
}
