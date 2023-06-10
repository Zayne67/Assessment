<?php
    session_start();

    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/post.php");

    error_reporting(E_ERROR | E_PARSE);

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
            $image = $user_data['profile_image'];
            $login = "Logout";
            
        }else{
            $login = "Login";
        }
    }else{
        $login = "Login";
    }

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if($_POST['changepfp']) {
            if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){
                $id = $_SESSION['userid'];
                $filename = "upload/" . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], $filename); 
    
                if(file_exists($filename))
                {
                    $newfile = $filename;
                    $query = "UPDATE users SET profile_image = '$newfile' WHERE userid = '$id' LIMIT 1";
                    $DB = new Database();
                    $DB->save($query);
    
                    header("Location: setting.php");
                }
            }else{
                header("Location: setting.php");
            }
        }

        if($_POST['changename']) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $query1 = "UPDATE users SET first_name = '$first_name' WHERE userid = '$id' LIMIT 1";
            $query2 = "UPDATE users SET last_name = '$last_name' WHERE userid = '$id' LIMIT 1";

            $DB = new Database();
            $DB->save($query1);
            $DB->save($query2);
        }

        if($_POST['changepass']) {
            $password = $_POST['password'];
            $query = "UPDATE users SET password = '$password' WHERE userid = '$id' LIMIT 1";

            $DB = new Database();
            $DB->save($query);
        }
    }
    if(isset($_POST['post'])){
        unset($_POST['post']);
    }

    $post = new Post();
    $id = $_SESSION['userid'];
    $posts = $post->get_post($id);
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
        .profile{
            margin-top: 0.5rem;
        }
        .profile img{
            border-radius: 10rem;
        }
        .profile input{
            padding: 0.3rem 0.5rem;
            margin-top: 0.5rem;
            border: none;
            outline: none;
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
                        <a class="black regular" href="home.php">Overview</a>
                    </div>
                    <div class="col options">
                        <a class="black regular" href="home.php">Front-End</a>
                    </div>
                    <div class="col options">
                        <a class="black regular" href="home.php">Back-End</a>
                    </div>
                    <div class="col options">
                        <a class="black regular" href="home.php">PHP</a>
                    </div>
                    <div class="col options">
                        <a class="black regular" href="home.php">CSS</a>
                    </div>
                </div>
                <div class="col-9 text-start">
                    <div class="row profile">
                        <div class="col-4">
                            <img src="<?php echo $image ?>" width="200rem">
                            <form method="POST" enctype="multipart/form-data">
                                <input type="file" name="file">
                                <br>
                                <input type="submit" value="Change Profile" name="changepfp">
                            </form>
                        </div>
                        <div class="col-8 mono">
                        <?php
                            foreach ($posts as $ROW){
                                $user = new User();
                                $ROW_USER = $user->get_user($ROW['userid']);
                            }
                            ?>
                            <h1 class="large"><?php echo $name ?></h1>
                            <div class="row">
                                <div class="col">
                                    <form method="POST">
                                        <div class="col">
                                            <input type="text" name="first_name" placeholder="First Name">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="last_name" placeholder="Last Name">
                                        </div>
                                        <div class="col">
                                            <input type="submit" name="changename" value="Change name">
                                        </div>
                                    </form>
                                </div>
                                <div class="col">
                                    <form method="POST">
                                        <div class="col">
                                            <input type="text" name="password" placeholder="New Password">
                                        </div>
                                        <div class="col">
                                            <input type="submit" name="changepass" value="Change password">
                                        </div>
                                    </form>
                                </div>
                            </div>
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