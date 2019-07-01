<?php
session_start();
require "session.php";
require "bd.php";

	$username = $_POST['username'];
	
	
	if(isset($_POST['message']))
	{
		if($_POST['message'])
		{
			if (!$_POST['username'] == "")
			{
				if ( $username == $login )
				{
					echo "
						<script>alert('Диалог с самим собой невозможен!')</script>
						<script>location.href = '../' </script>
					";
				}
				else 
				{
				    $firstcheck = "{$username}_{$login}";
				    $query = mysqli_query($link, "SHOW TABLES FROM $db_table LIKE 'chat_$firstcheck';");
                    $result = mysqli_num_rows($query);
			    	if ($result == "0" )
			    	{
						$secondcheck = "{$login}_{$username}";
						$query = mysqli_query($link, "SHOW TABLES FROM $db_table LIKE 'chat_$secondcheck';");
						$result = mysqli_num_rows($query);
						if ($result == "0" )
						{
	    		    	    $namechat = "{$login}_{$username}";
			        	    $query2 = mysqli_query($link, "CREATE TABLE `chat_$namechat` (`id` int(11) NOT NULL,`name` varchar(16) NOT NULL,`text` varchar(512) NOT NULL,`ddtt` varchar(64) NOT NULL,`read` varchar(3) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8");
                            $query3 = mysqli_query($link, "ALTER TABLE `chat_$namechat` ADD PRIMARY KEY (`id`);");
			        	    $query4 = mysqli_query($link, "ALTER TABLE `chat_$namechat` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;");
			        	    
							$query2 = mysqli_query($link, "CREATE TABLE `geo_$namechat` (`id` int(11) NOT NULL,`name` varchar(16) NOT NULL,`geo` varchar(5) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8");
                            $query3 = mysqli_query($link, "ALTER TABLE `geo_$namechat` ADD PRIMARY KEY (`id`);");
			        	    $query4 = mysqli_query($link, "ALTER TABLE `geo_$namechat` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;");
							$query2 = mysqli_query($link, "INSERT INTO `geo_$namechat`(`name`, `geo`) VALUES ('$login', 'off')");
							$query2 = mysqli_query($link, "INSERT INTO `geo_$namechat`(`name`, `geo`) VALUES ('$username', 'off')");
							
	    		    	    $query1 = mkdir("../messages/$namechat", 0700);
							$query5 = copy("../messages/admin/index.php", "../messages/$namechat/index.php" );
	    		    	    $query6 = copy("../messages/admin/ajax.php", "../messages/$namechat/ajax.php" );
	    		    	    $query7 = copy("../messages/admin/message.php", "../messages/$namechat/message.php" );
	    		    	    $query1 = copy("../messages/admin/editgeo.php", "../messages/$namechat/editgeo.php" );
	    		    	    $query1 = copy("../messages/admin/getgeo.php", "../messages/$namechat/getgeo.php" );
	    		    	    $query1 = copy("../messages/admin/read.php", "../messages/$namechat/read.php" );
	    		    	    $query8 = copy("../bd.php", "../messages/$namechat/bd.php" );
	    		    	    $query9 = copy("../session.php", "../messages/$namechat/session.php" );
	    		    	    $query1 = copy("../geo.php", "../messages/$namechat/geo.php" );
	    		    	    
							echo "<script>location.href = '/messages/$namechat' </script>";
			        	}
			        	else 
			        	{
							echo "<script>location.href = '/messages/$secondcheck' </script>";
						}
			    	}
			    	else
			    	{
						echo "<script>location.href = '/messages/$firstcheck' </script>";
					}
				}
			}
		}
	}




?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">