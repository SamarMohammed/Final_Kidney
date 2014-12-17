<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="mysql"; // Database name 

$email=$_GET['email'];

	$con=mysqli_connect($host, $username, $password) or die("cannot connect");  //connect to the database
    mysqli_select_db($con,$db_name) or die("cannot select DB!!");
	//$m=$row['emailp'];
    $f=" DELETE FROM  `match` WHERE emailp = '$email'";
	$rr=mysqli_query($con, $f);
	if($rr)
	{
		echo "<h1> DATA HAVE BEEN DELETED </h1>";
		header("location:d.php");
	}
	else
		echo "<h1>THERE IS A PROBLEM.</h1>";
?>