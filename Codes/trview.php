<?php
    require('connection.php');
    session_start();
    if (isset($_SESSION['user1'])) {
        $user1 = $_SESSION['user1'];
    }
    if (isset($_SESSION['user2'])) {
        $user2 = $_SESSION['user2'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trade Requests</title>
</head>
<body>
<div class="heading">
        <center><h1>Trade Requests</h1></center>
    </div>   
    <br>
    <div class="pages">
    </div>
    <br>
    <hr size="3" width="100%" align="center" color="black">

         
</body>
<style type="text/css">
    table {
        border-collapse: collapse;
        width: 100%;
        color: black;
        font-family: monospace;
        font-size: 25px;
        text-align: left;
    }
    th {
        background-color: #588c7e;
        color: white;
    }
    form{padding-top: 10px;
        text-align: left;
        font-size:20px;}
    input{width: 250px;
        height:30px;
        font-size: 20px;}    
    
</style>    
<table>
        <tr>
            <th>User1</th>
            <th>User2</th>
            <th>Card1</th>
            <th>Card2</th>
            
    </tr>





    <?php
    $search_query = "SELECT * from trades WHERE user1='$user1' and user2='$user2' OR user1='$user2' and user2='$user1'";
        function executeQuery($search_query)
        {
    
    
            $dbhost = "localhost";
            $dbuser = "root";
            $dbpass = "";
            $dbname = "fifa_card";
            $conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
        if ($conn-> connect_error){
            die("Connection failed:". $conn-> connect_error);
        }

        $result = $conn-> query($search_query);
        return $result;
            }


        
        $result =executeQuery($search_query);
        while ($row=mysqli_fetch_array($result)){
            echo "<tr><td>". $row['user1'] . "</td><td>" . $row['user2'] . "</td><td>" . $row['card1'] . "</td><td>" . $row['card2'] . "</tr></td>"; 
        }
            echo "</table>";
        
    
    
    
    ?>
    <br>
    <br>
    <center>
    <a href="trade.php">Go Back</a>
    </center>
</table>
</html>