<?php  
require 'function.php';

// fungsi login 
if(!isset($_SESSION['login']))   {
    // yaudah
} else {
    // sudah login
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Kasir Toko Bangunan</title>
    <style>
        body{
            margin: 0;
            padding: 0;
            background-image: url('css/4.jpg');
            background-size: cover ;
        }
        .container{
            top: 50%;
            left: 50%;
            position: absolute;
            transform: translate(-50%,-50%);
        }

        .card{
            padding: 60px 40px 50px 40px;
            background: rgb(50, 50, 50);
            border-radius: 10px;
        }

        #name{
            width: 200px;
            border: none;
            background: transparent;
            border-bottom: 1px solid white;
            padding: 6px;
            margin-bottom: 15px;
            color: white;
        }

        #button{
            border: 20px;
            padding: 10px 20px;
            background: dodgerblue;
            color: white;
            margin-top: 20px;
            border: none;
            outline: none;
            margin-left: 50px;
        }
        #button:hover{
            background-color: greenyellow;
            color: black;
            cursor: pointer;
        }
        a{
            font-size: 13px;
        }
        img{
            border-radius: 50%;
            position: absolute;
            margin-left: 100px;
            margin-top: -40px;

        }
    </style>
</head>
<body>
    <div class="container">
        <img src="default.png" height="70" width="70">
        <form action="#" method="post">
            <div class="card">
                <input type="text" name="username" id="name" placeholder="Username">
                <br>
                <input type="password"  name="password" id="name" placeholder="Password">
                <br>
                <input type="submit" name="login" value="Submit" id="button">
            </div>
        </form>
    </div>
</body>
</html>