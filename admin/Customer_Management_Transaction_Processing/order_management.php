<?php
session_start();

include 'db.php';
$conn = open_database();

$sql_products = "SELECT * FROM tbl_product";
$result_products = $conn->query($sql_products);
?>


<?php
// Xử lý tìm kiếm 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_term'])) {
    $search_term = $_POST['search_term'];
    $sql_search = "SELECT * FROM tbl_product WHERE product_name LIKE '%$search_term%' OR barcode LIKE '%$search_term%'";
    $result_products = $conn->query($sql_search);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm mới</title>
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
        <h2>Thêm sản phẩm</h2>

        <form method="POST" action="">
            <input type="hidden" name="customer_id" class="form-control" value="<?php echo $customer_id; ?>">
            <label for="search_term">Tìm kiếm sản phẩm:</label>
            <input type="text" name="search_term" class="form-control" placeholder="Nhập từ khóa tìm kiếm">
            <input type="submit" value="Tìm kiếm" class="btn">

            <a href="check_info_cus.php" class="btn">Quay lại</a>
        </form>
        <form method="POST" action="process_order.php">
            <!-- <input type="hidden" name="customer_id" class="form-control" value=""> -->
            <?php
            $customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : '';
            $_SESSION['customer_id'] =  $customer_id;

            ?>
            <!-- <input type="hidden" name="customer_id" class="form-control" value="<?php echo $customer_id; ?>"> -->

            </select>
            <input type="hidden" name="customer_id" class="form-control" value="<?php echo $customer_id; ?>">

            <!-- <input type="hidden" name="customer_id" class="form-control" value="<?php echo $customer_id; ?>"> -->


            <?php if ($result_products->num_rows > 0) : ?>
                <h3>Danh sách sản phẩm:</h3>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh</th>
                        <!-- <th>Số lượng</th> -->
                        <th>Thêm vào đơn hàng</th>
                        <!-- Thêm các cột khác tương ứng với các trường trong bảng tbl_product -->
                    </tr>
                    <?php
                    // Đặt con trỏ về đầu kết quả truy vấn
                    $result_products->data_seek(0);
                    while ($row = $result_products->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['product_id']; ?></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><img src="../Product_Catalog_Management/uploads/<?php echo $row['product_img']; ?>" alt="<?php echo $row['product_name']; ?>" style="width: 100px;height: 100px;"></td>
                            <!-- <td><input type="number" name="quantity" class="form-control" min="1" value="1" required></td> -->
                            <td>
                                <form method="POST" action="process_order.php">
                                    <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                    <input type="number" name="quantity" class="form-control" min="1" value="1" required style="width: 70px;">
                                    <input type="submit" value="Thêm vào đơn hàng" class="btn">
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else : ?>
                <p>Không có sản phẩm nào.</p>
            <?php endif; ?>
        </form>


        <!-- 
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
            <?php //foreach ($_SESSION['cart'] as $item) : 
            ?>
                <tr>
                    <td><?php //echo $item['product_id']; 
                        ?></td>
                    <td><?php //echo $item['product_name']; 
                        ?></td>
                    <td><?php //echo $item['price']; 
                        ?></td>
                    <td><?php //echo $item['quantity']; 
                        ?></td>
                    <td><?php //echo $item['price'] * $item['quantity']; 
                        ?></td>
                    <td><a href="?action=delete&product_id=<?php //echo $item['product_id']; 
                                                            ?>">Xoá</a></td>
                </tr>
            <?php //endforeach; 
            ?>
        </table> -->

        <!-- Form nhập thông tin thanh toán -->
        <!-- <h2>Thông tin thanh toán</h2> -->




    </div>
</body>

</html>