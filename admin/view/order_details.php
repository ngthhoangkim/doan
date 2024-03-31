<!DOCTYPE html>
<html>
<head>
    <title>Chi tiết đơn hàng</title>
    <!-- Thêm Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Tùy chỉnh CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 200px ;
        }
        h2 {
            color: #333;
            text-align: center;
            margin-top: 30px;
        }
        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #343a40;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    <?php
    // Kết nối cơ sở dữ liệu
    $conn = new mysqli("localhost", "root", "", "dbtrangsuc");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Lấy order_id từ URL
    $order_id = $_GET["order_id"];

    // Truy vấn dữ liệu từ bảng order_details
    $sql = "SELECT od.product_id, p.name, od.price, od.quantity
            FROM order_details od
            JOIN products p ON od.product_id = p.id
            WHERE od.order_id = $order_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Chi tiết đơn hàng #" . $order_id . "</h2>";
        echo "<table class='table table-striped'>";
        echo "<tr><th>Sản phẩm</th><th>Đơn giá</th><th>Số lượng</th><th>Tổng tiền</th></tr>";

        while ($row = $result->fetch_assoc()) {
            $total_price = $row["price"] * $row["quantity"];
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . number_format($row["price"], 0, ',', '.') . " VNĐ</td>";
            echo "<td>" . $row["quantity"] . "</td>";
            echo "<td>" . number_format($total_price, 0, ',', '.') . " VNĐ</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Không có chi tiết đơn hàng";
    }

    $conn->close();
    ?>
</body>
</html>