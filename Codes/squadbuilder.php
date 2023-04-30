<?php
include_once("connection.php");
session_start();
if (isset($_SESSION['fifa_username'])) {
    $fifa_username = $_SESSION['fifa_username'];
}
if(isset($_POST['formation'])) {
    $formation = $_POST['formation'];
} else {
    $formation = "4-3-3";
}
$positions = array(
    "4-3-3" => array("gk", "lb", "cb", "cb", "rb", "cm", "cm", "cm", "lw", "rw", "st"),
    "4-4-2" => array("gk", "lb", "cb", "cb", "rb", "lm", "cm", "cm", "rm", "st", "st")
);
$inventory_query = "SELECT players.name, players.position, inventory.player_id, inventory.quantity, inventory.visible, players.pace, players.shoot, players.pass, players.dribble, players.defend, players.physical, players.price
              FROM inventory
              INNER JOIN players ON inventory.player_id = players.id
              WHERE inventory.fifa_username = '$fifa_username'";
$inventory_result = mysqli_query($con, $inventory_query);
$inventory = mysqli_fetch_all($inventory_result, MYSQLI_ASSOC);

$player_ids = array_column($inventory, 'player_id');
$player_ids_string = implode(',', $player_ids);

$players_query = "SELECT * FROM players WHERE id IN ($player_ids_string)";
$players_result = mysqli_query($con, $players_query);
$players = mysqli_fetch_all($players_result, MYSQLI_ASSOC);


function playerDropdown($position, $inventory,$con) {
    echo "<select name='$position'>";
    echo "<option value=''>Select Player</option>";
    foreach($inventory as $item) {
        if($item['position'] == $position) {
            echo 'sama';
            $player_query = "SELECT * FROM players WHERE id = ".$item['player_id'];
            $player_result = mysqli_query($con, $player_query);
            $player = mysqli_fetch_assoc($player_result);
            echo "<option value='".$player['id']."'>".$player['name']." - ".$player['club']."</option>";
        }
    }
    echo "</select>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Squad Builder</title>
</head>
<body>
    <h1>Squad Builder</h1>
    <form method="post" action="squadbuilder.php">
        <label for="formation">Formation:</label>
        <select name="formation">
            <option value="4-3-3" <?php if($formation == "4-3-3") echo "selected"; ?>>4-3-3</option>
            <option value="4-4-2" <?php if($formation == "4-4-2") echo "selected"; ?>>4-4-2</option>
        </select>
        <br><br>
        <?php
            foreach($positions[$formation] as $position) {
                echo "<label for='$position'>$position:</label>";
                playerDropdown($position, $inventory,$con);
                echo "<br><br>";
            }
        ?>
        <input type="submit" value="Build Squad">
    </form>
</body>
</html>
