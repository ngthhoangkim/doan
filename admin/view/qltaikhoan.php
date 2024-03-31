<style>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Roboto', sans-serif;
    }

    .qltk1 {
        background-size: cover;
        padding-top: 100px; /* Thay đổi margin-top thành padding-top */
    }

    .qltk {
        width: 80%;
        margin: 0 auto; /* Canh giữa nội dung */
        color: #333; /* Màu chữ chính */
    }

    .qltk table {
        width: 100%; /* Sửa chiều rộng của bảng */
        border-collapse: collapse; /* Loại bỏ khoảng cách giữa các ô */
        margin-top: 20px; /* Thêm khoảng cách từ bảng đến tiêu đề */
    }

    .qltk table th,
    .qltk table td {
        border: 1px solid black;
        padding: 10px; /* Thêm padding cho ô */
    }

    .qltk table th {
        background-color: #116A7B;
        color: #ECE5C7;
        text-align: center; /* Căn giữa nội dung trong thẻ th */
    }

    .qltk table td {
        text-align: center;
    }
</style>

</style>
<body>
    <div class="qltk1">
    <main class="qltk">
        <h3 align="center" >THÔNG TIN KHÁCH HÀNG</h3>
        <table align="center" cellpadding=0 cellspacing=0>
            <tr>
                <th>ID</th>
                <th>USERNAME</th>
                <th>EMAIL</th>
                <th>PHONE</th>
                <th>ADDRESS</th>
                <th>AVATA</th>
            </tr>
            <?php
                //kết nối csdl
                $conn = mysqli_connect("localhost","root","","dbtrangsuc");
                //truy vấn 
                $sql = "SELECT * FROM users";
                $result=mysqli_query($conn,$sql);
                //in ra
                while($row=mysqli_fetch_assoc($result)){
                    $id = $row['id'];
                    $username = $row['username'];
                    $email = $row['email'];
                    $user_type = $row['user_type'];
                    $img = $row['image'];
                    $address = $row['address'];
                    $phone = $row['phone'];
            ?>
            <tr>
                <td><?php echo $id ?></td>
                <td><?php echo $username ?></td>
                <td><?php echo $email ?></td>
                <td><?php echo $phone?></td>
                <td><?php echo $address?></td>
                <td><?php echo $img ?></td>
            </tr>
            <?php } ?>
        </table>
    </main>
    </div>
</body>
