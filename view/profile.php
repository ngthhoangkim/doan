<?php
   @include '../model/connectdb.php';
   session_start();
   $user_id = $_SESSION['id_user'];
    
   if(isset($_POST['update_profile'])){
      //cập nhật thông tin cá nhân
      $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
      $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
      $update_address = mysqli_real_escape_string($conn, $_POST['update_address']);
      $update_phone = mysqli_real_escape_string($conn, $_POST['update_phone']);

      mysqli_query($conn, "UPDATE `users` SET username = '$update_name', email = '$update_email' WHERE id = '$user_id'") or die('Cập nhật thất bại');
      
      if(empty($update_phone) || empty($update_address)){
         
         $message[] = 'Bạn hãy điền đầy đủ thông tin!';
      } else{
         mysqli_query($conn, "UPDATE `users` SET phone = '$update_phone', address = '$update_address' WHERE id = '$user_id'") or die('Cập nhật thất bại');       
      }
      
      //cập nhật ảnh 
      $update_image = $_FILES['update_image']['name'];
      $update_image_size = $_FILES['update_image']['size'];
      $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
      $update_image_folder = '../public/uploaded_img/'.$update_image;

      if(!empty($update_image)){
         if($update_image_size > 2000000){
               $message[] = 'Ảnh quá lớn';
         }else{
               $image_update_query = mysqli_query($conn, "UPDATE `users` SET image = '$update_image' WHERE id = '$user_id'") or die('Cập nhật thất bại');
               if($image_update_query){
                  move_uploaded_file($update_image_tmp_name, $update_image_folder);
               }
               $message[] = 'Cập nhật ảnh thành công!';
         }
      }
      $message[] = 'Cập nhật thành công!';
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Profile</title>

   <link rel="apple-touch-icon" href="../public/img/logotron.png"> <!--chỉnh logo trên tiêu đề  -->
   <link rel="shortcut icon" type="../public/image/x-icon" href="../public/img/logotron.png"><!--chỉnh logo trên tiêu đề -->

   <style>
      :root{
         --black:#333;
         --white:#fff;
         --gray: gray;
         --light-bg:#eee;
         --text:#ECE5C7;
         --box-shadow:0 5px 10px rgba(0,0,0,.1);
      }
      *{
         font-family: 'Poppins', sans-serif;
         margin:0; padding:0;
         box-sizing: border-box;
         outline: none; border: none;
         text-decoration: none;
      }

      *::-webkit-scrollbar{
      width: 10px;
      }

      *::-webkit-scrollbar-track{
         background-color: transparent;
      }

      *::-webkit-scrollbar-thumb{
         background-color: var(--gray);
      }

      .btn,
      .delete-btn{
         width: 100%;
         border-radius: 5px;
         padding:10px 30px;
         color:var(--black);
         display: block;
         text-align: center;
         cursor: pointer;
         font-size: 20px;
         margin-top: 10px;
      }

      .btn{
         background-color: var(--white);
      }

      .btn:hover{
         background-color: var(--text);
      }

      .delete-btn{
         background-color: var(--white);
      }

      .delete-btn:hover{
         background-color: var(--text);
      }

      .message{
         margin:10px 0;
         width: 100%;
         border-radius: 5px;
         padding:10px;
         text-align: center;
         background-color: var(--white);
         color:var(--black);
         font-size: 20px;
      }

      .form-container{
         min-height: 100vh;
         background-color: var(--light-bg);
         display: flex;
         align-items: center;
         justify-content: center;
         padding:20px;
      }

      .form-container form{
         padding:20px;
         background-color: var(--white);
         box-shadow: var(--box-shadow);
         text-align: center;
         width: 500px;
         border-radius: 5px;
      }

      .form-container form h3{
         margin-bottom: 10px;
         font-size: 30px;
         color:var(--black);
         text-transform: uppercase;
      }

      .form-container form .box{
         width: 100%;
         border-radius: 5px;
         padding:12px 14px;
         font-size: 18px;
         color:var(--black);
         margin:10px 0;
         background-color: var(--light-bg);
      }

      .form-container form p{
         margin-top: 15px;
         font-size: 20px;
         color:var(--black);
      }

      .form-container form p a{
         color:var(--text);
      }

      .form-container form p a:hover{
         text-decoration: underline;
      }

      .container{
         min-height: 100vh;
         background-color: var(--light-bg);
         display: flex;
         align-items: center;
         justify-content: center;
         padding:20px;
      }

      .container .profile{
         padding:20px;
         background-color: var(--white);
         box-shadow: var(--box-shadow);
         text-align: center;
         width: 400px;
         border-radius: 5px;
      }

      .container .profile img{
         height: 150px;
         width: 150px;
         border-radius: 50%;
         object-fit: cover;
         margin-bottom: 5px;
      }

      .container .profile h3{
         margin:5px 0;
         font-size: 20px;
         color:var(--black);
      }

      .container .profile p{
         margin-top: 20px;
         color:var(--black);
         font-size: 20px;
      }

      .container .profile p a{
         color:var(--text);
      }

      .container .profile p a:hover{
         text-decoration: underline;
      }

      .update-profile{
         min-height: 100vh;
         background-color: var(--light-bg);
         display: flex;
         align-items: center;
         justify-content: center;
         padding:20px;
      }

      .update-profile form{
         padding:20px;
         background-color: var(--white);
         box-shadow: var(--box-shadow);
         text-align: center;
         width: 700px;
         text-align: center;
         border-radius: 5px;
      }

      .update-profile form img{
         height: 200px;
         width: 200p;
         border-radius: 50%;
         object-fit: cover;
         margin-bottom: 5px;
      }

      .update-profile form .flex{
         display: flex;
         justify-content: space-between;
         margin-bottom: 20px;
         gap:15px;
      }

      .update-profile form .flex .inputBox{
         width: 49%;
      }

      .update-profile form .flex .inputBox span{
         text-align: left;
         display: block;
         margin-top: 15px;
         font-size: 17px;
         color:var(--black);
      }

      .update-profile form .flex .inputBox .box{
         width: 100%;
         border-radius: 5px;
         background-color: var(--light-bg);
         padding:12px 14px;
         font-size: 17px;
         color:var(--black);
         margin-top: 10px;
      }

      @media (max-width:650px){
         .update-profile form .flex{
            flex-wrap: wrap;
            gap:0;
         }
         .update-profile form .flex .inputBox{
            width: 100%;
         }
      }
   </style>
</head>

<body>   
<div class="update-profile">
   <?php
      $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('Cập nhật thất bại');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <?php
         if($fetch['image'] == ''){
            echo '<img src="../public/img/avata_default.png">';
         }else{
            echo '<img src="../public/uploaded_img/'.$fetch['image'].'">';
         }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>
      <div class="flex">
         <div class="inputBox">
            <span>Username:</span>
            <input type="text" name="update_name" value="<?php echo $fetch['username']; ?>" class="box">
            <span>Email :</span>
            <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
            <span>Avata:</span>
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
         </div>
         <div class="inputBox">
            <span>Số điện thoại :</span>
            <input type="phone" name="update_phone" value="<?php echo $fetch['phone']; ?>" class="box">
            <span>Địa chỉ:</span>
            <input type="text" name="update_address" value="<?php echo $fetch['address']; ?>" class="box">
         </div>
         <script type="module" src=""></script>
      </div>
      <a class="delete-btn" href="../index.php?act=update_pass">Đổi mật khẩu</a>
      <input type="submit" value="Cập nhật" name="update_profile" class="btn">
      <a href="../index.php" class="delete-btn">Trở về</a>
   </form>

</div>

</body>
</html>