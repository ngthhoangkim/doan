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
<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header('location: ../login/login.php');
    exit;
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
};
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Xóa sản phẩm khỏi giỏ hàng
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($cart[$id]);
    $_SESSION['cart'] = $cart;
}

// Cập nhật số lượng sản phẩm
if (isset($_POST['update'])) {
    $quantities = $_POST['quantity'];
    foreach ($cart as $id => $product) {
        if (isset($quantities[$id])) {
            $cart[$id]['quantity'] = $quantities[$id];
        }
    }
    $_SESSION['cart'] = $cart;
}
?>
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
                    <th>Thành tiền</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($cart as $id => $product):
                    $subtotal = $product['price'] * $product['quantity'];
                    $total += $subtotal;
                    ?>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><img src="../admin/update_img/<?php echo $product['image']; ?>" alt="" width="100px"></td>
                        <td><?php echo $product['name']; ?></td>
                        <td>
                            <form method="post">
                                <input type="number" name="quantity[<?php echo $id; ?>]" value="<?php echo $product['quantity']; ?>" min="1">
                                <button type="submit" name="update">Cập nhật</button>
                            </form>
                        </td>
                        <td><?php echo number_format($product['price'], 0, ',', '.'); ?> đ</td>
                        <td><?php echo number_format($subtotal, 0, ',', '.'); ?> đ</td>
                        <td><a href="?remove=<?php echo $id; ?>" class="mot">Xóa</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5">Tổng cộng</th>
                    <th><?php echo number_format($total, 0, ',', '.'); ?> đ</th>
                    <th><a href="#" class="btn btn-primary">Thanh toán</a></th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>

</html>
