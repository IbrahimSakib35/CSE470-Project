<?php
    require('connection.php');
    session_start();
    if (isset($_SESSION['user1'])) {
        $user1 = $_SESSION['user1'];
    }
    if (isset($_SESSION['user2'])) {
        $user2 = $_SESSION['user2'];
    }

    $user1_inventory_query = "SELECT inventory.quantity, players.name
                                FROM inventory 
                                INNER JOIN players 
                                ON inventory.player_id = players.id 
                                WHERE inventory.fifa_username = '$user1'";

    $user2_inventory_query = "SELECT inventory.quantity, players.name
                                FROM inventory 
                                INNER JOIN players 
                                ON inventory.player_id = players.id 
                                WHERE inventory.fifa_username = '$user2'";

    $user1_inventory_result = mysqli_query($con, $user1_inventory_query);
    $user2_inventory_result = mysqli_query($con, $user2_inventory_query);

    $user1_inventory = mysqli_fetch_all($user1_inventory_result, MYSQLI_ASSOC);
    $user2_inventory = mysqli_fetch_all($user2_inventory_result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Trade</title>
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
        <h1>Trade</h1>
        
        <form action="submit_trade.php" method="post">
            <input type="hidden" name="user1" value="<?php echo $user1; ?>">
            <input type="hidden" name="user2" value="<?php echo $user2; ?>">
            
            <h2><?php echo $user1; ?>'s inventory:</h2>
            <table>
                <thead>
                    <tr>
                        <th>Player</th>
                        <th>Quantity</th>
                        <th>Select to Trade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($user1_inventory as $player): ?>
                    <tr>
                        <td><?php echo $player['name']; ?></td>
                        <td><?php echo $player['quantity']; ?></td>
                        <td><input type="checkbox" name="user1_cards[]" value="<?php echo $player['name']; ?>"></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <h2><?php echo $user2; ?>'s inventory:</h2>
            <table>
                <thead>
                    <tr>
                        <th>Player</th>
                        <th>Quantity</th>
                        <th>Select to Trade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($user2_inventory as $player): ?>
                    <tr>
                        <td><?php echo $player['name']; ?></td>
                        <td><?php echo $player['quantity']; ?></td>
                        <td><input type="checkbox" name="user2_cards[]" value="<?php echo $player['name']; ?>"></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <input type="submit" name="submit" value="Submit Trade">
        </form>
        <br>
        <button type="button"><a href="trview.php">Previous trades</a></button>
    </body>
</html>
