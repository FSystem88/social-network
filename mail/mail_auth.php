<?php
require_once 'PHPMailer/PHPMailerAutoload.php';
require_once 'email.php';

	$mail = new PHPMailer;
	$mail->CharSet = 'UTF-8';

	// Настройки SMTP
	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPDebug = 0;
	
	$mail->Host = "ssl://smtp.mail.ru";
	$mail->Port = 465;
	$mail->Username = "{$myemail}";
	$mail->Password = "{$mypassword}";
	
	// От кого
	$mail->setFrom('$myemail', '$myname');        
	
	// Кому
	$mail->addAddress("{$email}", '');
	
	// Тема письма
	$subject = "ВЫПОЛНЕН ВХОД";
	$mail->Subject = $subject;
	
	// Тело письма
	$body = "Выполнен вход в систему:
	<br /> </br>IP адрес: {$ip}<br/></br>Устройство: {$comp}";
	$mail->msgHTML($body);

	// Приложение
	//$mail->addAttachment (__DIR__ . '/image.jpg');

	$mail->send();


?>