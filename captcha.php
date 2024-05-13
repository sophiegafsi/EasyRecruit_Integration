<?php
	session_start();

	// Generate a random string and store it in the session
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
	$_SESSION['captcha'] = $randomString;
	
	// Create a CAPTCHA image
	header('Content-type: image/png');
	$image = imagecreatetruecolor(100, 30);
	$background_color = imagecolorallocate($image, 255, 255, 255);
	$text_color = imagecolorallocate($image, 0, 0, 0);
	imagefilledrectangle($image, 0, 0, 200, 50, $background_color);
	imagettftext($image, 14, 0, 5, 20, $text_color, 'assets/ARIAL.ttf', $randomString);
	imagepng($image);
	imagedestroy($image);
	
?>