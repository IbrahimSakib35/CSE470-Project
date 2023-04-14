<?php
$dbhost="localhost";
$dbusername="root";
$dbpassword="";
$dbname="fifa_card";
if(!$con = mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname))
{

	die("failed to connect!");
}