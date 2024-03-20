<?php
      @include '../model/connectdb.php';
      session_start();
      $user_id = $_SESSION['id_user'];
      if(isset($_POST['update_pass'])){

            $old_pass = $_POST['old_pass'];
            $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
            $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
            $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));
        
            if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
                if($update_pass != $old_pass){
                      $message[] = 'Không trùng khớp với mật khẩu cũ!';
                }else if($new_pass != $confirm_pass){
                      $message[] = 'Mật khẩu nhập lại không trùng khớp!';
                }else{
                      mysqli_query($conn, "UPDATE `users` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('Cập nhật thất bại');
                      $message[] = 'Cập nhật mật khẩu thành công!';
                }
            }
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ĐỔI MẬT KHẨU</title>
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

      .form-container form input{
            width: 100%;
            padding:10px 15px;
            font-size: 17px;
            margin:8px 0;
            background: #eee;
            border-radius: 5px;
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

      button a{
            color: black;
      }

      button a:hover{
            color: #ECE5C7;
      }

      button{
            display: inline-block;
            background-color: #fff;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
      }

      button:hover{
            background-color: #116A7B;
      }

   </style>
   

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Đổi mật khẩu</h3>
      <?php
         if(isset($message)){
            foreach($message as $message){
               echo '<span  class="error-msg">'.$message.'</span>';
            };
         };
      ?>
      <input type="hidden" name="old_pass" value="<?php // echo $fetch['password']; ?>">
      <input type="password" name="update_pass" placeholder="Nhập mật khẩu cũ" class="box">
      <input type="password" name="new_pass" placeholder="Nhập mật khẩu mới" class="box">
      <input type="password" name="confirm_pass" placeholder="Nhập lại mật khẩu" class="box">
      
      <button name="update_pass"><a href="">Cập nhật</a></button>
   </form>

</div>

</body>
</html>

