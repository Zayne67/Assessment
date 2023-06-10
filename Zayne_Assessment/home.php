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

    //For Posting
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if($_POST['publish']) {
            $post = new Post();
            $id = $_SESSION['userid'];
            $data = $_POST;

            $result = $post->create_post($id, $data);

            if($result ==""){
                header("Location: home.php");
                die;
            }else{
                header("Location: home.php");
                die;
            }
        }
    }
    if(isset($_POST['post'])){
        unset($_POST['post']);
    }

    $post = new Post();
    $id = $_SESSION['userid'];
    $posts = $post->get_posts($id);

    $user = new User();
    $id = $_SESSION['userid'];
    $friends = $user->get_friends($id);

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
            margin-left: 0rem;
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
        .insidepost img{
            border-radius: 10rem;
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
                <div class="col-9 text-center">
                    <div class="col carousel user" data-flickity='{ "autoplay": true, "wrapAround": true, "autoPlay": 3000, "pauseAutoPlayOnHover": true}'>
                        <?php 
                            if($friends){
                                foreach ($friends as $FRIEND_ROW){
                                include("user.php");
                                }
                            }
                        ?>
                    </div>
                    <div class="col">
                        <div class="container mono spacing">
                            <form method="POST" class="post">
                                <textarea name="post" cols="80" rows="4" maxlength="230" placeholder="What's on your mind?"></textarea>
                                <input class="btn" type="submit" name="publish" value="Post">
                            </form>
                        </div><br>
                        <?php
                            if($posts){
                                foreach ($posts as $ROW){
                                    $user = new User();
                                    $ROW_USER = $user->get_user($ROW['userid']);

                                    include("post.php");
                                }
                            }
                        ?>
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