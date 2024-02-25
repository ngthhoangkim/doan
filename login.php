<!DOCTYPE html>
<html lang="en">

<head>
    <title>Luxurious</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="img/logotieude.png"> <!--chỉnh logo trên tiêu đề  -->
    <link rel="shortcut icon" type="image/x-icon" href="img/logotron.png"><!--chỉnh logo trên tiêu đề  -->

    <link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">

    <!-- font chữ: Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="css/fontawesome.min.css">
</head>
<body>
    <div class="login">
        <h2 class="h2 text-success"><b>Đăng nhập / Đăng ký</b></h2>
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form action="#">
                    <h1 class="h2 text-success"><b>Tạo tài khoản</b></h1>
                    <div class="social-container">
                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    </div>
                    <input type="text" placeholder="Username" />
                    <input type="email" placeholder="Email" />
                    <input type="password" placeholder="Password" />
                    <input type="password" placeholder="Nhập lại password"/>
                    <button>Đăng ký</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="#">
                    <h1 class="h1 text-success"><b>Đăng nhập</b></h1>
                    <div class="social-container">
                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    </div>
                    <input type="email" placeholder="Username" />
                    <input type="password" placeholder="Password" />
                    <a href="#">Quên mật khẩu</a>
                    <button>Đăng nhập</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1 class="h1 text-success">Luxurious</h1>
                        <p>Chào mừng bạn đến với thế giới của những trang sức lấp lánh</p>
                        <button class="button2" id="signIn">Đăng nhập</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1 class="h1 text-success">Chào bạn !</h1>
                        <p>Nếu bạn chưa có tài khoản hãy nhấn đăng ký tại đây</p>
                        <button class="button2" id="signUp">Đăng ký</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- js -->
<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add('right-panel-active');
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove('right-panel-active');
    });
</script>