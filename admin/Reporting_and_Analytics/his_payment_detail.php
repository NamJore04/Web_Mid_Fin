<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử thanh toán</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background-color: #007bff;
            color: #fff;
            text-align: left;
        }

        .purchase-history {
            margin-top: 20px;
        }

        .btn-delete {
            padding: 8px 16px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .no-record {
            color: #dc3545;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="container">

        <?php

        include 'db.php';
        session_start();
        $conn = open_database();
        // echo $_POST['order_id'];
        // Kiểm tra nếu order_id đã được gửi từ form
        if (isset($_POST['order_id'])) {
            // Lấy order_id từ form
            $order_id = $_POST['order_id'];

            // Truy vấn lịch sử đơn hàng từ bảng transaction sử dụng prepared statement
            $sql_history_payment = "SELECT * FROM transaction WHERE order_id = ?";
            $stmt_history_payment = $conn->prepare($sql_history_payment);
            $stmt_history_payment->bind_param("i", $order_id);
            $stmt_history_payment->execute();
            $result_history_payment = $stmt_history_payment->get_result();

            // Kiểm tra số lượng kết quả trả về
            if ($result_history_payment->num_rows > 0) {
                // Hiển thị thông tin lịch sử đơn hàng
                echo '<div class="purchase-history">';
                echo '<h3>Lịch sử mua hàng:</h3>';
                echo '<table>';
                echo '<tr><th>Ngày Mua</th><th>Mã sản phẩm</th><th>Số Lượng</th><th>Giá Đơn Vị</th><th>Tổng Tiền</th></tr>';
                while ($row = $result_history_payment->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['payment_date'] . '</td>';
                    echo '<td>' . $row['product_id'] . '</td>';
                    echo '<td>' . $row['quantity'] . '</td>';
                    echo '<td>' . $row['unit_price'] . '</td>';
                    echo '<td>' . $row['total_amount'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '<form action="dashboard.php">';
                echo '<button onclick="window.location.href = "dashboard.php"; type="submit" style="display: flex;margin: auto; background-color: #1fa1b8;" class="btn">Về dash board</button>';
                echo '</form>';
                echo '</div>';
            } else {
                echo '<p class="no-record">Không có lịch sử mua hàng.</p>';
            }
        }

        $conn->close();
        ?>
    </div>

</body>

</html>