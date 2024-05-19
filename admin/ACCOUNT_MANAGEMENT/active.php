<?php
include 'db.php';
$conn = open_database();
session_start();



if (isset($_GET['code'])) {
    $activate_token = $_GET['code'];
    // $_SESSION['activate_token'] = $activate_token;


    $activation_message = '';

    // Kiểm tra mã xác nhận trong cơ sở dữ liệu
    $sql = "SELECT email, created_at  FROM account WHERE activate_token = '$activate_token'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        $created_at = $row['created_at'];
        $current_time = time();

        if (($current_time - $created_at) > 60) {
            $activation_message =  "Liên kết kích hoạt đã hết hạn. Vui lòng yêu cầu mã mới.";
        } else {
            // Kích hoạt tài khoản
            $sql_update = "UPDATE account SET activated = 1 WHERE email = '$email'";
            if ($conn->query($sql_update) === TRUE) {
                $activation_message = "Tại khoản của bạn đã được kích hoạt thành công!";
            } else {
                $activation_message = "Error: " . $sql_update . "<br>" . $conn->error;
            }
        }

        // // Kích hoạt tài khoản
        // $sql_update = "UPDATE account SET activated = 1 WHERE email = '$email'";
        // if ($conn->query($sql_update) === TRUE) {
        //     $activation_message = "Your account has been activated successfully!";
        // } else {
        //     $activation_message = "Error: " . $sql_update . "<br>" . $conn->error;
        // }

        // // Xóa mã xác nhận khỏi cơ sở dữ liệu
        // $sql_delete = "DELETE FROM activate_token WHERE activate_token = '$activate_token'";
        // $conn->query($sql_delete);
    } else {
        $activation_message = "Mã kích hoạt không hợp lệ.";
    }
} else {
    $activation_message = "Mã kích hoạt bị thiếu.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Account Activation</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .row {
            display: flex;
            justify-content: center;
        }

        .col-md-6 {
            width: 100%;
        }

        h4 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .text-success {
            color: green;
        }

        .text-danger {
            color: red;
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
            text-align: center;
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .p-3 {
            padding: 1rem;
        }

        .border {
            border: 1px solid #ddd;
        }

        .rounded {
            border-radius: 0.25rem;
        }

        .mt-5 {
            margin-top: 3rem;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .px-5 {
            padding-left: 3rem;
            padding-right: 3rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-5 mx-auto p-3 border rounded">
                <h4>Account Activation</h4>
                <?php if (isset($activation_message) && strpos($activation_message, 'thành công') != false) : ?>

                    <p class="text-success"><?= $activation_message ?></p>
                    <p>Click <a href="change_password_first.php">here</a> to login and manage your account information.</p>
                    <a class="btn btn-success" href="change_password_first.php">Login</a>
                <?php else : ?>
                    <p class="text-danger"><?= $activation_message ?></p>
                    <!-- <p>Click <a href="change_password_first.php">here</a> to login.</p> -->
                    <!-- <a class="btn btn-success px-5" href="change_password_first.php">Login</a> -->
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>