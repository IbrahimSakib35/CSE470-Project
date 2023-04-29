<?php
    require('connection.php');
    session_start();

    if (isset($_POST['submit'])) {
        $user1 = $_POST['user1'];
        $user2 = $_POST['user2'];

        if (isset($_POST['user1_cards']) && isset($_POST['user2_cards'])) {
            $user1_cards = $_POST['user1_cards'];
            $user2_cards = $_POST['user2_cards'];

            foreach ($user1_cards as $card_name) {
                $card_query = "SELECT id FROM players WHERE name = '$card_name'";
                $card_result = mysqli_query($con, $card_query);
                $card = mysqli_fetch_assoc($card_result);
                $card_id = $card['id'];
                $update1 = "UPDATE inventory 
                  SET quantity = quantity - 1 
                  WHERE fifa_username = '$user1' AND player_id = '$card_id'";
                mysqli_query($con, $update1);;

                $trade_query = "INSERT INTO trades (card1, user1, user2) VALUES ('$card_id', '$user1', '$user2')";
                mysqli_query($con, $trade_query);
            }

            foreach ($user2_cards as $card_name) {
                $card_query = "SELECT id FROM players WHERE name = '$card_name'";
                $card_result = mysqli_query($con, $card_query);
                $card = mysqli_fetch_assoc($card_result);
                $card_id = $card['id'];
                $update3 = "UPDATE inventory 
                  SET quantity = quantity - 1 
                  WHERE fifa_username = '$user2' AND player_id = '$card_id'";
                mysqli_query($con, $update3);

                $trade_query = "INSERT INTO trades (card2, user1, user2) VALUES ('$card_id', '$user2', '$user1')";
                mysqli_query($con, $trade_query);
            }

            echo"<script>
            alert('Trade request submitted!');
            window.location.href='home.php';
            </script>";
    
        } else {
            echo"<script>
            alert('Select card!');
            window.location.href='trade.php';
            </script>";
    
        }
    }
?>
