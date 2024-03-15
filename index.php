<?php
    session_start();
    ob_start();
    include "model/connectdb.php";


    include "view/header.php";
   
    if(isset($_GET['act'])){
        switch ($_GET['act']) {
            case 'about':
                include "view/about.php";
                break;
            
            case 'sanpham':
                include "view/sanpham.php";
                break;
            
            case 'lienhe':
                include "view/lienhe.php";
                break;    
                
            case 'home':
                include "view/home.php";
                break;

            case 'thoat':
                header ('location:login/logout.php');
                break;

            case 'login':
                if(!isset($_SESSION['user_name'])){
                    header('location: login/login.php');
                }
                break;
            
            case 'forgot':
                header('location: login/forgot_pass.php');
                break;

            case 'home_admin':
                header('location: admin/index.php');
                break;
            
            case 'mail_admin':
                header('location: admin/view_admin/mail.php');
                break;
            
            case 'qldh_admin':
                header('location: admin/view_admin/qldh.php');
                break;
            
            case 'qlkh_admin':
                header('location: admin/view_admin/qlkh.php');
                break;

            case 'qlsp_admin':
                header('location: admin/view_admin/qlsp.php');
                break;

            default:
                include "view/home.php";
                break;
        }
    } else{
        include "view/home.php";
    }  
    include "view/footer.php";
?>