<?php
session_start();
	require_once "session.php"; 
	require_once "bd.php";
	$name = $_SESSION['user'];
   	$urldir = $_SERVER['REQUEST_URI']; 
   	$urldir = substr($urldir,10);
   	$namechat = str_replace('ajax.php', '', $urldir);
   	$namechat = str_replace('/', '', $namechat);
	$text = $_POST['text'];
	$date = date("d.m.y");
	$time = date("H:i:s");
	$ddtt = "Время: $time Дата: $date";
	if (!$_POST['text'] == "")
	{
		$result = mysqli_query($link, "INSERT INTO `chat_$namechat`(`name`, `text`, `ddtt`, `read`) VALUES ('$name','$text','$ddtt','no')");
	}
?>

