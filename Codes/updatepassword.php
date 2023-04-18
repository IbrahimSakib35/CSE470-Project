<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Update</title>
    <style>
        *{
            
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            font-family: poppins;
        
        }
        form{
            position:absolute;
            top:50%;
            left:50%;
            transform: translate(-50%,-50%);

            background-color: #e7c91f;
            width: 350px;
            border-radius: 5px;
            padding: 20px 25px 30px 25px
        }
        form h3{
            margin-bottom: 30px;
            color: black;
        }
        form input{
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
        form button{
            font-weight: 500;
            font-size: 15px;
            background-color: #e7c91f;
            color: black;
            padding: 4px 18px;
            border: 2px solid black;
            outline: none;


            }

    </style>
</head>
<body>
<?php
    require("connection.php");
    if(isset($_GET['email']) && isset($_GET['reset_token']))
    {
        date_default_timezone_set('Asia/Dhaka');
        $date=date("Y-m-d");
        $query="SELECT * FROM user WHERE email='$_GET[email]' AND resettoken='$_GET[reset_token]' AND resettokenexpire='$date'";
        $result=mysqli_query($con,$query);
        if($result)
        {
            if(mysqli_num_rows($result)==1)
            {
                echo"
                <form method='POST'>
                    <h3>Create New Password</h3>
                    <input type='password' placeholder='Give New Password' name='Password'>
                    <button type='submit' name='updatepassword'>Update</button>
                    <input type='hidden' name='email' value='$_GET[email]'>
                </form>";

            }
            else{
                echo"<script>
                alert('Invalid or Expired Link');
                window.location.href='index.php';
                </script>";
            }

        }
        else{
            echo"<script>
                alert('Server down');
                window.location.href='index.php';
                </script>";
        }
    }
?>    
<?php
    if(isset($_POST['updatepassword']))
    {
        $pass=password_hash($_POST['Password'],PASSWORD_BCRYPT);
        $update="UPDATE user SET password='$pass',resettoken=NULL,resettokenexpire=NULL WHERE email='$_POST[email]'";
        if(mysqli_query($con,$update))
        {
            echo"<script>
            alert('Password Updated Successfully');
            window.location.href='index.php';
            </script>";

        }
        else{
            echo"<script>
            alert('Server down');
            window.location.href='index.php';
            </script>";
        }
    }
?>    
</body>
</html>