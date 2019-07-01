<?php
	session_start();
	require_once "session.php"; 
	require "bd.php";
	$login = $_SESSION['user'];
	$end = mysqli_query($link, "SELECT * FROM users"  );
	echo "<form action=\"script.php\" method=\"POST\"></form>";
	while ($row = mysqli_fetch_row($end))
	{
		echo "
		<form action=\"script.php\" method=\"POST\">
		<p>{$row[1]}</p>
		<input type=\"hidden\" name=\"username\" value=\"{$row[1]}\">
		<input type=\"submit\" name=\"message\" align=\"right\" value=\"Начать диалог\">
		</form>
		
		";
	}
	echo "</form>";
	

?>