<?php
include 'db.php';
require('vendor/autoload.php');

$conn = open_database();
session_start();
function generateInvoice($transactions, $customer_info, $total_amount, $given_amount, $change) {
    $pdf = new FPDF();
    $pdf->AddPage();

    // Add a header
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');
    $pdf->Ln(10);

    // Customer Information
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetFillColor(200, 220, 255);
    $pdf->Cell(0, 10, 'Customer Information', 0, 1, 'L', true);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, 'Customer Name: ' . $customer_info['full_name'], 0, 1);
    $pdf->Cell(0, 10, 'Phone Number: ' . $customer_info['phone_number'], 0, 1);
    $pdf->Cell(0, 10, 'Address: ' . $customer_info['address'], 0, 1);
    // $pdf->Cell(0, 10, 'Staff: ' . $user_id, 0, 1);
    $pdf->Ln(10);


    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Invoice Information', 0, 1, 'L', true);

    // Table Header
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->Cell(40, 10, 'Order ID', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Product ID', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Quantity', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Unit Price', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Total Amount', 1, 0, 'C', true);
    $pdf->Ln();

    // Table Content
    $pdf->SetFont('Arial', '', 10);
    foreach ($transactions as $transaction) {
        $pdf->Cell(40, 10, $transaction['order_id'], 1);
        $pdf->Cell(40, 10, $transaction['product_id'], 1);
        $pdf->Cell(40, 10, $transaction['quantity'], 1);
        $pdf->Cell(40, 10, number_format($transaction['unit_price'], 2) . ' VND', 1);
        $pdf->Cell(40, 10, number_format($transaction['total_amount'], 2) . ' VND', 1);
        $pdf->Ln();
    }

    $pdf->Ln(10);
    // Summary
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 10, 'Total Amount:', 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 10, number_format($total_amount, 2) . ' VND', 0, 1);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 10, 'Given Amount:', 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 10, number_format($given_amount, 2) . ' VND', 0, 1);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 10, 'Change:', 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 10, number_format($change, 2) . ' VND', 0, 1);

    // Save the invoice as a file
    $invoice = 'invoice/' . $_SESSION['order_id'] . '_' . $customer_info['phone_number'] . '_invoice.pdf';
    $pdf->Output('F', $invoice);
}


// Handle the payment process
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_payment'])) {
    $customer_id = $_POST['customer_id'];
    $given_amount = $_POST['given_amount'];
    $total_amount = $_POST['total_amount'];

    // Calculate the change
    $change = $given_amount - $total_amount;
    if($change < 0) {
        $_SESSION['message'] = "Thanh toán không thành công. Số tiền khách hàng đưa không đủ.";
        header("Location: check_info_cus.php");
        exit();
    }

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
    if ($result_transaction->num_rows > 0) {
        while ($transaction = $result_transaction->fetch_assoc()) {
            $transactions[] = $transaction;
        }
        $user_id = $_SESSION['user_id'];

        // Generate PDF invoice
        generateInvoice($transactions, $customer_info, $total_amount, $given_amount, $change, $user_id);

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
        $_SESSION['message'] = "Thanh toán thành công. Hóa đơn được tạo.";
        header("Location: check_info_cus.php");
        exit();
    } else {
        // Redirect or show error message
        $_SESSION['message'] = "Thanh toán không thành công. Vì đơn hàng không sản phẩm nào.";
        header("Location: check_info_cus.php");
        exit();
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pay'])) {
    $customer_id = $_POST['customer_id'];
    $total_amount = $_POST['total_amount'];
    // Display the payment processing page
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thanh Toán</title>
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
        </style>
    </head>

    <body>
        <div class="container">
            <h2>Thanh Toán</h2>
            <div class="info">
                <label for="total_amount">Tổng Số Tiền:</label>
                <p><?php echo number_format($total_amount, 2) . ' VND'; ?></p>
            </div>
            <form method="post" action="">
                <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
                <div class="info">
                    <label for="given_amount">Số Tiền Khách Hàng Đưa:</label>
                    <input type="number" name="given_amount" required>
                </div>
                <div class="btn-container">
                    <button type="submit" name="confirm_payment" class="btn">Xác Nhận Thanh Toán</button>
                    <a href="check_info_cus.php" class="btn">Quay Lại</a>
                </div>
            </form>
        </div>
    </body>

    </html>

<?php
} else {
    header("Location: check_info_cus.php");
    exit();
}
?>