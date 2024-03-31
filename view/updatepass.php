<?php
include '../model/connectdb.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id_user'];

if (isset($_POST['update_pass'])) {
    $old_pass = md5(mysqli_real_escape_string($conn, $_POST['old_pass']));
    $new_pass = md5(mysqli_real_escape_string($conn, $_POST['new_pass']));
    $confirm_pass = md5(mysqli_real_escape_string($conn, $_POST['confirm_pass']));

    if (empty($old_pass) || empty($new_pass) || empty($confirm_pass)) {
        $message[] = 'Vui lòng điền đầy đủ thông tin.';
    } else {
        $result = mysqli_query($conn, "SELECT password FROM users WHERE id = '$user_id'");
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $db_password = $row['password'];

            if ($db_password != $old_pass) {
                $message[] = 'Mật khẩu cũ không đúng.';
            } elseif ($new_pass != $confirm_pass) {
                $message[] = 'Mật khẩu mới và xác nhận mật khẩu không khớp.';
            } else {
                $update_query = mysqli_query($conn, "UPDATE users SET password = '$new_pass' WHERE id = '$user_id'");
                if ($update_query) {
                    $message[] = 'Cập nhật mật khẩu thành công!';
                } else {
                    $message[] = 'Cập nhật thất bại. Vui lòng thử lại sau.';
                }
            }
        } else {
            $message[] = 'Không tìm thấy người dùng.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ĐỔI MẬT KHẨU</title>
    <link rel="apple-touch-icon" href="../public/img/logotron.png">
    <link rel="shortcut icon" type="../public/image/x-icon" href="../public/img/logotron.png">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;600&display=swap');
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .form-container {
            width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: center;
            color: #333;
        }

        .box {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #116A7B;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #088395;
        }

        .error-msg {
            color: red;
            display: block;
            margin-top: 5px;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .form-container {
                width: 90%;
            }
        }

        a {
            padding: 10px 0 0 0;
            color: #088395;
            /* Màu chữ */
            text-decoration: none;
            /* Loại bỏ gạch chân mặc định */
            border-bottom: 2px solid transparent;
            /* Đường viền dưới */
            transition: border-color 0.3s ease;
            /* Hiệu ứng chuyển đổi màu đường viền */
            display: inline-block;
            /* Để có thể căn giữa */
        }

        a:hover {
            border-color: #088395;
            /* Màu đường viền khi di chuột qua */
        }

        /* Căn giữa */
        a {
            text-align: center;
            width: 100%;
        }

        body {
            background: url("../public/img/nen.jpg");
            background-size: cover;
        }

        .form-container {
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
            background-color: rgba(255, 255, 255, 0.3);
            /* Màu nền và độ trong suốt */
            text-align: center;
            width: 500px;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Đổi mật khẩu</h3>
            <?php
            if (isset($message)) {
                foreach ($message as $msg) {
                    echo '<span  class="error-msg">' . $msg . '</span>';
                }
                ;
            }
            ;
            ?>
            <input type="password" name="old_pass" placeholder="Nhập mật khẩu cũ" class="box">
            <input type="password" name="new_pass" placeholder="Nhập mật khẩu mới" class="box">
            <input type="password" name="confirm_pass" placeholder="Xác nhận mật khẩu mới" class="box">
            <button type="submit" name="update_pass">Cập nhật</button>
            <a href="../index.php">Trang chủ</a>
        </form>
    </div>
</body>

</html>