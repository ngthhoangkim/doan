<head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;800&display=swap');
.container {
    margin: 30px auto
}
.container .product-item {
    min-height: 450px;
    border: none;
    overflow: hidden;
    position: relative;
    border-radius: 0
}

.container .product-item .product {
    width: 100%;
    height: 350px;
    position: relative;
    overflow: hidden;
    cursor: pointer
}

.container .product-item .product img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.container .product-item .product .icons .icon {
    width: 40px;
    height: 40px;
    background-color: #fff;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: transform 0.6s ease;
    transform: rotate(180deg);
    cursor: pointer
}

.container .product-item .product .icons .icon:hover {
    background-color: #10c775;
    color: #fff
}

.container .product-item .product .icons .icon:nth-last-of-type(3) {
    transition-delay: 0.2s
}

.container .product-item .product .icons .icon:nth-last-of-type(2) {
    transition-delay: 0.15s
}

.container .product-item .product .icons .icon:nth-last-of-type(1) {
    transition-delay: 0.1s
}

.container .product-item:hover .product .icons .icon {
    transform: translateY(-60px)
}

.container .product-item .tag {
    text-transform: uppercase;
    font-size: 0.75rem;
    font-weight: 500;
    position: absolute;
    top: 10px;
    left: 20px;
    padding: 0 0.4rem;
}

.container .product-item .title {
    font-size: 0.95rem;
    letter-spacing: 0.5px
}

.container .product-item .fa-star {
    font-size: 0.65rem;
    color: #ff0000;
}

.container .product-item .price {
    margin-top: 10px;
    margin-bottom: 10px;
    font-weight: 600;
}

.fw-800 {
    font-weight: 800;
}

.bg-green {
    background-color: #208f20 !important;
    color: #fff;
}

.bg-black {
    background-color: #1f1d1d;
    color: #fff
}

.bg-red {
    background-color: #bb3535;
    color: #fff
}
</style>
</head>
<?php
    @include '../model/connectdb.php';

    // Initialize $product_data array
    $product_data = array();

    //truy vấn
    $sql = "SELECT products.*, type.name_type FROM products INNER JOIN type ON products.id_type = type.id";
    $result = mysqli_query($conn, $sql);
    //in ra 
    while ($row = mysqli_fetch_assoc($result)) {
        $product_data[] = array(
            'id' => $row['id'],
            'name_type' => $row['name_type'],
            'image' => 'admin/update_img/' . $row['image'],
            'name' => $row['name'],
            'price' => $row['price']
        );
    }
?>
<body>
    <div class="container bg-white">
        <h2>Tất cả sản phẩm</h2>
        <form action="" method="post">
            <div class="row">
               <?php foreach ($product_data as $product) { ?>
                     <div class="col-lg-3 col-sm-6 d-flex flex-column align-items-center justify-content-center product-item my-3">
                        <div class="product"> <img src="<?php echo $product['image']; ?>" alt="">
                           <ul class="d-flex align-items-center justify-content-center list-unstyled icons">
                              <li class="icon"><a href="index.php?act=chitietsp&id=<?php echo $product['id'];?>"><span class="fas fa-expand-arrows-alt"></span></a></li>
                              <li class="icon"><span class="fas fa-shopping-bag"></span></li>
                           </ul>
                        </div>
                        <div class="title pt-4 pb-1"><?php echo $product['name']; ?></div>
                        <div class="price"><?php echo $product['price']; ?></div>
                     </div>
               <?php } ?>
            </div>
            <div>
               <input type="hidden" name="product_id" value="<?php echo $product['id'];?>"></input>
               <input type="hidden" name="img_product" value="<?php echo $product['image'];  ?>"></input>
               <input type="hidden" name="type_product" value="<?php echo $product['name_type'];  ?>"></input>
               <input type="hidden" name="price_procduct" value="<?php echo $product['price']; ?>"></input>
               <input type="hidden" name="name_product" value="<?php echo $product['name'];  ?>"></input>
            </div>
        </form>
    </div>
</body>


