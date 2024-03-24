<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto:400,400i,700&display=swap');
    .dssp {
        margin-top: 100px;
        font-family: 'Roboto', sans-serif;
    }

    .dssp h2{
        text-align: center;
        margin-bottom: 30px;
        font-family: 'Roboto', sans-serif;
    }

    .dssp .search-bar {
        margin-bottom: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        
    }

    .dssp .search-input {
        width: 500px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-family: 'Roboto', sans-serif;
    }

    .dssp table {
        width: 100%;
        border-collapse: collapse;
        margin-left: 3px;
    }

    .dssp th, .dssp td {
        padding: 8px;
        text-align: center;
        border: 1px solid black;
    }

    .dssp th {
        background-color: #088395;
        color: #ECE5C7 ;
    }
    .dssp .edit-button, .dssp .delete-button {
        padding: 6px 12px;
        background-color: #116A7B;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-right: 5px;
        margin-bottom: 5px;
    }

    .dssp .edit-button:hover, .dssp .delete-button:hover {
        background-color: #088395;
    }

    .dssp .edit-button:active, .dssp .delete-button:active {
        background-color: #088395;
    }

    .add_button {
        padding: 10px 20px;
        background-color: #116A7B;
        color: white;
        border-radius: 4px;
        cursor: pointer;
        margin-left: 20px;
        font-family: 'Roboto', sans-serif;
    }

    img{
        width: 100px; 
        height: 100px;
    }
</style>

<main>
    <div class="dssp">
        <a href="../admin/index.php?act=qlsanpham"><button class="add_button">Thêm mới</button></a>
        <h2>Danh sách sản phẩm</h2>
        <div class="search-bar">
            <input type="text" class="search-input" placeholder="Nhập từ khóa tìm kiếm">
        </div>
        <table>
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Loại</th>
                    <th>Giá sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
                <?php
                    //kết nối csdl
                    $conn = mysqli_connect("localhost","root","","dbtrangsuc");
                    $idList = array();
                    //truy vấn 
                    $sql = "SELECT products.*, type.name_type FROM products INNER JOIN type ON products.id_type = type.id";
                    $result=mysqli_query($conn,$sql);
                    //in ra
                    while($row=mysqli_fetch_assoc($result)){
                        $idList[] = $row['id'];
                        $name_product = $row['name'];
                        $qty_product = $row['qty'];
                        $price_product = $row['price'];
                        $method_product = $row['method'];
                        $img_product = $row['image'];
                        $type_product = $row['name_type'];
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $name_product ?></td>
                        <td><?php echo $type_product ?></td>
                        <td><?php echo $price_product ?></td>
                        <td><?php echo $qty_product ?></td>
                        <td><?php echo $method_product ?></td>
                        <td><img src="<?php echo '../admin/update_img/' . $row['image']; ?>" alt="Hình ảnh sản phẩm"></td>
                        <td>
                            <a href="view/edit_product.php?edit_id=<?php echo $row['id'];?>"><button class="edit-button">Sửa</button></a>
                            <a href="view/delete_product.php?delete_id=<?php echo $row['id'];?>"><button class="delete-button">Xóa</button></a>
                        </td>
                    </tr>
                </tbody>
                <?php
                    }
                    mysqli_close($conn);
                ?>
        </table>
    </div> 
</main>
