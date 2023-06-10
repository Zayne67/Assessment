<?php

    include("classes/connect.php");
    include("classes/signup.php");

    $first_name = "";
    $last_name = "";
    $email = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $signup = new Signup();
        $result = $signup->evaluate($_POST);

        if($result != "")
        {
        }else
        {
            header("Location: index.php");
            die;
        }

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];

    }
?>
<html lang="eng">
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
                            <h1 class="text-center x-large">Sign up</h1>
                            <div class="col">
                                <p>First name</p>
                                <input type="text" name="first_name" value="<?php $first_name ?>">
                            </div>
                            <div class="col">
                                <p>Last name</p>
                                <input type="text" name="last_name" value="<?php $last_name ?>">
                            </div>
                            <div class="col">
                                <p>Email</p>
                                <input type="text" name="email" value="<?php $email ?>">
                            </div>
                            <div class="col">
                                <p>Password</p>
                                <input type="password" name="password" value="<?php $password ?>">
                            </div>
                            <div class="col">
                                <input class="black-bg white" type="submit" value="Register">
                            </div>
                            <div class="col">
                                <span>Already have an account? </span><a href="login.php">Login</a>
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