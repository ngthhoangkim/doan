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

    // Chuyển hướng đến trang giỏ hàng
    header('location:view/view-cart.php');
    exit(); // Kết thúc kịch bản sau khi chuyển hướng
}
?>
