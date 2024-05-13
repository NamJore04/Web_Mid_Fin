<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include 'db.php';
session_start();
// Load Composer's autoloader
require 'vendor\autoload.php';

$error = '';
$first_name = '';
$last_name = '';
$email = '';
$user = '';
$pass = '';
$pass_confirm = '';

// Xử lý dữ liệu biểu mẫu sau khi gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo 'nhin cc';

    if (isset($_POST['first']) && isset($_POST['last']) && isset($_POST['email']) && isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['pass-confirm'])) {
        $first_name = $_POST['first'];
        $last_name = $_POST['last'];
        $email = $_POST['email'];
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $pass_confirm = $_POST['pass-confirm'];
        // $role = $_POST['role'];

        if (empty($first_name)) {
            $error = 'Please enter your first name';
        } else if (empty($last_name)) {
            $error = 'Please enter your last name';
        } else if (empty($email)) {
            $error = 'Please enter your email';
        } else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $error = 'This is not a valid email address';
        } else if (empty($user)) {
            $error = 'Please enter your username';
        } else if (empty($pass)) {
            $error = 'Please enter your password';
        } else if (strlen($pass) < 6) {
            $error = 'Password must have at least 6 characters';
        } else if ($pass != $pass_confirm) {
            $error = 'Password does not match';
        } else {
            // register a new account
            // echo 'good';
            // Initialize PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'namhuynhfree@gmail.com';               //SMTP username
                $mail->Password   = 'zbvn whtw giaa hwpn';                  //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('namhuynhfree@gmail.com', 'Nam Jore');
                $mail->addAddress($email, $last_name);     //Add a recipient
                // $mail->addAddress('ellen@example.com');               //Name is optional
                $mail->addReplyTo('namhuynhfree@gmail.com', 'Nam Jore');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                // //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $rand = random_int(0, 1000);
                $activate_token = md5($user . '+' . $rand);
                // Tạo đường dẫn kích hoạt với mã xác nhận
                $activation_link = "http://localhost/web2/Account_management/admin/active.php?code=$activate_token"; //http://localhost:8080/52200151_Lab08/source%20code/active.php?code=

                // Nội dung email kích hoạt
                $mail->Subject = 'Activate your account';
                $mail->Body    = "Click the following link to activate your account: <a href='$activation_link'>$activation_link</a>";
                $mail->AltBody = "Please copy and paste the following URL into your browser's address bar to activate your account: $activation_link";


                $mail->send();
                // echo 'Message has been sent';
                // $conn = open_database();
                // Thêm tài khoản vào database
                // Sau khi kiểm tra hợp lệ của dữ liệu đăng ký, thêm tài khoản vào cơ sở dữ liệu
                if (empty($error)) {
                    try {
                        // Mở kết nối đến cơ sở dữ liệu
                        $conn = open_database();
                        $hash = password_hash($pass, PASSWORD_DEFAULT);

                        // Tạo truy vấn SQL để chèn dữ liệu mới
                        $sql = "INSERT INTO account (username, firstname, lastname, email, password, activate_token)
                        VALUES ('$user','$first_name', '$last_name', '$email',  '$hash',  '$activate_token')";
                        $sql_info_page = "INSERT INTO info_page (username)  VALUES ('$user')";
                       
                        // $result_info_page = $conn->query($sql_info_page);
                        // Thực thi truy vấn
                        if ($conn->query($sql) === TRUE && $conn->query($sql_info_page)) {
                            // Thông báo thành công
                            // echo "Đăng ký thành công!";
                            header("Location: verify.php");
                        } else {
                            // Thông báo lỗi nếu có
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }

                        // Đóng kết nối
                        $conn->close();
                    } catch (Exception $e) {
                        // Bắt lỗi nếu có
                        echo "Error: " . $e->getMessage();
                    }
                }
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        .bg {
            background: #eceb7b;
        }
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
                            <div class="invalid-tooltip">Last name is required</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input value="<?= $email ?>" name="email" required class="form-control" type="email" placeholder="Email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="user">Username</label>
                        <input value="<?= $user ?>" name="user" required class="form-control" type="text" placeholder="Username" id="user">
                        <div class="invalid-feedback">Please enter your username</div>
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input value="<?= $pass ?>" name="pass" required class="form-control" type="password" placeholder="Password" id="pass">
                        <div class="invalid-feedback">Password is not valid.</div>
                    </div>
                    <div class="form-group">
                        <label for="pass2">Confirm Password</label>
                        <input value="<?= $pass_confirm ?>" name="pass-confirm" required class="form-control" type="password" placeholder="Confirm Password" id="pass2">
                        <div class="invalid-feedback">Password is not valid.</div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" name="role" id="role">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div> -->


                    <div class="form-group">
                        <?php
                        if (!empty($error)) {
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                        ?>
                        <button type="submit" class="btn btn-success px-5 mt-3 mr-2">Register</button>
                        <button type="reset" class="btn btn-outline-success px-5 mt-3">Reset</button>
                    </div>
                    <!-- <div class="form-group">
                        <p>Already have an account? <a href="login.php">Login</a> now.</p>
                    </div> -->
                </form>

            </div>
        </div>

    </div>
</body>

</html>