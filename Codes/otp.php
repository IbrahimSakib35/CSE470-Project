<?php
require('connection.php');
session_start();
$email=$_SESSION['email'];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function sendNtf($email)
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
        $mail->Username   = 'vlempire420@gmail.com';                     //SMTP username
        $mail->Password   = 'xxlalsyxtzaqyhpr';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('vlempire420@gmail.com', 'VL-EMP');
        $mail->addAddress($email);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'EMP-FIFA Log Notification ';
        $mail->Body    = "Your Account Logged-in";

    
        $mail->send();
        return true;
    }   
    catch (Exception $e) {
        return false;
    }
}
if($_SERVER['REQUEST_METHOD']=="POST")
{
    $otp=$_POST['otp'];
    if(!empty($otp))
    {
        $query="SELECT * FROM user WHERE email='$email'";
        $result=mysqli_query($con,$query);
        if($result)
        {
            if($result && mysqli_num_rows($result)>0)
            {
                $user_data=mysqli_fetch_assoc($result);
                if($user_data['otp']===$otp)
                {
                    $_SESSION['logged_in']=true;
                    $_SESSION['email']=$user_data['email'];
                    $_SESSION['fifa_username']=$user_data['fifa_username'];
                    sendNtf($email);
                    header("Location:index.php");
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
              
                <input type="text" placeholder="Enter otp" name="otp" id="otp" style="color:cyan">
                <button type="submit" class="otp-btn" name="verify"><b>Submit</b></button>

            </form>

    </div>
    
</body>
</html>