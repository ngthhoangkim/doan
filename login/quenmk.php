<?php
   if (isset($_POST['nutguiyeucau'])==true)
   {
       $email = $_POST['email'];
       //lấy dữ liệu 
       $conn = new PDO("mysql:host=localhost;dbname=dbtrangsuc;charset=utf8" , "root","");
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
      $sql="SELECT * FROM users WHERE email = ?";
      $stmt = $conn->prepare($sql);   //tạo 1  prepare stement  tạo ra 1 cái bảo mật 
      $stmt->execute( [$email] );
      $count = $stmt->rowCount();
      if ($count==0) {
       $loi = "tài khoản không tồn tại ";
      }
      else {
         // Tạo mật khẩu mới không mã hóa cho người dùng
         $matkhaumoi_nguoidung = rand(10000000, 99999999); // Tạo mật khẩu ngẫu nhiên
     
         // Mã hóa mật khẩu mới để lưu vào cơ sở dữ liệu
         $matkhaumoi_md5 = md5($matkhaumoi_nguoidung);
     
         // Cập nhật mật khẩu đã mã hóa vào cơ sở dữ liệu
         $sql = "UPDATE users SET password = ? WHERE email = ?";
         $stmt = $conn->prepare($sql);
         $stmt->execute([$matkhaumoi_md5, $email]);
     
         // Gửi mật khẩu mới không mã hóa cho người dùng
         $kq = GuiMatKhauMoi($email, $matkhaumoi_nguoidung);
         if ($kq == true) {
             echo "<script>document.location='thongbao.php';</script>";
         }
     }
     
      
   }
   
   ?>
<?php
   function GuiMatKhauMoi($email, $matkhaumoi_nguoidung){
   require "PHPMailer-master/src/PHPMailer.php"; 
   require "PHPMailer-master/src/SMTP.php"; 
   require 'PHPMailer-master/src/Exception.php'; 
   $mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
   try {
       $mail->SMTPDebug = 0; //0,1,2: chế độ debug
       $mail->isSMTP();  
       $mail->CharSet  = "utf-8";
       $mail->Host = 'smtp.gmail.com';  //SMTP servers
       $mail->SMTPAuth = true; // Enable authentication
       $mail->Username = 'son696552@gmail.com'; // SMTP username
       $mail->Password = 'jfqc kebi zckx qhpc
       ';   // SMTP password
       $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
       $mail->Port = 465;  // port to connect to                
       $mail->setFrom('son696552@gmail.com', 'LUXURIOUS' ); 
       $mail->addAddress($email); 
       $mail->isHTML(true);  // Set email format to HTML
       $mail->Subject = 'MẬT KHẨU MỚI ';
       $noidungthu = "<p>Bạn nhận được thư này , do bạn hoặc ai đó quên mật khẩu yêu cầu mật khẩu mới </p>
              MẬT KHẨU MỚI CỦA BẠN LÀ :  { $matkhaumoi_nguoidung}
       "; 
       $mail->Body = $noidungthu;
       $mail->smtpConnect( array(
           "ssl" => array(
               "verify_peer" => false,
               "verify_peer_name" => false,
               "allow_self_signed" => true
           )
       ));
       $mail->send();
       return true ;
   } catch (Exception $e) {
       echo 'Error: ', $mail->ErrorInfo;
       return false ;
   }
   }
   ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<form method="post"   style="width:600px;" class="border border-warning border-3 m-auto p-3">
   <div class="mb-3 text-center">
      <h1>QUÊN MẬT KHẨU  </h1>
      <!-- in tài khoản không tồn tai  -->
      <?php if (!empty($loi)) { ?>
      <div class="alert alert-danger"><?= $loi ?></div>
      <?php } ?>
   </div>
   <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">nhập Email</label>
      <input value="<?php if (isset($email)==true) echo $email ?>"    type="email" class="form-control" id="email" name ="email">
   </div>
   <button type="submit" name="nutguiyeucau" value="nutgui" class="btn btn-primary">gửi yêu cầu</button>
</form>