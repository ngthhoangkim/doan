<?php
    @include '../../model/connectdb.php';

    if(isset($_REQUEST['delete_id']) and $_REQUEST['delete_id']!=""){

        $id=$_GET['delete_id'];
        $sql = "DELETE FROM products WHERE id ='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>confirm('Xóa thành công');</script>";
            echo "<html><a href='../index.php?act=view_product'>Quay lại</a></html>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    $conn->close();
    }
?>