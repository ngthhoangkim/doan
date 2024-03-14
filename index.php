<?php
    session_start();
    ob_start();
    include "model/connectdb.php";
    include "model/user.php";

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
                        
            case 'login':
                if(!isset($_SESSION['user_name'])){
                    header('location: login/login.php');
                }
            
            case 'forgot':
                header('location: login/forgot_pass.php');
            default:
                include "view/home.php";
                break;
        }
    } else{
        include "view/home.php";
    }  
    include "view/footer.php";
?>