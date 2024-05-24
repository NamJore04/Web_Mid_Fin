<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include 'db.php';
session_start();
require 'vendor/autoload.php';

$error = '';
$first_name = '';
$last_name = '';
$email = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['first']) && isset($_POST['last']) && isset($_POST['email'])) {
        $first_name = $_POST['first'];
        $last_name = $_POST['last'];
        $email = $_POST['email'];

        if (empty($first_name)) {
            $error = 'Please enter your first name';
        } else if (empty($last_name)) {
            $error = 'Please enter your last name';
        } else if (empty($email)) {
            $error = 'Please enter your email';
        } else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $error = 'This is not a valid email address';
        } else {
            // Tự động tạo tên người dùng từ email
            $user = explode('@', $email)[0];
            // Sử dụng tên người dùng làm mật khẩu tạm thời
            $pass = $user;

            // Initialize PHPMailer
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'namhuynhfree@gmail.com';
                $mail->Password   = 'zbvn whtw giaa hwpn';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;

                $mail->setFrom('namhuynhfree@gmail.com', 'Nam Jore');
                $mail->addAddress($email, $last_name);
                $mail->addReplyTo('namhuynhfree@gmail.com', 'Nam Jore');

                $mail->isHTML(true);
                $rand = random_int(0, 1000);
                $activate_token = md5($user . '+' . $rand);
                $activation_link = "http://localhost/Web_Mid_Fin/admin/Account_management/active.php?code=$activate_token";

                $mail->Subject = 'Activate your account';
                $mail->Body    = "Click the following link to activate your account: <a href='$activation_link'>$activation_link</a>";
                $mail->AltBody = "Please copy and paste the following URL into your browser's address bar to activate your account: $activation_link";

                $mail->send();

                if (empty($error)) {
                    try {
                        $conn = open_database();
                        $hash = password_hash($pass, PASSWORD_DEFAULT);
                        $created_at = time();

                        $sql = "INSERT INTO account (username, firstname, lastname, email, password, activate_token, created_at)
                                VALUES ('$user', '$first_name', '$last_name', '$email', '$hash', '$activate_token', '$created_at')";
                        $sql_info_page = "INSERT INTO info_page (username) VALUES ('$user')";

                        if ($conn->query($sql) === TRUE && $conn->query($sql_info_page)) {
                            header("Location: verify.php");
                        } else {
                            $error = "<p style='color: red; font-weight: bold;'>Email này đã tồn tại.</p>";
                        }

                        $conn->close();
                    } catch (Exception $e) {
                        $error = "<p style='color: red; font-weight: bold;'>Email này đã tồn tại.</p>";
                    }
                }
            } catch (Exception $e) {
                $error = "<p style='color: red; font-weight: bold;'>Email này đã tồn tại.</p>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register an account</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .container { width: 90%; max-width: 600px; margin: 50px auto; background-color: #fff; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 8px; }
        .text-center { text-align: center; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { margin-bottom: .5rem; display: block; }
        .form-group input { width: 100%; padding: .375rem .75rem; border: 1px solid #ced4da; border-radius: .25rem; box-sizing: border-box; }
        .btn { display: inline-block; padding: 10px 20px; font-size: 14px; text-align: center; text-decoration: none; border-radius: 4px; transition: background-color 0.3s ease; margin-top: 10px; width: 100%; box-sizing: border-box; }
        .btn-success { background-color: #28a745; color: #fff; border: none; }
        .btn-success:hover { background-color: #218838; }
        .alert { padding: 15px; border: 1px solid transparent; border-radius: 4px; margin-bottom: 20px; }
        .alert-danger { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 border my-5 p-4 rounded mx-3">
                <h3 class="text-center text-secondary mt-2 mb-3 mb-3">Create a new account</h3>
                <form method="POST" action="" novalidate>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstname">First name</label>
                            <input value="<?= $first_name ?>" name="first" required class="form-control" type="text" placeholder="First name" id="firstname">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastname">Last name</label>
                            <input value="<?= $last_name ?>" name="last" required class="form-control" type="text" placeholder="Last name" id="lastname">
                            <!-- <div class="invalid-tooltip">Last name is required</div> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input value="<?= $email ?>" name="email" required class="form-control" type="email" placeholder="Email" id="email">
                    </div>
                    <div class="form-group">
                        <?php if (!empty($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
                        <button type="submit" class="btn btn-success px-5 mt-3 mr-2">Register</button>
                        <!-- <a href="../index.php"><button type=""  class="btn btn-outline-success px-5 mt-3">Home Page</button></a> -->
                    </div>
                </form>
                <button onclick="window.location.href='../index.php'" class="btn btn-outline-success px-5 mt-3">Home Page</button>
            </div>
        </div>
    </div>
</body>
</html>
