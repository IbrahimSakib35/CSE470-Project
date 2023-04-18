<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset</title>
</head>
<body>
    <div class="forgot" >
            <form method="POST" action="forgotpassword.php">
                <h2>
                    <span>Reset Password</span>
                    <button type="reset">X</button>
                </h2>
                <input type="email" placeholder="Enter E-mail" name="email" >
                <br>
                <button type="submit" class="rst-btn" name="reset"><b>Send Reset Link</b></button>
                <br>
                <br>
                <h5 style="color:Black">Don't want to?</h5>
                <button class="btn"><a href="index.php">Go Back</a></button>
            </form>
            <style>
                *{
                    
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                    text-decoration: none;
                    font-family: poppins;
                
                }
                div.forgot{
                    position:absolute;
                    top:50%;
                    left:50%;
                    transform: translate(-50%,-50%);

                    background-color: #e7c91f;
                    width: 350px;
                    border-radius: 5px;
                    padding: 20px 25px 30px 25px
                }
                div.forgot h3{
                    margin-bottom: 30px;
                    color: black;
                }
                div.forgot input{
                    width: 100%;
                    margin-bottom: 20px;
                    background-color: white;
                    border: none;
                    border-bottom: 2px solid #e7c91f;
                    border-radius: 0;
                    padding: 5px 0;
                    font-weight: 500;
                    font-size: 15px;
                    outline: none;
                    }
                div.forgot button.btn{
                    font-weight: 500;
                    font-size: 15px;
                    background-color: #e7c91f;
                    color: black;
                    padding: 4px 18px;
                    border: 2px solid black;
                    outline: none;


                    }
                div.forgot button.rst-btn{
                    font-weight: 500;
                    font-size: 15px;
                    background-color: #e7c91f;
                    color: black;
                    padding: 4px 18px;
                    border: 2px solid black;
                    outline: none;


                    }
    

            </style>
            


    </div>
</body>
</html>