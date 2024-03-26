<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>ADMIN | LUXURIOUS</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="shortcut icon" type="../../public/image/x-icon" href="../../public/img/logotron.png"><!--chỉnh logo trên tiêu đề -->
    <title>Chỉnh sửa Sản Phẩm</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather+Sans:wght@300;400;500;600&display=swap');

        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f8f9fa;
            margin-top: 80px;
            font-family: 'Merriweather', sans-serif;
;
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

        input[type="text"]:focus,
        input[type="file"]:focus,
        select:focus {
            border-color: black;
            box-shadow: 0 0 5px black;
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

        .back_bnt{
            background-color: #116A7B;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .back_bnt:hover{
            background-color: #088395;
        }
    </style>
</head>
<body>

<?php
    @include '../../model/connectdb.php';
    if (isset($_GET['edit_id'])) {
        $editId = $_GET['edit_id'];
        $select = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$editId'");
        $fetch = mysqli_fetch_assoc($select);

        if(isset($_POST['update_product'])){
            //cập nhật thông tin văn bản
            $update_name = mysqli_real_escape_string($conn, $_POST['new_name']);
            $update_price = mysqli_real_escape_string($conn, $_POST['new_price']);
            $update_method = mysqli_real_escape_string($conn, $_POST['new_method']);
            $update_qty = mysqli_real_escape_string($conn, $_POST['new_qty']);
            $update_type = mysqli_real_escape_string($conn, $_POST['new_type']);

            if (!empty($_FILES['new_img']['name'])) {
                // Xóa ảnh cũ
                $old_image_path = '../update_img/' . $fetch['image'];
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }

                

                // Cập nhật ảnh mới
                if (!empty($_FILES['new_img']['name'])) {
                    $update_image = $_FILES['new_img']['name'];
                    $update_image_tmp_name = $_FILES['new_img']['tmp_name'];
                    $update_image_folder = '../update_img/' . $update_image;

                    move_uploaded_file($update_image_tmp_name, $update_image_folder);
                    mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$editId'") or die('Cập nhật thất bại');
                }
        }
        // Cập nhật thông tin sản phẩm
        mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price', method = '$update_method', qty = '$update_qty', id_type = $update_type WHERE id = '$editId'") or die('Cập nhật thất bại');
        echo "Cập nhật sản phẩm thành công";
    }
}
?>
<main>
    <button class="back_bnt" onclick="window.location.href = '../../admin/index.php?act=view_product';">Quay trở về</button>
    <div class="form-container">
        <h2>Sửa Sản Phẩm</h2>
        <form action="" method="post" enctype="multipart/form-data">
            Tên Sản Phẩm: <input type="text" name="new_name" value="<?php echo $fetch['name']; ?>"><br>
            Giá Sản Phẩm: <input type="text" name="new_price" value="<?php echo $fetch['price']; ?>" required pattern="[0-9]+"><br>
            Mô Tả: <input type="text" name="new_method" value="<?php echo $fetch['method']; ?>"><br>
            Hình Ảnh: <input type="file" name="new_img"><br>
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
</html>