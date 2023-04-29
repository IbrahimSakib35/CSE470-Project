<?php
require('connection.php');
session_start();
if (isset($_SESSION['fifa_username'])) {
    $fifa_username = $_SESSION['fifa_username'];
    $query = "SELECT players.id, players.name, players.position, players.club, players.country, inventory.quantity
              FROM inventory
              INNER JOIN players ON inventory.player_id = players.id
              WHERE inventory.fifa_username = '$fifa_username'
              ORDER BY players.position";
    $result = mysqli_query($con, $query);
    if (!$result) {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "<script>
          alert('No user detected');
          window.location.href='home.php';
          </script>";
}

function getChemistry($player1, $player2) {
    $chemistry = 0;
    if ($player1['club'] == $player2['club']) {
        $chemistry += 1;
    }
    if ($player1['country'] == $player2['country']) {
        $chemistry += 1;
    }
    if ($player1['position'] == 'GK' && $player2['position'] == 'GK') {
        $chemistry += 3;
    } else if (abs(ord($player1['position']) - ord($player2['position'])) <= 2) {
        $chemistry += 2;
    } else if (abs(ord($player1['position']) - ord($player2['position'])) <= 4) {
        $chemistry += 1;
    }
    return $chemistry;
}

$formations = [
    '4-3-3' => [
        ['GK'],
        ['LB', 'CB', 'CB', 'RB'],
        ['CM', 'CM', 'CM'],
        ['LW', 'CF', 'RW']
    ],
    '4-4-2' => [
        ['GK'],
        ['LB', 'CB', 'CB', 'RB'],
        ['LM', 'CM', 'CM', 'RM'],
        ['ST', 'ST']
    ]
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $formation = $_POST['formation'];
    $squad = [];
    $totalChemistry = 0;
    foreach ($formations[$formation] as $row) {
        $rowChemistry = 0;
        $rowPlayers = [];
        foreach ($row as $position) {
            $bestPlayer = null;
            foreach ($result as $row2) {
                $playerChemistry = 0;
                foreach ($rowPlayers as $player) {
                    $playerChemistry += getChemistry($row2, $player);
                }
                if ($row2['position'] == $position && $playerChemistry > $rowChemistry) {
                    $bestPlayer = $row2;
                    $rowChemistry = $playerChemistry;
                }
            }
            if ($bestPlayer != null) {
                $rowPlayers[] = $bestPlayer;
                $totalChemistry += $rowChemistry;
            }
        }
        $squad[] = $rowPlayers;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Squad Builder</title>
</head>
<body>
   <header> 
    <h1>FIFA Card Management</h1>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="inventory.php">Inventory</a></li>
            <li><a href="playercard.php">Player Cards</a></li>
            <li><a href="trading.php">Trading</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
   </header> 
   <main>
      <h2>Squad Builder</h2>
      <form method="post">
         <label for="formation">Formation:</label>
         <select name="formation" id="formation">
            <option value="433">4-3-3</option>
            <option value="442">4-4-2</option>
         </select>
         <table>
            <thead>
               <tr>
                  <th>Position</th>
                  <th>Player Name</th>
                  <th>Club</th>
                  <th>Country</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>GK</td>
                  <td>
                     <select name="gk">
                        <option value="">Select a GK</option>
                        <?php while ($row = mysqli_fetch_assoc($gk_result)) : ?>
                        <option value="<?php echo $row['player_id']; ?>"><?php echo $row['name']; ?></option>
                        <?php endwhile; ?>
                     </select>
                  </td>
                  <td></td>
                  <td></td>
               </tr>
               <tr>
                  <td>LB</td>
                  <td>
                     <select name="lb">
                        <option value="">Select a LB</option>
                        <?php while ($row = mysqli_fetch_assoc($lb_result)) : ?>
                        <option value="<?php echo $row['player_id']; ?>"><?php echo $row['name']; ?></option>
                        <?php endwhile; ?>
                     </select>
                  </td>
                  <td></td>
                  <td></td>
               </tr>
               <tr>
                  <td>CB1</td>
                  <td>
                     <select name="cb1">
                        <option value="">Select a CB</option>
                        <?php while ($row = mysqli_fetch_assoc($cb_result)) : ?>
                        <option value="<?php echo $row['player_id']; ?>"><?php echo $row['name']; ?></option>
                        <?php endwhile; ?>
                     </select>
                  </td>
                  <td></td>
                  <td></td>
               </tr>
               <tr>
                  <td>CB2</td>
                  <td>
                     <select name="cb2">
                        <option value="">Select a CB</option>
                        <?php mysqli_data_seek($cb_result, 0); ?>
                        <?php while ($row = mysqli_fetch_assoc($cb_result)) : ?>
                        <option value="<?php echo $row['player_id']; ?>"><?php echo $row['name']; ?></option>
                        <?php endwhile; ?>
                     </select>
                  </td>
                  <td></td>
                  <td></td>
               </tr>  
            </tbody>
         </table>
      </form>
        <h3>Chemistry: <?php echo $chemistry; ?></h3>
   </main>
      <button type="button"><a href="inventory.php">Back to Inventory</a></button>
</body>
</html>   
