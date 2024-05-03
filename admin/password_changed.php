<?php 
session_start();
// $_SESSION['role'] = $login_result['role'];
// if ($_SESSION['role'] == 'admin') {
//     header('Location: index.php');
// } else {
//     header('Location: index_employee.php');
// }
// exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Changed</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert alert-success" role="alert">
                    Your password has been changed successfully!
                </div>
                <?php if ($_SESSION['role'] == 'admin') : ?>
                    <a href="index.php" class="btn btn-primary btn-block">Back to Home</a>
                <?php else : ?>
                    <a href="index_employee.php" class="btn btn-primary btn-block">Back to Home</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
