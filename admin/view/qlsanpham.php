<style>
    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background-color: #f8f9fa;
        margin-top: 80px;
    }

    .form-container {
        width: 400px;
        margin-bottom: 20px;
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }

    .form-container:hover {
        transform: translateY(-3px);
    }

    input[type="text"],
    input[type="file"],
    select {
        width: calc(100% - 22px);
        padding: 10px;
        margin-top: 5px;
        margin-bottom: 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        box-sizing: border-box;
        background-color: #f8f9fa;
        color: #495057;
    }

    input[type="submit"] {
        background-color: #116A7B;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
        margin-top: 10px;
    }

    input[type="submit"]:hover {
        background-color: #088395;
    }

    img {
        width: 50px;
        height: 50px;
    }

    input[type="text"]:focus,
    input[type="file"]:focus,
    select:focus {
        border-color: black;
        box-shadow: white;
    }

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

    .form-container h2 {
        text-align: center;
    }
    a{
        text-decoration: none;
        text-align: center;
        color:#116A7B; 
        margin-bottom: 20px; 
        margin-top: 20px
    }

    a:hover{
        text-decoration:underline;
    }
    .container{
         background:url("../public/img/nen.jpg");
         background-size:cover;
      }
      .form-container {
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
    background-color: rgba(255, 255, 255, 0.3); /* Màu nền và độ trong suốt */
    text-align: center;
    width: 500px;
}
</style>
</head>
<body>
    <main>
        <div class="container">
            <a href="../admin/index.php?act=view_product"><h2>Xem danh sách sản phẩm</h2></a>
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
                            $conn = mysqli_connect("localhost", "root", "", "dbtrangsuc");
                            $result = mysqli_query($conn, "SELECT * FROM type");
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='".$row['id']."'>".$row['name_type']."</option>";
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
            $conn = mysqli_connect("localhost", "root", "", "dbtrangsuc");

            if(isset($_POST['submit_product'])) {
                $name = $_POST['name'];
                $price = $_POST['price'];
                $method = $_POST['method'];
                $qty = $_POST['qty'];
                $id_type = $_POST['id_type'];

                $image = $_FILES['image']['name'];
                $image_tmp = $_FILES['image']['tmp_name'];

                // Kiểm tra sản phẩm có tồn tại không dựa trên tên và hình ảnh
                $check_query = mysqli_query($conn, "SELECT * FROM products WHERE name='$name' OR image='$image'");
                if(mysqli_num_rows($check_query) > 0) {
                    echo "<script>alert('Sản phẩm đã tồn tại!');</script>";
                } else {
                    // Nếu sản phẩm không trùng, tiến hành thêm vào CSDL
                    $target_dir = "../admin/update_img/";
                    $target_file = $target_dir . basename($_FILES["image"]["name"]);

                    move_uploaded_file($image_tmp, $target_file);

                    $sql = "INSERT INTO products (name, price, method, image, qty, id_type) VALUES ('$name', '$price', '$method', '$image', '$qty', '$id_type')";
                    if(mysqli_query($conn, $sql)) {
                        echo "<script>alert('Thêm sản phẩm thành công!');</script>";
                        echo "<script>window.location.href = window.location.href;</script>";
                        exit;
                    } else {
                        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
            }

            if(isset($_POST['submit_category'])) {
                $tenloai = $_POST['tenloai'];

                $check_query = mysqli_query($conn, "SELECT * FROM type WHERE name_type='$tenloai'");
                if(mysqli_num_rows($check_query) == 0) {
                    $sql = "INSERT INTO type (name_type) VALUES ('$tenloai')";
                    if(mysqli_query($conn, $sql)) {
                        echo "<script>alert('Thêm loại sản phẩm thành công!');</script>";
                        echo "<script>window.location.href = window.location.href;</script>";
                        exit;
                    } else {
                        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
                    }
                } else {
                    echo "<script>alert('Loại sản phẩm này đã tồn tại!')</script>";
                }
            }

            mysqli_close($conn);
        ?>     
    </main>
</body>
</html>
