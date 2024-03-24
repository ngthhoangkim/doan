<?php
   // Kết nối đến cơ sở dữ liệu
   $servername = "localhost"; // Tên máy chủ MySQL
   $username = "root"; // Tên người dùng MySQL
   $password = ""; // Mật khẩu MySQL
   $dbname = "dbtrangsuc"; // Tên cơ sở dữ liệu
   
   // Tạo kết nối
   $conn = new mysqli($servername, $username, $password, $dbname);
   
   // Kiểm tra kết nối
   if ($conn->connect_error) {
       die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
   }
   
   // Kiểm tra nếu form đã được gửi đi
   if(isset($_POST['send'])) {
       // Lấy dữ liệu từ form
       $ten = $_POST['name'];
       $gmail = $_POST['email'];
       $sodt = $_POST['phone'];
       $noidung = $_POST['message'];
   
       // Chèn dữ liệu vào cơ sở dữ liệu
       $sql = "INSERT INTO lienhe (ten, gmail, sodt, noidung) VALUES ('$ten', '$gmail', '$sodt', '$noidung')";
   
       if ($conn->query($sql) === TRUE) {
         
       } else {
         
       }
   }
   
   // Đóng kết nối
   $conn->close();
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Liên hệ</title>
      <style>
         body {
         font-size: 16px;
         font-family: Arial, sans-serif;
         line-height: 1.6;
         background-color: #f4f4f4;
         }
         #contact {
         background-color: #fff;
         padding: 25px;
         margin: 20px auto;
         max-width: 500px;
         border-radius: 5px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         }
         fieldset {
         margin-bottom: 20px;
         }
         input[type="text"],
         input[type="email"],
         input[type="phone"],
         textarea {
         width: 100%;
         padding: 10px;
         border: 1px solid #ccc;
         border-radius: 5px;
         box-sizing: border-box;
         }
         textarea {
         height: 100px;
         resize: vertical;
         }
         button[type="submit"] {
         width: 100%;
         padding: 10px;
         border: none;
         border-radius: 5px;
         background-color: #116a7b;
         color: #fff;
         cursor: pointer;
         transition: background-color 0.3s;
         }
         button[type="submit"]:hover {
         background-color: #0a4c56;
         }
         h1 {
         margin-bottom: 30px;
         font-size: 30px;
         text-align: center; /* Căn giữa nội dung */
         color: #116a7b;
         }
      </style>
   </head>
   <body>
      <DIV>
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.1352584761203!2d106.65027987583848!3d10.800951058739267!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752937ddf0706b%3A0x833dda1f4454e779!2zTE9UVEUgTWFydCBUw6JuIELDrG5o!5e0!3m2!1svi!2s!4v1710562059940!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </DIV>
      <div class="container">
         <form id="contact" action="" method="post">
            <h1>Liên hệ</h1>
            <fieldset>
               <input placeholder="Tên" name="name" type="text" tabindex="1" autofocus>
            </fieldset>
            <fieldset>
               <input placeholder="Email" name="email" type="email" tabindex="2">
            </fieldset>
            <fieldset>
               <input placeholder="Phone" name="phone" type="phone" tabindex="3">
            </fieldset>
            <fieldset>
               <textarea name="message" placeholder="Nội dung" tabindex="5"></textarea>
            </fieldset>
            <fieldset>
               <button type="submit" name="send" id="contact-submit">Gửi</button>
            </fieldset>
         </form>
      </div>
   </body>
</html>