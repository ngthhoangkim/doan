<?php
    @include 'connectdb.php';
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .main{
            border: 1px solid #116A7B;
            width:100%;
            height: auto;
        }
        .sidebar{
            border:1px solid #116A7B;
            height:390px;
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
        .maincontent{
            height:auto;
            width:79%;
            margin-top: 5px;
            margin-left: 5px;
            float:right;
        }
        ul.product_list{
            padding: 0;
            margin: 0;
            list-style: none;
            width:100%;
        }
        ul.product_list li{
            width: 19%;
            border:1px solid  #000;
            margin: 5px;
            float:left;
            background: #79CDCD;
            height: 330px;
        }
        ul.product_list li a {
            text-decoration: none;
        }
        ul.product_list li img {
            height:190px;
            width:100%;
        }

        p.name_product{
            text-align: center;
            color:#000;
            font-size: 8px;
            font-weight: bold;
        }

        p.price_product{
            text-align: center;
            font-size: 10px;
            font-weight: bold;
            color:#000;
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
    <div class="maincontent">
        
    <ul class="product_list">
            <?php 
             if(isset($_GET['id_type'])){
    // Lấy giá trị id_type từ URL
    $id_type = $_GET['id_type'];
    // Truy vấn SQL để lấy tất cả sản phẩm theo id_type
    $sql = "SELECT * FROM products WHERE id_type='$id_type'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Hiển thị tất cả sản phẩm theo id_type
        while($row_pro = $result->fetch_assoc()) {
            echo '<li>';
            echo '<img src="admin/update_img/'.$row_pro['image'].'">';
            echo '<p class="name_product">Tên sản phẩm: '.$row_pro['name'].'</p>';
            echo '<p class="price_product">Giá: '.number_format($row_pro['price'],0,',','.').' đ</p>';
            echo '</li>';
        }
    } else {
        echo 'Không có sản phẩm cho loại này';
    }
} else {
    // Truy vấn SQL để lấy một sản phẩm ngẫu nhiên có id_type
    $sql = "SELECT * FROM products WHERE id_type IS NOT NULL ORDER BY RAND() LIMIT 10";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Hiển thị một sản phẩm ngẫu nhiên có id_type
        while($row_pro = $result->fetch_assoc()) {
        echo '<li>';
        echo '<img src="admin/update_img/'.$row_pro['image'].'">';
        echo '<p class="name_product">Tên sản phẩm: '.$row_pro['name'].'</p>';
        echo '<p class="price_product">Giá: '.number_format($row_pro['price'],0,',','.').' đ</p>';
        echo '</li>';
        }
    } else {
        echo 'Không có sản phẩm ngẫu nhiên';
    }
}
            ?>
        </ul>
    </div>
    <div class="clear"></div>
</div>
</body>