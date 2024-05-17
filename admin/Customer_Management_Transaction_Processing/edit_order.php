<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_order'])) {
    $transaction_id = $_POST['transaction_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];
    $total_amount = $_POST['total_amount'];
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chỉnh Sửa Đơn Hàng</title>
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
            h3 {
                text-align: center;
                color: #007bff;
                margin-bottom: 20px;
            }
            .edit-form {
                margin: 0 auto;
                max-width: 400px;
            }
            .edit-form label {
                display: block;
                margin-bottom: 8px;
                font-weight: bold;
            }
            .edit-form input[type="text"],
            .edit-form input[type="number"] {
                width: 100%;
                padding: 10px;
                margin-bottom: 20px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            .edit-form .btn {
                display: inline-block;
                padding: 10px 20px;
                border: none;
                background-color: #007bff;
                color: #fff;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
                text-align: center;
                text-decoration: none;
                transition: background-color 0.3s ease;
            }
            .edit-form .btn:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="edit-form">
                <h3>Chỉnh sửa đơn hàng</h3>
                <form method="post" action="check_info_cus.php">
                    <input type="hidden" name="transaction_id" value="<?php echo $transaction_id; ?>">
                    <label for="product_id">Mã sản phẩm:</label>
                    <input type="text" name="product_id" value="<?php echo $product_id; ?>" readonly>
                    <label for="quantity">Số lượng:</label>
                    <input type="number" name="quantity" min="1" value="<?php echo $quantity; ?>">
                    <label for="unit_price">Giá đơn vị:</label>
                    <input type="number" name="unit_price" value="<?php echo $unit_price; ?>">
  
                    <button type="submit" name="update_order" class="btn">Cập nhật</button>
                </form>
            </div>
        </div>
    </body>
    </html>
    <?php
}
?>
