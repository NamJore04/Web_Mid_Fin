<?php
include 'db.php';
require('vendor/autoload.php');

$conn = open_database();
session_start();

// Function to generate PDF invoice
function generateInvoice($transactions, $customer_info, $employee_info, $total_amount, $given_amount, $change)
{
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
    $pdf->Ln(10);

    // Employee Information
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetFillColor(200, 220, 255);
    $pdf->Cell(0, 10, 'Employee Information', 0, 1, 'L', true);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, 'Employee Name: ' . $employee_info['firstname'] . ' ' . $employee_info['lastname'], 0, 1);
    $pdf->Cell(0, 10, 'Email: ' . $employee_info['email'], 0, 1);
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


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_invoice'])) {
    // Generate PDF invoice and update transactions
    $customer_id = $_POST['customer_id'];
    $total_amount = $_POST['total_amount'];
    $given_amount = $_POST['given_amount'];
    $change = $given_amount - $total_amount;

    // Fetch customer info
    $sql_customer_info = "SELECT * FROM customer WHERE customer_id = ?";
    $stmt_customer_info = $conn->prepare($sql_customer_info);
    $stmt_customer_info->bind_param("i", $customer_id);
    $stmt_customer_info->execute();
    $result_customer_info = $stmt_customer_info->get_result();
    $customer_info = $result_customer_info->fetch_assoc();

    // Fetch employee info
    $username = $_SESSION['user'];
    $sql_employee_info = "SELECT * FROM account WHERE username = ?";
    $stmt_employee_info = $conn->prepare($sql_employee_info);
    $stmt_employee_info->bind_param("s", $username);
    $stmt_employee_info->execute();
    $result_employee_info = $stmt_employee_info->get_result();
    $employee_info = $result_employee_info->fetch_assoc();

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
        // $user_id = $_SESSION['user_id'];

        // Generate PDF invoice
        generateInvoice($transactions, $customer_info, $employee_info, $total_amount, $given_amount, $change);

        // Update transactions to mark them as history
        $sql_update_transaction = "UPDATE transaction SET is_order = 0 WHERE customer_id = ? AND is_order = 1";
        $stmt_update_transaction = $conn->prepare($sql_update_transaction);
        $stmt_update_transaction->bind_param("i", $customer_id);
        $stmt_update_transaction->execute();

        $sql_update_orders = "UPDATE orders SET is_order = 0 WHERE customer_id = ? AND is_order = 1 AND order_id = ?";
        $stmt_update_orders = $conn->prepare($sql_update_orders);
        $stmt_update_orders->bind_param("ii", $customer_id, $_SESSION['order_id']);
        $stmt_update_orders->execute();

        $_SESSION['message'] = "Thanh toán thành công. Hóa đơn được tạo.";
        header("Location: check_info_cus.php");
        exit();
    } else {
        $_SESSION['message'] = "Thanh toán không thành công. Vì đơn hàng không sản phẩm nào.";
        header("Location: check_info_cus.php");
        exit();
    }
}
