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

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy thông tin sản phẩm từ form
    $product_id = $_POST['product_id'];

    // Lấy thông tin sản phẩm từ cơ sở dữ liệu
    $sql_product = "SELECT * FROM tbl_product WHERE product_id = $product_id";
    $result_product = $conn->query($sql_product);
    $product = $result_product->fetch_assoc();
}
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

            // echo $customer_id;
            // $_SESSION['customer_id'] = $_GET['customer_id'];
            ?>
            <input type="hidden" name="customer_id" class="form-control" value="<?php echo $customer_id; ?>">

            <label for="product_id">Chọn Sản Phẩm:</label>
            <select name="product_id" class="form-control" required>
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
            <input type="number" name="quantity" class="form-control" min="1" value="1" required>
            <!-- <form action="process_order.php" method="post">
                <input type="text" name="barcode" placeholder="Nhập mã vạch sản phẩm">
                <input type="submit" value="Tìm kiếm">
            </form> -->

            <!-- <button id="add-product-btn" class="btn">Thêm Sản Phẩm</button> -->
            <input type="submit" value="Thêm Vào Đơn Hàng" class="btn">
            <a href="index.php" class="btn">Quay lại Trang Chính</a>
        </form>


        <?php if (isset($product)) : ?>
            <h3>Thông tin sản phẩm vừa nhập:</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <!-- Thêm các cột khác tương ứng với các trường trong bảng tbl_product -->
                </tr>
                <tr>
                    <td><?php echo $product['product_id']; ?></td>
                    <td><?php echo $product['product_name']; ?></td>
                    <!-- Hiển thị các trường khác của sản phẩm -->
                </tr>
            </table>
        <?php endif; ?>


    </div>
</body>

</html>