<?php
require('connection.php');
session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function subbed($email)
{
    global $con;
    $sql= "UPDATE user SET sub=1 WHERE email='$email'";
    if($con->query($sql)==TRUE){
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
            $mail->Subject = 'EMP-FIFA News and Updates ';
            $mail->Body    = "You are currently subbed to our news and updates";

        
            $mail->send();
            return true;
        }   
        catch (Exception $e) {
            return false;
        }
    }    
}
function unsubbed($email)
{
    global $con;
    $sql= "UPDATE user SET sub=0 WHERE email='$email'";
    if($con->query($sql)==TRUE){
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
            $mail->Subject = 'EMP-FIFA News and Updates ';
            $mail->Body    = "You have unsubbed from our news and updates";

        
            $mail->send();
            return true;
        }   
        catch (Exception $e) {
            return false;
        }
    }    
}
if (isset($_POST['sub'])) {
    subbed($email);
    echo"<script>
    alert('You Subscribed!');
    window.location.href='nau.php';
    </script>";
} 
elseif (isset($_POST['unsub'])) {
    unsubbed($email);
    echo"<script>
    alert('You Unubscribed!');
    window.location.href='nau.php';
    </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News and Updates</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
   <header> 
    <div class='bar'>
    <h1>Subscribe to get latest news and updates!</h1>
    <br>
    <p>Your Email: <?php echo $email; ?></p>
    <form method="post">
        <button type="submit" name="sub">Subscribe to our news and updates</button>
        <button type="submit" name="unsub">Unsubscribe from our news and updates</button>
    </form>
    <br>
    <button type="button"><a href="home.php">Home</a></button>
    </div>
   </header> 
</body>
</html>