<head>
	<style>
		html {
			font-size: 62.5%;
			box-sizing: border-box;
		}

		body {
			padding: 2rem 4rem;
			line-height: 1.7;
			font-family: "Nunito Sans", sans-serif;
			color: #555;
			min-height: 100vh;
		}

		img {
			max-width: 100%;
			vertical-align: middle;
			border-radius: 4px;
		}

		a {
			text-decoration: none;
			color: #333333;
		}

		a:hover {
			color: #f58551;
		}

		button {
			background-color: #16cc9b;
			border: 2px solid #16cc9b;
			color: #ffffff;
			transition: all 0.25s linear;
			cursor: pointer;
		}

		button::after {
			position: relative;
			right: 0;
			content: " \276f";
			transition: all 0.15s linear;
		}

		button:hover {
			background-color: #f58551;
			border-color: #f58551;
		}

		button:hover::after {
			right: -5px;
		}

		button:focus {
			outline: none;
		}

		ul {
			padding: 0;
			margin: 0;
			list-style-type: none;
		}

		input {
			transition: all 0.25s linear;
		}

		input[type=number]::-webkit-inner-spin-button,
		input[type=number]::-webkit-outer-spin-button {
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			margin: 0;
		}

		input {
			outline: none;
		}

		.container {
			width: 90%;
			margin: 0 auto;
			overflow: auto;
		}

		/* --- HEADER --- */
		header h1 {
			font-family: 'Roboto', sans-serif;
			font-weight: 400;
			font-size: 3rem;
			color: #116A7B;
			margin-bottom: 2rem;
			text-align: center;
			word-spacing: 3px;
		}

		header.container {
			margin-bottom: 1.5rem;
		}

		header .breadcrumb li {
			float: left;
			padding: 0 6px;
		}

		header .breadcrumb li:first-child {
			padding-left: 2px;
		}

		header .breadcrumb li:not(:last-child)::after {
			content: " \276f";
			padding-left: 8px;
		}

		header .count {
			float: right;
		}

		/* --- PRODUCT LIST --- */
		.products {
			border-top: 1px solid #ddd;
		}

		.products > li {
			padding: 1rem 0;
			background-color: #fff;
			padding: 1rem;
			margin-bottom: 1rem;
		}

		.row {
			display: flex;
		}

		.col.left {
			flex-basis: 70%;
		}

		.col.right {
			flex-basis: 30%;
			display: flex;
			align-items: center;
		}

		.detail {
			padding: 0 0.5rem;
			line-height: 2.2rem;
		}

		.detail .name {
			font-size: 1.2rem;
			font-weight: 700;
		}

		.detail .description {
			font-size: 1rem;
			margin: 0.7rem 0;
			line-height: 1.4;
		}

		.detail .price {
			font-size: 1.2rem;
			font-weight: 700;
		}

		.quantity,
		.remove {
			width: 50%;
			text-align: center;
		}

		.quantity>input {
			display: inline-block;
			width: 60px;
			height: 60px;
			position: relative;
			left: calc(50% - 30px);
			background: #fff;
			border: 2px solid #ddd;
			text-align: center;
			font: 600 1.5rem Helvetica, Arial, sans-serif;
		}

		.quantity>input:hover,
		.quantity>input:focus {
			border-color: #f58551;
		}

		.close {
			cursor: pointer;
			font-size: 1.5rem;
		}

		.close:hover {
			color: #f58551;
		}

		/* --- SUMMARY --- */
		.promotion,
		.summary,
		.checkout {
			float: left;
			width: 100%;
			margin-top: 1.5rem;
		}

		.promotion>label {
			float: left;
			width: 100%;
			margin-bottom: 1rem;
		}

		.promotion>input {
			float: left;
			width: 80%;
			font-size: 1rem;
			padding: 1rem 1.5rem;
			border: 2px solid #116A7B;
		}

		.promotion>button {
			float: left;
			width: 20%;
			padding: 1rem 0.5rem;
			color: #116A7B;
			background-color: #fff;
			border: 2px solid #116A7B;
		}
		.summary {
			font-size: 1.2rem;
			text-align: right;
		}

		.summary ul li {
			padding: 0.5rem 0;
		}

		.summary ul li span {
			display: inline-block;
			width: 30%;
		}

		.summary ul li.total {
			font-weight: bold;
		}

		.hide {
			display: none !important;
		}

		/* --- SMALL SCREEN --- */
		@media all and (max-width: 599px) {
			.thumbnail img {
				display: none;
			}

			.quantity>input {
				width: 40px;
				height: 40px;
				left: calc(50% - 20px);
			}

			.remove svg {
				width: 40px;
				height: 40px;
			}
		}

		/* --- MEDIUM & LARGE SCREEN --- */
		@media all and (min-width: 600px) {
			html {
				font-size: 14px;
			}

			.container {
				width: 75%;
				max-width: 960px;
			}

			.thumbnail,
			.detail {
				float: left;
			}

			.thumbnail {
				width: 30%;
			}

			.detail {
				width: 65%;
				padding: 0 1rem;
			}

			.promotion,
			.summary {
				width: 50%;
			}

			.checkout {
				width: 100%;
			}

			.checkout,
			.summary {
				text-align: right;
			}
		}

		/* --- LARGE SCREEN --- */
		@media all and (min-width: 992px) {
			html {
				font-size: 16px;
			}
		}
    </style>
</head>

<body>
    <main>
        <header class="container">
            <h1>Giỏ hàng</h1>

            <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li>Giỏ hàng</li>
            </ul>

            <!-- Total product -->
            <span class="count">3 sản phẩm</span>
        </header>

        <section class="container">
            <ul class="products">
                <li class="row">
                    <div class="col left">
                        <div class="thumbnail">
                            <a href="#">
                                <img src="https://via.placeholder.com/200x150" alt="" />
                            </a>
                        </div>
                        <div class="detail">
                            <div class="name"><a href="#">Sản phẩm 1</a></div>
                            <div class="description">
                                Mô tả sản phẩm
                            </div>
                            <div class="price">giá</div>
                        </div>
                    </div>

                    <div class="col right">
                        <div class="quantity">
                            <input type="number" class="quantity" step="1" value="2" />
                        </div>

                        <div class="remove">
                            <span class="close"><i class="fa fa-times" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </li>

                <li class="row">
                    <div class="col left">
                        <div class="thumbnail">
                            <a href="#">
                                <img src="https://via.placeholder.com/200x150" alt="" />
                            </a>
                        </div>
                        <div class="detail">
                            <div class="name"><a href="#">Sản phẩm 2</a></div>
                            <div class="description">
                                Mô tả sản phẩm 2
                            </div>
                            <div class="price">giá</div>
                        </div>
                    </div>

                    <div class="col right">
                        <div class="quantity">
                            <input type="number" class="quantity" step="1" value="1" autocomplete="off" />
                        </div>

                        <div class="remove">
                            <span class="close"><i class="fa fa-times" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </li>
            </ul>
        </section>

        <section class="option-container container">
            <!-- Mã giảm giá -->
            <div class="promotion">
                <label for="promo-code">Nhập mã giảm giá?</label>
                <input type="text" id="promo-code" autocomplete="off" />
                <button type="button"></button>
            </div>

            <!-- Tổng tiền -->
            <div class="summary">
                <ul>
                    <li class="subtotal">Tổng tiền<span>giá</span></li>
                    <li class="vat">Ship<span>giá</span></li>
                    <li class="discount hide">Giảm giá<span>giá</span></li>
                    <li class="total">Tổng hóa đơn<span>giá</span></li>
                </ul>
            </div>
        </section>
    </main>
</body>

</html>