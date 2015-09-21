<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Donate To Living Waters for the World</title>

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
				<h1>Ways to give</h1>
				<div class="clearfix" />
			</header>				
			<div class="row">	
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="well column">
						<div class="row">
							<div class="hidden-xs col-sm-2 col-md-2 col-lg-2">
								<img src='images/square_two.jpg' class='img-circle' width="100%" />
							</div>
							<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
								<h2>Donate Online Now</h2>
								<p>Help change a life forever! Your tax-deductible donation to Living Waters for the World keeps clean water flowing and brings health, hope and transformation to all involved.</p>
								<p>You'll have the option to send a Personalized e-card to honor friends and loved ones with your donation of $25 or more.</p>
								<div class="index-donate">
									<form name='next' id='next' method='post' action='donate.php'>
											<input type='hidden' name='ecard' id='ecard' value='0' />
											<label><input type="radio" name="amount" id="amount" value='25'> $25</label>
											<label><input type="radio" name="amount" id="amount" value='50'> $50</label>
											<label><input type="radio" name="amount" id="amount" checked="true" value='100'> $100</label>
											<label><input type="radio" name="amount" id="amount" value='200'> $200</label>
											<label><input type="radio" name="amount" id="amount" value='other'> Other</label>
											<button class='btn btn-primary' id='ecardNext' href='#'>Donate Now</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
					<div class="well">
						<h2>Check</h2>
						<p>Mail a check made payable to Living Waters for the World to:<br />
							5016 Spedale Ct. #399<br />
							Spring Hill, TN 37174</p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
					<div class="well">
						<h2>Amazon.com</h2>
						<p>Support LWW while you shop! Save and use <a href="http://www.amazon.com/gp/redirect.html?ie=UTF8&location=http://www.amazon.com/&tag=lwwbookstore-20&linkCode=ur2&camp=1789&creative=9325/" target="_blank">this link to amazon.com</a> which donates to us a portion of every sale.</p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
					<div class="well">
						<h2>Stock</h2>
						<p><a href="mailto:carie@livingwatersfortheworld.org?Subject=Stock%20Gift%20Inquiry">Email Carie Turner</a> to make a gift of appreciated stock or securities.<br /><br /><br /></p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
					<div class="well">
						<h2>Planned Gift</h2>
						<p>Support LWW through your estate, annuity or trust.  <a href="mailto:jennifer@livingwatersfortheworld.org?Subject=Planned%20Gift%20Inquiry">Email Jennifer Zehnder</a> to inquire.<br/><br /></p>
					</div>
				</div>
			</div>
		</div>

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

		<script type='text/javascript'>
		$(document).ready(function() {

			$('ecardNext').click(function(e) {
        		$("next").submit();
    		});

		});
		</script>
	</body>
</html>