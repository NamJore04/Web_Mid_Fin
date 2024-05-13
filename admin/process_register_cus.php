<?php
session_start();
include 'db.php';
$conn = open_database();

if (!$conn) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];
    $name = $_POST['name'];
    $address = $_POST['address'];

    $sql_check_phone = "SELECT * FROM customer WHERE phone_number = '$phone'";
    $result_check_phone = $conn->query($sql_check_phone);

    if ($result_check_phone->num_rows > 0) {
        $_SESSION['message'] = "Số điện thoại này đã được đăng ký.";
        header("Location: register_acc_cus.php?phone_number=$phone");
        exit();
    } else {
        $sql_insert_customer = "INSERT INTO customer (phone_number, full_name, address) VALUES ('$phone', '$name', '$address')";

        if ($conn->query($sql_insert_customer) === TRUE) {
            $_SESSION['message'] = "Đăng ký thành công!";
            header("Location: register_acc_cus.php");
            exit();
        } else {
            $_SESSION['message'] = "Có lỗi xảy ra khi đăng ký: " . $conn->error;
            header("Location: register_acc_cus.php");
            exit();
        }
    }
} else {
    header("Location: register_acc_cus.php");
    exit();
}

$conn->close();
?>
