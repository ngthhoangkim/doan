<?php
    @session_start(); // Khai báo session_start()

    // Bao gồm file kết nối đến cơ sở dữ liệu
    @include '../model/connectdb.php';
    

    // Kiểm tra xem người dùng đã đăng nhập chưa
    $isLoggedIn = isset($_SESSION['username']);

    // Nếu người dùng chưa đăng nhập và không phải trang đăng nhập
    if (!$isLoggedIn && basename($_SERVER['PHP_SELF']) != 'login.php') {
        // Chuyển hướng đến trang đăng nhập
        header('Location: http://localhost/doan/login/login.php');
        exit; // Dừng việc thực thi mã PHP tiếp theo
    }

    // Cập nhật lại trạng thái đăng nhập sau khi người dùng đăng nhập thành công
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Kiểm tra username và password trong cơ sở dữ liệu
        if ($username == 'username' && $password == 'pass') {
            $_SESSION['isLoggedIn'] = true;
            // Chuyển hướng về trang thanh toán sau khi đăng nhập thành công
            header('Location: http://localhost/doan/index.php?act=thanhtoan.php');
            exit;
        }
    }

?>

<head>
    <link rel="apple-touch-icon" href="public/img/logotron.png"> <!--chỉnh logo trên tiêu đề  -->
    <link rel="shortcut icon" type="public/image/x-icon" href="public/img/logotron.png"><!--chỉnh logo trên tiêu đề  -->

    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/main.css">


    <!-- font chữ: Roboto -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="public/css/fontawesome.min.css">

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* Chiều cao tối thiểu của body là 100% của viewport */
            margin: 0;
        }

        .background-image {
            flex: 1;
            /* Phần này sẽ mở rộng để lấp đầy không gian giữa header và footer */
            display: flex;
            align-items: center;
            justify-content: center;
        }


        main {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 105vh;
            /* Chiều cao tối thiểu của main là 100% chiều cao của viewport */
            scroll-behavior: smooth;
            overflow: auto;
            scroll-behavior: smooth;

        }

        .overlay-content {
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            /* Căn giữa nội dung */
            z-index: 1;
            /* Đảm bảo nội dung hiển thị trên ảnh nền */
            width: 80%;
            /* Chiều rộng của overlay-content */
            max-width: 800px;
            /* Giới hạn chiều rộng tối đa */
            background: rgba(0, 0, 0, 0.5);
            /* Màu nền của overlay-content với độ mờ là 50% */
            margin-top: 150px;
        }

        /*style.css*/
        .header_checkout {
            display: flex;
            justify-content: space-evenly;
        }

        .info_user {
            padding: 20px;
            background-color: white;
            margin-top: 20px;
            height: 540px;
        }

        .info_user,
        .info_order {
            height: auto;
            /* Thiết lập chiều cao tự động */
            min-height: 600px;
            /* Đảm bảo chiều cao tối thiểu của phần tử */
            overflow: auto;
            /* Bật tính năng cuộn nếu nội dung vượt quá kích thước */
        }

        .header_checkout .form-group label {
            display: block;
            font-weight: bold;
            margin: 2px;
        }

        .header_checkout .form-group input,
        .header_checkout .form-group textarea {
            display: block;
        }

        .header_checkout .form-group input {
            width: 350px;
            padding: 10px;
        }

        .header_checkout .form-group textarea {
            width: 350px;
            padding: 10px;
            height: 200px;
        }

        .header_checkout .introduce_order,
        .header_checkout .introduce_info {
            text-align: center;
            border-bottom: 1px solid black;
            padding-bottom: 5px;
        }

        .header_checkout .info_order {
            background-color: white;
            margin-top: 20px;
            padding: 10px;
            height: auto;
        }

        .header_checkout .info_order table thead tr th {
            padding: 5px;
            text-align: center;
        }

        .header_checkout .info_order table tbody tr td {
            text-align: center;
            padding-bottom: 10px;
        }

        .header_checkout .name_product {
            width: 50%;
        }

        .header_checkout table {
            border-bottom: 1px solid black;
        }

        .header_checkout .total_product {
            font-size: 20px;
            width: 50%;
            font-weight: 600;
            margin-top: 10px;
        }

        .header_checkout .submit_checkout {
            padding: 10px;
            background-color: tomato;
            border: none;
            font-weight: 600;
            font-size: 17px;
            text-align: center;
            cursor: pointer;
        }

        .header_checkout button {
            margin-left: 200px;
            margin-top: 10px;
        }

        .require_login {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .require_login .frame_require_login {
            margin-top: 20px;
            padding: 130px 20px 20px 20px;
            background-color: white;
            height: 300px;
        }
    </style>
</head>


<body>
    <main>
        <?php
            // Lấy giá trị 'id' từ biến session hoặc từ dữ liệu đầu vào của người dùng
            $userId = isset($_SESSION['userId']) ? intval($_SESSION['userId']) : 0;

            if ($userId > 0) {
                // Truy vấn để lấy thông tin từ bảng 'users' dựa trên 'id'
                $query = "SELECT * FROM users WHERE userId = $userId";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    $user = mysqli_fetch_assoc($result);
            
                    // Lấy thông tin sản phẩm từ giỏ hàng của người dùng
                    $query = "SELECT cart.*, products.name AS name_products FROM cart INNER JOIN products ON cart.product_id = products.id WHERE cart.user_id = $userId";
                    $result = mysqli_query($conn, $query);
                    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
                    // Xử lý thông tin sản phẩm ở đây
                } else {
                    echo "Không tìm thấy người dùng với ID: $userId";
                }
            } else {
                echo "ID người dùng không hợp lệ!";
            }
            

        ?>
        <div class="background-image">
            <div class="overlay-content">
                <h1>Checkout - Luxury Store</h1>
                <form method="POST">
                    <div class="header_checkout">

                        <!-- THÔNG TIN NGƯỜI DÙNG -->
                        <div class="info_user">
                            <div class="introduce_info" style="color:black">
                                <h2>Thông tin của bạn</h2>
                            </div>

                            <?php
                            // Xử lý dữ liệu biểu mẫu khi người dùng gửi
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                // Kiểm tra và xử lý dữ liệu gửi từ biểu mẫu
                                if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['sdt']) && isset($_POST['address'])) {
                                    $name = $_POST['name'];
                                    $email = $_POST['email'];
                                    $sdt = $_POST['sdt'];
                                    $address = $_POST['address'];

                                    // Cập nhật thông tin vào biến $users
                                    $users = array(
                                        'username' => $name,
                                        'email' => $email,
                                        'sdt' => $sdt,
                                        'address' => $address
                                    );
                                }
                            }

                            // Hiển thị form với thông tin nhập từ biến $users
                            ?>
                            <form method="POST">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Họ và tên</label>
                                    <input name="name" value="<?php echo $users['username'] ?>" type="text" 
                                        class="form-control" placeholder="Nhập tên của bạn"
                                        required="required">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input name="email" value="<?php echo $users['email'] ?>" 
                                        type="text" class="form-control"
                                        placeholder="Nhập email của bạn" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số điện thoại</label>
                                    <input name="sdt" value="<?php echo $users['sdt'] ?>" type="text" 
                                        class="form-control"
                                        placeholder="Nhập số điện thoại của bạn" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Địa chỉ nhận hàng</label>
                                    <input name="address" value="<?php echo $users['address'] ?>" 
                                        type="text" class="form-control"
                                        placeholder="Nhập địa chỉ của bạn" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Note</label>
                                    <textarea name="note" id="input" class="form-control" rows="3"
                                        placeholder="Notes (Không bắt buộc điền!)"></textarea>
                                </div>
                            </form>
                        </div>
                        
                        <!-- THÔNG TIN ĐƠN HÀNG -->
                        <div class="info_order" style="color: black">
                            <div class="introduce_order">
                                <h2>Thông tin đơn hàng</h2>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        // Lấy thông tin giỏ hàng từ session
                                        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

                                        foreach ($cart as $key => $values) : ?>
                                            <tr>
                                                <td class="name_product"><?php echo $values['name'] ?></td>
                                                <td><?php echo $values['qty'] ?></td>
                                                <td><?php echo number_format($values['sale_price'] * $values['qty'] * 1000) ?>,000đ</td>
                                            </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            
                            <!--    Chức năng tính tổng giá tiền   -->
                            <?php
                                // Khởi tạo biến lưu trữ tổng số tiền đơn hàng
                                $totalPrice = 0;
                                function total_price($cart)
                                {
                                    $total = 0;
                                    foreach ($cart as $item) {
                                        $total += $item['sale_price'] * $item['qty'];
                                    }
                                    return $total;
                                }
                            ?>

                            <div class="total_product">
                                <p>Tổng tiền: <?php echo number_format(total_price($cart) * 1000) ?>,000đ</p>
                            </div>
                            <div>
                                <button class="submit_checkout">Đặt hàng</button>
                            </div>

                        </div>
                    </div>
                </form>

                <br class="require_login">
                <div class="frame_require_login">
                    <strong></strong>
<!--                    <a style="text-decoration: none;font-weight: 600; font-size: 17px;" href="../login/login.php"> - Đăng nhập</a>  -->
                </div>

            </div>
        </div>

    </main>
</body>