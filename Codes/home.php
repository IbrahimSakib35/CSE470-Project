<?php
require('connection.php');
session_start();
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
    <div class="bar">
        <button type="button"><a href="home.php">Home</a></button>
        <button type="button"><a href="playercard.php">Player Cards</a></button>
        <button type="button"><a href="inventory.php">Your Inventory</a></button>
        <button type="button"><a href="trading.php">Trading</a></button>
        <button type="button"><a href="logout.php">Logout</a></button>
        <button type="button"><a href="nau.php">News and updates</a></button>
    </div> 
   </header> 
</body>
</html>    