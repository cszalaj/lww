<?php

	include 'includes/top.php';

	$donation_id = $_SESSION['donationID'];
	$honor_id = $_SESSION['honorID'];
	$background = $_SESSION['background'];

	error_reporting(E_ALL);

	function wrap($fontSize, $angle, $fontFace, $string, $width){
	    $ret = "";
	    $arr = explode(' ', $string);
	    foreach ( $arr as $word ){
	        $teststring = $ret.' '.$word;
	        $testbox = imagettfbbox($fontSize, $angle, $fontFace, $teststring);
	        if ( $testbox[2] > $width ){
	            $ret.=($ret==""?"":"\n").$word;
	        } else {
	            $ret.=($ret==""?"":' ').$word;
	        }
	    }
	    return $ret;
	}

	$d_sql = $db->query("SELECT * FROM `lw_donation` WHERE `id` = $donation_id LIMIT 1") or die(mysql_error());
	$d_info = $d_sql->fetch_assoc();

	$h_sql = $db->query("SELECT * FROM `lw_ecard` WHERE `id` = $honor_id LIMIT 1") or die(mysql_error());
	$h_info = $h_sql->fetch_assoc();

	$imgPath = "./images/ecards/".$background."_thumb.jpg";
	//$imgPath = "./images/ecards/2_thumb.jpg";

	$font = 'fonts/mesmerize.ttf';

	$img = imagecreatefromjpeg($imgPath);

	$black = imagecolorallocate($img, 255, 255, 255);
	$white = imagecolorallocatealpha($img, 60, 108, 240, 50);
	
	$from_name_first = $d_info['first_name'];
	$from_name_last  = $d_info['last_name'];
	$honor_name 	 = $h_info['honor_name'];

	$donor_name = "$from_name_first $from_name_last";

	$honor_message = "In the memory of $honor_name";

	if($h_info['honor'] == 'In Honor Of') {
		$honor_message = "In your honor";
	}

	$messages = array();

	$messages[0] = "";

	$messages[1] = "$honor_message, $donor_name made a gift to Living Waters for the World because every child of God deserves clean water";

	$messages[2] = "$honor_message, $donor_name made a gift to Living Waters for the World because empowering communities leads to sustainable clean water.";

	$messages[3] = "$honor_message, $donor_name made a gift to Living Waters for the World to help provide clean water for all God's children throughout their developmental years.";

	$messages[4] = "$honor_message, $donor_name made a gift to Living Waters for the World because people of faith have the power to create change.";

	$messages[5] = "$honor_message, $donor_name made a gift to Living Waters for the World because mission that transforms all begins in relationship.";

	$messages[6] = '';

	imagefilledrectangle($img, 0, 340, 800, 500, $white);
	$text = wrap('20', '0', $font, stripslashes($messages[$background]), '700');
	imagettftext($img, 20, 0, 60, 380, $black, $font, $text);

	$chars = strlen("This message is sent to you by ".$from_name_first." ".$from_name_last);
	$mid = ceil(($chars * 4)/2);
	$x_ax = ceil(350-$mid);

	$text = wrap('11', '0', $font, stripslashes("This message is sent to you by ".$from_name_first." ".$from_name_last), '700');
	imagettftext($img, 11, 0, $x_ax, 490, $black, $font, $text);



	imagejpeg($img, "ecards/".md5($h_info['id']).".jpg");
	
	header("Content-type: image/jpeg");
	imagejpeg($img);

	imagedestroy($img);

	?>