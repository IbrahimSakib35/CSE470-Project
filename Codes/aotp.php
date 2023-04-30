<?php
require('connection.php');
session_start();
$aemail=$_SESSION['aemail'];
if($_SERVER['REQUEST_METHOD']=="POST")
{
    $aotp=$_POST['aotp'];
    if(!empty($aotp))
    {
        $query="SELECT * FROM admins WHERE aemail='$aemail'";
        $result=mysqli_query($con,$query);
        if($result)
        {
            if($result && mysqli_num_rows($result)>0)
            {
                $user_data=mysqli_fetch_assoc($result);
                if($user_data['aotp']===$aotp)
                {
                    $_SESSION['alogged_in']=true;
                    $_SESSION['aemail']=$result_fetch['aemail'];
                    header("Location:ahome.php");
                    exit;

                }
            }
        } 
        echo"something wrong";   
    }
    else
    {
        echo"wrong";
    }
}    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP checking</title>
    <link rel="stylesheet" href="otp.css">
</head>
<body>
    <header>
        <h1>OTP checker</h1>

        
        
    </header>

    <div class="otp">

            <form method="post">
                <h2>
                    <span>Enter OTP</span>
                    <button type="reset">X</button>
                </h2>
              
                <input type="text" placeholder="Enter otp" name="aotp" style="color:cyan">
                <button type="submit" class="otp-btn" name="averify"><b>Submit</b></button>

            </form>

    </div>
    
</body>
</html>