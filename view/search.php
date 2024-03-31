<?php
@session_start(); // Khai báo session_start()

// Bao gồm file kết nối đến cơ sở dữ liệu
@include '../model/connectdb.php';

// Kết nối đến cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "dbtrangsuc");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Biến để kiểm tra đã thực hiện kiểm tra hay chưa
$checked = false;

// Kiểm tra nếu có tham số product_name trong URL
if (isset($_GET['product_name'])) {
    $product_name = $_GET['product_name'];

    // Câu lệnh SQL để lấy dữ liệu từ bảng products
    $sql = "SELECT * FROM products WHERE name LIKE '%$product_name%'";

    // Thực thi câu lệnh SQL
    $result = $conn->query($sql);

    // Đã thực hiện kiểm tra
    $checked = true;
}


$limit = 20; // Số sản phẩm hiển thị trên một trang
$cr_page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1; // Trang hiện tại

if (isset($_GET['product_name'])) {
    $search_term = $_GET['product_name'];

    // Số sản phẩm phù hợp với từ khóa tìm kiếm
    $countSql = "SELECT COUNT(*) as total FROM products WHERE name LIKE '%$search_term%'";
    $resultCount = $conn->query($countSql);
    $total_table = $resultCount->fetch_assoc()['total'];

    // Tính tổng số trang dựa trên tổng số sản phẩm và số sản phẩm trên một trang
    $page = ceil($total_table / $limit);

    // Đảm bảo trang hiện tại không vượt quá số trang tìm được
    if ($cr_page > $page) {
        $cr_page = $page;
    }

    // Đảm bảo trang hiện tại không nhỏ hơn 1
    if ($cr_page < 1) {
        $cr_page = 1;
    }

    // Tính start để phân trang
    $start = ($cr_page - 1) * $limit;

    // Truy vấn dữ liệu sản phẩm cần tìm kiếm với phân trang
    $searchSql = "SELECT * FROM products WHERE name LIKE '%$search_term%' LIMIT $start, $limit";
    $resultSearch = $conn->query($searchSql);
} else {
    $error_search = "Không tìm thấy sản phẩm cần tìm";
}


