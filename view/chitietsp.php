<?php
// Kết nối đến cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "dbtrangsuc");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="vi">
   <head>
      <style>
         body {
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;
         background-color: #f4f4f4;
         }
         .container {
         display: flex;
         max-width: 1200px;
         margin: 0 auto;
         padding: 20px;
         box-sizing: border-box;
         }
         .sidebar {
         flex: 0 0 20%;
         background-color: #ffffff;
         border: 1px solid  #45a049;
         border-radius: 5px;
         padding: 10px;
         margin-right: 20px;
         }
         .list_sidebar {
         padding: 0;
         margin: 0;
         list-style: none;
         }
         .list_sidebar li {
         margin-bottom: 10px;
         }
         .list_sidebar li a {
         text-decoration: none;
         color:  #45a049;
         display: block;
         padding: 8px;
         border-radius: 5px;
         transition: background-color 0.3s ease;
         }
         .list_sidebar li a:hover {
         background-color: cadetblue;
         }
         .product_detail {
         flex: 1;
         background-color: #ffffff;
         border: 1px solid #45a049;
         border-radius: 5px;
         padding: 20px;
         }
         .hinhanh {
         width: 40%;
         float: left;
         margin-right: 20px;
         }
         .hinhanh img {
         width: 100%;
         border-radius: 5px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         }
         .thongtin {
         width: 50%;
         float: left;
         }
         .thongtin p {
         margin-top: 0;
         }
         .thongtin input[type="submit"] {
         background-color: #45a049;
         color: #fff;
         border: none;
         padding: 10px 20px;
         border-radius: 5px;
         cursor: pointer;
         transition: background-color 0.3s ease;
         }
         .thongtin input[type="submit"]:hover {
         background-color:  #45a049;
         }
         .clear {
         clear: both;
         }
         .product_detail h3 ,
         .product_detail h4 {
         /* Căn giữa nội dung của thẻ h3 */
         text-align: center;
         }
         .product_detail h3 {
         padding: 40px;
         color:  #45a049;
         }
      </style>
   </head>
   <body>
      <div class="container">
         <div class="sidebar">
            <ul class="list_sidebar">
               <li><a href="index.php?act=sanpham&id_type=5">Nhẫn</a></li>
               <li><a href="index.php?act=sanpham&id_type=6">Dây chuyền</a></li>
               <li><a href="index.php?act=sanpham&id_type=7">Vòng tay</a></li>
               <li><a href="index.php?act=sanpham&id_type=8">Khuyên tai</a></li>
            </ul>
         </div>
         <div class="product_detail">
            <h3>CHI TIẾT SẢN PHẨM </h3>
            <div class="hinhanh">
               <?php
                  // Kết nối cơ sở dữ liệu
                  @include 'connectdb.php';
                  
                  // Kiểm tra xem có tham số id_product trên URL hay không
                  if(isset($_GET['id'])){
                      // Lấy giá trị id_product từ URL
                      $id = $_GET['id'];
                      // Truy vấn SQL để lấy thông tin chi tiết sản phẩm
                      $sql = "SELECT * FROM products WHERE id='$id'";
                      $result = $conn->query($sql);
                  
                      if ($result->num_rows > 0) {
                          // Hiển thị thông tin chi tiết sản phẩm
                          $row_pro = $result->fetch_assoc();
                          echo '<img src="../admin/update_img/'.$row_pro['image'].'" alt="Hình ảnh sản phẩm"> ';
                      } else {
                          echo 'Không tìm thấy hình ảnh sản phẩm';
                      }
                  } else {
                      echo 'Không có hình ảnh sản phẩm để hiển thị';
                  }
                  ?>
            </div>
            <div class="thongtin">
               <?php
                  // Kết nối cơ sở dữ liệu
                  @include 'connectdb.php';
                  
                  // Kiểm tra xem có tham số id_product trên URL hay không
                  if(isset($_GET['id'])){
                      // Lấy giá trị id_product từ URL
                      $id = $_GET['id'];
                      // Truy vấn SQL để lấy thông tin chi tiết sản phẩm
                      $sql = "SELECT * FROM products WHERE id='$id'";
                      $result = $conn->query($sql);
                  
                      if ($result->num_rows > 0) {
                          // Hiển thị thông tin chi tiết sản phẩm
                          $row_pro = $result->fetch_assoc();
                      
                          echo '<h4>Tên sản phẩm :'.$row_pro['name'].'</h4>';
                          echo '<p>Giá: '.number_format($row_pro['price'],0,',','.').' đ</p>';
                          echo '<p>Mô tả: '.$row_pro['method'].'</p>';
                      
                      } else {
                          echo 'Không tìm thấy sản phẩm';
                      }
                  } else {
                      echo 'Không có thông tin sản phẩm để hiển thị';
                  }
                  ?>
               <?php
                  echo '<form action="index.php?act=giohang&id" method="post">';
                  echo '<input type="hidden" name="product_id" value="' . $row_pro['id'] . '">';
                  echo '<input type="submit" name="add_to_cart" value="Thêm vào giỏ hàng">';
                  echo '</form>';
                  
                             ?>
            </div>
         </div>
         <div class="clear"></div>
      </div>
   </body>
</html>