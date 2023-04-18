<?php 
require('connection.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up or Login page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
       <div class="container">
        <h1>FIFA Card Management</h1>
        <div class="signup">
            <button type="button" onclick="popup('login-popup')">Login</button>
            <button type="button" onclick="popup('register-popup')">Register</button>
        </div>
       </div>  

    </header>
    <div class="userpage" id="login-popup">
        <div class="login">
            <form method="POST" action="login_register.php">
                <h2>
                    <span>Login Here</span>
                    <button type="reset" onclick="popup('login-popup')">X</button>
                </h2>
                <input type="text" placeholder="Enter E-mail" name="email" style="color:cyan">
                <input type="password" placeholder="Enter Password" name="password" style="color:cyan">
                <button type="submit" class="lgn-btn" name="login"><b>Login</b></button>

            </form>
            <div class="forgot-btn">
                <button type="button"><a href="reset.php">"Forgot Password?</a></button>
            </div>    
            <style>
                .forgot-btn{
                    text-align: right;
                }
                .forgot-btn button{
                    border:2px solid yellow;
                    background-color: transparent;
                    color: white;

                    font-weight: 450;
                    cursor: pointer;
                }
            </style>
        </div>
    </div>
    <div class="userpage" id="register-popup">
        <div class="register">
            <form method="POST" action="login_register.php">
                <h2>
                    <span>Register Here</span>
                    <button type="reset" onclick="popup('register-popup')">X</button>
                </h2>
                <input type="text" placeholder="Enter FIFA username" name="fifa_username" id="fifa_username" style="color:cyan">
                <input type="text" placeholder="Enter Username" name="username" id="username" style="color:cyan">
                <input type="email" placeholder="Enter Email" name="email" id="email"style="color:cyan">
                <input type="password" placeholder="Enter Password" name="password" id="password" style="color:cyan">
                <button type="submit" class="rgst-btn" name="register"><b>Register</b></button>

            </form>
        </div>
    </div>
    <?php
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true)
        {
            header("location:home.php");

        }
    ?>
    <script>
        function popup(popup_name)
        {
            get_popup=document.getElementById(popup_name);
            if(get_popup.style.display=="flex")
            {
                get_popup.style.display="none";
            }
            else
            {
                get_popup.style.display="flex";
            }
        }
    </script>

    
</body>
</html>