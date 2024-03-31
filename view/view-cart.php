<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="apple-touch-icon" href="../public/img/logotron.png"> <!--chỉnh logo trên tiêu đề  -->
    <link rel="shortcut icon" type="../public/image/x-icon" href="../public/img/logotron.png">
    <!--chỉnh logo trên tiêu đề  -->

    <title>Giỏ hàng</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;600&display=swap');
        body{
            font-family: 'Roboto', sans-serif;
        }
        /* Thiết lập border và margin cho bảng */
        table {
            border-collapse: collapse;
            width: 70%;
            margin: 20px auto;
            /* căn giữa bảng và tạo khoảng cách 20px trên và dưới */
        }

        /* Thiết lập màu nền và đường viền cho thẻ th */
        th {
            font-weight: normal;
            background-color: #f2f2f2;
            border: 1px solid #dddddd;
            padding: 8px;
            color: #116A7B;
        }

        /* Thiết lập đường viền cho thẻ td */
        td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: center;
            /* căn giữa nội dung trong ô */
        }
        /* Thiết lập style cho input và button trong td */
        td input[type="text"] {
            width: 50px;
            /* Độ rộng của input */
            padding: 5px;
            box-sizing: border-box;
        }

        td button[type="submit"] {
            padding: 5px 10px;
            background-color: #116A7B;
            color: #ECE5C7;
            border: none;
            cursor: pointer;
        }

        td button[type="submit"]:hover {
            background-color: #088395;
            /* Màu nút khi hover */
        }

        a.mot {
            text-decoration: none;
            background-color:#116A7B;
            color: #ECE5C7;
            padding: 5px 10px;
            border-radius: 3px;
        }

        a.mot:hover {
            background-color: #088395;
        }

        .back-button {
            margin: 50px;
            text-align: left;
        }
    </style>
