<?php
	include 'includes/top.php';

	$donation_id = $_SESSION['donationID'];
	$honor_id = $_SESSION['honorID'];

	$d_sql = $db->query("SELECT * FROM `lw_donation` WHERE `id` = $donation_id LIMIT 1") or die(mysql_error());
	$d_info = $d_sql->fetch_assoc();

	$h_sql = $db->query("SELECT * FROM `lw_ecard` WHERE `id` = $honor_id LIMIT 1") or die(mysql_error());
	$h_info = $h_sql->fetch_assoc();

	$d_first_name 	= $d_info['first_name'];
	$d_last_name	= $d_info['last_name'];
	$d_email		= $d_info['email'];
	$h_first_name 	= $h_info['recipient_first'];
	$h_last_name	= $h_info['recipient_last'];
	$h_email		= $h_info['recipient_email'];

	$message = $h_info['special_message'];

	if($message == '') {
		$message = 'Every gift empowers volunteers and communities to put their faith into action.  To save lives by providing sustainable, clean water around the world.';
	} 
?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Build your ecard</title>

		<!-- Bootstrap CSS -->
		<link href="css/theme.css" rel="stylesheet">
		<link rel="stylesheet" href="css/custom.css" type="text/css">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>
	<body>

		<div class="container" id='mainContain'>
			<header>
				<img src='images/logo.png' height='100px' alt='Living Waters for the World' class="float-left" />
				<h1>Build Your E-card</h1>
				<div class="clearfix" />
			</header>	
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<p>Thank you for your donation, it has been processed. Please select your ecard image and message below.</p>
					<p>Questions/Comments?  Contact us: <a href='mailto:infolww@livingwatersfortheworld.org'>infolww@livingwatersfortheworld.org</a>.</p>
				</div>
			</div>
			<form name='ecard' method='post' action='preview_ecard.php' id='ecardForm'>
			<div class="panel panel-default">
				<div class="panel-heading">
					Choose the e-card image
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<div class="form-group">
								<img src="images/ecards/1_thumb.jpg" class='img-responsive'>
								<input required type='radio' name='img' value='1' /> Protecting the Vulnerable
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<div class="form-group">
								<img src="images/ecards/2_thumb.jpg" class='img-responsive'>
								<input required type='radio' name='img' value='2' /> Helping Communities
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<div class="form-group">
								<img src="images/ecards/5_thumb.jpg" class='img-responsive'>
								<input required type='radio' name='img' value='5' /> Sharing Living Water
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<div class="form-group">
								<img src="images/ecards/4_thumb.jpg" class='img-responsive'>
								<input required type='radio' name='img' value='4' /> Training Volunteers
							</div>
						</div>
<!-- 						
						
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<div class="form-group">
								<img src="images/ecards/3_thumb.jpg" class='img-responsive'>
								<input required type='radio' name='img' value='3' /> Sustaining a Generation
							</div>
						</div>

						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<img src="images/ecards/7_thumb.jpg" class='img-responsive'>
							<input type='radio' name='img' value='7' /> Option 6
						</div> -->
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					Delivery Information
				</div>
				<div class="panel-body">
					<div class="formgroup">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="row">
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
										<div class="form-group">
										<label>Your First Name</label>
										<input required type='text' name='from_first_name' id='from_first_name' class='form-control' value="<?php echo($d_first_name); ?>"/>
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
										<div class="form-group">
										<label>Your Last Name</label>
										<input required type='text' name='from_last_name' id='from_last_name' class='form-control' value="<?php echo($d_last_name); ?>"/>
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
										<div class="form-group">
										<label>Your Email</label>
										<input required type='email' name='from_email' id='from_email' class='form-control' value="<?php echo($d_email); ?>" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<hr />
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<div class="form-group">
									<label>Recipient First Name</label>
									<input required type='text' name='to_first_name' id='to_first_name' class='form-control' value="<?php echo($h_first_name); ?>"/>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<div class="form-group">
									<label>Recipient Last Name</label>
									<input required type='text' name='to_last_name' id='to_last_name' class='form-control' value="<?php echo($h_last_name); ?>"/>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<div class="form-group">
									<label>Recipient Email</label>
									<input required type='email' name='to_email' id='to_email' class='form-control' value="<?php echo($h_email); ?>" />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					Personalize Your Message
				</div>
				<div class="panel-body">
					<p>We have provided a suggested message for you.  Feel free to use all or none of this message for your e-card.</p>
					<textarea class='form-control' name='message' id='message'><?php echo $message ?></textarea>
				</div>
			</div>

			<button class='btn btn-success'>Preview Your E-Card</button>
			</form>
			<br>
			<br>
			<br>
			</div>
			
		</div>

		<!-- jQuery -->
		<script src="js/jquery.js"></script>
		<script src="js/parsley.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/site.js"></script>

	</body>
</html>