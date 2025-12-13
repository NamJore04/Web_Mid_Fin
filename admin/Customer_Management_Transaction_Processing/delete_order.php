<?php
include 'db.php';
$conn = open_database();
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_order'])) {
    $transaction_id = $_POST['transaction_id'];

    $sql_delete = "DELETE FROM transaction WHERE transaction_id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $transaction_id);

    if ($stmt_delete->execute()) {
        $_SESSION['message'] = "Đã xóa thành công sản phẩm.";
    } else {
        $_SESSION['error'] = "Có lỗi xảy ra. Vui lòng thử lại.";
    }

    header("Location: check_info_cus.php");
    exit();
}
?>
