<?php
include 'db.php';
$conn = open_database();
session_start();



if (isset($_GET['code'])) {
    $activate_token = $_GET['code'];
    // $_SESSION['activate_token'] = $activate_token;


    // Kiểm tra mã xác nhận trong cơ sở dữ liệu
    $sql = "SELECT email FROM account WHERE activate_token = '$activate_token'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        // Kích hoạt tài khoản
        $sql_update = "UPDATE account SET activated = 1 WHERE email = '$email'";
        if ($conn->query($sql_update) === TRUE) {
            $activation_message = "Your account has been activated successfully!";
        } else {
            $activation_message = "Error: " . $sql_update . "<br>" . $conn->error;
        }

        // // Xóa mã xác nhận khỏi cơ sở dữ liệu
        // $sql_delete = "DELETE FROM activate_token WHERE activate_token = '$activate_token'";
        // $conn->query($sql_delete);
    } else {
        $activation_message = "Invalid activation code.";
    }
} else {
    $activation_message = "Activation code is missing.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Account Activation</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-5 mx-auto p-3 border rounded">
                <h4>Account Activation</h4>
                <?php if (isset($activation_message) && strpos($activation_message, 'successfully') !== false) : ?>
                    <p class="text-success"><?= $activation_message ?></p>
                    <p>Click <a href="change_password_first.php">here</a> to login and manage your account information.</p>
                    <a class="btn btn-success px-5" href="change_password_first.php">Login</a>
                <?php else : ?>
                    <p class="text-danger"><?= $activation_message ?></p>
                    <!-- <p>Click <a href="change_password_first.php">here</a> to login.</p>
                    <a class="btn btn-success px-5" href="change_password_first.php">Login</a> -->
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>