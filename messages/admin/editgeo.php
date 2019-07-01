<?php 
session_start();
require "bd.php";
require "session.php";

	$urldir = $_SERVER['REQUEST_URI']; 
	$urldir = substr($urldir,10);
	$namechat = str_replace('editgeo.php', '', $urldir);
	$namechat = str_replace('/', '', $namechat);

	$login = $_SESSION['user'];
	$editgeo = $_POST['editgeo'];
	
	$result - mysqli_query($link, "UPDATE `geo_{$namechat}` SET `geo`='{$editgeo}' WHERE `name`='{$login}'");
	

?>