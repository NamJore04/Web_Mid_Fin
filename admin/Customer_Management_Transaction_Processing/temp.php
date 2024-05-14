<?php
session_start();

// Include file kết nối đến cơ sở dữ liệu
include 'db.php';
$conn = open_database();

// Khởi tạo giỏ hàng nếu chưa tồn tại
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Xử lý thêm sản phẩm vào giỏ hàng từ tìm kiếm theo tên hoặc mã vạch
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
        if (array_key_exists($product_id, $_SESSION['cart'])) {
            // Nếu sản phẩm đã tồn tại, tăng số lượng
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
        } else {
            // Nếu chưa tồn tại, thêm sản phẩm mới vào giỏ hàng
            $sql_product = "SELECT * FROM tbl_product WHERE product_id = $product_id";
            $result_product = $conn->query($sql_product);
            if ($result_product->num_rows > 0) {
                $row = $result_product->fetch_assoc();
                $_SESSION['cart'][$product_id] = array(
                    'product_id' => $row['product_id'],
                    'product_name' => $row['product_name'],
                    'price' => $row['price'],
                    'quantity' => $quantity
                );
            }
        }
    }
}

// Xử lý xoá sản phẩm khỏi giỏ hàng
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    if (array_key_exists($product_id, $_SESSION['cart'])) {
        unset($_SESSION['cart'][$product_id]);
    }
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
        <form method="POST" action="">
            <!-- <input type="hidden" name="customer_id" class="form-control" value=""> -->
            <?php
            $customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : '';
            $_SESSION['customer_id'] =  $customer_id;
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

            <input type="submit" value="Thêm Vào Đơn Hàng" class="btn">
            <a href="index.php" class="btn">Quay lại Trang Chính</a>
        </form>

        <form method="POST" action="">
            <!-- Existing form fields... -->

            <label for="search_term">Tìm kiếm:</label>
            <input type="text" name="search_term" class="form-control" placeholder="Nhập từ khóa tìm kiếm">
            <input type="submit" value="Tìm kiếm" class="btn">
        </form>

        <?php if ($result_products->num_rows > 0) : ?>
            <h3>Danh sách sản phẩm:</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh</th>
                    <th>Thêm vào đơn hàng</th>
                </tr>
                <?php
                // Đặt con trỏ về đầu kết quả truy vấn
                $result_products->data_seek(0);
                while ($row = $result_productsfetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['product_id']; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><img src="../Product_Catalog_Management/uploads/<?php echo $row['product_img']; ?>" alt="<?php echo $row['product_name']; ?>" style="width: 100px;height: 100px;"></td>
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                <input type="hidden" name="quantity" value="1">
                                <input type="submit" value="Thêm vào đơn hàng" class="btn">
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else : ?>
            <p>Không có sản phẩm nào.</p>
        <?php endif; ?>
        <!-- Danh sách sản phẩm đang chọn -->
        <h2>Danh sách sản phẩm đang chọn</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Xoá</th>
            </tr>
            <?php foreach ($_SESSION['cart'] as $item) : ?>
                <tr>
                    <td><?php echo $item['product_id']; ?></td>
                    <td><?php echo $item['product_name']; ?></td>
                    <td><?php echo $item['price']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo $item['price'] * $item['quantity']; ?></td>
                    <td><a href="?action=delete&product_id=<?php echo $item['product_id']; ?>">Xoá</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Form nhập thông tin thanh toán -->
        <h2>Thông tin thanh toán</h2>
        <form method="POST" action="">
            <!-- Các trường thông tin thanh toán -->
            <input type="submit" name="payment" value="Thanh toán">
        </form>
    </div>
</body>

</html>