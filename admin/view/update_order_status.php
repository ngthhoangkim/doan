<?php
$conn = mysqli_connect('localhost','root','','dbtrangsuc') or die('Kết nối thất bại');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $payment_status = $_POST['payment_status'];

    // Cập nhật trạng thái thanh toán của đơn hàng
    $sql = "UPDATE orders SET payment_status = '$payment_status' WHERE id = '$order_id'";

    if (mysqli_query($conn, $sql)) {
        // Cập nhật thành công
        header('Location: qldonhang.php?success=1');
        exit;
    } else {
        // Cập nhật thất bại
        header('Location: qldonhang.php?error=1');
        exit;
    }
}
?>