</head>
<?php
    session_start();
    @include '../model/connectdb.php';
    function getCartFromDatabase($user_id, $conn) {
        $cart = array();
    
        $query = mysqli_query($conn, "SELECT products.*, cart.price, cart.qty FROM products INNER JOIN cart ON products.id = cart.product_id WHERE cart.user_id = '$user_id'");
        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                $item = array(
                    'id' => $row['id'],
                    'name' => $row['name'], // Tên sản phẩm có thể lấy từ bảng products
                    'image' => $row['image'], // Đường dẫn ảnh sản phẩm cũng có thể lấy từ bảng products
                    'price' => $row['price'],
                    'quantity' => $row['qty']
                );
                $cart[$row['id']] = $item;
            }
        }
        return $cart;
    }
    //bắt buộc đăng nhập mới được thêm sản phẩm vào giỏ 
    if (!isset($_SESSION['id_user'])) {
        header('location: login/login.php');
        exit;
    }else{
        $user_id = $_SESSION['id_user'];
    }
    // Kiểm tra xem phiên session đã được bắt đầu chưa
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    ;
    //khởi tạo giỏ hàng trống
    $cart = getCartFromDatabase($user_id, $conn);

    if (isset($_GET['id'])) {
        // Sử dụng hàm mysqli_real_escape_string để tránh SQL Injection
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        // Thực hiện truy vấn SQL
        $query = mysqli_query($conn, "SELECT * FROM products WHERE id= '$id'");
        // Kiểm tra xem truy vấn có thành công hay không
        if ($query) {
            $product = mysqli_fetch_assoc($query);
        } else {
            // Xử lý lỗi truy vấn ở đây nếu cần
        }
    }

    // Kiểm tra xem $product đã được khởi tạo hay không trước khi sử dụng
    if (isset($product)) {
        $item = [
            'id' => $product['id'],
            'name' => $product['name'],
            'image' => $product['image'],
            'price' => $product['price'],
            'quantity' => 1
        ];

        // Khởi tạo $_SESSION['cart'] nếu chưa tồn tại
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        if (isset($_SESSION['cart'][$id])) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng lên 1
            $_SESSION['cart'][$id]['quantity'] += 1;
             // Cập nhật số lượng trong cơ sở dữ liệu
            if (isset($_SESSION['id_user'])) {
                $user_id = $_SESSION['id_user'];
                $new_quantity = $_SESSION['cart'][$id]['quantity'];
                
                // Sử dụng prepared statement để tránh SQL Injection
                $sql_update = "UPDATE cart SET qty = ? WHERE user_id = ? AND product_id = ?";
                $stmt = $conn->prepare($sql_update);
                $stmt->bind_param("iii", $new_quantity, $user_id, $id);
                
                if ($stmt->execute()) {
                    // Thành công
                    // Redirect hoặc thực hiện các hành động khác tùy thuộc vào yêu cầu của bạn
                    header('Location: view/view-cart.php');
                    exit();
                } else {
                    // Xử lý lỗi nếu cần
                    echo "Error: " . $sql_update . "<br>" . $conn->error;
                }
                $stmt->close();
            }
        } else {
            // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm vào giỏ hàng
            $_SESSION['cart'][$id] = $item;
        }

        if (isset($_SESSION['id_user'])) {
            $user_id = $_SESSION['id_user'];
            $product_id = $product['id'];
            $price = $product['price'];
            $qty = 1; // Số lượng mặc định là 1

            // Lưu thông tin vào bảng cart
            $sql = "INSERT INTO cart (user_id, product_id, price, qty) VALUES ('$user_id', '$product_id', '$price', '$qty')";
            if (mysqli_query($conn, $sql)) {
                // Thành công, thêm sản phẩm vào giỏ hàng và chuyển hướng đến trang giỏ hàng
                $_SESSION['cart'][$id] = $item;
                header('location:view/view-cart.php');
                exit();
            } else {
                // Xử lý lỗi nếu không thể lưu vào cơ sở dữ liệu
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    } else {
        if (isset($_POST['add_to_cart'])) {
            $id = mysqli_real_escape_string($conn, $_POST['product_id']);
            $query = mysqli_query($conn, "SELECT * FROM products WHERE id= '$id'");
            if ($query) {
                $product = mysqli_fetch_assoc($query);
            } else {
                // Xử lý lỗi khi truy vấn không thành công
            }

            if (isset($product)) {
                $item = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'image' => $product['image'],
                    'price' => $product['price'],
                    'quantity' => 1
                ];

                // Khởi tạo giỏ hàng nếu chưa tồn tại
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }

                // Cập nhật số lượng sản phẩm nếu đã có trong giỏ hàng
                if (isset($_SESSION['cart'][$id])) {
                    $_SESSION['cart'][$id]['quantity'] += 1;
                } else {
                    $_SESSION['cart'][$id] = $item;
                }

                if (isset($_SESSION['id_user'])) {
                    $user_id = $_SESSION['id_user'];
                    $product_id = $product['id'];
                    $price = $product['price'];
                    $qty = 1; // Số lượng mặc định là 1

                    // Lưu thông tin vào bảng cart
                    $sql = "INSERT INTO cart (user_id, product_id, price, qty) VALUES ('$user_id', '$product_id', '$price', '$qty')";
                    if (mysqli_query($conn, $sql)) {
                        // Thành công, thêm sản phẩm vào giỏ hàng và chuyển hướng đến trang giỏ hàng
                        $_SESSION['cart'][$id] = $item;
                        header('location:view/view-cart.php');
                        exit();
                    } else {
                        // Xử lý lỗi nếu không thể lưu vào cơ sở dữ liệu
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }

                header('location:view/view-cart.php');
                exit();
            }
        }
    }

    // Xóa sản phẩm khỏi giỏ hàng
    if (isset($_GET['remove'])) {
        $id = $_GET['remove'];
        unset($cart[$id]);
        $_SESSION['cart'] = $cart;

        // Xóa dữ liệu tương ứng trong cơ sở dữ liệu
        if (isset($_SESSION['id_user'])) {
            $user_id = $_SESSION['id_user'];
            // Sử dụng prepared statement để tránh SQL Injection
            $sql_delete = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
            $stmt = $conn->prepare($sql_delete);
            $stmt->bind_param("ii", $user_id, $id);
            if ($stmt->execute()) {
                // Thành công
                // Redirect hoặc thực hiện các hành động khác tùy thuộc vào yêu cầu của bạn
                header('Location: view-cart.php');
                exit();
            } else {
                // Xử lý lỗi nếu cần
                echo "Error: " . $sql_delete . "<br>" . $conn->error;
            }
            $stmt->close();
        }

        //xóa tất cả sản phẩm
        if (isset($_GET['clear_all']) && $_GET['clear_all'] == true) {
            // Xóa giỏ hàng trong phiên session
            $_SESSION['cart'] = array();

            // Xóa tất cả sản phẩm trong cơ sở dữ liệu
            if (isset($_SESSION['id_user'])) {
                $user_id = $_SESSION['id_user'];
                // Sử dụng prepared statement để tránh SQL Injection
                $sql_delete_all = "DELETE FROM cart WHERE user_id = ? ";
                $stmt = $conn->prepare($sql_delete_all);
                $stmt->bind_param("i", $user_id);
                if ($stmt->execute()) {
                    // Thành công
                    // Redirect hoặc thực hiện các hành động khác 
                    header('Location: view-cart.php');
                    exit();
                } else {
                    // Xử lý lỗi nếu cần
                    echo "Error: " . $sql_delete_all . "<br>" . $conn->error;
                }
                $stmt->close();
            }
        }
    }



    // Cập nhật số lượng sản phẩm
    if (isset($_POST['update'])) {
        $quantities = $_POST['quantity'];
        foreach ($cart as $id => $product) {
            if (isset($quantities[$id])) {
                $cart[$id]['quantity'] = $quantities[$id];
            }

            if (isset($_SESSION['id_user'])) {
                $user_id = $_SESSION['id_user'];
                $new_quantity = $quantities[$id];
                // Sử dụng prepared statement để tránh SQL Injection
                $sql_update = "UPDATE cart SET qty = ? WHERE user_id = ? AND product_id = ?";
                $stmt = $conn->prepare($sql_update);
                $stmt->bind_param("iii", $new_quantity, $user_id, $id);
                if ($stmt->execute()) {
                    // Thành công
                    // Redirect hoặc thực hiện các hành động khác tùy thuộc vào yêu cầu của bạn
                    header('Location: view-cart.php');
                    exit();
                } else {
                    // Xử lý lỗi nếu cần
                    echo "Error: " . $sql_update . "<br>" . $conn->error;
                }
                $stmt->close();
            }
        }
        $_SESSION['cart'] = $cart;
    }
