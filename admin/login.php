<?php
// session_start();
// if (isset($_SESSION['user'])) {
//     header('Location: index.php');
//     exit();
// }

// $error = '';

// $user = '';
// $pass = '';

// if (isset($_POST['user']) && isset($_POST['pass'])) {
//     $user = $_POST['user'];
//     $pass = $_POST['pass'];

//     if (empty($user)) {
//         $error = 'Please enter your username';
//     }
//     else if (empty($pass)) {
//         $error = 'Please enter your password';
//     }
//     else if (strlen($pass) < 6) {
//         $error = 'Password must have at least 6 characters';
//     }
//     else if ($user == 'admin' && $pass == '123456') {
//         // success
//         $_SESSION['user'] = 'admin';
//         $_SESSION['name'] = 'Mai Van Manh';
//         $_SESSION['role'] = 'admin';
//         header('Location: index.php');
//         exit();
//     } else {
//         $error = 'Invalid username or password';
//     }
// }

?>

<?php
include 'database.php';
session_start();
// $_SESSION['user'];
open_database();
if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

$error = '';

$user = '';
$pass = '';

if (isset($_POST['user']) && isset($_POST['pass'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    if (empty($user)) {
        $error = 'Please enter your username';
    } else if (empty($pass)) {
        $error = 'Please enter your password';
    } else if (strlen($pass) < 6) {
        $error = 'Password must have at least 6 characters';
    }
    // else if ($user == 'admin' && $pass == '123456') {
    //     // success

    //     $_SESSION['user'] = 'admin';
    //     $_SESSION['name'] = 'Mai Van Manh';

    //     header('Location: index.php');
    //     exit();
    else {
        // Gọi hàm login() để kiểm tra thông tin đăng nhập
        $login_result = login($user, $pass);

        // Xử lý kết quả trả về từ hàm login()
        if ($login_result['code'] == 0) {
            // Nếu không có lỗi, đăng nhập thành công
            $_SESSION['user'] = $user;
            $_SESSION['role'] = $login_result['role'];
            if ($login_result['role'] === 'admin') {
                header('Location: index.php');
            } else {
                // header('Location: index.php');
                header('Location: index_employee.php');
            }
            exit();
            // $_SESSION['name'] = $login_result['data']['name']; // Giả sử 'name' là một trường trong dữ liệu của người dùng

            // header('Location: index.php');
            // exit();
        } else {
            // Nếu có lỗi, gán thông báo lỗi cho biến $error
            $error = $login_result['error'];
        }
    }
}



function login($user, $pass)
{
    //Check If user exist on DB
    $sql = "SELECT * FROM account WHERE username = ?";
    $conn = open_database();

    $stm = $conn->prepare($sql); // SQL Injection
    $stm->bind_param('s', $user);

    if (!$stm->execute()) {
        return array('code' => 500, 'error' => 'Cannot execute command');
    }
    $result = $stm->get_result();

    if ($result->num_rows == 0) {
        return array('code' => 2, 'error' => 'User does not exist');
    }

    $data = $result->fetch_assoc();

    // //Compare $pass with $pass on DB
    // $hashed_password = $data['password'];
    // if (!password_verify($pass, $hashed_password)) {
    //     return array('code' => 2, 'error' => 'Invalid Password');
    // }

    //Check if that user is activated (activated == 1)
    if ($data['activated'] == 0) {
        return array('code' => 2, 'error' => 'This account is not activated. Please log in by clicking the link in your email!');
    }
    if ($data['locked'] == 1) {
        return array('code' => 2, 'error' => 'This account is locked. Please contact the administrator for assistance.');
    }

    return array('code' => 0, 'error' => '', 'data' => $data, 'role' => $data['role']);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

        .login-form {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 350px;
        }

        .login-form h3 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 3px;
            background-color: #28a745;
            color: #fff;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #218838;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 3px;
            margin-bottom: 20px;
        }

        .alert-danger strong {
            font-weight: bold;
        }

        .form-group p {
            margin-bottom: 10px;
            color: #333;
        }

        .form-group a {
            color: #007bff;
            text-decoration: none;
        }

        .form-group a:hover {
            text-decoration: underline;
        }

        .text-danger {
            color: #dc3545;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-form">
            <h3>User Login</h3>
            <form method="post" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input value="<?= $user ?>" name="user" id="user" type="text" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="pass" value="<?= $pass ?>" id="password" type="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <?php
                    if (!empty($error)) {
                        echo "<div class='alert-danger'>$error</div>";
                    }
                    ?>
                    <button>Login</button>
                </div>
                <!-- <div class="form-group">
                    <p>Don't have an account yet? <a href="register_Admin.php">Register now</a>.</p>
                    <p>Forgot your password? <a href="forgot_Admin.php">Reset your password</a>.</p>
                </div> -->
            </form>
            <!-- <p class="text-danger">Đăng nhập bằng tài khoản: <strong>admin</strong> - <strong>123456</strong></p>
        <p class="text-danger">Username và mật khẩu này đang viết trực tiếp trong code, cần bổ sung chức năng đọc database để lấy username và mật khẩu trong database</p> -->
        </div>
    </div>

</body>

</html>