?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <title>SEARCH</title>
    <link rel="apple-touch-icon" href="../public/img/logotron.png">
    <link rel="shortcut icon" type="../public/image/x-icon" href="../public/img/logotron.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Sử dụng CSS Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
        }

        .content {
            margin-top: 20px;
        }

        .content_frame {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
        }

        .content_card {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .content_item {
            border: 1px solid #e1e1e1;
            padding: 20px;
            position: relative;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .content_item:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }

        .img_product img {
            max-width: 100%;
            height: auto;
        }

        .in_stock {
            display: flex;
            align-items: center;
            color: green;
            margin-bottom: 10px;
        }

        .click_order {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            background-color: rgba(123, 95, 95, 0.8);
            color: #fff;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .content_item:hover .click_order {
            opacity: 1;
        }

        .click_order a {
            color: #fff;
            text-decoration: none;
        }

        .click_order button {
            background-color: #0655a6;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .click_order button:hover {
            background-color: #043d73;
        }

        .describe_product {
            margin-top: 10px;
            font-weight: bold;
        }

        .cost_product p {
            color: gray;
            font-size: 17px;
        }

        .cost_product h2 {
            color: #ff6600;
            font-size: 20px;
        }

        .page_number {
            margin-top: 25px;
            text-align: center;
        }

        .page_number ul {
            display: inline-flex;
            list-style-type: none;
        }

        .page_number ul li {
            margin: 0 5px;
        }

        .page_number ul li a {
            display: block;
            padding: 5px 10px;
            border: 1px solid #ccc;
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
        }

        .page_number ul li a:hover {
            background-color: #ff6600;
            color: #fff;
        }

        .back-button {
            text-align: center;
        }

        .back-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff6600;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .back-button a:hover {
            background-color: #e65c00;
        }
    </style>
</head>

<body>
    <main>

        <div class="search">
            <div class="search_frame" style="padding: 10px 20px">
                <form action="search.php" id="search_box" method="GET" role="form">
                    <input id="search_text" name="product_name" type="text" placeholder="Nhập tên sản phẩm cần tìm...">
                    <button id="search_submit" type="submit"><i class="fas fa-search"></i></button>
                </form>

                <div class="back-button">
                    <a href="../index.php" class="mot">Quay về trang chủ</a>
                </div>
            </div>
        </div>
        <!--Area of content-->
        <div class="content">
            <div class="content_type"></div>
            <div class="content_product">
                <div class="content_frame">
                    <div class="content_card">
                        <?php if (isset($resultSearch) && $resultSearch->num_rows > 0): ?>
                            <?php foreach ($resultSearch as $info_product): ?>
                                <div class="content_item">
                                    <?php
                                    $statusArray = array();
                                    $statusArray['status'] = 'active';
                                    ?>
                                    <div class="in_stock">
                                        <?php if (isset($info_product['status'])): ?>
                                            <?php if ($info_product['status'] == 'active'): ?>
                                                <i class="far fa-check-circle"></i>
                                                <p>In stock</p>
                                            <?php else: ?>
                                                <i style="color: red;" class="fas fa-times-circle"></i>
                                                <p style="color: red;">
                                                    <?php echo $info_product['status'] ?>
                                                </p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="img_product">
                                        <a href="chitietsp.php?id=<?php echo $info_product['id'] ?>">
                                            <img src="../admin/update_img/<?php echo $info_product['image'] ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="click_order">
                                        <p>
                                            <a href="chitietsp.php?id=<?php echo $info_product['id'] ?>">Click để xem chi
                                                tiết</a>
                                        </p>
                                        <button>
                                            <a style="text-decoration: none; color:white;"
                                                href="../index.php?act=giohang&id=<?php echo $info_product['id'] ?>">Đặt hàng</a>
                                        </button>
                                    </div>
                                    <div class="describe_product">
                                        <p>
                                            <?php echo $info_product['name'] ?>
                                        </p>
                                    </div>
                                    <div class="cost_product">
                                        <p style="">
                                            <?php echo $info_product['price'] ?>₫
                                        </p>
                                        <?php if (isset($info_product['sale_price'])): ?>
                                            <h2>
                                                <?php echo $info_product['sale_price'] ?>.000₫
                                            </h2>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p style="font-weight: 600;">Không tìm thấy sản phẩm nào phù hợp.</p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
            <?php if (isset($resultSearch)) { ?>
                <div class="page_number">
                    <div class="number">
                        <ul>
                            <?php if ($cr_page - 1 > 0) { ?>
                                <li class="number1"><a
                                        href="search.php?page=<?php echo $cr_page - 1 ?>&product_name=<?php echo isset($_GET['product_name']) ? $_GET['product_name'] : '' ?>"><i
                                            class="fas fa-chevron-left"></i></a></li>
                            <?php } ?>
                            <?php for ($i = 1; $i <= ceil($total_table / $limit); $i++) { ?>
                                <li class="number1 <?php echo (($cr_page == $i) ? 'active' : '') ?>"><a
                                        href="search.php?page=<?php echo $i ?>&product_name=<?php echo isset($_GET['product_name']) ? $_GET['product_name'] : '' ?>">
                                        <?php echo $i ?>
                                    </a></li>
                            <?php } ?>
                            <?php if ($cr_page + 1 <= ceil($total_table / $limit)) { ?>
                                <li class="number1"><a
                                        href="search.php?page=<?php echo $cr_page + 1 ?>&product_name=<?php echo isset($_GET['product_name']) ? $_GET['product_name'] : '' ?>"><i
                                            class="fas fa-chevron-right"></i></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            <?php } else { ?>
                <div class="unknown"></div>
            <?php } ?>
        </div>

    </main>

</body>

</html>