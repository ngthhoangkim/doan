<?php
    @include '../model/connectdb.php.php';

    session_start();
    
    if(!isset($_SESSION['admin_name'])){
       header('location:../login/login.php');
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>ADMIN | LUXURIOUS</title>
    <link rel="stylesheet" href="../../public/css/admin.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="shortcut icon" type="../../public/image/x-icon" href="../../public/img/logotron.png"><!--chỉnh logo trên tiêu đề -->
    <link rel="apple-touch-icon" href="../../public/img/logotron.png"> <!--chỉnh logo trên tiêu đề  -->

</head>
<body>
   <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3>A<span>dmin</span></h3>
        </div>
        
        <div class="side-content">
            <div class="profile">
                <div class="profile-img bg-img" style="background-image: url(../../public/img/avata.png)"></div>
                <h4><?php echo $_SESSION['admin_name'] ?></h4>
                
            </div>

            <div class="side-menu">
                <ul>
                    <li>
                       <a href="../../index.php?act=home_admin" class="active">
                            <span class="las la-home"></span>
                            <small>Home</small>
                        </a>
                    </li>
                    <li>
                       <a href="../../index.php?act=mail_admin">
                            <span class="las la-envelope"></span>
                            <small>Mailbox</small>
                        </a>
                    </li>
                    <li>
                       <a href="../../index.php?act=qlsp_admin">
                            <span class="las la-clipboard-list"></span>
                            <small>Sản phẩm</small>
                        </a>
                    </li>
                    <li>
                       <a href="../../index.php?act=qldh_admin">
                            <span class="las la-shopping-cart"></span>
                            <small>Đơn hàng</small>
                        </a>
                    </li>
                    <li>
                       <a href="../../index.php?act=qlkh_admin">
                            <span class="las la-user"></span>
                            <small>Khách hàng</small>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>

