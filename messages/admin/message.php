<?php
session_start();
	require_once "session.php"; 
	require_once "bd.php";
	
	$urldir = $_SERVER['REQUEST_URI']; 
	$urldir = substr($urldir,10);
	$namechat = str_replace('message.php', '', $urldir);
	$namechat = str_replace('/', '', $namechat);
	
	$sql = "SELECT * FROM `chat_{$namechat}` ORDER BY `id` ASC ";
	$result = mysqli_query($link, $sql);
	
	echo '  <meta charset="utf-8"><table border="2" cellpadding="20" width="100%">';
	while ($row = mysqli_fetch_row($result))
	{
		echo "<tr ";
		if ($row[4] == 'no')
		{
			echo "style=\"background: #b3e5fc\">";
		}
		else
		{
			echo "style=\"background: #ffffff\">";
		}
		echo "<td style=\"width: 20%\">От: {$row[1]}</td><td style=\"width: 60%\">{$row[2]}</td><td style=\"width: 20%\">{$row[3]}</td></tr>";
	}
?>