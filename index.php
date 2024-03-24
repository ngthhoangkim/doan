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

            case 'profile':
                header('location: view/profile.php');
                break;
            
            case 'update_pass':
                header('location: view/updatepass.php');
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