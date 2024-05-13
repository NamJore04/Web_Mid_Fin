<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset user password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            width: 80%;
            max-width: 400px;
        }

        .btn {
            display: inline-block;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #218838;
        }

        .alert {
            background-color: #dc3545;
            color: #fff;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php
        $error = '';
        $email = '';
        if (isset($_POST['email'])) {
            $email = $_POST['email'];

            if (empty($email)) {
                $error = 'Please enter your email';
            }
            else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
                $error = 'This is not a valid email address';
            }
            else {
                // reset password
                echo 'good';
            }
        }
    ?>
    <div class="container">
        <div class="card">
            <h3 class="text-center text-secondary mt-5 mb-3">Reset Password</h3>
            <form method="post" action="" class="mb-5">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" id="email" type="text" class="form-control" placeholder="Email address" value="<?= $email ?>">
                </div>
                <div class="form-group">
                    <p>If your email exists in the database, you will receive an email containing the reset password instructions.</p>
                </div>
                <div class="form-group">
                    <?php
                        if (!empty($error)) {
                            echo "<div class='alert'>$error</div>";
                        }
                    ?>
                    <button class="btn">Reset password</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
