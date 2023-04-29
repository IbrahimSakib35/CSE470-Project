<?php
require('connection.php');
session_start();
if(isset($_POST['submit'])) {
    $user1 = $_POST['username1'];
    $user2 = $_POST['username2'];
    
    $_SESSION['user1'] = $user1;
    $_SESSION['user2'] = $user2;
    header("location:trade.php");

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tr1</title>
</head>
<body>
    <div class='bar'>  
            <h1>FIFA Card Management</h1>
            <button type="button"><a href="home.php">Home</a></button>
            <button type="button"><a href="playercard.php">Player Cards</a></button>
            <button type="button"><a href="trading.php">Trading</a></button>
            <button type="button"><a href="logout.php">Logout</a></button>
    </div>
    <style>
        .bar{
            background-color: yellow;
            padding: 10px;
            margin: 10px;
            display : flex;
            flex-direction: row;
            align-items: center;

        }
        div.bar button{
            background-color: #09b961;
            font-size: 15px;
            font-weight: 500;
            padding: 4px 12px;
            border: 2px solid black;
            border-radius: 5px;
            outline: none;
            margin-left: 20px;
            cursor: pointer;


        }
    </style>
    <br>
    <br>
  
    <form method="post">
        <label for="username1">FIFA Username 1:</label>
        <input type="text" name="username1" id="username1" required>

        <label for="username2">FIFA Username 2:</label>
        <input type="text" name="username2" id="username2" required>

        <button type="submit" name="submit">Submit</button>
    </form>

</body>
</html>