<?php
require('connection.php');
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email,$vcode)
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
        $mail->Subject = 'EMP-FIFA Email Verification';
        $mail->Body    = "Thanks for registration!
        Click the link below to verify your account
        <a href='localhost/470/verify.php?email=$email&vcode=$vcode'>Verify </a>";

    
        $mail->send();
        return true;
    }   
    catch (Exception $e) {
        return false;
    }
}
function sendOtp($email,$otp)
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
        $mail->Subject = 'EMP-FIFA login OTP';
        $mail->Body    = "Your login otp: $otp";

    
        $mail->send();
        return true;
    }   
    catch (Exception $e) {
        return false;
    }
}
if(isset($_POST['login']))
{
    $email=$_POST['email'];
    $_SESSION['email']=$email;
    include 'otp.php';

    $query="SELECT * FROM user WHERE email='$_POST[email]'";
    $result=mysqli_query($con,$query);
    if($result)
    {
        if(mysqli_num_rows($result)==1)
        {
            $result_fetch=mysqli_fetch_assoc($result);
            if($result_fetch['is_verified']==1)
            {
                if(password_verify($_POST['password'],$result_fetch['password']))
                {

                    $otp=rand(11111,99999);
                    $update="UPDATE user SET otp='$otp' WHERE email='$_POST[email]'";
                    
                    if(mysqli_query($con,$update) && sendOtp($_POST['email'],$otp)){

                        echo"<script>
                        alert('An OTP sent to your Email');
                        window.location.href='otp.php';
                        </script>";
                    }
                    else{
                        echo"<script>
                        alert('Cannot Run Query');
                        window.location.href='index.php';
                        </script>";

                    }

                }
                else
                {
                    echo"<script>
                    alert('Incorrect Password');
                    window.location.href='index.php';
                    </script>";

                }
            }
            else{
                echo"<script>
                alert('User Not Registered');
                window.location.href='index.php';
                </script>";

            }

        }
        else
        {
            echo"<script>
            alert('Email or Username doesn't exist');
            window.location.href='index.php';
            </script>";
        }

    }
    else
    {
        echo"<script>
        alert('Cannot Run Query');
        window.location.href='index.php';
        </script>";

    }
}
if(isset($_POST['register']))
{
    $user_exist_query="SELECT * FROM user WHERE username='$_POST[username]'";
    $result=mysqli_query($con,$user_exist_query);
    if($result)
    {
        if(mysqli_num_rows($result)>0)
        {
            $result_fetch=mysqli_fetch_assoc($result);
            if($result_fetch['username']==$_POST['username'])
            {
                echo"<script>
                alert('$result_fetch[username]- This username is already taken');
                window.location.href='index.php';
                </script>";
               
            }
            else
            {
                echo"<script>
                alert('Nothing');
                window.location.href='index.php';
                </script>";
               
            }

        }
        else
        {
            $queryy="SELECT * FROM user WHERE fifa_username='$_POST[fifa_username]' OR email='$_POST[email]'";
            $find=mysqli_query($con,$queryy);
            if($find)
            {
                if(mysqli_num_rows($find)>0)
                {
                    $result_fetchs=mysqli_fetch_assoc($find);
                    if($result_fetchs['is_verified']==1)
                    {
                        echo"<script>
                        alert('$result_fetchs[fifa_username]- This FIFA account is already registered');
                        window.location.href='index.php';
                        </script>";
                    }
                    else
                    {
                        $password=password_hash($_POST['password'],PASSWORD_BCRYPT);
                        $vcode=bin2hex(random_bytes(16));
                        $query="UPDATE user SET username='$_POST[username]',password='$password',verification_code='$vcode' WHERE fifa_username='$_POST[fifa_username]' AND email='$_POST[email]'";
                        echo $query;
                        if(mysqli_query($con,$query) && sendMail($_POST['email'],$vcode))
                        {
                            echo"<script>
                            alert('Check your mail to verify!');
                            window.location.href='index.php';
                            </script>";
    
                        }
                        else
                        {
                            echo"<script>
                            alert('Server Down');
                            window.location.href='index.php';
                            </script>";
    
                        }
                    }
                }    
            }
            else
            {
                echo"<script>
                alert('No Fifa account');
                window.location.href='index.php';
                </script>";
            }    

        }

    }
    else
    {
        echo"<script>
        alert('Cannot Run Query');
        window.location.href='index.php';
        </script>";
    }
}
?>