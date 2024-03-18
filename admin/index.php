<?php
    @include '../model/connectdb.php.php';

    session_start();
    
    if(!isset($_SESSION['admin_name'])){
       header('location:../login/login.php');
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

    //         case 'thoat':
    //             unset($_SESSION['role']);
    //             header ('location:login/index.php');
                        
    //         case 'login':
    //             if (isset($_POST['login'])&&($_POST['login'])) {
    //                 $user = $_POST['username'];
    //                 $pass = $_POST['password'];

    //                 $kq = getuser($user,$pass);
    //                 $role = $kq[0]['role'];

    //                 if($role==1){
    //                     $_SESSION['role'] = $role;
    //                     header ('location:admin/index.php');
    //                 }else{
    //                     $_SESSION['role'] = $role;
    //                     $_SESSION['iduser'] = $kq[0]['id'];
    //                     $_SESSION['user'] = $kq[0]['user'];
    //                     header ('location: doan/index.php');
    //                     break;
    //                 }
    //             }
            
            default:
                include "view/home.php";
                break;
        }
    } else{
        include "view/home.php";
    }  
    // include "view/footer.php";
?>