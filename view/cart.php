<?php
// Kiểm tra xem phiên session đã được bắt đầu chưa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

@include 'connect.php';

// Kiểm tra xem ID đã được truyền qua biến $_GET hay không
if(isset($_GET['id'])){
    // Sử dụng hàm mysqli_real_escape_string để tránh SQL Injection
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    // Thực hiện truy vấn SQL
    $query = mysqli_query($conn, "SELECT * FROM products WHERE id= '$id'");
    // Kiểm tra xem truy vấn có thành công hay không
    if($query) { 
        $product = mysqli_fetch_assoc($query);
    } else {
        // Xử lý lỗi truy vấn ở đây nếu cần
    }
}

// Kiểm tra xem $product đã được khởi tạo hay không trước khi sử dụng
if(isset($product)) {
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

    // Chuyển hướng đến trang giỏ hàng
    header('location:view/view-cart.php');
    exit(); // Kết thúc kịch bản sau khi chuyển hướng
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
?>