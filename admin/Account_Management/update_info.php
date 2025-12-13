<?php
session_start();
include 'db.php';
$conn = open_database();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
$message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];

    // Xử lý tải lên ảnh đại diện mới
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $file_tmp_name = $_FILES['avatar']['tmp_name'];
        $file_name = $_FILES['avatar']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_exts = array('jpg', 'jpeg', 'png', 'gif');
        // echo $file_tmp_name;

        if (in_array($file_ext, $allowed_exts)) {
            $new_file_name = 'avatar_' . $user . '.' . $file_ext;
            $upload_dir = 'uploads/';
            $upload_path = $upload_dir . $new_file_name;

            if (move_uploaded_file($file_tmp_name, $upload_path)) {
                // Cập nhật đường dẫn ảnh đại diện trong cơ sở dữ liệu
                $sql_update_img = "UPDATE info_page SET img = '$upload_path' WHERE username = '$user'";
                if ($conn->query($sql_update_img) !== TRUE) {
                    $message = "Có lỗi xảy ra khi cập nhật ảnh đại diện: " . $conn->error;
                }
            } else {
                $message = "Có lỗi xảy ra khi tải lên ảnh đại diện.";
            }
        } else {
            $message = "Định dạng ảnh không hợp lệ. Vui lòng chọn file ảnh có định dạng JPG, JPEG, PNG hoặc GIF.";
        }
    }

    // Tiếp tục cập nhật thông tin người dùng
    $sql_update_info_page = "UPDATE info_page SET dob = '$dob', phone = '$phone' WHERE username = '$user'";
    
    if ($conn->query($sql_update_info_page) === TRUE) {
        $message .= " Thông tin đã được cập nhật thành công!";
    } else {
        $message = "Có lỗi xảy ra khi cập nhật thông tin: " . $conn->error;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Thông Tin</title>
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

        h1 {
            text-align: center;
        }

        .message {
            margin-top: 20px;
            padding: 10px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            border-radius: 4px;
            text-align: center;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Chỉnh Sửa Thông Tin</h1>
        <?php if (!empty($message)) : ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <a href="info_page.php"><button type="button" class="btn">Trở về trang thông tin</button></a>
    </div>
</body>

</html>
