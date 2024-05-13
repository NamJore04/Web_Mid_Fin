<?php
// Kết nối đến cơ sở dữ liệu
$conn = new mysqli('localhost', 'root', '', 'n21_web');

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Thực hiện truy vấn SQL để lấy dữ liệu
$sql_cartegory = "SELECT * FROM tbl_cartegory";
$result_cartegory = $conn->query($sql_cartegory);

$sql_brand = "SELECT * FROM tbl_brand";
$result_brand = $conn->query($sql_brand);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="grid.css">
    <link rel="stylesheet" href="style.css">
    <title>Ivy</title>
</head>

<body>

    <!-- Header -->
    <header class="header">
        <div class="logo">
            <a href="index.php">
                <!-- <img src="img/logo.png" alt=""> -->
                <i class="header__logo-img fa-brands fa-shopify">G21</i>

            </a>
        </div>
        <div class="menu">

            <?php
            if ($result_cartegory->num_rows > 0) {
                while ($row = $result_cartegory->fetch_assoc()) {
                    echo "<li><a href='cartegory.php'>" . $row["cartegory_name"] . "</a>";

                    echo '<ul class="sub-menu">';
                    mysqli_data_seek($result_brand, 0);
                    while ($row_brand = $result_brand->fetch_assoc()) {
                        if ($row["cartegory_id"] == $row_brand["cartegory_id"]) {
                            echo '<li><a>' . $row_brand["brand_name"] . '</a></li>';
                        }
                    }
                    echo '</ul>';

                    echo "</li>";
                }
            } else {
                echo "<li>Không có dữ liệu</li>";
            }
            ?>
            
        </div>
        <div class="others">
            <li><input placeholder="Tìm kiếm" type="text"><i class="fa-solid fa-magnifying-glass"></i></li>
            <li><i class="fa-solid fa-paw"></i></li>
            <li><i class="fa-solid fa-bag-shopping"></i></li>
            <li><i class="fa-solid fa-user"></i></li>
        </div>
    </header>

