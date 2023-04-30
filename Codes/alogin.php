<?php
require('connection.php');
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function sendOtp($aemail,$aotp)
{
    require ("PHPMailer/PHPMailer.php");
    require ("PHPMailer/SMTP.php");
    require ("PHPMailer/Exception.php");
    $mail = new PHPMailer(true);
    try {
        //Server settings

        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'sakibibrahim35@gmail.com';                     //SMTP username
        $mail->Password   = 'uuohlrqoegbyukif';                              //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('vlempire420@gmail.com', 'VL-EMP');
        $mail->addAddress($aemail);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'FIFA Email Verification';
        $mail->Body    = "Your login otp: $aotp";

    
        $mail->send();
        return true;
    }   
    catch (Exception $e) {
        return false;
    }
}
if(isset($_POST['alogin']))
{
    $aemail=$_POST['aemail'];
    $_SESSION['aemail']=$aemail;
    include 'aotp.php';
    $query="SELECT * FROM admins WHERE aemail='$_POST[aemail]'";
    $result=mysqli_query($con,$query);
    if($result)
    {
        if(mysqli_num_rows($result)==1)
        {
            $result_fetch=mysqli_fetch_assoc($result);
            if($result_fetch['ais_verified']==1)
            {
                if($result_fetch['apassword']===$_POST['apassword'])
                {

                    $aotp=rand(11111,99999);
                    $update="UPDATE admins SET aotp='$aotp' WHERE aemail='$_POST[aemail]'";
                    
                    if(mysqli_query($con,$update) && sendOtp($_POST['aemail'],$aotp)){

                        echo"<script>
                        alert('An OTP sent to your Email');
                        window.location.href='aotp.php';
                        </script>";
                    }
                    else{
                        echo"<script>
                        alert('Cannot Run Queryuuu');
                        window.location.href='alogin.php';
                        </script>";

                    }

                }
                else
                {
                    echo"<script>
                    alert('Incorrect Password');
                    window.location.href='alogin.php';
                    </script>";

                }
            }
            else{
                echo"<script>
                alert('User Not Registered');
                window.location.href='alogin.php';
                </script>";

            }

        }
        else
        {
            echo"<script>
            alert('Email or Username doesn't exist');
            window.location.href='alogin.php';
            </script>";
        }

    }
    else
    {
        echo"<script>
        alert('Cannot Run Query');
        window.location.href='alogin.php';
        </script>";

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <link rel="stylesheet" href="astyle.css">
</head>
<body>
    <header>
        <h1>FIFA Admins</h1>

        
        
    </header>

    <div class="auserpage">
        <div class="alogin">
            <form method="POST">
                <h2>
                    <span>Login Here</span>
                    <button type="reset">X</button>
                </h2>
                <input type="text" placeholder="Enter E-mail" name="aemail" style="color:cyan">
                <input type="password" placeholder="Enter Password" name="apassword" style="color:cyan">
                <button type="submit" class="algn-btn" name="alogin"><b>Login</b></button>
                <br>
                <br><br>
                <h5 style="color:white">Not Admin?</h5>
                <button class="btn"><a href="index.php">Go Back</a></button>

            </form>
        </div>
    </div>

</body>
</html>