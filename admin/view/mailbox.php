<!DOCTYPE html>
<html>

<head>
    <title>Quản lý Liên hệ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 100px;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            text-align: center;
            /* Thêm để căn giữa tiêu đề */
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            /* Thêm màu cho tiêu đề */
        }

        table {
            width: 100%;
            border-collapse: collapse;
           
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            text-align: center;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        th {
            background-color: #116A7B;
            color: white;
        }

        .delete-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .delete-btn:hover {
            background-color: #da190b;
        }

        .container {
            /* background:url("../public/img/nen.jpg"); */
            background-size: cover;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Quản lý Liên hệ</h1>
        <?php
        // Kết nối đến cơ sở dữ liệu
        $servername = "localhost";
        $username = "root"; // Thay username bằng username của bạn
        $password = ""; // Thay password bằng password của bạn
        $dbname = "dbtrangsuc"; // Thay tên cơ sở dữ liệu của bạn
        
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
        }

        // Xử lý xóa dữ liệu nếu được yêu cầu
        if (isset($_POST['delete_id'])) {
            $delete_id = $_POST['delete_id'];
            $sql = "DELETE FROM lienhe WHERE id=$delete_id";
            if ($conn->query($sql) === TRUE) {
                exit();
            } else {
                echo "Lỗi khi xóa: " . $conn->error;
            }
        }

        // Lấy dữ liệu từ bảng lienhe
        $sql = "SELECT id, ten, gmail, sodt, noidung FROM lienhe";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Hiển thị dữ liệu dưới dạng bảng
            echo "<table><tr><th>Tên</th><th>Email</th><th>Số điện thoại</th><th>Nội dung</th><th>Thao tác</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["ten"] . "</td><td>" . $row["gmail"] . "</td><td>" . $row["sodt"] . "</td><td>" . $row["noidung"] . "</td><td><form method='post' action=''><input type='hidden' name='delete_id' value='" . $row["id"] . "'><button type='submit' class='delete-btn'>Xóa</button></form></td></tr>";
            }
            echo "</table>";
        } else {
            echo "Không có dữ liệu";
        }
        $conn->close();
        ?>
    </div>
</body>

</html>