?>

<body>
    <div class="panel-body">
        <div class="back-button">
            <a href="../index.php?act=sanpham" class="mot">Quay lại trang Sản phẩm</a>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Ảnh sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                    <th><a href="?clear_all=true" class="mot" onclick="return confirmDeleteAll()">Xóa tất cả</a></th>
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
                        <td></td>
                        <td><img src="../admin/update_img/<?php echo $product['image']; ?>" alt="" width="100px"></td>
                        <td>
                            <?php echo $product['name']; ?>
                        </td>
                        <td>
                        <?php echo $product['quantity']; ?>
                        </td>
                        <td>
                            <?php echo number_format($product['price'], 0, ',', '.'); ?> đ
                        </td>
                        <td>
                            <?php echo number_format($subtotal, 0, ',', '.'); ?> đ
                        </td>
                        <td><a href="?remove=<?php echo $id; ?>" class="mot" onclick="return confirmDelete()">Xóa</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5">Tổng cộng</th>
                    <th>
                        <?php echo number_format($total, 0, ',', '.'); ?> đ
                    </th>
                    <th><a href="../view/checkout.php" class="mot">Thanh toán</a></th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

<script>
    // Hàm để hiển thị hộp thoại xác nhận trước khi xóa
    function confirmDelete() {
        return confirm("Bạn có chắc chắn muốn xóa sản phẩm này?");
    }

    // Hàm để hiển thị hộp thoại xác nhận trước khi xóa tất cả
    function confirmDeleteAll() {
        return confirm("Bạn có chắc chắn muốn xóa tất cả sản phẩm?");
    }
</script>

</html>