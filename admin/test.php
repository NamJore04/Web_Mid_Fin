<?php
// Bắt đầu phiên làm việc
session_start();

// Include file kết nối đến cơ sở dữ liệu
include 'db.php';
$conn = open_database();

// Lấy danh sách sản phẩm từ cơ sở dữ liệu
$sql_products = "SELECT * FROM tbl_product";
$result_products = $conn->query($sql_products);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Đơn Hàng Mới</title>
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

        form {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Tạo Đơn Hàng Mới</h2>
        <form method="POST" action="process_order.php">
            <!-- <input type="hidden" name="customer_id" class="form-control" value=""> -->
            <?php
            $customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : '';
            $_SESSION['customer_id'] =  $customer_id;
            ?>
            <input type="hidden" name="customer_id" class="form-control" value="<?php echo $customer_id; ?>">

            <div id="product-list">
                <div class="product-item">
                    <label for="product_id">Chọn Sản Phẩm:</label>
                    <select name="product_id[]" class="form-control" required>
                        <option value="">Chọn Sản Phẩm</option>
                        <?php
                        // Hiển thị danh sách sản phẩm để chọn
                        if ($result_products->num_rows > 0) {
                            while ($row = $result_products->fetch_assoc()) {
                                echo '<option value="' . $row['product_id'] . '">' . $row['product_name'] . '</option>';
                            }
                        } else {
                            echo '<option value="" disabled>Không có sản phẩm nào.</option>';
                        }
                        ?>
                    </select>

                    <label for="quantity">Số Lượng:</label>
                    <input type="number" name="quantity[]" class="form-control" min="1" value="1" required>
                </div>
            </div>

            <button id="add-product-btn" class="btn">Thêm Sản Phẩm</button>
            <input type="submit" value="Thêm Vào Đơn Hàng" class="btn">
            <a href="index_employee.php" class="btn">Quay lại Trang Chính</a>
        </form>
    </div>

    <script>
        document.getElementById('add-product-btn').addEventListener('click', function() {
            var productList = document.getElementById('product-list');

            var productItem = document.createElement('div');
            productItem.classList.add('product-item');

            var selectElement = document.createElement('select');
            selectElement.name = 'product_id[]'; // Sử dụng mảng để lưu nhiều sản phẩm
            selectElement.className = 'form-control';
            selectElement.required = true;

            var quantityInput = document.createElement('input');
            quantityInput.type = 'number';
            quantityInput.name = 'quantity[]'; // Sử dụng mảng để lưu số lượng của mỗi sản phẩm
            quantityInput.className = 'form-control';
            quantityInput.min = '1';
            quantityInput.value = '1';
            quantityInput.required = true;

            var productOption = document.createElement('option');
            productOption.value = '';
            productOption.text = 'Chọn Sản Phẩm';
            selectElement.appendChild(productOption);

            <?php
            // Đặt con trỏ của kết quả sản phẩm về đầu trước khi sử dụng nó
            mysqli_data_seek($result_products, 0);
            if ($result_products->num_rows > 0) {
                while ($row = $result_products->fetch_assoc()) {
                    echo "var optionElement = document.createElement('option');";
                    echo "optionElement.value = '{$row['product_id']}';";
                    echo "optionElement.text = '{$row['product_name']}';";
                    echo "selectElement.appendChild(optionElement);";
                }
            } else {
                echo "var disabledOption = document.createElement('option');";
                echo "disabledOption.value = '';";
                echo "disabledOption.text = 'Không có sản phẩm nào.';";
                echo "disabledOption.disabled = true;";
                echo "selectElement.appendChild(disabledOption);";
            }
            ?>

            productItem.appendChild(selectElement);
            productItem.appendChild(document.createTextNode(' ')); // Thêm dấu cách giữa các trường
            productItem.appendChild(quantityInput);

            productList.appendChild(productItem);
        });
    </script>
</body>

</html>
