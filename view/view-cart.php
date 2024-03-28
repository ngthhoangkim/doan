<?php
session_start(); // Start the session if it's not already started

// Initialize $cart variable properly
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// echo "<pre>";
// print_r($cart);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Thiết lập border và margin cho bảng */
        table {
            border-collapse: collapse;
            width: 70%;
            margin: 20px auto; /* căn giữa bảng và tạo khoảng cách 20px trên và dưới */
        }
        
        /* Thiết lập màu nền và đường viền cho thẻ th */
        th {
            background-color: #f2f2f2;
            border: 1px solid #dddddd;
            padding: 8px;
        }
        
        /* Thiết lập đường viền cho thẻ td */
        td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: center; /* căn giữa nội dung trong ô */
        }
        
        /* Thiết lập màu nền cho hàng chẵn */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Thiết lập style cho input và button trong td */
        td input[type="text"] {
            width: 50px; /* Độ rộng của input */
            padding: 5px;
            box-sizing: border-box; /* Đảm bảo kích thước của input bao gồm cả border và padding */
        }

        td button[type="submit"] {
            padding: 5px 10px;
            background-color: #4CAF50; /* Màu nút */
            color: white; /* Màu chữ */
            border: none;
            cursor: pointer;
        }

        td button[type="submit"]:hover {
            background-color: #45a049; /* Màu nút khi hover */
        }
        a.mot {
    text-decoration: none; /* loại bỏ gạch chân */
    background-color: #f44336; /* màu nền */
    color: white; /* màu chữ */
    padding: 5px 10px; /* độ lớn của padding */
    border-radius: 3px; /* bo tròn các góc */
}

a.mot:hover {
    background-color: #d32f2f; /* màu nền khi hover */
}

    </style>
</head>
<body>

<div class="panel-body">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Ảnh sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($cart as $key => $value): ?>
        <tr>
            <td><?php echo $key ?></td>
            <td><img src="../admin/update_img/<?php echo $value['image'] ?>" alt="" width="100px"></td>
            <td><?php echo $value['name'] ?></td>
            <td>
                <input type="text" name="quantity[]" value="<?php echo $value['quantity'] ?>">
                <button type="submit">Cập nhật</button>
            </td>
            <td><?php echo $value['price'] ?></td>
            <td><a href="" class= 'mot'>xóa</a></td>
        </tr>
    <?php endforeach ?>
        </tbody>
    </table>
</div>

</body>
</html>
