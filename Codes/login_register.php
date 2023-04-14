<?php
require('connection.php');
if(isset($_POST['register']))
{
    $user_exist_query="SELECT * FROM 'user' WHERE 'username'='$_POST[username]' OR 'email'='$_POST[email]'";
    $result=mysqli_query($con,$user_exist_query);
    if($result)
    {
        if(mysqli_num_rows($result)>0)
        {
            $result_fetch=mysqli_fetch_assoc($result);
            if($result_fetch['username']==$_POST['username'])
            {
                echo"<script>
                alert('$result_fetch[username]- This username already taken');
                window.location.href='index.php';
                </script>";
            }
            else
            {
                echo"<script>
                alert('$result_fetch[email]- This email already taken');
                window.location.href='index.php';
                </script>";
            }

        }
        else
        {
            $query="INSERT INTO `user`(`fifa_username`, `username`, `email`, `password`) VALUES ('$_POST[fifaname]','$_POST[username]','$_POST[email]','$_POST[password]')";
            if(mysqli_query($con,$query))
            {
                echo"<script>
                alert('Registration Successful! Login back');
                window.location.href='index.php';
                </script>";

            }
            else
            {
                echo"<script>
                alert('Cannot Run Query');
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