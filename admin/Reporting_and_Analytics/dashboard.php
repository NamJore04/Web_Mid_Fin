<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-right: 10px;
            color: #333;
        }

        select,
        input[type="date"] {
            padding: 8px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        ul {
            padding: 0;
            margin: 0;
            list-style-type: none;
        }

        li {
            background-color: #f0f0f0;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        li:hover {
            background-color: #e0e0e0;
        }

        li form {
            display: flex;
            align-items: center;
        }

        li button {
            padding: 8px 16px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Dashboard</h1>

        <!-- Form cho việc chọn khoảng thời gian -->
        <form action="dashboard.php" method="GET">
            <label for="time_period">Chọn khoảng thời gian:</label>
            <select name="time_period" id="time_period" onchange="toggleCustomDate(this.value)">
                <option value="today">Hôm nay</option>
                <option value="yesterday">Hôm qua</option>
                <option value="last_7_days">Trong vòng 7 ngày qua</option>
                <option value="this_month">Trong tháng này</option>
                <option value="custom">Khoảng thời gian cụ thể</option>
            </select>

            <div id="custom_dates" style="display: none;">
                <label for="start_date">Từ ngày:</label>
                <input type="date" name="start_date" id="start_date">
                <label for="end_date">Đến ngày:</label>
                <input type="date" name="end_date" id="end_date">
            </div>
            <input type="submit" value="Xem báo cáo">

        </form>


        <?php
        include 'db.php';
        session_start();
        $conn = open_database();

        // Lấy dữ liệu từ form nếu có
        $time_period = isset($_GET['time_period']) ? $_GET['time_period'] : '';
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

        // Khởi tạo biến để lưu trữ thông tin báo cáo
        $total_revenue = 0;
        $total_orders = 0;
        $total_products = 0;
        $order_list = [];
        $query = "SELECT SUM(total_amount) AS total_revenue, COUNT(DISTINCT order_id) AS total_orders, SUM(quantity) AS total_products
        FROM transaction
        WHERE payment_date = CURDATE() AND is_order = 0";
        $order_query = "SELECT order_id, customer_id, order_date
              FROM orders
              WHERE DATE(order_date) = CURDATE() AND is_order = 0
              ORDER BY order_date DESC";

        // Xử lý dữ liệu dựa trên khoảng thời gian được chọn
        switch ($time_period) {
            case 'today':
                $query = "SELECT SUM(total_amount) AS total_revenue, COUNT(DISTINCT order_id) AS total_orders, SUM(quantity) AS total_products
                          FROM transaction
                          WHERE payment_date = CURDATE() AND is_order = 0";
                $order_query = "SELECT order_id, customer_id, order_date
                                FROM orders
                                WHERE DATE(order_date) = CURDATE() AND is_order = 0
                                ORDER BY order_date DESC";
                break;
            case 'yesterday':
                $query = "SELECT SUM(total_amount) AS total_revenue, COUNT(DISTINCT order_id) AS total_orders, SUM(quantity) AS total_products
                          FROM transaction
                          WHERE payment_date = DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND is_order = 0";
                $order_query = "SELECT order_id, customer_id, order_date
                                FROM orders
                                WHERE DATE(order_date) = DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND is_order = 0
                                ORDER BY order_date DESC";
                break;
            case 'last_7_days':
                $query = "SELECT SUM(total_amount) AS total_revenue, COUNT(DISTINCT order_id) AS total_orders, SUM(quantity) AS total_products
                          FROM transaction
                          WHERE payment_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() AND is_order = 0";
                $order_query = "SELECT order_id, customer_id, order_date
                                FROM orders
                                WHERE DATE(order_date) BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() AND is_order = 0
                                ORDER BY order_date DESC";
                break;
            case 'this_month':
                $query = "SELECT SUM(total_amount) AS total_revenue, COUNT(DISTINCT order_id) AS total_orders, SUM(quantity) AS total_products
                          FROM transaction
                          WHERE MONTH(payment_date) = MONTH(CURDATE()) AND YEAR(payment_date) = YEAR(CURDATE()) AND is_order = 0";
                $order_query = "SELECT order_id, customer_id, order_date
                                FROM orders
                                WHERE MONTH(order_date) = MONTH(CURDATE()) AND YEAR(order_date) = YEAR(CURDATE()) AND is_order = 0
                                ORDER BY order_date DESC";
                break;
            case 'custom':
                if (!empty($start_date) && !empty($end_date)) {
                    $query = "SELECT SUM(total_amount) AS total_revenue, COUNT(DISTINCT order_id) AS total_orders, SUM(quantity) AS total_products
                              FROM transaction
                              WHERE payment_date BETWEEN '$start_date' AND '$end_date' AND is_order = 0";
                    $order_query = "SELECT order_id, customer_id, order_date
                                    FROM orders
                                    WHERE DATE(order_date) BETWEEN '$start_date' AND '$end_date' AND is_order = 0
                                    ORDER BY order_date DESC";
                } else {
                    echo '<p>Vui lòng chọn cả ngày bắt đầu và ngày kết thúc.</p>';
                }
                break;
            default:
                echo '<p>Vui lòng chọn khoảng thời gian.</p>';
                break;
        }

        // Thực hiện truy vấn SQL nếu có truy vấn
        if (isset($query)) {
            $result = $conn->query($query);
            if ($result && $result->num_rows > 0) {
                // Lấy dữ liệu từ kết quả truy vấn
                $row = $result->fetch_assoc();
                $total_revenue = $row['total_revenue'];
                $total_orders = $row['total_orders'];
                $total_products = $row['total_products'];
            }
        }

        // Thực hiện truy vấn SQL cho danh sách đơn hàng
        if (isset($order_query)) {
            $order_result = $conn->query($order_query);

            // Kiểm tra kết quả truy vấn
            if ($order_result && $order_result->num_rows > 0) {
                // Lặp qua các hàng kết quả và lưu vào danh sách đơn hàng
                while ($order_row = $order_result->fetch_assoc()) {
                    $order_list[] = $order_row;
                }
            }
        }

        $conn->close();
        ?>

        <!-- Hiển thị thông tin tổng quan -->
        <h2>Thông tin tổng quan</h2>
        <p>Tổng số tiền: <?php echo $total_revenue; ?></p>
        <p>Số lượng đơn hàng: <?php echo $total_orders; ?></p>
        <p>Số lượng sản phẩm: <?php echo $total_products; ?></p>
        <button onclick="window.location.href = '../index.php';" style="padding: 8px 16px; background-color: #dc3545; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Return to Index</button>

        <!-- Danh sách các đơn hàng -->
        <h2>Danh sách các đơn hàng</h2>
        <ul>
            <?php
            if (!empty($order_list)) {
                foreach ($order_list as $order) { ?>
                    <li>
                        <span><?php echo $order['order_date']; ?> - ID: <?php echo $order['order_id']; ?></span>
                        <form action="his_payment_detail.php" method="post">
                            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                            <button type="submit" name="his_payment_detail">Xem chi tiết</button>
                        </form>
                    </li>
            <?php
                }
            } else {
                echo '<li>Không có đơn hàng nào</li>';
            } ?>
        </ul>
    </div>

    <script>
        function toggleCustomDate(value) {
            var customDates = document.getElementById('custom_dates');
            if (value === 'custom') {
                customDates.style.display = 'block';
            } else {
                customDates.style.display = 'none';
            }
        }
    </script>
</body>

</html>