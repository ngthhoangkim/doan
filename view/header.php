<!DOCTYPE html>
<html lang="en">

<head>
    <title>Luxurious</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet"href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="apple-touch-icon" href="public/img/logotron.png"> <!--chỉnh logo trên tiêu đề  -->
    <link rel="shortcut icon" type="public/image/x-icon" href="public/img/logotron.png"><!--chỉnh logo trên tiêu đề  -->

    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/main.css">



    <!-- font chữ: Roboto -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="public/css/fontawesome.min.css">
</head>

<body>
    <!--phần top nav-->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="#">luxurious-strore@gmail.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="#">010-020-0340</a>
                </div>
                <div>
                    <a class="text-light" href="#" target="_blank" rel="sponsored"><i
                            class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="#" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                </div>
            </div>
        </div>
    </nav>
    <!--end-->
    <!-- Phần Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="index.php">
                Luxurious
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between"
                id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?act=about">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?act=sanpham">Sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?act=lienhe">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                        <i class="fa fa-fw fa-search text-dark mr-2"></i></a>
                    </a>
                    <!-- <a class="nav-icon position-relative text-decoration-none" href="index.php?act=giohang">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                    </a> -->
                    <?php
                    if (isset ($_SESSION['username'])) {
                        // echo $_SESSION['username'];
                        echo '
                            <a style="color:#116A7B;" class="nav-icon position-relative text-decoration-none" href="index.php?act=profile">' . $_SESSION['username'] . '</a>
                            <span class="las la-power-off"></span>
                            <a  style="text-decoration: none; color: black" href="index.php?act=thoat">Logout</a>
                        ';
                    } else {
                        //     
                        // }
                        ?>
                        <a class="nav-icon position-relative text-decoration-none" href="index.php?act=login">
                            <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        </a>
                    <?php } ?>


                </div>
            </div>

        </div>
    </nav>
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="search" placeholder="Search ...">
                    <button type="submit" name="submit" class="input-group-text bg-success text-light">
                        <a href="index.php?act=search.php"><i class="fa fa-fw fa-search text-white"></i></a>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Header -->
</body>

<!-- js -->
<script src="public/js/jquery-1.11.0.min.js"></script>
    <script src="public/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/templatemo.js"></script>
    <script src="public/js/custom.js"></script>
<!-- end js -->