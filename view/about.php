<body>
    <section class="about"> <!-- heor -->
        <div class="heading"> 
            <h1>About Us</h1>
        </div>

        <div class="main-about"> <!-- container -->
            <div class="content-about"> <!-- content -->
                <h2>Chào mừng bạn LUXURIOUS</h2>
                <p>
                    Chúng tôi tự hào được giới thiệu đến bạn một cửa hàng trang sức độc đáo và thú vị, 
                    nơi bạn có thể tìm thấy những món đồ trang sức tinh tế và sang trọng. 
                    Chúng tôi cam kết về việc cung cấp những món đồ trang sức chất lượng, từ nhẫn,bông tai cho đến 
                    dây chuyền và vòng đeo tay. Với sự kết hợp tinh tế giữa các loại đá quý,
                    kim loại quý và thiết kế tinh xảo, mỗi sản phẩm tại cửa hàng của chúng tôi đều 
                    là một tuyệt tác nghệ thuật.
                    Mỗi món trang sức được chọn lựa kỹ càng. Về dịch vụ khách hàng luôn là ưu tiên hàng đầu của chúng tôi. 
                    Chúng tôi tin rằng mỗi món trang sức có thể tạo ra những giá trị đáng kinh ngạc và mang lại niềm vui cho người sử dụng. 
                    Chúng tôi hy vọng rằng việc sở hữu một món đồ trang sức từ cửa hàng của chúng tôi sẽ làm tăng thêm vẻ đẹp và tự tin cho bạn.
                    Hãy đến và khám phá thế giới trang sức của chúng tôi
                </p>
                <a href="index.php"><button class="bnt-about">Let's go</button></a>
            </div>
            <div class="img-about">
                <img src="public/img/about.jpg" alt="">
            </div>
        </div>
    </section>
</body>

<style>
    *{
        margin: auto;
        padding: auto;
        box-sizing: border-box;
        font-family: 'Roboto', sans-serif;
    }

    .about{
        background-color: #f8f8f8;
    }

    .heading h1{
        color: #116A7B;
        font-size: 55px;
        text-align: center;
        margin-top: 35px;
    }

    .main-about{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 90%;
        margin: 65px auto;
    }

    .content-about h2{
        font-size: 30px;
        margin-bottom: 20px;
        color: #333;
        text-align: center;
    }

    .content-about p{
        font-size: 30px;
        line-height: 2;
        margin-bottom: 40px;
        color: #666;
    }

    .content-about button{
        display: inline-block;
        background-color: #116A7B;
        color: #ECE5C7;
        padding: 12px 24px;
        border-radius: 5px;
        font-size: 20px;
        border: none;
        cursor: pointer;
        transition: 0.3s ease;   
    }

    .content-about button:hover{
        background-color: #fff;
        color: black;
        transform: scale(1.1);
    }
    

    .content-about{
        flex: 1;
        width: 600px;
        margin: 0px 25px;
        animation: fadeInUp 2s ease;
    }

    .img-about{
        flex: 1;
        width: 600px;
        margin: auto;
        animation: fadeInUp 2s ease;
    }

    img{
        width: 100%;
        height: auto;
        border-radius: 10px;
    }

    @media screen and (max-width:768px) {
        .heading h1{
            font-size: 45px;
            margin-top: 30px;
        }
        
        .about{
            margin: 0px;
        }

        .main-about{
            width: 100%;
            flex-direction: column;
            margin: 0px;
            padding: 0px 40px;
        }

        .content-about{
            width: 100%;
            margin: 35px 0px;
        }

        .content-about h2{
            font-size: 30px;
        }

        .content-about p{
            font-size: 18px;
            margin-bottom: 20px ;
        }

        .content-about button{
            font-size: 16px;
            padding: 8px 16px;
        }

        .content-about img{
            width: 100%; 
        }
    }

    @keyframes fadeInUp  {
        0%{
            opacity: 0;
            transform: translate(50px);
        }
        100%{
            opacity: 1;
            transform: translate(0px);
        }
    }

</style>