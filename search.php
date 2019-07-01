<?php
require "bd.php";

	if (!$_POST['searchuser'] == "")
	{
		$searchuser = $_POST['searchuser'];
		
		if ($id = mysqli_query($link, "SELECT id FROM users WHERE login='$searchuser'")) 
		{
			$id1 = mysqli_num_rows($id);
			if ($id1 > 0) 
			{
				$result = mysqli_query($link, "SELECT * FROM users WHERE login='$searchuser'");
				echo "<form action=\"script.php\" method=\"POST\"></form>";
				$row=mysqli_fetch_array($result);
				echo "
				<form action=\"script.php\" method=\"POST\">
				<p>{$row[1]}</p>
				<input type=\"hidden\" name=\"username\" value=\"{$row[1]}\">
				<input type=\"submit\" name=\"message\" align=\"right\" value=\"Начать диалог\">
				</form>";
			}
			else
			{
				$result = "<a style=\"font-size: 15; color: red; \">Пользователь с логином</a> <a style=\"font-weight: bolder\">{$searchuser}</a> <a style=\"font-size: 15; color: red; \">не найден</a>";
				echo $result;
			}
		}
	}
	else
	{
		echo "<p style=\"font-size: 15; color: red; font-weight: bolder\">Пожалуйста введите имя пользователя!</p>";
	}
	

?>