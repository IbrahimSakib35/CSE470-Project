<?php
    require("connection.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    function sendMail($email,$reset_token)
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
            $mail->Subject = 'VL Ultimate Gamestore Password Reset Request';
            $mail->Body    = "Click the link below to Reset password of your account
            <a href='localhost/470/updatepassword.php?email=$email&reset_token=$reset_token'>Reset Password</a>";
    
        
            $mail->send();
            return true;
        }   
        catch (Exception $e) {
            return false;
        }
    }
    if(isset($_POST['reset']))
    {
        $query="SELECT * FROM user WHERE email='$_POST[email]'";
        $result=mysqli_query($con,$query);
        if($result)
        {
            if(mysqli_num_rows($result)==1){
                $reset_token=bin2hex(random_bytes(16));
                date_default_timezone_set('Asia/Dhaka');
                $date=date("Y-m-d");
                $query="UPDATE user SET resettoken='$reset_token',resettokenexpire='$date' WHERE email='$_POST[email]'";
                if(mysqli_query($con,$query) && sendMail($_POST['email'],$reset_token))
                {
                    echo"<script>
                    alert('Check Email for Reset Link!');
                    window.location.href='index.php';
                    </script>";

                }
                else{
                    echo"<script>
                    alert('Server Down!');
                    window.location.href='index.php';
                    </script>";
                }


            }
            else{
                echo"<script>
                alert('Invalid Email');
                window.location.href='index.php';
                </script>";
            }
        }
        else{
            echo"<script>
            alert('Cannot run query');
            window.location.href='index.php';
            </script>";
        }
    }
?>