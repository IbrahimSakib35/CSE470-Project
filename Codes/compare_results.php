<?php
require('connection.php');
session_start();

if (isset($_POST['playerId1']) && isset($_POST['playerId2'])) {
  $playerId1 = $_POST['playerId1'];
  $playerId2 = $_POST['playerId2'];

  $query1 = "SELECT * FROM players WHERE id = $playerId1";
  $result1 = mysqli_query($con, $query1);
  $row1 = mysqli_fetch_assoc($result1);

  $query2 = "SELECT * FROM players WHERE id = $playerId2";
  $result2 = mysqli_query($con, $query2);
  $row2 = mysqli_fetch_assoc($result2);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Compare Results</title>
  <style>
    .green {
      color: green;
    }
    .red {
      color: red;
    }
    .blue {
      color: blue;
    }
  </style>
</head>
<body>
  <h1>Compare Results</h1>
  <table>
    <tr>
      <th></th>
      <th><?php echo $row1['name']; ?></th>
      <th><?php echo $row2['name']; ?></th>
    </tr>
    <tr>
      <th>Pace</th>
      <td class="<?php echo $row1['pace'] > $row2['pace'] ? 'green' : ($row1['pace'] < $row2['pace'] ? 'red' : 'blue'); ?>"><?php echo $row1['pace']; ?></td>
      <td class="<?php echo $row2['pace'] > $row1['pace'] ? 'green' : ($row2['pace'] < $row1['pace'] ? 'red' : 'blue'); ?>"><?php echo $row2['pace']; ?></td>
    </tr>
    <tr>
      <th>Shooting</th>
      <td class="<?php echo $row1['shoot'] > $row2['shoot'] ? 'green' : ($row1['shoot'] < $row2['shoot'] ? 'red' : 'blue'); ?>"><?php echo $row1['shoot']; ?></td>
      <td class="<?php echo $row2['shoot'] > $row1['shoot'] ? 'green' : ($row2['shoot'] < $row1['shoot'] ? 'red' : 'blue'); ?>"><?php echo $row2['shoot']; ?></td>
    </tr>
    <tr>
      <th>Passing</th>
      <td class="<?php echo $row1['pass'] > $row2['pass'] ? 'green' : ($row1['pass'] < $row2['pass'] ? 'red' : 'blue'); ?>"><?php echo $row1['pass']; ?></td>
      <td class="<?php echo $row2['pass'] > $row1['pass'] ? 'green' : ($row2['pass'] < $row1['pass'] ? 'red' : 'blue'); ?>"><?php echo $row2['pass']; ?></td>
    </tr>
    <tr>
      <th>Dribbling</th>
      <td class="<?php echo $row1['dribble'] > $row2['dribble'] ? 'green' : ($row1['dribble'] < $row2['dribble'] ? 'red' : 'blue'); ?>"><?php echo $row1['dribble']; ?></td>
      <td class="<?php echo $row2['dribble'] > $row1['dribble'] ? 'dribble' : ($row2['dribble'] < $row1['dribble'] ? 'red' : 'dribble'); ?>"><?php echo $row2['dribble']; ?></td>
    </tr>
    <tr>
      <th>Defending</th>
      <td class="<?php echo $row1['defend'] > $row2['defend'] ? 'green' : ($row1['defend'] < $row2['defend'] ? 'red' : 'blue'); ?>"><?php echo $row1['defend']; ?></td>
      <td class="<?php echo $row2['defend'] > $row1['defend'] ? 'green' : ($row2['defend'] < $row1['defend'] ? 'red' : 'blue'); ?>"><?php echo $row2['defend']; ?></td>
    </tr>
    <tr>
      <th>Physicality</th>
      <td class="<?php echo $row1['physical'] > $row2['physical'] ? 'green' : ($row1['physical'] < $row2['physical'] ? 'red' : 'blue'); ?>"><?php echo $row1['physical']; ?></td>
      <td class="<?php echo $row2['physical'] > $row1['physical'] ? 'green' : ($row2['physical'] < $row1['physical'] ? 'red' : 'blue'); ?>"><?php echo $row2['physical']; ?></td>
    </tr>
    <tr>
      <th>Market Price</th>
      <td class="<?php echo $row1['price'] > $row2['price'] ? 'red' : ($row1['price'] < $row2['price'] ? 'green' : 'blue'); ?>"><?php echo $row1['price']; ?></td>
      <td class="<?php echo $row2['price'] > $row1['price'] ? 'red' : ($row2['price'] < $row1['price'] ? 'green' : 'blue'); ?>"><?php echo $row2['price']; ?></td>
    </tr>
  </table>
  <button type="button"><a href="home.php">Home Page</a></button>
</body>
</html>   