<?php
// Bắt đầu phiên làm việc
session_start();

// Include file kết nối đến cơ sở dữ liệu
include 'db.php';
$conn = open_database();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Truy vấn để lấy thông tin chi tiết đơn hàng
    $sql_transaction = "SELECT * FROM transaction WHERE order_id = ?";
    $stmt_transaction = $conn->prepare($sql_transaction);
    $stmt_transaction->bind_param("i", $order_id);
    $stmt_transaction->execute();
    $result_transaction = $stmt_transaction->get_result();

    // Lấy thông tin đơn hàng (ngày đặt hàng)
    $sql_order_info = "SELECT order_date FROM orders WHERE order_id = ?";
    $stmt_order_info = $conn->prepare($sql_order_info);
    $stmt_order_info->bind_param("i", $order_id);
    $stmt_order_info->execute();
    $result_order_info = $stmt_order_info->get_result();
    $row_order_info = $result_order_info->fetch_assoc();
    $order_date = $row_order_info['order_date'];
} else {
    // Nếu không có tham số order_id trong URL, chuyển hướng về trang trước đó hoặc trang khác
    // header("Location: previous_page.php");
    // header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng</title>
    <style>
        /* CSS cho trang chi tiết đơn hàng */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 70%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
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
            /* color: #007bff; */
            color: #fff;
            text-decoration: none;
        }

        /* a:hover {
            text-decoration: underline;
        } */

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
    </style>
</head>

<body>
    <!-- Hiển thị thông tin chi tiết đơn hàng -->
    <div class="container">
        <h1>Chi Tiết Đơn Hàng</h1>
        <h2>Thông tin đơn hàng</h2>
        <p><strong>Ngày Đặt Hàng:</strong> <?php echo $order_date; ?></p>

        <h2>Danh sách sản phẩm trong đơn hàng</h2>
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Ảnh</th>
                    <th>Số Lượng</th>
                    <th>Đơn Giá</th>
                    <th>Tổng Tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                while ($row_order_detail = $result_transaction->fetch_assoc()) {
                    $product_id = $row_order_detail['product_id'];
                    $quantity = $row_order_detail['quantity'];
                    $unit_price = $row_order_detail['unit_price'];
                    $total_amount_per_product = $quantity * $unit_price;

                    // Truy vấn để lấy thông tin sản phẩm từ bảng sản phẩm
                    $sql_product_info = "SELECT product_name,product_img FROM tbl_product WHERE product_id = ?";
                    $stmt_product_info = $conn->prepare($sql_product_info);
                    $stmt_product_info->bind_param("i", $product_id);
                    $stmt_product_info->execute();
                    $result_product_info = $stmt_product_info->get_result();
                    $row_product_info = $result_product_info->fetch_assoc();
                    $product_name = $row_product_info['product_name'];
                    $product_img = $row_product_info['product_img'];

                    echo "<tr>";
                    echo "<td>$count</td>";
                    echo "<td>$product_name</td>";
                    echo "<td><img src='../Product_Catalog_Management/uploads/$product_img' alt='$product_name' style='width: 100px; height: 100px;'></td>";
                    echo "<td>$quantity</td>";
                    echo "<td>$unit_price</td>";
                    echo "<td>$total_amount_per_product</td>";
                    echo "</tr>";

                    $count++;
                }

                // $phone =  $_SESSION['phone_number'];
                // echo $phone;
                // unset($_SESSION['customer_id']);
                // unset($_SESSION['order_id']);

                ?>
            </tbody>
        </table>


        <!-- <button class="btn" style="    margin: auto; display: flex;"><a href="check_info_cus.php?phone_number=<?php //echo $phone; 
                                                                                                                    ?>">Quay lại</a></button> -->
        <button class="btn" style="    margin: auto; display: flex;"><a href="check_info_cus.php">Quay lại</a></button>
    </div>
</body>

</html>