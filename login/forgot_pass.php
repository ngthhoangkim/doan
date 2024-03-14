<?php

// @include '../model/connectdb.php';

// if(isset($_POST['submit'])){
//    $email = mysqli_real_escape_string($conn, $_POST['email']);

//    // Kiểm tra xem email có tồn tại trong cơ sở dữ liệu không
//    $select = "SELECT * FROM users WHERE email = '$email'";
//    $result = mysqli_query($conn, $select);

//    if(mysqli_num_rows($result) > 0){
//       // Tạo mã đặt lại mật khẩu ngẫu nhiên
//       $reset_token = md5(uniqid(rand(), true));

//       // Lưu mã đặt lại mật khẩu vào cơ sở dữ liệu
//       $update = "UPDATE users SET password = '$reset_token' WHERE email = '$email'";
//       mysqli_query($conn, $update);

//       // Gửi email chứa liên kết đặt lại mật khẩu
//       $reset_link = "http://Luxurious.com/reset_password_form.php?token=$reset_token";
//       $to = $email;
//       $subject = "Yêu cầu đặt lại mật khẩu";
//       $message = "Xin chào,\n\nBạn đã yêu cầu đặt lại mật khẩu. Vui lòng truy cập liên kết sau để đặt lại mật khẩu:\n\n$reset_link\n\nNếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.\n\nTrân trọng,\nĐội ngũ hỗ trợ";
//       $headers = "From: LUXURIOUS@gmail.com\r\n";
//       mail($to, $subject, $message, $headers);

//       // Chuyển hướng người dùng đến trang thông báo thành công
//       header('location: reset_password_success.php');
//    }else{
//       $error[] = 'Email không tồn tại trong cơ sở dữ liệu!';
//    }
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ĐĂNG NHẬP | LUXURIOUS</title>
   <link rel="apple-touch-icon" href="../public/img/logotron.png"> <!--chỉnh logo trên tiêu đề  -->
   <link rel="shortcut icon" type="../public/image/x-icon" href="../public/img/logotron.png"><!--chỉnh logo trên tiêu đề  -->
   
   <style>
      @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;600&display=swap');
      *{
         font-family: 'Roboto', sans-serif;
         margin:0; padding:0;
         box-sizing: border-box;
         outline: none; border:none;
         text-decoration: none;
      }

      .container{
         min-height: 100vh;
         display: flex;
         align-items: center;
         justify-content: center;
         padding:20px;
         padding-bottom: 60px;
      }

      .container .content{
         text-align: center;
      }

      .container .content h3{
         font-size: 30px;
         color:#333;
      }

      .container .content h3 span{
         /* background: crimson; */
         color:#fff;
         border-radius: 5px;
         padding:0 15px;
      }

      .container .content h1{
         font-size: 50px;
         color:#333;
      }

      .container .content h1 span{
         /* color:#ff; */
        /* background-color:#fff; */
      }

      .container .content p{
         font-size: 25px;
         margin-bottom: 20px;
      }

      .container .content .btn{
         display: inline-block;
         padding:10px 30px;
         font-size: 20px;
         background: #333;
         color:#fff;
         margin:0 5px;
         text-transform: capitalize;
      }

      .container .content .btn:hover{
         background: #fff;
      }

      .form-container{
         min-height: 100vh;
         display: flex;
         align-items: center;
         justify-content: center;
         padding:20px;
         padding-bottom: 60px;
         background: #eee;
      }

      .form-container form{
         padding:20px;
         border-radius: 5px;
         box-shadow: 0 5px 10px rgba(0,0,0,.1);
         background: #fff;
         text-align: center;
         width: 500px;
      }

      .form-container form h3{
         font-size: 30px;
         text-transform: uppercase;
         margin-bottom: 10px;
         color:#333;
      }

      .form-container form input,
      .form-container form select{
         width: 100%;
         padding:10px 15px;
         font-size: 17px;
         margin:8px 0;
         background: #eee;
         border-radius: 5px;
      }

      .form-container form select option{
         background: #fff;
      }

      .form-container form .form-btn{
         background: #9BBEC8;
         color:crimson;
         text-transform: capitalize;
         font-size: 20px;
         cursor: pointer;
      }

      .form-container form .form-btn:hover{
         background: #116A7B;
         color:#fff;
      }

      .form-container form p{
         margin-top: 10px;
         font-size: 20px;
         color:#333;
      }

      .form-container form p a{
         color:#116A7B;
      }

      .form-container form .error-msg{
         margin:10px 0;
         display: block;
         background: #fff;
         color:black;
         border-radius: 5px;
         font-size: 20px;
         padding:10px;
      }
   </style>
   

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Quên mật khẩu</h3>
      <input type="email" name="email" required placeholder="Nhập email">
      <input type="submit" style="color:#ECE5C7 " name="submit" value="Gửi yêu cầu" class="form-btn">
      <p><a href="register.php">Đăng ký</a></p>
   </form>

</div>

</body>
</html>