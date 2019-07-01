<?php 
	session_start();
	require "bd.php";
			
			
			
	$login = $_POST['login'];
	$pass = $_POST['pass'];
	$email = $_POST['email'];

	if(isset($_SESSION['user']))
	{
		echo "<script>location.href = '../'</script>";
	}
	if($_POST['submit_close'])
	{
		unset($_SESSION['user']);
	}
		if (mysqli_connect_errno())
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	
	if(isset($_POST['forgot']))
	{
	if($_POST['forgot'])
	{
		if(!$_POST['email'] == "") 
		{
			$email = $_POST['email'];
			if ($result = mysqli_query($link, "SELECT id FROM users WHERE email='$email'"))
			{
				$row_cnt = $result->num_rows;
				if($row_cnt > 0)
				{
					$result = mysqli_query($link, "SELECT * FROM users WHERE email='$email'");
					while ($row = mysqli_fetch_row($result))
					{
						$login = "{$row[1]}";
						$pass = "{$row[3]}";
						include "mail/mail_forgot.php";
					}
					echo "<script>alert('Проверьте почту!')</script>";
					echo "<script>location.href = '../'</script>";
				}
				else
				{
					echo "<script>alert('Email not found')</script>"; 
				}
			}
		}
		else 
		{       
			echo "<script>alert('Email no input')</script>"; 
		}
	}
	}
	
	
	if(isset($_POST['reg']))
	{
	if($_POST['reg'])
	{
		if(!$_POST['login'] == "" && !$_POST['email'] == "" && !$_POST['pass'] == "") 
		{
			$login = $_POST['login'];
			$email = $_POST['email'];
			$pass = $_POST['pass'];
			if ($id = mysqli_query($link, "SELECT id FROM users WHERE login='$login'")) 
			{
				$id1 = mysqli_num_rows($id);
				if ($id1 > 0) 
				{
					echo "<script>alert('Пользователь с таким логином уже зарегистрирован!')</script>";
				}
				else
				{
					if ($id = mysqli_query($link, "SELECT `id` FROM `users` WHERE email = '$email'")) 
					{
						$id2 = mysqli_num_rows($id);
						if ($id2 > 0) 
						{
							echo "<script>alert('Пользователь с такой почтой уже зарегистрирован!')</script>";
						}
						else
						{
							$query2 = mysqli_query($link, "INSERT INTO `users`(`login`, `email`, `pass`) VALUES ('$login','$email','$pass')");
							if ($query2)
							{
								include "mail/mail_reg.php";
								$_SESSION['user'] = $login;
								echo "<script>location.href = '../'</script>";
							}
							else
							{
								echo "<script>alert('Не вносит в базу!')</script>";
							}
						}
					}
				}
			}
		}
		else
		{
			echo "<script>alert('Ничего не введено!')</script>";
		}
	}
	}
	
	
	
	mysqli_close($link);
?> 
<!DOCTYPE>
<html>
<head> 
<link rel="shortcut icon" href="icon.png">
<title>Cash&Мир</title>
<LINK rel="icon" href="https://mospolytech.ru/favicon.ico" type="image/x-icon" />
<LINK rel="shortcut icon" href="https://mospolytech.ru/favicon.ico" type="image/x-icon" />
<script src="https://code.jquery.com/jquery.js"></script>
<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js\"></script>
<script src=\"https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js\"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="css/tabs.css" rel="stylesheet">
<link href="css/gs.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">


	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
</head>

<body>
<div class="tabs">
    <input id="tab1" type="radio" name="tabs" checked="">
    <label for="tab1" title="Вход">Вход</label>
 
    <input id="tab2" type="radio" name="tabs">
    <label for="tab2" title="Восстановить пароль">Восстановить пароль</label>
	
	<input id="tab3" type="radio" name="tabs">
    <label for="tab3" title="Регистрация">Регистрация</label>
 
    <section id="content-tab1">
        <p>
	 </p><left> 
	<? 
	 
	if(isset($_POST['submit']))
	{
    if($_POST['submit'])
	{
		if(!$_POST['login'] == "" && !$_POST['pass'] == "") 
		{
			$login = $_POST['login'];
			$pass = $_POST['pass'];
			if ($result = mysqli_query($link, "SELECT id FROM users WHERE BINARY login='$login' AND BINARY pass='$pass'"))
			{
				$row_cnt = $result->num_rows;
				if($row_cnt > 0)
				{
					include "mail/mail_auth.php";
					$_SESSION['user'] = $login;
					echo "<script>location.href = '../'</script>";
				}
				else
				{
					echo "<script>alert('Login/Passwor not found')</script>"; 
				}
			}
			else
			{
				echo "<script>alert('Хуйня какая-то!')</script>"; 
			}
			
		}
		else 
		{       
			echo "<script>alert('Login/Password no input')</script>"; 
		}
	}
	}
	
	 
 ?>
 
 
	 <form method="post" action="" style=" margin-left: 30; margin-top: 20px;">
  <table cellpadding="5">
   <tbody><tr>
     <td colspan="2">Вход:</td></tr>
   <tr>
     <td>Логин:</td>
     <td><input type="text" name="login"></td></tr>
   <tr>
     <td>Пароль:</td>
     <td><input type="password" name="pass"></td></tr>
   <tr>
     <td colspan="2" align="left">
     <input type="submit" name="submit" value="Вход"></td></tr>
 </tbody></table></form> 
 </left>
        
    </section>  
	
	    <section id="content-tab2">
        <p>
	 </p><left> <form method="post" action="" style=" margin-left: 30; margin-top: 20px;">
  <table cellpadding="5">
   <tbody><tr>
     <td colspan="2">Восстановить пароль</td></tr>
   <tr>
     <td>Email:</td>
     <td><input type="email" name="email"></td></tr>
   <tr>
     <td colspan="2" align="left">
     <input type="submit" name="forgot" value="Восстановить"></td></tr>
 </tbody></table></form> </left>
        
    </section> 
	
    <section id="content-tab3">
        <p>
          </p><left><form method="post" action="" style=" margin-left: 30; margin-top: 20px;">
  <table cellpadding="5">
  <tbody><tr><td colspan="2">Регистрация:</td></tr>
     <tr><td>Логин:</td>
     <td><input type="text" name="login" pattern ="[A-Za-z0-9]{1,}" id="login"></td></tr>
   <tr>
     <td>Email:</td>
     <td><input type="email" name="email" id="email"></td></tr>
   <tr>
   <tr>
     <td>Пароль:</td>
     <td><input type="password" name="pass" id="pass"></td></tr>
   <tr>
     <td colspan="2" align="left">
     <input type="submit" name="reg" id="reg" value="Зарегистрироваться"></td></tr>
 </tbody></table></form></left>
    </section> 
</div>
<div id="footer">
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
</body>
</html>