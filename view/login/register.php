<?php

@include '../../model/connectdb.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM users WHERE email = '$email' ";
   // $selectAdmin = "SELECT * FROM users WHERE ";

   $result = mysqli_query($conn, $select);
   // $resultAdmin = mysqli_query($conn, $selectAdmin);

   // if(mysqli_num_rows($resultAdmin) > 0){
   //    $error[] = 'Tài khoản đã tồn tại!';
   // }

   if(mysqli_num_rows($result) > 0){

      $error[] = 'Tài khoản đã tồn tại!';

   }else{

      if($pass != $cpass){
         $error[] = 'Password không giống bạn hãy nhập lại!';
      }else{
         $insert = "INSERT INTO users(username, email, password, user_type) VALUES('$name','$email','$pass','user')";
         mysqli_query($conn, $insert);
         header('location:login.php');
      }
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ĐĂNG KÝ | LUXURIOUS</title>
   <link rel="apple-touch-icon" href="../../public/img/logotron.png"> <!--chỉnh logo trên tiêu đề  -->
   <link rel="shortcut icon" type="../../public/image/x-icon" href="../../public/img/logotron.png"><!--chỉnh logo trên tiêu đề  -->

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
      .form-container{
         background:url("../../public/img/nen.jpg");
         background-size:cover;
      }
      .form-container form {
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
    background-color: rgba(255, 255, 255, 0.3); /* Màu nền và độ trong suốt */
    text-align: center;
    width: 500px;
}
   </style>
</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Đăng ký</h3>
      <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span style="color:black; background-color:#fff" class="error-msg">'.$error.'</span>';
            };
         };
      ?>
      <input type="text" name="name" required placeholder="Nhập tên">
      <input type="email" name="email" required placeholder="Nhập email">
      <input type="password" name="password" required placeholder="Nhập password">
      <input type="password" name="cpassword" required placeholder="Nhập lại password">
      <input type="hidden" name="user_type" required placeholder="user">
      <!-- <select name="user_type">
         <option value="user">USER</option>
         <option value="admin">ADMIN</option>
      </select> -->
      <input style="color:#ECE5C7 " type="submit" name="submit" value="Đăng ký" class="form-btn">
      <p>Nếu bạn có tài khoản rồi hãy <a href="login.php">đăng nhập</a></p>
   </form>

</div>

</body>
</html>