<?php include 'includes/top.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title></title>
 
<link rel="stylesheet" type="text/css" href="//style/style.css" />

</head>

<body id="index" class="home">
	<div id="wrap">
		
		<div id="header">
			<div id="headerL">
				<h1 class="museo">We're Sorry</h1>
			</div>
			<div id="headerR">
				<img src="images/logo.png" alt="Living Waters" />
			</div>
		</div>
		<div class="clear">&nbsp;</div>
		<div id="pageContent">
			<?php include('includes/breadcrumb.php'); ?>
            <?php
                $try_again_link = (isset($_SESSION))
            ?>
			<p>There was a problem with your donation.  We are sorry for any inconvenience.  Please try your donation <a href="<?php echo $baseurl; ?>donate.php">again</a>.</p>
			<h3 class="museo">Gateway Error</h3>
			<p><?php echo urldecode($_GET['gateway_error']); ?></p>
			<br /><br /><br />
		</div>
	</div>
</body>
</html>