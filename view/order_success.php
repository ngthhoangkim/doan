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

$user_id = $_SESSION['id_user'];

// Lấy thông tin đơn hàng mới nhất
$sql = "SELECT o.*, od.*, p.name AS product_name, p.image AS product_image
        FROM orders o
        JOIN order_details od ON o.id = od.order_id
        JOIN products p ON od.product_id = p.id
        WHERE o.user_id = '$user_id'
        ORDER BY o.placed_on DESC
        LIMIT 1";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $order = mysqli_fetch_assoc($result);
} else {
    echo "Không tìm thấy đơn hàng.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thông tin đơn hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 80px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thông tin đơn hàng</h1>
        <table>
            <tr>
                <th>Ảnh sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
            <?php
            $total_price = 0;
            do {
                $product_price = $order['price'] * $order['quantity'];
                $total_price += $product_price;
                ?>
                <tr>
                    <td><img src="<?php echo $order['product_image']; ?>" alt="<?php echo $order['product_name']; ?>"></td>
                    <td><?php echo $order['product_name']; ?></td>
                    <td><?php echo $order['quantity']; ?></td>
                    <td><?php echo number_format($order['price'], 0, ',', '.'); ?> đ</td>
                    <td><?php echo number_format($product_price, 0, ',', '.'); ?> đ</td>
                </tr>
                <?php
            } while ($order = mysqli_fetch_assoc($result));
            ?>
            <tr>
                <td colspan="4" style="text-align:right;"><strong>Tổng cộng:</strong></td>
                <td><strong><?php echo number_format($total_price, 0, ',', '.'); ?> đ</strong></td>
            </tr>
        </table>
    </div>
</body>
</html>