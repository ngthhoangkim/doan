<?php
   // Bao gồm tệp kết nối CSDL
   @include 'connectdb.php';
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Sản Phẩm</title>
      <style>
         @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
         * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         font-family: 'Poppins', sans-serif;
         }
         body {
         background-color: #f5f5f5;
         }
         .main {
         max-width: 80%;
         margin: 0 auto;
         padding: 20px;
         display: flex;
         }
         .sidebar {
         background-color: #fff;
         border-radius: 10px;
         box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
         padding: 20px;
         margin-right: 20px;
         width: 300px;
         }
         .sidebar h3 {
         font-size: 18px;
         font-weight: 600;
         margin-bottom: 10px;
         }
         .sidebar ul {
         list-style-type: none;
         }
         .sidebar ul li a {
         display: block;
         color: #333;
         padding: 10px;
         text-decoration: none;
         border-radius: 5px;
         transition: background-color 0.3s ease;
         }
         .sidebar ul li a:hover {
         background-color: #f1f1f1;
         }
         .maincontent {
         flex-grow: 1;
         }
         .product_list {
         display: grid;
         grid-template-columns: repeat(4, 1fr);
         grid-gap: 20px;
         }
         .product_list li {
         background-color: #fff;
         border-radius: 10px;
         box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
         overflow: hidden;
         transition: transform 0.3s ease;
         }
         .product_list li:hover {
         transform: translateY(-5px);
         }
         .product_list li img {
         width: 100%;
         height: 200px;
         object-fit: cover;
         }
         .product_info {
         padding: 20px;
         }
         .product_info .name_product {
         font-size: 16px;
         font-weight: 600px;
         margin-bottom: 10px;
         text-align: left;
         }
         .product_info .price_product {
         font-size: 14px;
         color: #777;
         margin-bottom: 10px;
         text-align: left;
         }
         .product_info form {
         display: flex;
         justify-content: flex-end;
         }
         .product_info form input[type="submit"] {
         background-color: #4CAF50; /* Green color */
         color: white;
         border: none;
         padding: 10px 20px;
         border-radius: 5px;
         cursor: pointer;
         transition: background-color 0.3s ease;
         margin-left: 10px; /* Add margin to separate buttons */
         }
         .product_info form input[type="submit"]:hover {
         background-color: #45a049; /* Darker green color on hover */
         }
         @media (max-width: 768px) {
         .main {
         flex-direction: column;
         padding: 10px;
         }
         .sidebar {
         width: 100%;
         margin-right: 0;
         margin-bottom: 20px;
         }
         .product_list {
         grid-template-columns: repeat(2, 1fr);
         }
         }
         .sidebar ul li a,
         .product_list li a {
         text-decoration: none;
         }
      </style>
   </head>
   <body>
      <div class="main">
         <div class="sidebar">
            <h3>Danh Mục Sản Phẩm</h3>
            <ul>
               <li><a href="index.php?act=sanpham&id_type=5">Nhẫn</a></li>
               <li><a href="index.php?act=sanpham&id_type=6">Dây chuyền</a></li>
               <li><a href="index.php?act=sanpham&id_type=7">Vòng tay</a></li>
               <li><a href="index.php?act=sanpham&id_type=8">Khuyên tai</a></li>
            </ul>
         </div>
         <div class="maincontent">
            <ul class="product_list">
               <?php
                  if (isset($_GET['act']) && $_GET['act'] == 'sanpham' && isset($_GET['id_type'])) {
                      // Lấy giá trị id_type từ URL
                      $id_type = $_GET['id_type'];
                      // Truy vấn SQL để lấy tất cả sản phẩm theo id_type
                      $sql = "SELECT * FROM products WHERE id_type='$id_type'";
                      $result = $conn->query($sql);
                  
                      if ($result->num_rows > 0) {
                          // Hiển thị tất cả sản phẩm theo id_type
                          while ($row_pro = $result->fetch_assoc()) {
                              echo '<li>';
                              echo '<a href="index.php?act=chitietsp&id=' . $row_pro['id'] . '">';
                              echo '<img src="admin/update_img/' . $row_pro['image'] . '">';
                              echo '<div class="product_info">';
                              echo '<p class="name_product">';
                  if (strlen($row_pro['name']) > 20) {
                  echo substr($row_pro['name'], 0, 20) . '...';
                  } else {
                  echo $row_pro['name'];
                  }
                  echo '</p>';
                  
                              echo '<p class="price_product">' . number_format($row_pro['price'], 0, ',', '.') . ' đ</p>';
                              echo '<form action="index.php?act=giohang&id" method="post">';
                              echo '<input type="hidden" name="product_id" value="' . $row_pro['id'] . '">';
                              echo '<input type="submit" name="add_to_cart" value="Thêm vào giỏ hàng">';
                              echo '</form>';
                              echo '</div>';
                              echo '</a>';
                              echo '</li>';
                          }
                      } else {
                          echo 'Không có sản phẩm cho loại này';
                      }
                  } else {
                      // Truy vấn SQL để lấy một sản phẩm ngẫu nhiên có id_type
                      $sql = "SELECT * FROM products WHERE id_type IS NOT NULL ORDER BY RAND() LIMIT 12";
                      $result = $conn->query($sql);
                  
                      if ($result->num_rows > 0) {
                          // Hiển thị một sản phẩm ngẫu nhiên có id_type
                          while ($row_pro = $result->fetch_assoc()) {
                              echo '<li>';
                              echo '<a href="index.php?act=chitietsp&id=' . $row_pro['id'] . '">';
                              echo '<img src="admin/update_img/' . $row_pro['image'] . '">';
                              echo '<div class="product_info">';
                              echo '<p class="name_product">';
                  if (strlen($row_pro['name']) > 20) {
                  echo substr($row_pro['name'], 0, 20) . '...';
                  } else {
                  echo $row_pro['name'];
                  }
                  echo '</p>';
                  
                              echo '<p class="price_product">' . number_format($row_pro['price'], 0, ',', '.') . ' đ</p>';
                              echo '<form action="index.php?act=giohang&id" method="post">';
                              echo '<input type="hidden" name="product_id" value="' . $row_pro['id'] . '">';
                              echo '<input type="submit" name="add_to_cart" value="Thêm vào giỏ hàng">';
                              echo '</form>';
                              echo '</div>';
                              echo '</a>';
                              echo '</li>';
                          }
                      } else {
                          echo 'Không có sản phẩm ngẫu nhiên';
                      }
                  }
                  ?>
            </ul>
         </div>
      </div>
   </body>
</html>