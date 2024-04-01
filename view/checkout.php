<?php
include '../model/connectdb.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Kiểm tra người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit;
}

// Lấy giỏ hàng từ session
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

// Xử lý khi người dùng submit form thanh toán
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
    $user_id = $_SESSION['id_user'];
    $total_products = count($cart); // Số lượng sản phẩm trong giỏ hàng
    $total_price = 0;

    // Tính tổng giá trị đơn hàng
    foreach ($cart as $product) {
        $total_price += $product['price'] * $product['quantity'];
    }

    // Lưu đơn hàng vào bảng orders
    $placed_on = date('Y-m-d H:i:s');
    $payment_status = 'chưa giao hàng '; // Tình trạng thanh toán

    $sql = "INSERT INTO orders (user_id, name, number, email, method, address, total_products, total_price, placed_on, payment_status) 
            VALUES ('$user_id', '$name', '$phone', '$email', '$payment_method', '$address', '$total_products', '$total_price', '$placed_on', '$payment_status')";

    if (mysqli_query($conn, $sql)) {
        $order_id = mysqli_insert_id($conn);

        // Lưu chi tiết đơn hàng vào bảng order_details
        foreach ($cart as $product) {
            $product_id = $product['id'];
            $quantity = $product['quantity'];
            $price = $product['price'];
            $sql_details = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$price')";
            mysqli_query($conn, $sql_details);
        }

        // Xóa dữ liệu liên quan trong bảng cart
        $sql_delete = "DELETE FROM cart WHERE user_id = '$user_id'";
        mysqli_query($conn, $sql_delete);

        // Xóa giỏ hàng trong session
        unset($_SESSION['cart']);

        // Chuyển hướng đến trang thông báo thanh toán thành công
        header('Location: order_success.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Thanh toán</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="apple-touch-icon" href="../public/img/logotron.png"> <!--chỉnh logo trên tiêu đề  -->
    <link rel="shortcut icon" type="../public/image/x-icon" href="../public/img/logotron.png"><!--chỉnh logo trên tiêu đề  -->

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .payment-box {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            display: flex;
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
        }

        .left-side {
            background-color: #008B8B;
            color: #ECE5C7 ;
            padding: 40px;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .left-side h2 {
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
        }

        .left-side p {
            font-size: 16px;
            line-height: 1.6;
        }

        .right-side {
            padding: 40px;
            width: 50%;
            
        }

        .right-side h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        form .form-group {
            margin-bottom: 20px;
        }

        form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 14px;
        }

        form input[type="text"],
        form input[type="email"],
        form textarea {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            font-size: 16px;
        }

        form select {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            font-size: 16px;
        }

        form button {
            background-color:#008B8B;
            border: none;
            color: #ECE5C7 ;
            cursor: pointer;
            padding: 12px 24px;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        form button:hover {
            background-color: #fff;
            color: black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            text-align: center;
            font-size: 10px;
        }

        /* table th {
            background-color: #f2f2f2;
        } */

        table img {
            max-width: 80px;
            height: auto;
        }
        .container{
            background:url("../public/img/nen.jpg");
         background-size:cover;
      }

        
    </style>
</head>
<body>
    <div class="container">
        <div class="payment-box">
            <div class="left-side">
                <h2>Sản phẩm cần thanh toán</h2>
                <?php
                if (!empty($cart)) {
                    echo '<table>';
                    echo '<tr><th>Ảnh sản phẩm</th><th>Tên sản phẩm</th><th>Số lượng</th><th>Đơn giá</th><th>Thành tiền</th></tr>';
                    $total = 0;
                    foreach ($cart as $product) {
                        $subtotal = $product['price'] * $product['quantity'];
                        $total += $subtotal;
                        echo '<tr>';
                        echo '<td><img src="../admin/update_img/' . $product['image'] . '" alt="' . $product['name'] . '"></td>';
                        echo '<td>' . $product['name'] . '</td>';
                        echo '<td>' . $product['quantity'] . '</td>';
                        echo '<td>' . number_format($product['price'], 0, ',', '.') . ' đ</td>';
                        echo '<td>' . number_format($subtotal, 0, ',', '.') . ' đ</td>';
                        echo '</tr>';
                    }
                    echo '<tr><td colspan="4" style="text-align:right;"><strong>Tổng cộng:</strong></td><td><strong>' . number_format($total, 0, ',', '.') . ' đ</strong></td></tr>';
                    echo '</table>';
                } else {
                    echo '<p>Giỏ hàng trống.</p>';
                }
                ?>
            </div>
            <div class="right-side">
                <h2>Thông tin thanh toán</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="form-group">
                        <label for="name">Tên:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại:</label>
                        <input type="text" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ:</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Lời nhắn:</label>
                        <textarea id="message" name="message"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="payment_method">Hình thức thanh toán:</label>
                        <select id="payment_method" name="payment_method" required>
                            <option value="">Chọn hình thức thanh toán</option>
                            <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                            <option value="online">Thanh toán online</option>
                        </select>
                        <button type="button" onclick="window.location.href='view-cart.php'">Quay về trang giỏ hàng</button>
                        <button type="submit" style="float: right;">Thanh toán</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>