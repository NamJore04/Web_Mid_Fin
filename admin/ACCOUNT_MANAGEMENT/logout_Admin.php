<?php
    session_start();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng xuất</title>
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
        }

        .btn:hover {
            background-color: #218838;
        }

        .text-danger {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h4>Đăng xuất thành công</h4>
            <p>Tài khoản của bạn đã được đăng xuất khỏi hệ thống.</p>
            <p>Nhấn <a href="login.php">vào đây</a> để trở về trang đăng nhập, hoặc trang web sẽ tự động chuyển hướng sau <span id="counter" class="text-danger">5</span> giây nữa.</p>
            <a class="btn" href="login.php">Đăng nhập</a>
        </div>
    </div>

    <script>
        let duration = 5;
        let countDown = 5;
        let counter = document.getElementById('counter');
        let id = setInterval(() => {
            countDown--;
            if (countDown >= 0) {
                counter.textContent = countDown;
            }
            if (countDown === -1) {
                clearInterval(id);
                window.location.href = 'login.php';
            }
        }, 1000);
    </script>
</body>
</html>
