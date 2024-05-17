<?php
include 'db.php';
require('vendor/autoload.php');
$conn = open_database();
session_start();

?>

<?php
// Function to generate invoice PDF
function generateInvoice($transactions, $customer_info)
{
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, 'Customer Name: ' . $customer_info['full_name'], 0, 1);
    $pdf->Cell(0, 10, 'Phone Number: ' . $customer_info['phone_number'], 0, 1);
    $pdf->Cell(0, 10, 'Address: ' . $customer_info['address'], 0, 1);
    $pdf->Ln(10);

    $pdf->Cell(40, 10, 'Product ID', 1);
    $pdf->Cell(40, 10, 'Quantity', 1);
    $pdf->Cell(40, 10, 'Unit Price', 1);
    $pdf->Cell(40, 10, 'Total Amount', 1);
    $pdf->Ln();

    foreach ($transactions as $transaction) {
        $pdf->Cell(40, 10, $transaction['product_id'], 1);
        $pdf->Cell(40, 10, $transaction['quantity'], 1);
        $pdf->Cell(40, 10, $transaction['unit_price'], 1);
        $pdf->Cell(40, 10, $transaction['total_amount'], 1);
        $pdf->Ln();
    }
    $invoice =  $customer_info['phone_number'] . '_' . $_SESSION['order_id'] . '_invoice.pdf';

    $pdf->Output('F', 'invoice/' . $invoice);
}
// Handle payment
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pay']) && isset($_SESSION['order_id'])) {
    $customer_id = $_POST['customer_id'];

    // Update payment status or save payment information
    // For demonstration, we'll assume payment is successful

    // Fetch customer info
    $sql_customer_info = "SELECT * FROM customer WHERE customer_id = ?";
    $stmt_customer_info = $conn->prepare($sql_customer_info);
    $stmt_customer_info->bind_param("i", $customer_id);
    $stmt_customer_info->execute();
    $result_customer_info = $stmt_customer_info->get_result();
    $customer_info = $result_customer_info->fetch_assoc();

    // Fetch transactions
    $sql_transaction = "SELECT * FROM transaction WHERE customer_id = ? AND is_order = 1";
    $stmt_transaction = $conn->prepare($sql_transaction);
    $stmt_transaction->bind_param("i", $customer_id);
    $stmt_transaction->execute();
    $result_transaction = $stmt_transaction->get_result();

    $transactions = [];
    while ($transaction = $result_transaction->fetch_assoc()) {
        $transactions[] = $transaction;
    }

    // Generate PDF invoice
    generateInvoice($transactions, $customer_info);

    // Update transactions to mark them as history
    $sql_update_transaction = "UPDATE transaction SET is_order = 0 WHERE customer_id = ? AND is_order = 1";
    $stmt_update_transaction = $conn->prepare($sql_update_transaction);
    $stmt_update_transaction->bind_param("i", $customer_id);
    $stmt_update_transaction->execute();

    $sql_update_orders = "UPDATE orders SET is_order = 0 WHERE customer_id = ? AND is_order = 1 AND order_id = ?";
    $stmt_update_orders = $conn->prepare($sql_update_orders);
    $stmt_update_orders->bind_param("ii", $customer_id, $_SESSION['order_id']);
    $stmt_update_orders->execute();

    // Redirect or show success message
    $_SESSION['sucs'] = "Thanh toán thành công. Hóa đơn được tạo.";
    header("Location: check_info_cus.php");
    exit();
} else {
    // $_SESSION['message'] = 'Không có đơn hàng nào.';
}
?>


<!-- update order -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_order'])) {
    $transaction_id = $_POST['transaction_id'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];
    $total_amount = $_POST['unit_price'] * $_POST['quantity'];

    $sql_update_transaction = "UPDATE transaction SET quantity = ?, unit_price = ?, total_amount = ? WHERE transaction_id = ?";
    $stmt_update_transaction = $conn->prepare($sql_update_transaction);
    $stmt_update_transaction->bind_param("iddi", $quantity, $unit_price, $total_amount, $transaction_id);

    if ($stmt_update_transaction->execute()) {
    }
}
?>



