<?php
// Bắt đầu phiên làm việc
session_start();

// Include file kết nối đến cơ sở dữ liệu
include 'db.php';
$conn = open_database();

// Kiểm tra xem có dữ liệu được gửi từ form hay không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    unset($_SESSION['order_id']);
    // Lấy thông tin từ form
    $customer_id = $_POST['customer_id'];
    if (isset($_POST['barcode'])) {
    $barcode = $_POST['barcode'];
    $sql_search = "SELECT * FROM tbl_product WHERE barcode = ?";
    $stmt_search = $conn->prepare($sql_search);
    $stmt_search->bind_param("s", $barcode);
    $stmt_search->execute();
    $result_search = $stmt_search->get_result();
    if ($result_search->num_rows > 0) {
        // Hiển thị thông tin sản phẩm
    } else {
        echo "Không tìm thấy sản phẩm với mã vạch: " . $barcode;
    }
}
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Thực hiện truy vấn để lấy thông tin sản phẩm
    $sql_product = "SELECT * FROM tbl_product WHERE product_id = ?";
    $stmt_product = $conn->prepare($sql_product);
    $stmt_product->bind_param("i", $product_id);
    $stmt_product->execute();
    $result_product = $stmt_product->get_result();

    // Kiểm tra xem sản phẩm có tồn tại trong cơ sở dữ liệu không
    if ($result_product->num_rows > 0) {
        // Lấy thông tin của sản phẩm
        $row_product = $result_product->fetch_assoc();
        $product_name = $row_product['product_name'];
        $unit_price = $row_product['product_price_new']; // Lấy giá sản phẩm

        // Tính tổng tiền cho sản phẩm trong đơn hàng
        $total_amount = $unit_price * $quantity;

        // Thực hiện truy vấn để thêm sản phẩm vào đơn hàng
        $sql_add_to_order = "INSERT INTO order_details (order_id, product_id, quantity, unit_price, total_amount) 
                             VALUES (?, ?, ?, ?, ?)";
        $stmt_add_to_order = $conn->prepare($sql_add_to_order);

        // Lấy order_id từ session hoặc tạo mới nếu chưa tồn tại
        if (!isset($_SESSION['order_id'])) {
            $sql_create_order = "INSERT INTO orders (customer_id, order_date) VALUES (?, NOW())";
            $stmt_create_order = $conn->prepare($sql_create_order);
            $stmt_create_order->bind_param("i", $customer_id);
            $stmt_create_order->execute();

            // Lấy order_id của đơn hàng mới tạo
            $order_id = $stmt_create_order->insert_id;

            // Lưu order_id vào session để sử dụng cho các sản phẩm tiếp theo
            $_SESSION['order_id'] = $order_id;
        } else {
            // Lấy order_id từ session
            $order_id = $_SESSION['order_id'];
        }

        // Bind parameters và thực thi truy vấn
        $stmt_add_to_order->bind_param("iiidd", $order_id, $product_id, $quantity, $unit_price, $total_amount);
        if ($stmt_add_to_order->execute()) {
            $_SESSION['order_success'] = true;


            $sql_create_transaction = "INSERT INTO `transaction` (product_id, customer_id, quantity, unit_price, total_amount, payment_date) 
            VALUES (?, ?, ?, ?, ?, NOW())";
            $stmt_create_transaction = $conn->prepare($sql_create_transaction);
            $stmt_create_transaction->bind_param("iiidd", $product_id, $customer_id, $quantity, $unit_price, $total_amount);
            $stmt_create_transaction->execute();
            // $sql_create_purchase_history = "INSERT INTO purchase_history (customer_id, product_id, quantity, unit_price, total_amount, payment_date) 
            // VALUES (?, ?, ?, ?, ?, ?, NOW())";
            // $stmt_create_purchase_history = $conn->prepare($sql_create_purchase_history);
            // $stmt_create_purchase_history->bind_param("iiiiidd", $customer_id, $order_id, $product_id, $quantity, $unit_price, $total_amount);
            // $stmt_create_purchase_history->execute();
        } else {
            $_SESSION['order_failure'] = true;
        }

        // Đóng kết nối và statement
        $stmt_add_to_order->close();
        $stmt_product->close();
        $conn->close();

        // Chuyển hướng đến trang thông báo
        header("Location: order_notification.php");
        exit();
    } else {
        // Nếu không tìm thấy sản phẩm, chuyển hướng đến trang thông báo
        $_SESSION['order_failure'] = true;
        header("Location: order_notification.php");
        exit();
    }
} else {
    // Nếu không có dữ liệu được gửi từ form, chuyển hướng về trang thông báo
    $_SESSION['order_failure'] = true;
    header("Location: order_notification.php");
    exit();
}
