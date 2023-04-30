<?php
require('connection.php');
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function sendMsg($email,$msg)
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
        $mail->addAddress($email);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'News and Updates';
        $mail->Body    = "$msg";

    
        $mail->send();
        return true;
    }   
    catch (Exception $e) {
        return false;
    }
}
if(isset($_POST['msg']))
{
    $msg=$_POST['msg'];
    $query="SELECT * FROM user WHERE sub='1'";
    $result=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($result);
    $email=$row['email'];
    if(sendMsg($email,$_POST['msg'])){

        echo"<script>
        alert('News sent!');
        window.location.href='ahome.php';
        </script>";
    }
    else{
        echo"<script>
        alert('Cannot Run Queryuuu');
        window.location.href='ahome.php';
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
    <title>Home Page</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
   <header> 
    <h1>FIFA Card Management</h1>
    <br>
    <div class="bar">
        <form method="POST">
                <h2>
                    <span>Write News</span>
                    <button type="reset">X</button>
                </h2>
                <input type="text" placeholder="Enter message" name="msg" style="color:cyan">
                <button type="submit" name="message"><b>Send</b></button>
                <br>
                <br><br>

        </form>

        <button type="button"><a href="logout.php">Logout</a></button>
    </div> 
   </header> 
</body>
</html>    