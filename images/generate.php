<?php

	include '../includes/top.php';

	header("Content-type: images/jpeg");

	$sql = mysql_query("SELECT * FROM ecard WHERE id = '".mysql_real_escape_string($_GET['id'])."' LIMIT 1") or die(mysql_error());
	$row = mysql_fetch_assoc($sql);

	$imgPath = "images/".$row['background']."_bg.jpg";

	$img = imagecreatefromjpeg($imgPath);

	$black = imagecolorallocate($img, 0, 0, 0);
	$text = stripslashes($row['message']);
	imagettftext($img, 25, 0, 75, 300, $black, '', $text);
	imagejpeg($img);
	imagedestroy($img);