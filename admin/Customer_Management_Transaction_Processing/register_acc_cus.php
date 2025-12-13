<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Tài Khoản Khách Hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Đăng Ký Tài Khoản Khách Hàng</h2>
        <?php
        if (isset($_SESSION['message'])) {
            echo "<p style= 'color: green;'>{$_SESSION['message']}</p>";
            unset($_SESSION['message']);
        }
        ?>
        <form method="POST" action="process_register_cus.php">
            <?php
            // Kiểm tra xem phone_number có tồn tại trong $_GET hay không
            $phone_number = isset($_GET['phone_number']) ? $_GET['phone_number'] : '';
            ?>
            <input type="hidden" name="phone" value="<?php echo $phone_number; ?>">
            <input type="text" name="name" class="form-control" placeholder="Tên Khách Hàng" required>
            <input type="text" name="address" class="form-control" placeholder="Địa Chỉ" required>
            <input type="submit" value="Đăng Ký" class="btn">
            <a href="customer_management.php" class="btn">Quay lại</a>
        </form>
        <div class="btn-container">
        </div>
    </div>
</body>

</html>
