<!DOCTYPE html>
<html>
<head>
    <title>Quản lý đơn hàng</title>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: 100px auto;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

h1 {
    text-align: center;
    color: #333;
}

table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 20px;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #f5f5f5;
}

a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
</style></head>
<body>
    <div class="container">
        <h1>Quản lý đơn hàng</h1>

        <?php
        // Kết nối cơ sở dữ liệu
        $conn = new mysqli("localhost", "root", "", "dbtrangsuc");

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // Truy vấn dữ liệu từ bảng orders
        $sql = "SELECT o.id, o.name, o.number, o.email, o.total_price, o.placed_on, o.payment_status
                FROM orders o";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Tên khách hàng</th><th>Số điện thoại</th><th>Email</th><th>Tổng tiền</th><th>Ngày đặt hàng</th><th>Trạng thái thanh toán</th><th>Chi tiết</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["number"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . number_format($row["total_price"], 0, ',', '.') . " VNĐ</td>";
                echo "<td>" . $row["placed_on"] . "</td>";
                echo "<td>" . $row["payment_status"] . "</td>";
                echo "<td><a href='view/order_details.php?order_id=" . $row["id"] . "'>Xem chi tiết</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Không có đơn hàng nào";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>