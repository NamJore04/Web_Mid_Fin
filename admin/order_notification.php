<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Báo</title>
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
            text-align: center;
        }

        h2 {
            color: #007bff;
            margin-bottom: 20px;
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
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php

        if (isset($_SESSION['order_success'])) {
            echo "<h2>Sản phẩm đã được thêm vào đơn hàng thành công.</h2>";
        } elseif (isset($_SESSION['order_failure'])) {
            echo "<h2>Có lỗi xảy ra khi thêm sản phẩm vào đơn hàng.</h2>";
        } else {
            echo "<h2>Yêu cầu không hợp lệ.</h2>";
        }
        // $customer_id = $_GET['customer_id'];
        $customer_id = $_SESSION['customer_id'];

        // unset($_SESSION['order_failure']);
        // unset($_SESSION['order_success']);


        ?>
        <input type="hidden" name="customer_id" class="form-control" value="<?php echo $customer_id; ?>">


        <a href="purchase_history.php?customer_id=<?php echo $customer_id; ?>" class="btn">Xem đơn hàng của khách</a>

    </div>
</body>

</html>