
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Luxurious</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="../public/image/x-icon" href="../public/img/logotron.png"><!--chỉnh logo trên tiêu đề  -->

    <link rel="stylesheet" href="../public/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="../public/css/login.css">

    <!-- font chữ: Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="../public/css/fontawesome.min.css">
</head>
    <div class="login">
        <h2 class="h2 text-success"><b>Đăng nhập / Đăng ký</b></h2>
        <div class="container" id="container">
            <!-- đăng ký  -->
            <div class="form-container sign-up-container">
                 <form action="./login.php?act = reg" method="Post" autocomplete="off"> <!-- tự action lại bản thân của nó  -->
                    <h1 class="h2 text-success"><b>Tạo tài khoản</b></h1>
                    <div class="social-container">
                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    </div>
                    <input type="text" name="username" placeholder="Username" >
                    <input type="text" name="email" placeholder="Email" >
                    <input type="text" name="password" placeholder="Password" >
                    <input type="text" name="repassword" placeholder="Nhập lại password"> 
                    <button type="submit" name="dangky">Đăng ký</button>
                </form>
            </div>
            <!-- đăng nhập -->
            <div class="form-container sign-in-container">
                <form action="index.php?act=login" method="post">
                    <h1 class="h1 text-success"><b>Đăng nhập</b></h1>
                    <div class="social-container">
                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    </div>
                    <input type="text" name="username" placeholder="Username"  />
                    <input type="text" name="password" placeholder="Password" />
                    <a href="#">Quên mật khẩu</a>
                    <input type="submit" name="" value="ĐĂNG NHẬP"></input>
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

