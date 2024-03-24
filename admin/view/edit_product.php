<style>
    main {
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
</style>

<?php
    $conn = mysqli_connect("localhost","root","","dbtrangsuc");
    if (isset($_GET['edit_id'])) {
        $editId = $_GET['edit_id'];
        $select = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$editId'");
        $fetch = mysqli_fetch_assoc($select);

        if(isset($_GET['submit'])){
            //cập nhật thông tin văn bản
            $update_name = mysqli_real_escape_string($conn, $_POST['new_name']);
            $update_price = mysqli_real_escape_string($conn, $_POST['new_price']);
            $update_method = mysqli_real_escape_string($conn, $_POST['new_method']);
            $update_qty = mysqli_real_escape_string($conn, $_POST['new_qty']);
            $update_type = mysqli_real_escape_string($conn, $_POST['new_type']);

            mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price', method = '$update_method', qty = '$update_qty', id_type = $new_type WHERE id = '$$editId'") or die('Cập nhật thất bại');

            //cập nhật ảnh
            if (!empty($_FILES['new_img']['name'])) {
                $update_image = $_FILES['new_img']['name'];
                $update_image_tmp_name = $_FILES['new_img']['tmp_name'];
                $update_image_folder = '../update_img/' . $update_image;
    
                // Xóa ảnh cũ trước khi cập nhật ảnh mới
                unlink('../admin/update_img/' . $fetch['image']);
    
                move_uploaded_file($update_image_tmp_name, $update_image_folder);
                mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$editId'") or die('Cập nhật thất bại');
            }
        }
    }
?>
<body>
    <main>
        <div class="form-container">
            <h2>Sửa Sản Phẩm</h2>
            <form action="" method="post">
            Tên Sản Phẩm: <input type="text" name="new_name" value="<?php echo $fetch['name']; ?>"><br>
            Giá Sản Phẩm: <input type="text" name="new_price" value="<?php echo $fetch['price']; ?>" required pattern="[0-9]+"><br>
            Mô Tả: <input type="text" name="new_method" value="<?php echo $fetch['method']; ?>"><br>
            Hình Ảnh: <input type="file" name="new_img" value=""><br>
            Số Lượng: <input type="text" name="new_qty" value="<?php echo $fetch['qty']; ?>" required pattern="[0-9]+"><br>
            Loại:
                <select name="new_type" required>
                    <?php
                        $conn = mysqli_connect("localhost", "root", "", "dbtrangsuc");
                        $result = mysqli_query($conn, "SELECT * FROM type");
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='".$row['id']."'>".$row['name_type']."</option>";
                        }
                    ?>
                </select><br>
            <input type="submit" value="Cập nhật" name="update_product">
            </form>
        </div>
    </main>
</body>
    
