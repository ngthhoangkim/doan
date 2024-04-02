<?php
$conn = mysqli_connect('localhost', 'root', '', 'dbtrangsuc') or die('Kết nối thất bại');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Lấy order_id từ URL
$order_id = $_GET["id"];

// Truy vấn dữ liệu từ bảng order_details
$sql = "SELECT od.product_id, p.name, od.price, od.quantity
        FROM order_details od
        JOIN products p ON od.product_id = p.id
        WHERE od.order_id = $order_id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chi tiết đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0 auto; /* Căn giữa theo chiều ngang */
            padding: 20px;
            width: 70%; /* Thu nhỏ form lại thành 70% */
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Chi tiết đơn hàng #<?php echo $order_id; ?></h1>
    <?php if (mysqli_num_rows($result) > 0) { ?>
        <table>
            <tr>
                <th>Sản phẩm</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <?php $total_price = $row["price"] * $row["quantity"]; ?>
                <tr>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo number_format($row["price"], 0, ',', '.') . " VNĐ"; ?></td>
                    <td><?php echo $row["quantity"]; ?></td>
                    <td><?php echo number_format($total_price, 0, ',', '.') . " VNĐ"; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>Không có chi tiết đơn hàng.</p>
    <?php } ?>
</body>
</html>
<?php
mysqli_close($conn);
?>
