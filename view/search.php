<?php
@session_start(); // Khai báo session_start()

// Bao gồm file kết nối đến cơ sở dữ liệu
@include '../model/connectdb.php';

$limit = 50; // Số sản phẩm hiển thị trên một trang
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
    <link rel="apple-touch-icon" href="../public/img/logotron.png"> <!--chỉnh logo trên tiêu đề  -->
    <link rel="shortcut icon" type="../public/image/x-icon" href="../public/img/logotron.png">
    <!--chỉnh logo trên tiêu đề  -->

    <style>
        /*Xu ly content*/
        .content_type,
        .content_product,
        .page_number {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .content_frame {
            margin-top: 20px;
            height: auto;
            background-color: white;
            width: 100%;
            max-width: 1200px;
            /* Giới hạn chiều rộng tối đa */
            margin-left: auto;
            margin-right: auto;
            padding-left: 20px;
            padding-right: 20px;
        }

        .content_item {
            border: 1px solid #e1e1e1;
            padding: 20px 0;
            position: relative;
        }

        .content_item .img_product img {
            position: relative;
            width: 227px;
            height: 227px;
        }

        .content_item .in_stock {
            display: flex;
            color: green;
            margin-left: 10px;
        }

        .content_card {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            padding: 5px 5px;
        }

        .describe_product,
        .cost_product {
            margin-top: 10px;
            margin-left: 10px;
        }

        .cost_product p {
            text-decoration-line: line-through;
            color: gray;
            font-size: 17px
        }

        .click_order {
            display: flex;
            padding: 10px 5px;
            background-color: rgb(123 95 95 / 80%);
            position: absolute;
            top: 65%;
            opacity: 0;
        }

        .click_order p a {
            color: white;
            text-decoration: none;
        }

        .click_order button {
            margin-left: 15px;
            background-color: rgb(6 85 166);
            padding: 0px 9.5px;
            border: none;
            cursor: pointer;
        }

        .click_order button:hover {
            background-color: rgb(6 85 166);
        }

        .content_item:hover .click_order {
            opacity: 1;
            transition: all 0.5s;
            transform: translateY(-50%);
        }

        .content_item:hover {
            border: 1px solid yellow;
        }

        .page_number {
            margin-top: 25px;
        }

        .page_number .number ul {
            display: flex;
        }

        .page_number .number ul li a {
            text-decoration: none;
            color: black;
            font-size: 16px;
        }

        .page_number .number ul li {
            border: 2px solid black;
            margin: 10px;
            border-radius: 30px;
            list-style: none;
            padding: 5px 10px;
        }

        .page_number .number li:hover {
            background-color: yellow;
            transition: all 0.7s;
        }

        /*Ket thuc content*/
    </style>
</head>

<body>
    <main>
        <div class="search">
            <div class="search_frame">
                <form action="search.php" id="search_box" method="GET" role="form">
                    <input id="search_text" name="product_name" type="text" placeholder="Nhập tên sản phẩm cần tìm...">
                    <button id="search_submit" type="submit"><i class="fas fa-search"></i></button>
                </form>
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
                                        <?php if (isset($info_product['status']) && $info_product['status'] == 'active'): ?>
                                            <i class="far fa-check-circle"></i>
                                            <p>In stock</p>
                                        <?php else: ?>
                                            <i style="color: red;" class="fas fa-times-circle"></i>
                                            <p style="color: red;">Sold out</p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="img_product">
                                        <a href="product_detail.php?id=<?php echo $info_product['id'] ?>">
                                            <img src="../admin/update_img/<?php echo $info_product['image'] ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="click_order">
                                        <p>
                                            <a href="chitietsp.php?id=<?php echo $info_product['id'] ?>">Click để xem chi tiết</a>
                                        </p>
                                        <button>
                                            <a style="text-decoration: none; color:white;" href="./view-cart.php?id=<?php echo $info_product['id'] ?>">Đặt hàng</a>
                                        </button>
                                    </div>
                                    <div class="describe_product">
                                        <p>
                                            <?php echo $info_product['name'] ?>
                                        </p>
                                    </div>
                                    <div class="cost_product">
                                        <p style="">
                                            <?php echo $info_product['price'] ?>.000₫
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