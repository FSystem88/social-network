<?php
session_start();
	require "session.php";
	require "bd.php";
	
	$login = $_SESSION['user'];
	
	$result = mysqli_query($link, "SHOW TABLES FROM $db_table LIKE 'chat%{$login}%'");
	$check = mysqli_num_rows($result);
	if ($check == 0)
	{
		echo "<br><br><b>Список диалогов пуст!</b><br><br><br>";
	}
	else
	{
		while ($table = mysqli_fetch_array($result))
		{
			$namechat = str_replace('chat_', '', $table[0]);
			$userchat = str_replace('_', ' с ', $namechat);
			$fff = array("_", "{$login}");
			$username = str_replace($fff, "", "{$namechat}");
			$numbread = mysqli_query($link, "SELECT COUNT(*) as total FROM {$table[0]} WHERE `name`='$username' AND `read`='no'");
			$numread = mysqli_fetch_assoc($numbread);
			echo "<button style=\"width: 50%;height: 5%;\"><b><a href=\"../messages/{$namechat}\">Диалог {$userchat}</a></b></button> <i>Непрочитанных: {$numread['total']}</i><br><br>"; 
		}
	}
?>