<?php
// Kiểm tra xem phiên session đã được bắt đầu chưa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

@include 'connect.php';
// Hàm để lấy thông tin giỏ hàng từ cơ sở dữ liệu dựa trên ID người dùng
function getCartFromDatabase($user_id, $conn) {
    $cart = array();

    $query = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'");
    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $item = array(
                'id' => $row['product_id'],
                'name' => '', // Tên sản phẩm có thể lấy từ bảng products
                'image' => '', // Đường dẫn ảnh sản phẩm cũng có thể lấy từ bảng products
                'price' => $row['price'],
                'quantity' => $row['qty']
            );
            $cart[$row['product_id']] = $item;
        }
    }
    return $cart;
}
?>