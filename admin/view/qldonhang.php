<!DOCTYPE html>
<html>
<head>
    <title>Quản lý đơn hàng</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .sp{
            padding: 80px 50px 50px ;
        }
    </style>
</head>
<body>
    <div class="sp">
    <h2>Quản lý đơn hàng</h2>
    <table>
        <tr>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Tổng tiền</th>
            <th>Ngày đặt</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
        <?php
        // Kết nối cơ sở dữ liệu
        $conn = new mysqli("localhost", "root", "", "dbtrangsuc");

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // Truy vấn dữ liệu từ bảng orders
        $sql = "SELECT * FROM orders";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['number'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['total_price'] . "</td>";
                echo "<td>" . $row['placed_on'] . "</td>";
                echo "<td>" . $row['payment_status'] . "</td>";
                echo "<td>
                    <a href='xoa_don_hang.php?order_id=" . $row['id'] . "'>Xóa</a>
                    <a href='cap_nhat_trang_thai.php?order_id=" . $row['id'] . "'>xác nhận</a>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>Không có đơn hàng nào</td></tr>";
        }

        $conn->close();
        ?>
    </table>
    </div>
</body>
</html>