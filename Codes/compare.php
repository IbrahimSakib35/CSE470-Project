<?php
require('connection.php');
session_start();

if (isset($_POST['id'])) {

  $playerId1 = $_POST['id'];
  $query1 = "SELECT * FROM players WHERE id = $playerId1";
  $result1 = mysqli_query($con, $query1);
  $row1 = mysqli_fetch_assoc($result1);

  $query2 = "SELECT * FROM players WHERE id != $playerId1";
  $result2 = mysqli_query($con, $query2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Compare Players</title>
</head>
<body>
  <h1>Compare Players</h1>
  <h2>Player 1:</h2>
  <div class='player'>
  <table>
    <tr><th>Player Name</th><td class='highlight'><?php echo $row1['name']; ?></td></tr>
    <tr><th>Club Name</th><td class='highlight'><?php echo $row1['club']; ?></td></tr>
    <tr><th>Country Name</th><td class='highlight'><?php echo $row1['country']; ?></td></tr>
    <tr><th>Position</th><td class='highlight'><?php echo $row1['position']; ?></td></tr>
    <tr><th>Pace</th><td class='highlight'><?php echo $row1['pace']; ?></td></tr>
    <tr><th>Shooting</th><td class='highlight'><?php echo $row1['shoot']; ?></td></tr>
    <tr><th>Passing</th><td class='highlight'><?php echo $row1['pass']; ?></td></tr>
    <tr><th>Dribbling</th><td class='highlight'><?php echo $row1['dribble']; ?></td></tr>
    <tr><th>Defending</th><td class='highlight'><?php echo $row1['defend']; ?></td></tr>
    <tr><th>Physicality</th><td class='highlight'><?php echo $row1['physical']; ?></td></tr>
  </table>
  </div>
  <br>

  <h2>Player 2:</h2>
  <form action="compare_results.php" method="post">
    <input type="hidden" name="playerId1" value="<?php echo $playerId1; ?>">
    <select name="playerId2">
      <?php while ($row2 = mysqli_fetch_assoc($result2)) { ?>
        <option value="<?php echo $row2['id']; ?>"><?php echo $row2['name']; ?></option>
      <?php } ?>
    </select>
    <br>
    <input type="submit" value="Compare">
  </form>
  <br>
  <button type="button"><a href="home.php">Home Page</a></button>
  <style>
        .player{
          background-image: url('pl.jpg');
          background-repeat: no-repeat;
          background-size: cover;
          display: flex;
          justify-content: center;
          align-items: center;
          height: 300px;
          width: 200px;
          border: 1px solid black;
          border-radius: 10px;
          padding: 20px;
          box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
        }
        .player .highlight {
          background-color: #ffd700;
          font-weight: bold;
        }
  </style>
</body>
</html>

<?php
} 
else {
  header("Location: playercard.php");
  exit();
}
?>