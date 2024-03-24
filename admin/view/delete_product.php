<?php
    @include '../../model/connectdb.php';
    if(isset($_REQUEST['delete_id']) and $_REQUEST['delete_id']!=""){

        $id=$_GET['delete_id'];
        $sql = "DELETE FROM products WHERE id ='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Xoá thành công!";
        } else {
            echo "Error updating record: " . $conn->error;
    }
    $conn->close();
    }
?>