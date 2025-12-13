<?php
// Bắt đầu phiên làm việc
session_start();

// Include file kết nối đến cơ sở dữ liệu
include 'db.php';
$conn = open_database();

// Lấy ID của khách hàng từ session
// $customer_id = $_SESSION['customer_id'];

// $customer_id = $_GET['customer_id'];
$customer_id = $_SESSION['customer_id'];

// $url = "order_notification.php?customer_id=" . $customer_id;
// header("Location: $url");
// exit();

// Truy vấn để lấy thông tin đơn hàng của khách hàng
$sql_orders = "SELECT * FROM orders WHERE customer_id = ?";
$stmt_orders = $conn->prepare($sql_orders);
$stmt_orders->bind_param("i", $customer_id);
$stmt_orders->execute();
$result_orders = $stmt_orders->get_result();

$sql_customer = "SELECT * FROM customer WHERE customer_id = ?";
$stmt_customer = $conn->prepare($sql_customer);
$stmt_customer->bind_param("i", $customer_id);
$stmt_customer->execute();
$result_customer = $stmt_customer->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <style>
        /* CSS cho trang giỏ hàng */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #007bff;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php
    $row_customer = $result_customer->fetch_assoc();
    $customer_name = $row_customer['full_name'];
    ?>
    <h1>Giỏ Hàng của <?php echo $customer_name; ?></h1>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Ngày Đặt Hàng</th>
                <th>Tổng Tiền</th>
                <th>Chi Tiết</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            while ($row_order = $result_orders->fetch_assoc()) {
                $order_id = $row_order['order_id'];
                $order_date = $row_order['order_date'];

                // Truy vấn để tính tổng tiền của đơn hàng
                $sql_total_amount = "SELECT SUM(total_amount) AS total FROM order_details WHERE order_id = ?";
                $stmt_total_amount = $conn->prepare($sql_total_amount);
                $stmt_total_amount->bind_param("i", $order_id);
                $stmt_total_amount->execute();
                $result_total_amount = $stmt_total_amount->get_result();
                $row_total_amount = $result_total_amount->fetch_assoc();
                $total_amount = $row_total_amount['total'];

                echo "<tr>";
                echo "<td>$count</td>";
                echo "<td>$order_date</td>";
                echo "<td>$total_amount</td>";
                echo "<td><a href='order_details.php?order_id=$order_id'>Xem Chi Tiết</a></td>";
                echo "</tr>";

                $count++;
            }
            ?>
        </tbody>
    </table>
</body>

</html>