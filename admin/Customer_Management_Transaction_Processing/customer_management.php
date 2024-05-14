<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập Số Điện Thoại Khách Hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
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

        label {
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        button[type="button"] {
            padding: 10px 20px;
            border: none;
            background-color: #6c757d;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button[type="button"]:hover {
            background-color: #5a6268;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Nhập Số Điện Thoại Khách Hàng</h2>
        <form method="post" action="check_info_cus.php">
            <label for="phone">Số Điện Thoại:</label><br>
            <input type="text" id="phone" name="phone_number" required><br><br>
            <input type="submit" value="Kiểm tra">
            <a href="index.php">Thoát</a>
        </form>
    </div>
</body>

</html>
<?php 
session_start();
unset($_SESSION['cus_phone_number']);
?>