<?php
include 'db.php';
$conn = open_database();
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiểm Tra Thông Tin Khách Hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
        }

        .info label {
            font-weight: bold;
        }

        .info p {
            margin: 5px 0;
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
            margin-right: 10px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .purchase-history {
            margin-top: 20px;
        }

        .purchase-history h3 {
            color: #007bff;
            margin-bottom: 10px;
        }

        .purchase-history table {
            width: 100%;
            border-collapse: collapse;
        }

        .purchase-history th,
        .purchase-history td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .purchase-history th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Kiểm Tra Thông Tin Khách Hàng</h2>
        <?php


        // $phone = $_POST['phone_number'];
        $phone = isset($_SESSION['cus_phone_number']) ? $_SESSION['cus_phone_number'] : $_POST['phone_number'];
        $_SESSION['cus_phone_number'] = $phone;

        // $phone = isset($_SESSION['cus_phone_number']) ? $_SESSION['cus_phone_number'] :  $_POST['phone_number'];
        // $_SESSION['cus_phone_number'] = $phone;
        // echo $_POST['phone_number'];
        // echo $_SESSION['cus_phone_number'];
        // $_SESSION['cus_phone_number'] = $phone;
        // if (isset($_SESSION['cus_phone_number'])) {
        //     echo $_SESSION['cus_phone_number'];
        // } else {
        //     echo 'nhin cc';
        // }



        // $sql_check_phone = "SELECT * FROM customer WHERE phone_number = '$phone'";
        // $result_check_phone = $conn->query($sql_check_phone);



        $sql_check_phone = "SELECT * FROM customer WHERE phone_number = ?";
        $stmt_check_phone = $conn->prepare($sql_check_phone);
        $stmt_check_phone->bind_param("s", $phone);
        $stmt_check_phone->execute();
        $result_check_phone = $stmt_check_phone->get_result();



        if ($result_check_phone->num_rows > 0) {
            $row = $result_check_phone->fetch_assoc();
            $customer_id = $row['customer_id']; // Lấy customer_id của khách hàng

            // Hiển thị thông tin cá nhân của khách hàng
            echo '<div class="info">';
            echo '<label for="name">Tên Khách Hàng:</label>';
            echo '<p>' . $row['full_name'] . '</p>';
            echo '<label for="phone">Số Điện Thoại:</label>';
            echo '<p>' . $row['phone_number'] . '</p>';
            echo '<label for="address">Địa Chỉ:</label>';
            echo '<p>' . $row['address'] . '</p>';
            echo '</div>';

            // Truy vấn lịch sử mua hàng của khách hàng
            // $sql_transaction = "SELECT * FROM transaction WHERE customer_id = '$customer_id'";
            // $result_transaction = $conn->query($sql_transaction);

            $sql_transaction = "SELECT * FROM transaction WHERE customer_id = ?";
            $stmt_transaction = $conn->prepare($sql_transaction);
            $stmt_transaction->bind_param("i", $customer_id);
            $stmt_transaction->execute();
            $result_transaction = $stmt_transaction->get_result();

            // Hiển thị thông tin lịch sử mua hàng
            if ($result_transaction->num_rows > 0) {
                echo '<div class="purchase-history">';
                echo '<h3>Đơn hàng:</h3>';
                echo '<table>';
                echo '<tr><th>Ngày Mua</th><th>Mã sản phẩm</th><th>Số Lượng</th><th>Giá Đơn Vị</th><th>Tổng Tiền</th></tr>';
                while ($purchase_row = $result_transaction->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $purchase_row['payment_date'] . '</td>';
                    echo '<td>' . $purchase_row['product_id'] . '</td>';
                    echo '<td>' . $purchase_row['quantity'] . '</td>';
                    echo '<td>' . $purchase_row['unit_price'] . '</td>';
                    echo '<td>' . $purchase_row['total_amount'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '</div>';
            } else {
                echo '<p>Không có thông tin lịch sử mua hàng.</p>';
            }
        } else {
            header("Location: register_acc_cus.php?phone_number=$phone");
            exit();
        }
        ?>

        <div class="btn-container">
            <a href="order_management.php?customer_id=<?php echo $customer_id; ?>" class="btn">Thêm sản phẩm mới</a>
            <a href="customer_management.php" class="btn">Kiểm Tra Số Điện Thoại Khác</a>
            <a href="index.php" class="btn">Trở về Trang Nhân Viên</a>
            <a href="payment.php" class="btn">Thanh toán</a>
        </div>

    </div>
</body>

</html>