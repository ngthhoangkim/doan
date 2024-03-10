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
                unset($_SESSION['role']);
                header ('location:login/index.php');
                        
            // case 'login':
                
            //     if (isset($_POST['login'])&&($_POST['login'])) {
            //         $user = $_POST['username'];
            //         $pass = $_POST['password'];

            //         $kq = getuser($user,$pass);
            //         $role = $kq[0]['role'];

            //         if($role==1){
            //             $_SESSION['role'] = $role;
            //             header ('location:admin/index.php');
            //         }else{
            //             $_SESSION['role'] = $role;
            //             $_SESSION['iduser'] = $kq[0]['id'];
            //             $_SESSION['user'] = $kq[0]['user'];
            //             header ('location: doan/index.php');
            //             break;
            //         }
            //     }
            
            default:
                include "view/home.php";
                break;
        }
    } else{
        include "view/home.php";
    }  
    include "view/footer.php";
?>