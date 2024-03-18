<style>
.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh; /* Sử dụng min-height thay vì height để tránh hiện tượng tràn nội dung */
    background-color: #f8f9fa; /* Màu nền */
}

.form-container {
    width: 400px;
    margin-bottom: 20px;
    background-color: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Bóng đổ */
    transition: transform 0.3s ease-in-out;
}

.form-container:hover {
    transform: translateY(-3px); /* Hiệu ứng nhấn nút */
}

input[type="text"],
input[type="file"],
select {
    width: calc(100% - 22px); /* Sử dụng calc để tránh tràn khỏi khung */
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 10px;
    border: 1px solid #ced4da; /* Màu viền input */
    border-radius: 4px;
    box-sizing: border-box;
    background-color: #f8f9fa; /* Màu nền input */
    color: #495057; /* Màu chữ input */
}

input[type="submit"] {
    background-color: #7B68EE; /* Màu nút */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
    margin-top: 10px; /* Căn giữa nút ấn */
}

input[type="submit"]:hover {
    background-color: #0056b3; /* Màu hover của nút */
}

img {
    width: 50px;
    height: 50px;
}

/* Hiệu ứng khi focus vào input */
input[type="text"]:focus,
input[type="file"]:focus,
select:focus {
    border-color: #4CAF50;
    box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
}

/* Animation cho form-container */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-container {
    animation: slideIn 0.5s ease-out;
}

h2 {
    text-align: center; /* Căn giữa tiêu đề */
}

    
</style>

<body>
    <div class="container">
        <div class="form-container">
            <h2>Thêm Sản Phẩm</h2>
            <form method="post" enctype="multipart/form-data" id="addProductForm">
                Tên Sản Phẩm: <input type="text" name="name" required><br>
                Giá Sản Phẩm: <input type="text" name="price" required pattern="[0-9]+"><br>
                Mô Tả: <input type="text" name="method" required><br>
                Hình Ảnh: <input type="file" name="image" required><br>
                Số Lượng: <input type="text" name="qty" required pattern="[0-9]+"><br>
                Loại: 
                <select name="id_type" required>
                    <?php
                        // Kết nối CSDL và truy vấn các loại sản phẩm
                        $conn = mysqli_connect("localhost", "root", "", "dbtrangsuc");
                        $result = mysqli_query($conn, "SELECT * FROM typle");
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='".$row['id']."'>".$row['name_typle']."</option>";
                        }
                    ?>
                </select><br>
                <input type="submit" value="Thêm" name="submit_product">
            </form>
        </div>
        <div class="form-container">
            <h2>Thêm Phân Loại</h2>
            <form method="post">
                Tên Loại: <input type="text" name="tenloai" required><br>
                <input type="submit" value="Thêm" name="submit_category">
            </form>
        </div>
    </div>
    <?php
        // Kết nối CSDL
        $conn = mysqli_connect("localhost", "root", "", "dbtrangsuc");

        // Xử lý thêm sản phẩm khi nhấn nút "Thêm"
        if(isset($_POST['submit_product'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $method = $_POST['method'];
            $image = $_FILES['image']['name'];
            $qty = $_POST['qty'];
            $id_type = $_POST['id_type'];

            $target_file = $target_dir . basename($_FILES["image"]["name"]);

            // Upload file hình ảnh
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

            // Thêm sản phẩm vào CSDL
            $sql = "INSERT INTO products (name, price, method, image, qty, id_typle) VALUES ('$name', '$price', '$method', '$image', '$qty', '$id_type')";
            if(mysqli_query($conn, $sql)) {
                // Thông báo thành công
                echo "<script>alert('Thêm sản phẩm thành công!');</script>";
                echo "<script>window.location.href = window.location.href;</script>";
                exit; // Đảm bảo không có mã HTML hoặc mã PHP khác sau chuyển hướng
            } else {
                echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        // Xử lý thêm phân loại
        if(isset($_POST['submit_category'])) {
            $tenloai = $_POST['tenloai'];

            // Kiểm tra xem loại đã tồn tại trong CSDL chưa
            $check_query = mysqli_query($conn, "SELECT * FROM typle WHERE name_typle='$tenloai'");
            if(mysqli_num_rows($check_query) == 0) {
                // Nếu loại chưa tồn tại, thêm mới vào CSDL
                $sql = "INSERT INTO typle (name_typle) VALUES ('$tenloai')";
                if(mysqli_query($conn, $sql)) {
                    // Thông báo thành công
                    echo "<script>alert('Thêm loại sản phẩm thành công!');</script>";
                    echo "<script>window.location.href = window.location.href;</script>";
                    exit; // Đảm bảo không có mã HTML hoặc mã PHP khác sau chuyển hướng
                } else {
                    echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                // Nếu loại đã tồn tại, hiển thị thông báo lỗi
                echo "<script>alert('Loại sản phẩm này đã tồn tại!')</script>";
            }
        }

        // Đóng kết nối CSDL
        mysqli_close($conn);
    ?>
</body>
</html>