<?php
// delete payment
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_his_payment'])) {
    // $customer_id = $_POST['customer_id'];

    

    // Delete transaction records where is_order is equal to 0
    $sql_delete_transaction = "DELETE FROM transaction WHERE is_order = 0";
    $stmt_delete_transaction = $conn->prepare($sql_delete_transaction);
    $stmt_delete_transaction->execute();
}
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

        .btn:last-child {
            margin-right: 0;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }


        .btn-delete {
            background-color: #dc3545;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-delete:hover {

            background-color: #c82333;
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

        .total-amount {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">

        <h2>Kiểm Tra Thông Tin Khách Hàng</h2>
        <?php


        if (isset($_SESSION['sucs'])) {
            echo '<p style="color: green;">' . $_SESSION['sucs'] . '</p>';
            unset($_SESSION['sucs']);
        }

        if (isset($_SESSION['error'])) {
            echo '<p style="color: red;">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }

        $phone = isset($_SESSION['cus_phone_number']) ? $_SESSION['cus_phone_number'] : $_POST['phone_number'];
        $_SESSION['cus_phone_number'] = $phone;





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


            $sql_orders = "SELECT * FROM orders WHERE order_id = ?";
            $stmt_orders = $conn->prepare($sql_orders);
            $stmt_orders->bind_param("i", $_SESSION['order_id']);
            $stmt_orders->execute();
            $result_orders = $stmt_orders->get_result();


            while ($order_row = $result_orders->fetch_assoc()) {
                if ($order_row['is_order'] == 1) {
                    // echo $_SESSION['order_id'];
                    // Hiển thị thông tin đơn hàng
                    if ($result_transaction->num_rows > 0) {
                        echo '<div class="purchase-history">';
                        echo '<h3>Đơn hàng:</h3>';
                        echo '<table>';
                        $total_all_amounts = 0;
                        echo '<tr><th>Ngày Mua</th><th>Mã sản phẩm</th><th>Số Lượng</th><th>Giá Đơn Vị</th><th>Tổng Tiền</th><th>Chỉnh sửa</th><th>Xóa</th></tr>';
                        while ($purchase_row = $result_transaction->fetch_assoc()) {
                            if ($purchase_row['is_order'] == 1) {
                                echo '<tr>';
                                echo '<td>' . $purchase_row['payment_date'] . '</td>';
                                echo '<td>' . $purchase_row['product_id'] . '</td>';
                                echo '<td>' . $purchase_row['quantity'] . '</td>';
                                echo '<td>' . $purchase_row['unit_price'] . '</td>';
                                echo '<td>' . $purchase_row['total_amount'] . '</td>';
                                echo '<td>';
                                echo '<form method="post" action="edit_order.php">';
                                echo '<input type="hidden" name="transaction_id" value="' . $purchase_row['transaction_id'] . '">';
                                echo '<input type="hidden" name="product_id" value="' . $purchase_row['product_id'] . '">';
                                echo '<input type="hidden" name="quantity" value="' . $purchase_row['quantity'] . '">';
                                echo '<input type="hidden" name="unit_price" value="' . $purchase_row['unit_price'] . '">';
                                echo '<input type="hidden" name="total_amount" value="' . $purchase_row['total_amount'] . '">';
                                echo '<button type="submit" name="edit_order" class="btn">Sửa</button>';
                                echo '</form>';
                                echo '</td>';

                                echo '<td>';
                                echo '<form form method="post" action="delete_order.php">';
                                echo '<input type="hidden" name="transaction_id" value="' . $purchase_row['transaction_id'] . '">';
                                echo '<button type="submit" name="delete_order" class="btn btn-delete">Xóa</button>';
                                echo '</form>';
                                echo '</td>';
                                echo '</tr>';
                                $total_all_amounts += $purchase_row['total_amount'];
                            }
                        }
                        echo '</table>';
                        echo '</div>';
                        echo '<div class="total-amount">Tổng số tiền: ' . number_format($total_all_amounts, 2) . ' VND</div>';
                    }
                } else {
                    // echo '<p>Không có thông tin lịch sử đơn hàng.</p>';
                    echo '<p>Không có đơn hàng.</p>';
                }
            }
        } else {
            header("Location: register_acc_cus.php?phone_number=$phone");
            exit();
        }
        ?>

        <?php
        // Kiểm tra khi nút "Xem lịch sử mua hàng" được nhấn
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['history_payment'])) {
            // Lấy customer_id từ form
            $customer_id = $_POST['customer_id'];

            // Truy vấn lịch sử đơn hàng từ bảng transaction
            $sql_history_payment = "SELECT * FROM transaction WHERE customer_id = ? AND is_order = 0";
            $stmt_history_payment = $conn->prepare($sql_history_payment);
            $stmt_history_payment->bind_param("i", $customer_id);
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
                echo '<tr>';
                echo '<td colspan="5">';
                echo '<form form method="post" action="">';
                echo '<button type="submit" name="delete_his_payment" style = "display: flex;margin: auto;"  class="btn btn-delete">Xóa lịch sử</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
                echo '</table>';
                echo '</div>';
            } else {
                // Nếu không có lịch sử đơn hàng
                echo '<p>Không có lịch sử mua hàng.</p>';
            }
        }
        ?>


        <div class="btn-container">
            <a href="order_management.php?customer_id=<?php echo $customer_id; ?>" class="btn">Thêm sản phẩm mới</a>
            <a href="customer_management.php" class="btn">Kiểm Tra Số Điện Thoại Khác</a>
            <a href="../index.php" class="btn">Trở về Trang Nhân Viên</a>
            <!-- <a href="payment.php" class="btn">Thanh toán</a> -->
            <form method="post" action="" style="margin-top:10px;">
                <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                <a href=""><button type="submit" name="pay" class="btn">Thanh toán</button></a>

                <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                <a href=""><button type="submit" name="history_payment" class="btn">Xem lịch sử mua hàng</button></a>

            </form>
        </div>

    </div>
</body>

</html>