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
	$mail->setFrom("{$myemail}", "{$myname}");        
	
	// Кому
	$mail->addAddress("{$email}", '');
	
	// Тема письма
	$subject = "Поздравляем с регистрацией!";
	$mail->Subject = $subject;
	
	// Тело письма
	$body = "Поздравляем Вас с регистрацией!<br /><br />
			Здравствуйте, {$login}.<br /><br />
			Ваш пароль:<br />
			{$pass}.<br /><br />";
	$mail->msgHTML($body);

	// Приложение
	//$mail->addAttachment (__DIR__ . '/image.jpg');

	$mail->send();


?>