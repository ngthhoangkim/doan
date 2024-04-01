<?php
$conn = mysqli_connect('localhost','root','','dbtrangsuc') or die('Kết nối thất bại');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Truy vấn dữ liệu từ bảng orders
$sql = "SELECT o.id, o.name, o.number, o.email, o.total_price, o.placed_on, o.payment_status 
       FROM orders o";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản lý đơn hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 100px 0px 0px 0px       }

        .container {
            max-width: 1200px;
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

        .status-form {
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Quản lý đơn hàng</h1>
        <?php
        if (isset($_GET['success'])) {
            echo "<p style='color:green;'>Cập nhật trạng thái đơn hàng thành công!</p>";
        }
        if (isset($_GET['error'])) {
            echo "<p style='color:red;'>Cập nhật trạng thái đơn hàng thất bại!</p>";
        }
        ?>
        <table>
            <tr>
                <th>Tên khách hàng</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Tổng tiền</th>
                <th>Ngày đặt hàng</th>
                <th>Trạng thái thanh toán</th>
                <th>Chi tiết</th>
            </tr>
            <?php if (mysqli_num_rows($result) > 0) { ?>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["number"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo number_format($row["total_price"], 0, ',', '.') . " VNĐ"; ?></td>
                        <td><?php echo $row["placed_on"]; ?></td>
                        <td>
                            <form class="status-form" method="post" action="view/update_order_status.php">
                                <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                <select name="payment_status">
                                    <option value="chưa giao" <?php if ($row['payment_status'] == 'chưa giao') echo 'selected'; ?>>chưa giao</option>
                                    <option value="đã giao" <?php if ($row['payment_status'] == 'đã giao') echo 'selected'; ?>>Hoàn tất</option>
                                </select>
                                <button type="submit">Cập nhật</button>
                            </form>
                        </td>
                        <td><a href="order_details.php?id=<?php echo $row['id']; ?>">Xem chi tiết</a></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="7">Không có đơn hàng nào.</td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>