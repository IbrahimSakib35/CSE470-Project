<?php
require('connection.php');
session_start();
if (isset($_SESSION['fifa_username'])) {
    $fifa_username = $_SESSION['fifa_username'];

    $sort = "";
    if (isset($_POST['sort'])) {
        $sort = $_POST['sort'];
    }

    $query = "SELECT players.name, inventory.quantity, inventory.visible, players.pace, players.shoot, players.pass, players.dribble, players.defend, players.physical, players.price
              FROM inventory
              INNER JOIN players ON inventory.player_id = players.id
              WHERE inventory.fifa_username = '$fifa_username'";
              

    if ($sort != "") {
        $query .= " ORDER BY players.$sort DESC";
    }
    
    $result = mysqli_query($con, $query);
    
    if (!$result) {
        echo "Error: " . mysqli_error($con);
    }
    mysqli_data_seek($result,0);
    $row=mysqli_fetch_assoc($result);
    $aaa=$row['visible'];
} else {
    echo "<script>
          alert('No user detected');
          window.location.href='home.php';
          </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
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
   <main>
      <h2>Your Inventory</h2>
      <form method="post" action="inventory.php">
         <label for="sort">Sort by:</label>
         <select id="sort" name="sort">
            <option value="">--Select--</option>
            <option value="pace"<?php if ($sort == "pace") { echo " selected"; } ?>>Pace</option>
            <option value="shoot"<?php if ($sort == "shoot") { echo " selected"; } ?>>Shoot</option>
            <option value="pass"<?php if ($sort == "pass") { echo " selected"; } ?>>Pass</option>
            <option value="dribble"<?php if ($sort == "dribble") { echo " selected"; } ?>>Dribble</option>
            <option value="defend"<?php if ($sort == "defend") { echo " selected"; } ?>>Defend</option>
            <option value="physical"<?php if ($sort == "physical") { echo " selected"; } ?>>Physical</option>
            <option value="price"<?php if ($sort == "price") { echo " selected"; } ?>>Price</option>
         </select>
         <input type="submit" value="Sort">
      </form>
      <table id="inventory-table">
         <thead>
            <tr>
               <th>Player Name</th>
               <th>Quantity</th>
               <th>Pace</th>
               <th>Shoot</th>
               <th>Pass</th>
               <th>Dribble</th>
               <th>Defend</th>
               <th>Physical</th>
               <th>Price</th>
            </tr>
         </thead>
         <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
               <td><?php echo $row['name']; ?></td>
               <td><?php echo $row['quantity']; ?></td>
               <td><?php echo $row['pace']; ?></td>
               <td><?php echo $row['shoot']; ?></td>
               <td><?php echo $row['pass']; ?></td>
               <td><?php echo $row['dribble']; ?></td>
               <td><?php echo $row['defend']; ?></td>
               <td><?php echo $row['physical']; ?></td>
               <td><?php echo $row['price']; ?></td>
            </tr>
            <?php endwhile; ?>
         </tbody>
      </table>
      <?php 
      if ($aaa == 1) : ?>
         <button id="toggle-btn" type="button">Hide Inventory</button>
      <?php else : ?>
         <button id="toggle-btn" type="button">Show Inventory</button>
      <?php endif; ?>
   </main>
   <button type="button"><a href="squadbuilder.php">Squad Builder</a></button>
   <script>
      const toggleBtn = document.getElementById('toggle-btn');
      const inventoryTable = document.getElementById('inventory-table');
      inventoryTable.style.display = '<?php echo $aaa == 1 ? "table" : "none"; ?>';

      toggleBtn.addEventListener('click', () => {
         if (toggleBtn.textContent == 'Hide Inventory') {
            inventoryTable.style.display = 'none';
            toggleBtn.textContent = 'Show Inventory';
            window.location.href='show.php';
         } else {
            inventoryTable.style.display = 'table';
            toggleBtn.textContent = 'Hide Inventory';
            window.location.href='hide.php';
         }
      });
   </script>
</body>
</html>