<?php
    session_start();
    ob_start();
    include "model/connectdb.php";


    include "view/header.php";
   
    if(isset($_GET['act'])){
        switch ($_GET['act']) {
            case 'search':
                include "view/search.php";
                break;

            case 'about':
                include "view/about.php";
                break;
            
            case 'sanpham':
                include "view/sanpham.php";
                break;

            case 'chitietsp':
                include "view/chitietsp.php";
                break;
                
            case 'lienhe':
                include "view/lienhe.php";
                break;    
                
            case 'thanhtoan':
                include "view/thanhtoan.php";
                break;
                
            case 'home':
                include "view/home.php";
                break;

            case 'thoat':
                header ('location:view/login/logout.php');
                break;

            case 'login':
                if(!isset($_SESSION['user_name'])){
                    header('location: view/login/login.php');
                }
                break;
            
            case 'forgot':
                header('location: view/login/forgot_pass.php');
                break;

            case 'profile':
                header('location: view/profile.php');
                break;
            
            case 'update_pass':
                header('location: view/updatepass.php');
                break;
                
            case 'giohang':
                include "view/view-cart.php";
                break;

            default:
                include "view/home.php";
                break;
        }
    } else if (isset($_GET['submit']) && isset($_GET['search'])) {
        $product_name = $_GET['search'];
        $search_url = "view/search.php?product_name=" . urlencode($product_name);
        header("Location: $search_url");
        exit();
    } else{
        include "view/home.php";
    }  
    include "view/footer.php";
?>