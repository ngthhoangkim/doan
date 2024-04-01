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

// Lấy thông tin đơn hàng của người dùng
$sql = "SELECT o.id, o.name, o.number, o.email, o.method, o.address, o.total_price, o.placed_on, o.payment_status, GROUP_CONCAT(od.product_id, ':', od.quantity, ':', od.price SEPARATOR '|') AS order_details
        FROM orders o
        JOIN order_details od ON o.id = od.order_id
        WHERE o.user_id = $user_id
        GROUP BY o.id
        ORDER BY o.placed_on DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            padding-top: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .order-item {
            border: 1px solid #e9ecef;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 5px;
        }

        .order-item h3 {
            color: #333;
            margin-bottom: 10px;
        }

        .order-item p {
            margin: 5px 0;
        }

        .order-item ul {
            list-style-type: none;
            padding: 0;
        }

        .order-item ul li {
            margin-left: 20px;
        }
        .go-back {
        position: absolute;
        left: 50px;
        top: 20px;
        }
        button {
            background-color:#008B8B;
            border: none;
            color: #fff;
            cursor: pointer;
            padding: 12px 24px;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
            
        }

        button:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
    
<button type="button" onclick="window.location.href='../index.php'" class="go-back">Quay về trang chủ</button>
    <div class="container">
        <h1 class="mb-4">Your Orders</h1>
        <?php
        // Hiển thị danh sách đơn hàng
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='order-item'>";
                echo "<div class='row'>";
                echo "<div class='col-md-6'>";
                echo "<p><strong>Name:</strong> " . $row['name'] . "</p>";
                echo "<p><strong>Phone:</strong> " . $row['number'] . "</p>";
                echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
                echo "<p><strong>Payment Method:</strong> " . $row['method'] . "</p>";
                echo "<p><strong>Address:</strong> " . $row['address'] . "</p>";
                echo "</div>";
                echo "<div class='col-md-6'>";
                echo "<p><strong>Total Price:</strong> " . number_format($row['total_price'], 0, ',', '.') . " VNĐ</p>";
                echo "<p><strong>Ordered On:</strong> " . $row['placed_on'] . "</p>";
                echo "<p><strong>trạng thái đơn hàng : </strong> " . $row['payment_status'] . "</p>";
                echo "<h4>Ordered Products:</h4>";
                echo "<ul>";
                $order_details = explode('|', $row['order_details']);
                foreach ($order_details as $detail) {
                    list($product_id, $quantity, $price) = explode(':', $detail);
                    $product_sql = "SELECT name FROM products WHERE id = $product_id";
                    $product_result = $conn->query($product_sql);
                    $product_name = $product_result->fetch_assoc()['name'];
                    echo "<li>$product_name x $quantity (Price: " . number_format($price, 0, ',', '.') . " VNĐ)</li>";
                }
                echo "</ul>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "You don't have any orders.";
        }
        ?>
    </div>
</body>
</html>
