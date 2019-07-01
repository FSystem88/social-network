<?php
session_start();
require "bd.php";
require "session.php";
	$login = $_SESSION['user'];
    $urldir = $_SERVER['REQUEST_URI']; 
	$urldir = substr($urldir,10);
	$blablabla1 = array("getgeo.php", "/");
	$namechat = str_replace($blablabla1, "", "{$urldir}");
	$blablabla2 = array("_", "{$login}");
	$username = str_replace($blablabla2, "", "{$namechat}");


	$result = mysqli_query($link, "SELECT * FROM `geo_{$namechat}` WHERE name='$username'");
	while ($row = mysqli_fetch_row($result))
	{
		if ($row[2] == "off")
		{
			echo "<script>alert('Пользователь $username запретил Вам просматривать его геолокацию!');</script>";
		}
		else
		{
			$result = mysqli_query($link, "SELECT * FROM `geo` WHERE name='$username'");
			while ($row = mysqli_fetch_row($result))
			{
				$lat = "{$row[2]}";
				$lat1 = substr("{$lat}", 0, 2);
				$lat02 = ($lat-$lat1)*60;
				$lat2 = substr("{$lat02}", 0, 2);
				$lat03 = ($lat02-$lat2)*60;
				$lat3 = round($lat03, 1);
				
				$lon = "{$row[3]}";
				$lon1 = substr("{$lon}", 0, 2);
				$lon02 = ($lon-$lon1)*60;
				$lon2 = substr("{$lon02}", 0, 2);
				$lon03 = ($lon02-$lon2)*60;
				$lon3 = round($lon03, 1);

				echo "<script>if (confirm(\"Последняя геолокация {$row[1]} была получена: дата: {$row[4]}, время {$row[5]}. Показать отметку в Gogole Maps?\")){ window.open(\"https://www.google.com/maps/place/{$lat1}%C2%B0{$lat2}'{$lat3}%22N+{$lon1}%C2%B0{$lon2}'{$lon3}%22E/@{$lat},{$lon},17z\")}</script>";
			}
		}
	}
?>
