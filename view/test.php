<?php
// Bắt đầu hoặc tiếp tục một phiên session
session_start();

// Kiểm tra xem session đã được khởi tạo trước đó không
if(isset($_SESSION)) {
    // Hủy session nếu có
    session_destroy();
}
  
?>
