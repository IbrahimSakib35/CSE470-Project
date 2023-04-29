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
    <title>Player Cards</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
   <header> 
    <h1>FIFA Card Management</h1>
    <div class="bar">
        <button type="button"><a href="home.php">Home</a></button>
        <button type="button"><a href="trading.php">Trading</a></button>
        <button type="button"><a href="logout.php">Logout</a></button>
    </div> 
    <br>
    <br>
    <div class="form">
      <h2>Search For Players</h2>
      <form method="get" action="search.php">
        <input type="text" placeholder="Enter player name" name="player_name" id="player_name" style="color:cyan">
        <input type="text" placeholder="Enter player club" name="player_club" id="player_club" style="color:cyan">
        <input type="text" placeholder="Enter player country" name="player_country" id="player_country" style="color:cyan">
        <br>
        <button type="submit" class="src-btn" name="search"><b>Search</b></button>
      </form>
    </div>  
</header> 

</body>
</html>