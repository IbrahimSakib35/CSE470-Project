<?php
require('connection.php');
session_start();
if (isset($_SESSION['fifa_username'])) {
    $fifa_username = $_SESSION['fifa_username'];
}
$update="UPDATE inventory SET visible=1 WHERE fifa_username='$fifa_username'";
$result = mysqli_query($con, $update);
echo "<script>
alert('Your Inventory is now Public!');
window.location.href='inventory.php';
</script>";
?>