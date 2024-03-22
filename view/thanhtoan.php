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


        /*        .background-image {
            background-image: url('../public/img/thanhtoan.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
            color: white;           Màu văn bản trên ảnh 
            height: 100%;           Đảm bảo chiều cao của phần tử background-image là 100% của trình duyệt
        }   */

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
        <div class="background-image">
            <div class="overlay-content">
                <h1>Checkout - Luxury Store</h1>
                <form method="POST">
                    <div class="header_checkout">
                        <div class="info_user">
                            <div class="introduce_info" style="color:black">
                                <h2>Thông tin của bạn</h2>
                            </div>
                            <form>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Họ và tên</label>
                                    <input name="name" type="text" class="form-control" placeholder="Nhập tên của bạn"
                                        required="required">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input name="email" type="text" class="form-control"
                                        placeholder="Nhập email của bạn" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số điện thoại</label>
                                    <input name="sdt" type="text" class="form-control"
                                        placeholder="Nhập số điện thoại của bạn" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Địa chỉ nhận hàng</label>
                                    <input name="address" type="text" class="form-control"
                                        placeholder="Nhập địa chỉ của bạn" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Note</label>
                                    <textarea name="note" id="input" class="form-control" rows="3"
                                        placeholder="Notes (Không bắt buộc điền!)"></textarea>
                                </div>
                            </form>
                        </div>
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
                                    <tr>
                                        <td class="name_product"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="total_product">
                                <p>Tổng tiền</p>
                            </div>
                            <div>
                                <button class="submit_checkout">Đặt hàng</button>
                            </div>

                        </div>
                    </div>
                </form>

                <br class="require_login">
                <div class="frame_require_login">
                    <strong>Vui lòng đăng nhập để đặt hàng!</strong>
                    <a style="text-decoration: none;font-weight: 600; font-size: 17px;" href="../login/login.php"> -
                        Đăng nhập</a>
                </div>

            </div>
        </div>

    </main>
</body>