<?php include 'includes/top.php'; 

	$sql = $db->query("SELECT * FROM lw_ecard WHERE md5(id) = '".$db->real_escape_string($_GET['send'])."' LIMIT 1") or die(mysql_error());
	$row = $sql->fetch_assoc();


	// SEND THE ECARD
	include_once 'scripts/phpmailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Debugoutput = 'html';
	$mail->Host = "smtp.mandrillapp.com";
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->Username = "jon@aristoworks.com";
	$mail->Password = "FNXVq2DQpNgY4_JNAIKPkw";
	$mail->setFrom('server@livingwatersfortheworld.org', 'Living Waters');
	$mail->addReplyTo('server@livingwatersfortheworld.org', 'Living Waters');
	
	$mail->Subject = 'Living Waters For The World Donation E-Card';
	$body = "<img src='http://livingwatersfortheworld.org/ecard_new/ecards/".md5($row['id']).".jpg' alt='Missing E-card' /><p>".$row['special_message']."</p>";
	$mail->msgHTML($body);
	//Replace the plain text body with one created manually
	$mail->AltBody = 'A contribution to Living Waters to the world has been made on your behalf. To receive and read your e-card, please use an html capable email client to view this message. ';
	
	$emails = explode(",", $row['recipient_email']);
	foreach($emails as $email) {
		$mail->addAddress($email);
		if (!$mail->send()) {
		    echo "Mailer Error: " . $mail->ErrorInfo;
		} 
		$mail->ClearAddresses();

	}

	//send the message, check for errors
	


?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Your e-Card has been sent</title>

		<!-- Bootstrap CSS -->
		<link href="css/theme.css" rel="stylesheet">
		<link rel="stylesheet" href="css/custom.css" type="text/css">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.3.2/respond.min.js"></script>
		<![endif]-->

	</head>
	<body>
		<div class="container" id="mainContain">
			<header>
				<img src='images/logo.png' height='100px' alt='Living Waters for the World' class="float-left" />
				<h1>Your E-card Has Been Sent</h1>
				<div class="clearfix" />
			</header>	
			<p class="lead">The E-card that you designed has been delivered.  
			The recipient will receive the email shortly.  
			If you determine that you are experiencing delivery problems please contact us at <a href='mailto:support@livingwatersfortheworld.org'>support@livingwatersfortheworld.org</a> and we will provide assistance.</p>

			<center>
				<a class='btn btn-info' href="donate.php">Create Another E-card</a>
				<a class='btn btn-info' href="https://www.facebook.com/LWWmission">Connect with Living Waters for the World</a>
			</center>
			
		</div>


		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


	</body>
</html>
<?php
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);
?>