<?php 
	session_start();
	require_once "session.php"; 
	require_once "bd.php"; 
	$login = $_SESSION['user'];	
	
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Социальная сеть ♥</title>
<link rel="shortcut icon" href="icon.png">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="shortcut icon" href="icon1.png">
<LINK rel="icon" href="https://mospolytech.ru/favicon.ico" type="image/x-icon" />
<LINK rel="shortcut icon" href="https://mospolytech.ru/favicon.ico" type="image/x-icon" />
<script src="https://code.jquery.com/jquery.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<link href="css/tabs.css" rel="stylesheet">
<link href="css/gs.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<script type='text/javascript'> 
    $(document).ready(function() { 
      $("input#trigger1").toggle(function() { 
        $("DIV#box1").fadeIn(); 
        return false; 
      },  
      function() { 
        $("DIV#box1").fadeOut(); 
        return false; 
      }); 
    }); 
    
    $(document).ready(function() { 
      $("input#trigger3").toggle(function() { 
        $("DIV#box3").fadeIn(); 
        return false; 
      },  
      function() { 
        $("DIV#box3").fadeOut(); 
        return false; 
      }); 
    }); 
  </script>  
  	<script>
			navigator.geolocation.getCurrentPosition(		//вызываем функцию получения координат
				function(position)							// выполняем в случае успеха получения координат ↓
				{
					var lat = position.coords.latitude;		// присваиваем lat и lon ширину и высоту
					var lon = position.coords.longitude;	// и отправляем по POST запросу ↓
					$.ajax({								// вызываем AJAX (скрытая отправка запросов) для первого захода, чтобы он записал координаты сразу же
						url: "geo.php",						// файл обработчик, где прописано чтобы он записал координаты в бд по именем пользователя
						type: "POST",						//
						data: {lat:lat, lon:lon},			//
						success: function(response) {}		//выполняем в случае успеха
					});										
					setInterval(function(){					//цикл записи коорд. в БД через каждую минуту
						$.ajax({
							url: "geo.php",  //
							type: "POST",
							data: {lat:lat, lon:lon},
							success: function(response) {}
						});
					}, 60000)					
				}
			);
	</script>

</head>
<body>
								
		 
		 
<div class="tabs">
    <input id="tab1" type="radio" name="tabs" checked="">
    <label for="tab1" title="Профиль"><? echo $login ?></label>
    <input id="tab2" type="radio" name="tabs">
    <label for="tab2" title="Пользователи">Пользователи</label>
	<input id="tab3" type="radio" name="tabs">
    <label for="tab3" title="Диалоги">Диалоги</label>

	
	
	
    <section id="content-tab1" name="profile">
	<a name="profile"></a>
		<form method="post" style=" margin-left: 30; margin-top: 20px;">
		<table>	
		<tbody>
    <tr>
    <td><p>Привет, <? echo $login; ?></p>
    
    </td>
</tr>
        <tr>
    <td>
<br><input type="submit" name="submit_close" value="Выход">
        </td>
</tr>


			<tr>
<td><br><input type="button" id="trigger3" value="Изменить пароль"></td>
</tr>
	<tr>
	<td>
	<div id="box3" style="display: none">
		
		<br><input type="password" name="newpass" id="newpass" value=""> 
		<br>
		<input type="submit" name="editpass" value="Изменить">
		
	</div> 
	</td>
	</tr>
			
		<tr>
		<form action="" method="post"></form>
		<td><br><input type="submit" name="delete_user" value="Удалить аккаунт" onclick="return confirm('Вы точно хотите удалить аккаунт?');"></td>
		
		</tr>
		</tbody>
		</table>
		</form> 
		
		
		

    <?
	if(isset($_POST['delete_user']))
	{
	if($_POST['delete_user'])
	{
		$result = mysqli_query($link, "DELETE FROM users WHERE login='$login'" );
		unset($_SESSION['user']);
		echo "<script>location.href = '../'</script>";
	}
	}
	

		
		
if(isset($_POST['editpass']))
{
	if($_POST['editpass'])
	{
		if (!$_POST['newpass'] == "")
		{
			$login = $_SESSION['user'];
			$newpass = $_POST['newpass'];
			$result = mysqli_query($link, "UPDATE users SET pass='$newpass'  WHERE login='$login'" );
			echo "<script>alert('Пароль изменён!')</script>";
		}
		else
		{
			echo "<script>alert('Новый пароль не введен!')</script>";
		}
	}	
}
	
		
		
	?>
	
	
    </section>  
	
		<section id="content-tab2" name="users">
		<a name="users"></a>
        <p>
          </p><form method="post"  style=" margin-left: 30; margin-top: 20px;">
		  		<table border="1" cellpadding="4" cellspacing="0" style="width: 100%">
		<tbody>
		<tr>
		<td>
			<table style="width: 100%">
			<tbody>
			<tr>
			<form method="" name="searchForm" action="" id="searchForm">
			<td style="width: 50%"><input type="text" id="searchuser" name="searchuser" value="" ></td>
			<td style="width: 50%"><input type="button" id="search" name="search" align="right" onClick="getdetails2()" value="НАЙТИ" required></td>
			</form>	
			</tr>
			</tbody>
			</table>
		</td>
		</tr>
		<tr>
		<td> <div id="msg2"></div> </td>
		</tr>
		<tr>
		<td><div id="msg1"></div></td>
		</tr>
		</tbody>
		</table>
		
	

		 
		</form>
        <p></p>
    </section> 
	
	    <section id="content-tab3" name="message">
		<a name="message"></a>
 <div name="message">
	 
	<h1>Диалоги</h1>	
	<div id="msg3"></div>
	
        </div>
    </section> 
	
   

	
	

</div>
<script>
		
		
	setInterval(function(){
	$.ajax({
        type: "POST",
        url: "allusers.php"
    }).done(function( result )
        {
            $("#msg1").html( ""+result );
        });
	}, 1000)
		
		
function getdetails2(){
    var searchuser = $('#searchuser').val();
    $.ajax({
        type: "POST",
        url: "search.php",
        data: {searchuser:searchuser}
    }).done(function( result )
        {
            $("#msg2").html( ""+result );
        });
}


setInterval(function(){
    $.ajax({
        type: "POST",
        url:"chats.php"
    }).done(function( result )
        {
            $("#msg3").html( ""+result );
			
        })}
, 1000)

</script>
</body>
</html>