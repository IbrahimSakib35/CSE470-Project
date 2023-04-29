<?php
require('connection.php');
session_start();

if (isset($_GET['id'])) {
  $playerId = $_GET['id'];

  // Retrieve the player stats from the database
  $query = "SELECT * FROM players WHERE id = $playerId";
  $result = mysqli_query($con, $query);

  if (mysqli_num_rows($result) > 0) {
    // Display the player stats in a table
    $row = mysqli_fetch_assoc($result);
    echo "<div class='player'>";
    echo "<table>";
    echo "<tr><th>Player Name</th><td class='highlight'>" . $row['name'] . "</td></tr>";
    echo "<tr><th>Club Name</th><td class='highlight'>" . $row['club'] . "</td></tr>";
    echo "<tr><th>Country Name</th><td class='highlight'>" . $row['country'] . "</td></tr>";
    echo "<tr><th>Position</th><td class='highlight'>" . $row['position'] . "</td></tr>";
    echo "<tr><th>Pace</th><td class='highlight'>" . $row['pace'] . "</td></tr>";
    echo "<tr><th>Shooting</th><td class='highlight'>" . $row['shoot'] . "</td></tr>";
    echo "<tr><th>Passing</th><td class='highlight'>" . $row['pass'] . "</td></tr>";
    echo "<tr><th>Dribbling</th><td class='highlight'>" . $row['dribble'] . "</td></tr>";
    echo "<tr><th>Defending</th><td class='highlight'>" . $row['defend'] . "</td></tr>";
    echo "<tr><th>Physicality</th><td class='highlight'>" . $row['physical'] . "</td></tr>";
    echo "<tr><th>Market Price</th><td class='highlight'>" . $row['price'] . "</td></tr>";
    echo "</table>";
    echo"</div>";
    echo"<br>";
    echo "<form action='compare.php' method='post'>";
    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
    echo "<input type='submit' value='Compare Selected'>";
    echo "</form>";

  } else {
    // Display a message indicating the player card could not be found
    echo "The player card could not be found.";
  }
} else {
  // If the player ID was not provided in the URL, redirect back to the playercard.php page
  header("Location: playercard.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Stats</title>
</head>
<body>
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
    <button type="button"><a href="home.php">Home Page</a></button>
</body>
</html>