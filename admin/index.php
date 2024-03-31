<?php
    @include '../model/connectdb.php';

    session_start();
    
    if(!isset($_SESSION['admin_name'])){
       header('location:../../view/login/login.php');
    }
     
    include "../admin/view/header.php";

    if(isset($_GET['act'])){
        switch ($_GET['act']) {
            case 'qldonhang':
                include "../admin/view/qldonhang.php";
                break;
            
            case 'mailbox':
                include "../admin/view/mailbox.php";
                break;    
                
            case 'qltaikhoan':
                include "../admin/view/qltaikhoan.php";
                break;
            
            case 'qlsanpham':
                include "../admin/view/qlsanpham.php";
                break;
            
            case 'view_product' :
                include "../admin/view/view_sanpham.php";
                break;
            
            default:
                include "view/home.php";
                break;
        }
    } else{
        include "view/home.php";
    }  
    // include "view/footer.php";
?>