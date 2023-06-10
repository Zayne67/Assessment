<?php 
session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");

if(isset($_SESSION['userid']))
    {
        $id = $_SESSION['userid'];
        $login = new Login();
        $login->check_login($id);

        $result = $login->check_login($id);

        if($result){
            $user = new User();
            $user_data = $user->get_data($id);

            $name = $user_data['first_name'] . " " . $user_data['last_name'];
            $login = "Logout";
        }else{
            $login = "Login";
        }
    }else{
        $login = "Login";
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bathspa Dev</title>

        <!-- ICON -->
        <link rel="icon" type="image/x-icon" href="images/icon/logo.jpg">

        <link rel="stylesheet" href="cursor.css">

        <!-- Online CSS -->
        <link href="https://fonts.googleapis.com/css2?family=Space+Mono&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

        <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    </head>

    <style type="text/css">
        body{
            background-color: #DDDDDD;
        }
        /* Regular CSS */
        a{
            text-decoration: none;
        }
        .mono{
            font-family: Space Mono;
        }
        .padding{
            padding: 10rem 8rem 0rem 8rem;
        }
        .smaller{
            font-size: 0.8rem;
        }
        .small{
            font-size: 0.9rem;
        }
        .regular{
            font-size: 1rem;
        }
        .s-regular{
            font-size: 1.1rem;
        }
        .x-regular{
            font-size: 1.5rem;
        }
        .large{
            font-size: 2rem;
        }
        .x-large{
            font-size: 3rem;
        }
        .maxvh{
            height: 100%;
        }
        .white{
            color: #f2f2f2;
        }
        .black{
            color: #020202;
        }
        .black-bg{
            background-color: #000;
        }
        .blue-bg{
            background-color: #22314e;
        }

        /* Custom CSS */
        .navigation a{
            margin: 0rem 0.5rem 0rem 0.5rem;
        }
        .input input{
            font-weight: light;
            width:  100%;
            padding: 0.2rem 0.5rem 0.2rem 0.5rem;
            margin-bottom: 0.5rem;
            border-radius: 0.5rem;
            border: 1px solid black;
        }
        .desc{
            background-image: url("images/bathspa.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .input p{
            font-weight: bold;
            margin-bottom: -0.1rem;
        }
        .desc h1{
            margin-bottom: -0.1rem;
        }
        .flickity-button {
            display: none;
        }
        .flickity-page-dots {
            display: none;
        }
        .flickity is-pointer-down{
            border: none;
        }
        .post{
            background-color: #ffff;
            border-radius: 1rem;
        }
        .post textarea{
            border-radius: 1rem;
            resize: none;
            padding: 1rem;
            outline: none;
            border: none;
        }
        .btn{
            margin-top: -3rem;
            margin-left: 34rem;
        }
        .user img{
            border-radius: 10rem;
            margin: 0.5rem 0.3rem 0.5rem 0.3rem;
        }
        .posts{
            border-radius: 1rem;
            background-color: #ffff;
            height: 10rem;
        }
        .insidepost {
            padding-top: 1rem;
        }
        .option{

            border-right: 1px solid black;
        }
        .options{
            padding:1rem;
            border-bottom: 1px solid black;
        }
        .options:hover{
            background-color: #d2d2d2;
        }
        .insidepost img{
            border-radius: 10rem;
        }
        .profile {
            margin-top: 0.5rem;
        }
        .profile img{
            border-radius: 10rem;
        }
        .profile h1{
            margin-top: 1rem;
        }
        .orange-bg{
            background-color:#fb7a24;
        }
    </style>

<body>
        <div class="cursor">

        </div>  

        <div class="container-fluid blue-bg">
            <div class="row align-items-center">
                <div class="col-3">
                    <a href="home.php"><img src="images/icon/logo.jpg" height="70em"></a>
                </div>
                <div class="col-5">
                </div>
                <div class="col-4 text-end navigation mono">
                    <a class="white" href="about.php">About</a>
                    <a class="white" href="profile.php">Profile</a>
                    <a class="white" href="setting.php">Settings</a>
                    <a class="white" href="login.php"><?php echo $login ?></a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="container-fluid col-3 text-center mono option">
                <div class="col options">
                        <a class="black regular" href="home.php">Chat Community</a>
                    </div>
                    <div class="col options">
                        <a class="black regular" href="overview.php">Overview</a>
                    </div>
                    <div class="col options">
                        <a class="black regular" href="front.php">Front-End</a>
                    </div>
                    <div class="col options">
                        <a class="black regular" href="back.php">Back-End</a>
                    </div>
                    <div class="col options">
                        <a class="black regular" href="php.php">PHP</a>
                    </div>
                    <div class="col options">
                        <a class="black regular" href="css.php">CSS</a>
                    </div>
                </div>
                <div class="col-9 text-start profile mono">
                    <div class="row align-items-start">
                        <div class="col-4">
                            <img src="images/member-zayne.jpeg" height="300rem">
                        </div>
                        <div class="col">
                        <p class="s-regular">Hello, my name is Zayne Zack Mundo, and I am delighted to welcome you to this website I have created specifically for BSc students. I am passionate about education and believe in the power of knowledge-sharing to foster growth and development. Through this platform, I aim to provide comprehensive resources and support to my fellow BSc students, enabling them to navigate their academic journey with ease. <br><br>As a BSc student myself, I understand the challenges and complexities that often accompany this educational path. The wide range of subjects and concepts can sometimes feel overwhelming, and it's easy to get lost in the sea of information.</p>
                        </div>
                    </div>
                    <h1 class="x-regular">Tools Used:</h1>
                    <p class="s-regular">In creating this website for BSc students, I utilized several tools and technologies to ensure a seamless and engaging user experience.</p>
                    <div class="col carousel user" data-flickity='{ "autoplay": true, "wrapAround": true, "autoPlay": 3000, "pauseAutoPlayOnHover": true}'">
                        <div class="carousel-cell">
                            <a href="https://flickity.metafizzy.co"><img class="black-bg" src="images/flickity.webp" height="200rem" width="200rem"></a>
                        </div>
                        <div class="carousel-cell">
                            <a href="https://getbootstrap.com"><img src="images/bootstrap.jpg" height="200rem" width="200rem"></a>
                        </div>
                        <div class="carousel-cell">
                            <a href="https://www.apachefriends.org"><img class="orange-bg" src="images/xampp.png" height="200rem" width="200rem"></a>
                        </div>
                        <div class="carousel-cell">
                            <a href="https://code.visualstudio.com"><img src="images/visualstudio.png" height="200rem" width="200rem"></a>
                        </div>
                        <div class="carousel-cell">
                            <a href="https://fonts.google.com"><img src="images/googlefont.png" height="200rem" width="200rem"></a>
                        </div>
                        <div class="carousel-cell">
                            <a href="https://fonts.google.com"><img src="images/js.png" height="200rem" width="200rem"></a>
                        </div>
                    </div>
                </div>
                <div class="col-0">

                </div>
            </div>
        </div>
        <script>
        const cursor = document.querySelector(".cursor");

        document.addEventListener('mousemove', e => {
            cursor.setAttribute("style", "top: "+(e.pageY - 10)+"px; left: "+(e.pageX - 10)+"px;")
        })
        
        document.addEventListener('click', () => {
            cursor.classList.add("expand");

            setTimeout(() => {
                cursor.classList.remove("expand");
            }, 500)
        })  
    </script>
    </body>
</html>