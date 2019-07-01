<?php

session_start();
	require_once "session.php"; 
	require_once "bd.php"; 
	$login = $_SESSION['user'];
	$urldirq = $_SERVER['REQUEST_URI']; 
	$urldir = substr($urldirq,10);
	$blablabla1 = array("read.php", "/");
	$namechat = str_replace($blablabla1, "", "{$urldir}");
	$blablabla2 = array("_", "{$login}");
	$username = str_replace($blablabla2, "", "{$namechat}");

    $result = mysqli_query($link, "UPDATE `chat_$namechat` SET `read` = 'yes' WHERE `name`='$username'; ");
    


?>
