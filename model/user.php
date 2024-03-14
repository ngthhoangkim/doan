<?php
    function checkuser($user,$pass){
        $conn = connectdb();
        $stmt = $conn -> prepare("SELECT * FROM taikhoan WHERE username = '".$user."' AND password = '".$pass."' ");
        $stmt->execute();
        $resulst = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt->fetchAll();
        if (count($kq) > 0) return $kq[0]['IDrole'];
        else return 0;
            
    }

    function getuser($user,$pass){
        $conn = connectdb();
        $stmt = $conn -> prepare("SELECT * FROM taikhoan WHERE username = '".$user."' AND password =  '".$pass."'");
        $stmt->execute();
        $resulst = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt->fetchAll();
        return $kq[0]['role'];          
    }
?>