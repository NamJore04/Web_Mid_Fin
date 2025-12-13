<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'db.php';
session_start();
require 'vendor/autoload.php';

// Xử lý logic khi nhấn vào nút Resend Login Email
$error = '';
$success = '';
$email = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = $_POST['email'];

    if (empty($email)) {
        $error = 'Please enter your email';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'This is not a valid email address';
    } else {
        // Tìm thông tin của người dùng trong cơ sở dữ liệu
        $conn = open_database();
        $sql = "SELECT * FROM account WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $username = $row['username'];
            $last_name = $row['lastname'];

            // Chuyển trạng thái của tài khoản về 0 (chưa kích hoạt)
            $sql_update = "UPDATE account SET activated = 0 WHERE email = '$email'";
            $conn->query($sql_update);

            // Gửi email kích hoạt tài khoản
            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'namhuynhfree@gmail.com';
                $mail->Password   = 'zbvn whtw giaa hwpn'; // Thay bằng mật khẩu email của bạn
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;

                $mail->setFrom('namhuynhfree@gmail.com', 'Nam Jore');
                $mail->addAddress($email, $last_name);
                $mail->addReplyTo('namhuynhfree@gmail.com', 'Nam Jore');

                $mail->isHTML(true);
                $rand = random_int(0, 1000);
                $activate_token = md5($username . '+' . $rand);
                $activation_link = "http://localhost/Web_Mid_Fin/admin/Account_management/active.php?code=$activate_token";

                $mail->Subject = 'Re-activate your account';
                $mail->Body    = "Click the following link to activate your account: <a href='$activation_link'>$activation_link</a>";
                $mail->AltBody = "Please copy and paste the following URL into your browser's address bar to activate your account: $activation_link";

                $mail->send();

                $created_at = time();
                $sql = "UPDATE account SET activate_token = '$activate_token', created_at = '$created_at' WHERE email = '$email'";
                $conn->query($sql);

                $success = "An activation email has been sent to your email address.";
            } catch (Exception $e) {
                $error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $error = "Email not found in the database.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            width: 80%;
            max-width: 400px;
        }
        .btn {
            display: inline-block;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            text-decoration: none;
            transition: background-color 0.3s;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #218838;
        }
        .alert {
            background-color: #dc3545;
            color: #fff;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .success {
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h3 class="text-center text-secondary mt-5 mb-3">Reset Password</h3>
            <form method="post" action="" class="mb-5">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" id="email" type="text" class="form-control" placeholder="Email address" value="<?php if(isset($email)): echo $email; endif; ?>">
                </div>
                <div class="form-group">
                    <p>Nếu email của bạn tồn tại trong cơ sở dữ liệu, bạn sẽ nhận được email chứa hướng dẫn đặt lại mật khẩu.</p>
                </div>
                <div class="form-group">
                    <?php
                    if (!empty($error)) {
                        echo "<div class='alert'>$error</div>";
                    }
                    if (!empty($success)) {
                        echo "<div class='success'>$success</div>";
                    }
                    ?>
                    <button type="submit" class="btn">Reset password</button>
                </div>
            </form>
            <a href="login.php"><button class="btn" onclick="window.location.href='login.php'" style="margin-top: 10px;">Đăng nhập</button></a>
        </div>
    </div>
</body>
</html>
