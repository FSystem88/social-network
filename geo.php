<?php
session_start();
require "bd.php";
require "session.php";
$login = $_SESSION['user'];

	$lat = $_POST['lat'];
	$lon = $_POST['lon'];
	$date = date("d.m.y");
	$time = date("H:i:s");
	$result = mysqli_query($link, "SELECT * FROM geo WHERE name='$login'");
	$num = mysqli_num_rows($result);
	if ($num > 0 )
	{
		$result = mysqli_query($link, "UPDATE geo SET lat='$lat'  WHERE name='$login'");
		$result = mysqli_query($link, "UPDATE geo SET lon='$lon'  WHERE name='$login'");
		$result = mysqli_query($link, "UPDATE geo SET date='$date'  WHERE name='$login'");
		$result = mysqli_query($link, "UPDATE geo SET time='$time'  WHERE name='$login'");
	}
	else
	{
		$query = mysqli_query($link, "INSERT INTO `geo`(`name`, `lat`, `lon`, `date`, `time`) VALUES ('$login','$lat','$lon', '$date', '$time')");
	}	
?>