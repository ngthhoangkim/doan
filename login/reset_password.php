<?php

// @include '../model/connectdb.php';

// if(isset($_GET['token'])){
//    $token = $_GET['token'];

//    // Kiểm tra xem mã đặt lại mật khẩu có hợp lệ không
//    $select = "SELECT * FROM users WHERE password = '$token'";
//    $result = mysqli_query($conn, $select);

//    if(mysqli_num_rows($result) > 0){
//       // Hiển thị form đặt lại mật khẩu
//       echo '
//          <!DOCTYPE html>
//          <html lang="en">
//          <head>
//             <meta charset="UTF-8">
//             <meta http-equiv="X-UA-Compatible" content="IE=edge">
//             <meta name="viewport" content="width=device-width, initial-scale=1.0">
//             <title>Đặt lại mật khẩu</title>
//             <!-- Thêm các đườnglink CSS và thư viện cần thiết -->
//          </head>
//          <body>
//             <div class="form-container">
//                <form action="update_password.php" method="post">
//                   <h3>Đặt lại mật khẩu</h3>
//                   <input type="hidden" name="token" value="' . $token . '">
//                   <input type="password" name="password" required placeholder="Nhập mật khẩu mới">
//                   <input type="password" name="confirm_password" required placeholder="Xác nhận mật khẩu mới">
//                   <input type="submit" name="submit" value="Đặt lại mật khẩu" class="form-btn">
//                </form>
//             </div>
//          </body>
//          </html>
//       ';
//    }else{
//       // Hiển thị thông báo lỗi nếu mã đặt lại mật khẩu không hợp lệ
//       echo 'Mã đặt lại mật khẩu không hợp lệ!';
//    }
// }

?>