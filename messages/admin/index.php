<?php
	session_start();
	require_once "session.php"; 
	require_once "bd.php"; 
	$login = $_SESSION['user'];
	$urldir = $_SERVER['REQUEST_URI']; 
	$urldir = substr($urldir,10);
	$blablabla1 = array("getgeo.php", "/");
	$namechat = str_replace($blablabla1, "", "{$urldir}");
	$blablabla2 = array("_", "{$login}");
	$username = str_replace($blablabla2, "", "{$namechat}");

?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $namechat; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<script src="https://code.jquery.com/jquery.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<script>
function on_off(elem) {
 
    if (elem.id == "On") {
        elem.id = "Off";
        elem.style = "background: red";
        elem.value = "Off";
		var editgeo = "off";
        $.ajax({
            type: "POST",
            url: "editgeo.php",
            data: {editgeo:editgeo},
            success: function () {
            }
        });
 
    } else {
        elem.id = "On";
        elem.style = "background: lawngreen";
        elem.value = "On";
		var editgeo = "on";
        $.ajax({
            type: "POST",
            url: "editgeo.php",
            data: {editgeo:editgeo},
            success: function () {
            }
        });

    }
 
}
</script>
</head>
<body>
<a name="message"></a>
<div name="message">
	<button><b><a href="/">Назад</a></b></button><br>
	<div class="geoloc">
		<table>
			<tbody>
				<tr>
					<td>
						<h3>Геолокация для этого чата:</a>
					</td>
					<td>
						<?
						$result = mysqli_query($link, "SELECT * FROM `geo_$namechat` WHERE name='$login'");
						while ( $row = mysqli_fetch_array($result) )
						{
							if ($row[2] == "off")
							{
								echo "<input type=\"button\" id=\"Off\" style=\"background: red;\" value=\"Off\" onClick=\"on_off(this)\">";
							}
							else
							{
								echo "<input type=\"button\" id=\"On\" style=\"background: lawngreen;\" value=\"ON\" onClick=\"on_off(this)\">";
							}
						}
						?>
					<td>
				</tr>
			</tbody>
		</table>
	</div>
	<h1>Chat "<?php echo $namechat; ?>"</h1>	
	<div class="chatm" id="msg4" style="margin-bottom: 75px;"></div>
	<div id="bottom"></div>
	<form method="" name="form" action="" id="form">
	<table style="width: 100%;left: 0;bottom: 0;position: fixed;background: #3f51b5;">
	<tr>
		<td>Сообщение:</td>
	</tr>
	<tr>
		<td colspan="2"><input type="text" id="text" name="text"  style="width: 100%"value=""></td>
	</tr>
	<tr>
		<td><center><input type="submit" id="submit" name="submit" value="Отправить"></center></td>
		<td><center><button><a onclick="fff()">Показать геолокацию собеседника</a></button></center></td>
	</tr>
	</table>
	</form><br><br>

    </div>
	
	<div id="bottom"></div>
	<script>
		navigator.geolocation.getCurrentPosition(
				function(position)
				{
					var lat = position.coords.latitude;
					var lon = position.coords.longitude;
					$.ajax({
						url: "geo.php",
						type: "POST",
						data: {lat:lat, lon:lon},
						success: function(response) {}
					});
					setInterval(function(){
						$.ajax({
							url: "geo.php",
							type: "POST",
							data: {lat:lat, lon:lon},
							success: function(response) {
							}
						});
					}, 60000)					
				},
				function(error)
				{
				}
			);

		location.href = '#bottom';

	</script>
	<script>
	
	$('#form').submit(function(e){
		e.preventDefault();
		$.ajax({
		  url: "ajax.php",
		  type: "POST",
		  data: $('#form').serialize(),
		  success: function(response) {
			form.reset();
			location.href = '#bottom';
		  },
		  error: function(response) {
		 }
		});
	});
		

	</script>
	<script>
	

setInterval(function(){
    $.ajax({
        type: "POST",
        url:"message.php"
    }).done(function( result )
        {
            $("#msg4").html( ""+result );
			
        })}
, 1000);
	</script>
	<script>

function fff(){
    $.ajax({
        type: "POST",
        url:"getgeo.php"
    }).done(function( result )
        {
            $("qwerty").html( ""+result );
        })};
</script>
<script>
	setInterval(function(){
		$.ajax({
			type: "POST",
			url:"read.php"
		}).done(function( result )
			{
			}
		)}
	, 1000);
		</script>
<qwerty></qwerty>
</body>
</html>