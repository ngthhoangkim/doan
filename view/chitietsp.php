<!DOCTYPE html>
<html lang="vi">
<head>
   <style>
       .main{
            border: 1px solid #116A7B;
            width:100%;
            height: auto;
        }
        .sidebar{
            border:1px solid #116A7B;
            height:350px;
            width:20%;
            margin-top: 5px;
            margin-left: 5px;
            float:left;
        }
        ul.list_sidebar{
            padding:0;
            margin:0;
            width:100%;
            list-style: none;
            line-height: 35px;
        }
        ul.list_sidebar li:hover {
            background: cadetblue;
        }
        ul.list_sidebar li a {
            text-decoration: none;
            text-align: left;
            color:#3333ff;
            display: block;
        }
        ul.list_sidebar li{
            margin: 7px;
            padding: 5px;
        }
        .product_detail{
            height:auto;
            width:79%;
            margin-top: 5px;
            margin-left: 5px;
            float:right;
        }
        .product_detail:after {
         content: "";
        display: table;
         clear: both;
        }
        .hinhanh {
            float:left;
            width: 40%;
            height:auto;
            margin: 5px auto;
        }
        .hinhanh img{
            width:60%;
        }
        .thongtin {
            float:left;
            width: 60%;
            height:auto;
            margin: 5px auto;
        }
        
        .clear{
            clear:both;
        }
   </style>
</head>
<body>
<div class="main">
    <div class="sidebar">
        
        <ul class="list_sidebar">
            <li><a href="index.php?act=sanpham&id_type=5">Nhẫn</a></li>
            <li><a href="index.php?act=sanpham&id_type=6">Dây chuyền </a></li>
            <li><a href="index.php?act=sanpham&id_type=7">Vòng tay </a></li>
            <li><a href="index.php?act=sanpham&id_type=8">Khuyên tai</a></li>
        </ul>
    </div>
    <div class="product_detail">
        <h3> Chi tiết sản phẩm </h3>
        <div class="hinhanh" >
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
                    echo '<img src="admin/update_img/'.$row_pro['image'].'" alt="Hình ảnh sản phẩm"> ';
                } else {
                    echo 'Không tìm thấy hình ảnh sản phẩm';
                }
            } else {
                echo 'Không có hình ảnh sản phẩm để hiển thị';
            }
            ?>
        </div>
        <div class="thongtinsp">
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
                
                    echo '<h3>Tên sản phẩm :'.$row_pro['name'].'</h3>';
                    echo '<p>Giá: '.number_format($row_pro['price'],0,',','.').' đ</p>';
                    echo '<p>Mô tả: '.$row_pro['method'].'</p>';
                
                } else {
                    echo 'Không tìm thấy sản phẩm';
                }
            } else {
                echo 'Không có thông tin sản phẩm để hiển thị';
            }
            ?>
            <p><input type="submit" value="Thêm giỏ hàng"></p>
</div>

</div>
    <div class="clear"></div>
</div>

</body>