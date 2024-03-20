<style>
    .qltk{
        margin-top: 100px;
        font-family: 'Roboto', sans-serif;
    }

    .qltk table{
        width: 80%;
        border: 1px solid black;
        margin: 10px 0px 0px 100px;
    }
    .qltk table th{
        border: 1px solid black;
        height: 50px;
        background-color: #116A7B;
        color: #ECE5C7;
    }
    .qltk table td{
        text-align: center;
        border: 1px solid black;
        height: 50px;
    }
</style>
<body>
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
</body>
