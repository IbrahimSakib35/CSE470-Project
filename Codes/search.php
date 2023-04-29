<?php
require('connection.php');
session_start();
if (empty($_GET['player_name']) && empty($_GET['player_club']) && empty($_GET['player_country'])) {
    echo"<script>
        alert('Give input to search!');
        window.location.href='playercard.php';
        </script>";
    exit();
}
if (isset($_GET['player_name']) || isset($_GET['player_club']) || isset($_GET['player_country'])) {

  $playerName = $_GET['player_name'];
  $clubName = $_GET['player_club'];
  $countryName = $_GET['player_country'];

  $query = "SELECT id, name, club, country, position FROM players WHERE ";
  $conditions = array();

  if (!empty($playerName)) {
    $conditions[] = "name LIKE '%$playerName%'";
  }

  if (!empty($clubName)) {
    $conditions[] = "club LIKE '%$clubName%'";
  }

  if (!empty($countryName)) {
    $conditions[] = "country LIKE '%$countryName%'";
  }

  $query .= implode(' AND ', $conditions);

  $result = mysqli_query($con, $query);

  if (mysqli_num_rows($result) > 0) {
    echo "<div class='search'>";
    echo"<h1>Player Cards</h1>";
    echo"<br>";
    echo"<h4>click player names to view</h4>";
    echo"<br>";
    echo "<table>";
    echo "<tr><th>Player Name</th><th>Club Name</th><th>Country Name</th><th>Position</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td><a href='playerstats.php?id=" . $row['id'] . "'>" . $row['name'] . "</a></td>";
      echo "<td>" . $row['club'] . "</td>";
      echo "<td>" . $row['country'] . "</td>";
      echo "<td>" . $row['position'] . "</td>";
      echo "</tr>";
    }

    echo "</table>";
    echo"<br>";
    echo"<br>";
    echo'<button type="button"><a href="home.php">Home</a></button>';
    echo"</div>";
  } else {
 
    echo "No player cards were found based on your search parameters.";
  }
} else {
 
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
    <title>Searching</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
  <style>
    .search{
      background-color: yellow;
      padding: 10px;
      margin: 10px;
      display : flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-around;

    }
  </style>
</body>
</html>