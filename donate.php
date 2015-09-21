<?php
	
	include 'includes/states.php';
    function user($str){
        return (isset($_SESSION['user'][$str]) ? $_SESSION['user'][$str] : '');
    }

?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Donate</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/theme.css" type="text/css">
		<link rel="stylesheet" href="css/parsley.css" type="text/css">
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
				<h1>Donate</h1>
				<div class="clearfix" />
			</header>	
		<div class="panel panel-default">
			<div class="panel-heading">Thank you for your support!</div>
				<div class="panel-body">
					<div id="form-warning" class="panel panel-warning" style="display:none;">
						<div class="panel-heading">
							<h3 class="panel-title">Whoops! You missed something</h3>
						</div>
						<div class="panel-body">
							<div id="amountWarning" style="display:none;">Please enter an amount for your donation</div>
						</div>
					</div>
					<form role="form" name="donateForm" id="donateForm" method='post' action="submitpayment.php?test=true" data-parsley-validate>
					<div class="form-group">
						<label for="">Donation Amount</label>
						<div class="left-inner-addon">
						 	<span>$</span>
						 	<?php if(isset($_POST['amount'])) { 

						 		if($_POST['amount'] == 'other') {
						 			$placeholder = "Please enter a dollar amount.";
						 			$amount = '';
						 		} else {
						 			$amount = $_POST['amount'];

						 		}

						 		} else {
						 			$amount = '';
						 			} ?>
							<input required type='text' class='form-control' id="amount" name='amount' value='<?php echo $amount; ?>' placeholder='Please enter a dollar amount.' data-parsley-type="number" />
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-21">
							<div class="form-group">
							    <input type="checkbox" value="yes" name="anonymous" id="anonymous" /><label for="anonymous">&nbsp;I would like this gift to be anonymous.</label>
							</div>
							<div class="form-group">
							    <input type="checkbox" value="yes" name="matching" id="matching" /><label for="matching">&nbsp;My company will match this donation.</label>
							</div>
							<div id="matching_name" style="display:none;">
							   	<div class="form-group">
									<input type='text' class='form-control' id="company_name" data-parsley-validate-if-empty data-parsley-conditionalrequired='["[name=\"matching\"]:checked", "yes"]' data-parsley-conditionalrequired-message="Please provide your company name so that we may facilitate the matching process." name='company_name' value='' placeholder="Please enter your company's name" /><br>
									Living Waters for the World Tax ID #: ####-#####
								</div>
							</div>
							<div class="form-group">
								<label for="recurring">Would you like to setup recurring donation?</label><br>
								<input type='radio' name='recurring' value='No' checked='true' /> No – This is a one-time donation 
								<br>
								<input type='radio' name='recurring' value='Yes' /> Yes – I would like to contribute regularly
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="form-group recurringFrequency hide">
								<label for="">Recurring Frequency</label>
								<select name='recurringFrequency' class='form-control'>
									<option value='Monthly'>Monthly</option>
									<option value='Quarterly'>Quarterly (once every 3 months)</option>
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="form-group">
								<label for="honor">Would you like to make this gift in honor or memory of someone?</label>
								<select name='honor' id='honor' class="form-control">
									<option value='no'>No</option>
									<option value='yes'>Yes</option>
								</select>
							</div>
							<div id="honor_name" style="display:none;">
								<hr />
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
										<div class="form-group">
											<label for="honor_verb">Occasion</label>
											<select name="honor_verb" class='form-control' id="honor_verb">
												<option value="In Honor Of">In Honor Of</option>
												<option value="In Memory Of">In Memory Of</option>
											</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
										<div class="form-group">
											<label for="honor_name" id="honor_name_label">Honoree</label>
											<input type='text' class='form-control' id="honor_name" name='honor_name' value='' data-parsley-validate-if-empty data-parsley-conditionalrequired='["[name=\"honor\"]", "yes"]' data-parsley-conditionalrequired-message="Please provide the individual's name." />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="form-group">
											<label for="ack_type" id="ack_label">Would you like to send an acknowledgement via e-card or mail?</label>
											<select name="ack_type" class='form-control' id="ack_type">
												<option value="ecard">Send an e-card</option>
												<option value="mail">Send acknowledgement via mail</option>
												<option value="none" selected="selected">No, thank you</option>
											</select>										
										</div>
									</div>
								</div>
								<div id="ecard_email" style="display:none;">
									<div class="row">
										<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
											<div>
												<strong>You will be offered a selection of cards and messages after payment.</strong>
											</div>
											<div class="form-group">
												<label for="ack_email">Recipient Email Address</label>
												<input type="email" class='form-control' name='ack_email' value='' data-parsley-conditionalrequired='["[name=\"ack_type\"]", "ecard"]' data-parsley-conditionalrequired-message="Please provide the recipient email address." />
											</div>
										</div>
									</div>
								</div>
								<div id="ack_mail" style="display:none;">
									<h3>Acknowledgement Recipient Info</h3>
									<div class="row">
										<div class="col-xs-12 col-sm-6 col-med-6 col-lg-6 col-xl-6">
											<div class="form-group">
												<label for="ack_first">First</label>
												<input type='text' class='form-control' name='ack_first' value='' data-parsley-validate-if-empty data-parsley-conditionalrequired='["[name=\"ack_type\"]", "mail"]'/>
											</div>
										</div>
										<div class="col-xs-12 col-sm-6 col-med-6 col-lg-6 col-xl-6">
											<div class="form-group">
												<label for="ack_last">Last</label>
												<input type='text' class='form-control' name='ack_last' value='' data-parsley-validate-if-empty data-parsley-conditionalrequired='["[name=\"ack_type\"]", "mail"]'/>
											</div>

										</div>
									</div>

									<div class="row">
										<div class="col-xs-12 col-sm-8 col-med-8 col-lg-8 col-xl-8">
											<div class="form-group">
												<label for="ack_address">Address</label>
												<input type='text' class='form-control' name='ack_address' value='' data-parsley-validate-if-empty data-parsley-conditionalrequired='["[name=\"ack_type\"]", "mail"]'/>
											</div>
										</div>
										<div class="col-xs-12 col-sm-4 col-med-4 col-lg-4 col-xl-4">
											<div class="form-group">
												<label for="ack_city">City</label>
												<input type='text' class='form-control' name='ack_city' value='' data-parsley-validate-if-empty data-parsley-conditionalrequired='["[name=\"ack_type\"]", "mail"]'/>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
											<div class="form-group">
												<label for="ack_country">Country</label>
												<select name='ack_country' class='form-control' id="ack_country">
													<?php
														foreach($country_list as $key=>$val) {
															echo "<option value='$key'>$val</option>";
														}
													?>	
												</select>
											</div>
										</div>	
										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
											<div class="form-group" id="ack_state_dropdown">
												<label for="ack_state">State / Province</label>
												<select name='ack_state' class='form-control' id="ack_state">
													<option value='-1'>Select State</option>
													<?php
														foreach($us_states as $key=>$val) {
															echo "<option value='$key'>$val</option>";
														}
													?>	
												</select>
											</div>
											<!--This field is hidden unless the country select dropdown is US/AU/CA/IN-->
											<div class="form-group" id="ack_state_input" style="display:none;">
												<label for="billing_state">State / Province</label>
												<input type='text' class='form-control' id="ack_state_field" name='ack_state_field' value='' />
											</div>
										</div>	
										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
											<div class="form-group">
												<label for="ack_zip">Zip / Postal Code</label>
												<input type='text' class='form-control' name='ack_zip' value='' data-parsley-validate-if-empty data-parsley-conditionalrequired='["[name=\"ack_type\"]", "mail"]'/>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<div class="form-group">
												<label for="honor_message">Your Message to Recipient</label>
												<textarea class='form-control' name='honor_message' maxlength="255" data-parsley-validate-if-empty data-parsley-conditionalrequired='["[name=\"ack_type\"]", "mail"]'></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<hr />
					
					<h3>Billing Info</h3>

					<div class="row">
						<div class="col-xs-12 col-sm-6 col-med-6 col-lg-6 col-xl-6">
							<div class="form-group">
								<label for="billing_first">Billing First</label>
								<input required type='text' class='form-control' name='billing_first' value='' />
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-med-6 col-lg-6 col-xl-6">
							
							<div class="form-group">
								<label for="billing_last">Billing Last</label>
								<input required type='text' class='form-control' name='billing_last' value='' />
							</div>

						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 col-sm-8 col-med-8 col-lg-8 col-xl-8">
							<div class="form-group">
								<label for="billing_address">Address</label>
								<input required type='text' class='form-control' name='billing_address' value='' />
							</div>
						</div>
						<div class="col-xs-12 col-sm-4 col-med-4 col-lg-4 col-xl-4">
							<div class="form-group">
								<label for="billing_city">City</label>
								<input required type='text' class='form-control' name='billing_city' value='' />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<div class="form-group">
								<label for="billing_country">Country</label>
								<select name='billing_country' class='form-control' id="billing_country">
									<?php
										foreach($country_list as $key=>$val) {
											echo "<option value='$key'>$val</option>";
										}
									?>	
								</select>
							</div>
						</div>	
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<div class="form-group" id="billing_state_dropdown">
								<label for="billing_state">State / Province</label>
								<select name="billing_state" class="form-control" id="billing_state">
									<option value="-1">Select State</option>
									<?php
										foreach($us_states as $key=>$val) {
											echo "<option value='$key'>$val</option>";
										}
									?>	
								</select>
							</div>
							<!--This field is hidden unless the country select dropdown is US/AU/CA/IN-->
							<div class="form-group" id="billing_state_input" style="display:none;">
								<label for="billing_state_field">State / Province</label>
								<input type='text' class='form-control' id="billing_state_field" name='billing_state_field' value='' />
							</div>
						</div>	
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<div class="form-group">
								<label for="billing_zip">Zip / Postal Code</label>
								<input required type='text' class='form-control' name='billing_zip' value='' />
							</div>
						</div>	
					</div>

					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div class="form-group">
								<label for="billing_email">Email Address</label>
								<input required type='email' class='form-control' name='billing_email' value='' />
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div class="form-group">
								<label for="billing_phone">Phone Number</label>
								<input required type='phone' class='form-control' name='billing_phone' value='' />
							</div>
						</div>
					</div>

					<hr />

					<h3>Payment Information</h3>
						
						<!-- CREDIT / DEBIT CARD -->
						<div id='creditForm'>
						<div class="form-group">
							<label for="">Debit/Credit Card #</label>
							<input required type='number' name='card_num' value='' class='form-control' minlength="15" maxlength="16" data-parsley-type="number" />
						</div>

						<div class="form-group">
							<label for="">Exp Date</label>
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-med-3 col-lg-3 col-xl-3">
									<select required name='card_exp_month' class='form-control' data-parsley-type="number">
										<option value=''>Month</option>
										<?php

											for($i=1; $i<=12; $i++) {
												echo "<option value='$i'>$i</option>";
											}
										?>
									</select>
								</div>
								<div class="col-xs-12 col-sm-4 col-med-3 col-lg-3 col-xl-3">
									<select required name='card_exp_year' class='form-control' data-parsley-type="number">
										<option value=''>Year</option>
										<?php

											for($i=date('Y'); $i<=(date('Y')+7); $i++) {
												echo "<option value='$i'>$i</option>";
											}
										?>
									</select>
								</div>
							</div>
							<div class="clearfix"></div><br>
							
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-2 col-lg-2">
									<div class="form-group">
										<label for="card_sec_code">Security Code</label>
										<input required type='text' class='form-control' name='card_sec_code' id='card_sec_code' data-parsley-type="number" minlegth="3" maxlength="4" />
									</div>
								</div>
							</div>
							</div>
							</div>
							<!-- END CREDIT / DEBIT -->

							<h3>Special Instructions</h3>

							<p>Please provide any comments or instructions regarding your donation.</p>

							<div class="form-group">
								<textarea class='form-control' name='instructions'></textarea>
							</div>

							<button name="submit" class="btn btn-success">Submit Donation</button>
							<a href='donate.php' class='btn btn-danger'>Reset Form</a>
						</div>
					<input type='hidden' name='auth' value='123' />
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript">
		  	window.ParsleyConfig = {
		    	validators: {
		      	conditionalrequired: {
			        fn: function (value, requirements) {
			          // if requirements[0] value does not meet requirements[1] expectation, field is required
			          if (requirements[1] == $(requirements[0]).val() && '' == value)
			          return false;

			          return true;
		        }
		      }
		    }
		  };
		</script>
		<!-- jQuery
		<script src="//code.jquery.com/jquery.js"></script>-->
		<script src="js/jquery.js"></script>
		<script src="js/parsley.min.js"></script>
		<!-- Bootstrap JavaScript
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>-->
		<script src="js/bootstrap.min.js"></script>
		<script src="js/site.js"></script>
	</body>
</html>