<?php
	session_start(); 
	require "bd.php";
	if(isset($_SESSION['user']))
	{
		$login = $_SESSION['user'];
	}
	else
	{
		header("Location: auth.php");
		exit;
	}
	if($_POST['submit_close'])
	{
		unset($_SESSION['user']);
		header("Location: auth.php");
	}
	
?>