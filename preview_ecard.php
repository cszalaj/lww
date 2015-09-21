<?php 

	include 'includes/top.php';
	$donation_id = $_SESSION['donationID'];
	$honor_id = $_SESSION['honorID'];

	$img 		= $db->real_escape_string($_POST['img']);
	$message 	= $db->real_escape_string($_POST['message']);
	$d_first	= $db->real_escape_string($_POST['from_first_name']);
	$d_last		= $db->real_escape_string($_POST['from_last_name']);
	$d_email	= $db->real_escape_string($_POST['from_email']);
	$h_first	= $db->real_escape_string($_POST['to_first_name']);
	$h_last		= $db->real_escape_string($_POST['to_last_name']);
	$h_email	= $db->real_escape_string($_POST['to_email']);
	$image_path	= "ecards/" . md5($_SESSION['honorID']) . ".jpg";

	$db->query("UPDATE lw_ecard 
		SET recipient_first = '$h_first',
		recipient_last = '$h_last',
		recipient_email = '$h_email',
		image_id = $img,
		image_path = '$image_path',
		special_message = '$message'
		WHERE id = $honor_id") or die(mysql_error());

	$db->query("UPDATE lw_donation
		SET first_name = '$d_first',
		last_name = '$d_last',
		email = '$d_email'
		WHERE id = $donation_id") or die(mysql_error());

	$d_sql = $db->query("SELECT * FROM `lw_donation` WHERE `id` = $donation_id LIMIT 1") or die(mysql_error());
	$d_info = $d_sql->fetch_assoc();

	$h_sql = $db->query("SELECT * FROM `lw_ecard` WHERE `id` = $honor_id LIMIT 1") or die(mysql_error());
	$h_info = $h_sql->fetch_assoc();

	$_SESSION['background'] = $img;
	$_SESSION['from_first_name'] = $d_first;
	$_SESSION['from_last_name'] = $d_last;
	$_SESSION['from_email'] = $d_email;
	$_SESSION['to_first_name'] = $h_first;
	$_SESSION['to_last_name'] = $h_last;
	$_SESSION['to_email'] = $h_email;

?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Preview Your E-card</title>

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
		

		<div class="container" id='mainContain'>

			<header>
				<img src='images/logo.png' height='100px' alt='Living Waters for the World' class="float-left" />
				<h1>Preview Your Image</h1>
				<div class="clearfix" />
			</header>	

			<div class="panel panel-default">
				<div class="panel-heading">
					Delivery Information
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							From: <?php echo $_POST['from_first_name']." (".$_POST['from_email'].") "; ?>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							To: <?php echo $_POST['to_first_name']." (".$_POST['to_email'].") "; ?>
						</div>
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					Your E-card
				</div>
				<div class="panel-body" id='ecard_panel'>
					<img src='generate.php' class="img-responsive"/>
					<hr />
					<p><?php echo $h_info['special_message']; ?></p>
				</div>
			</div>
				<form name='handle' method='post' action='handle_donate.php'>
				<input type='hidden' name='ecard' value='1' />
				<center><a class='btn btn-success' href='confirm_send.php?send=<?php echo md5($honor_id); ?>'>Send E-Card</a>
				
				<a class='btn btn-warning' href="ecard.php">Change E-Card</a></center>
				</form>
<br>
<br>
<br>
		</div>


		<!-- jQuery -->
		<script src="js/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="js/bootstrap.min.js"></script>


	</body>
</html>