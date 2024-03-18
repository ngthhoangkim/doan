<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>ADMIN | LUXURIOUS</title>
    <link rel="stylesheet" href="../public/css/admin.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="shortcut icon" type="../public/image/x-icon" href="../public/img/logotron.png"><!--chỉnh logo trên tiêu đề -->
</head>
<body>
   <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3>A<span>dmin</span></h3>
        </div>
        
        <div class="side-content">
            <div class="profile">
                <a href="../admin/index.php?act=profile"><div class="profile-img bg-img" style="background-image: url(../public/img/avata.png)"></div></a>
                <h4><?php echo $_SESSION['admin_name'] ?></h4>
            </div>

            <div class="side-menu">
                <ul>
                    <li>
                       <a href="../admin/index.php" class="active">
                            <span class="las la-home"></span>
                            <small>Home</small>
                        </a>
                    </li>
                    <li>
                       <a href="../admin/index.php?act=mailbox">
                            <span class="las la-envelope"></span>
                            <small>Mailbox</small>
                        </a>
                    </li>
                    <li>
                       <a href="../admin/index.php?act=qlsanpham">
                            <span class="las la-clipboard-list"></span>
                            <small>Sản phẩm</small>
                        </a>
                    </li>
                    <li>
                       <a href="../admin/index.php?act=qldonhang">
                            <span class="las la-shopping-cart"></span>
                            <small>Đơn hàng</small>
                        </a>
                    </li>
                    <li>
                       <a href="../admin/index.php?act=qltaikhoan">
                            <span class="las la-user"></span>
                            <small>Khách hàng</small>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    
    <div class="main-content">
        
        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>
                
                <div class="header-menu">
                    <label for="">
                        <span class="las la-search"></span>
                    </label>
                    <div class="user">
                        <div class="bg-img" style="background-image: url(../public/img/avata.png)"></div>
                        
                        <span class="las la-power-off"></span>
                        <a href="../index.php?act=thoat">Logout</a>
                    </div>
                </div>
            </div>
        </header>