<?php
session_start();

    include("classes/connect.php");
    include("classes/login.php");

    $email = "";
    $password = "";

    if(isset($_SESSION['userid']))
    {
        unset($_SESSION['userid']);
    }else{
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $login = new Login();
        $result = $login->evaluate($_POST);

        if($result != "")
        {
        }else
        {
            header("Location: home.php");
            die;
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

    }
?>
<htm lang="eng">
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
    </head>
    <style>
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
        .small{
            font-size: 0.9rem;
        }
        .regular{
            font-size: 1rem;
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
        .black-bg{
            background-color: #000;
        }

        /* Custom CSS */
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
    </style>
    <body>
        <div class="cursor">

        </div>
        <div class="container-fluid maxvh">
            <div class="row maxvh">
                <div class="col-7 desc mono white">
                    <h1 class="large">BATHSPA</h1>
                    <h2 class="regular">UNIVERSITY</h2>
                </div>
                <div class="col-5 input">
                    <form method="POST">
                        <div class="container padding mono regular">
                            <h1 class="text-center x-large">Welcome</h1>
                            <div class="col">
                                <p>Email</p>
                                <input type="text" name="email" value="<?php $email ?>">
                            </div>
                            <div class="col">
                                <p>Password</p>
                                <input type="password" name="password" value="<?php $password ?>">
                            </div>
                            <div class="col">
                                <input class="black-bg white" type="submit" value="Login">
                            </div>
                            <div class="col">
                                <span>Don't have an account? </span><a href="signup.php">Register</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
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
</html>