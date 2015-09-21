<?php
	//error_reporting(0);

	include 'includes/top.php';
	
	$sql = $db->query("SELECT *  FROM `lw_donation` WHERE `datetime` >= DATE_SUB(NOW(), INTERVAL 1 HOUR)") or die(mysql_error());

	if($sql->num_rows >= 10) {
		die("Sorry but we are down for maintenance");
		mail('cszalaj@gamil.com, carie@livingwatersfortheworld.org', "Living Waters Hacker", "Someone has pushed through more than 10 orders in the past hour");
	} 

	$card_num = $_POST['card_num'];
	$exp_date = $_POST['card_exp_month']."/".$_POST['card_exp_year'];
	$code = $_POST['card_sec_code'];

	$first_name = $_POST['billing_first'];
	$last_name = $_POST['billing_last'];
	$address = $_POST['billing_address'];
	$city = $_POST['billing_city'];
	$state = $_POST['billing_state'];
	$zip = $_POST['billing_zip'];
	$country = $_POST['billing_country'];
	$phone = $_POST['billing_phone'];
	$email = $_POST['billing_email'];
	$instructions = $_POST['instructions'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$amount = $_POST['amount'];
	$honor = $_POST['honor'];
	$anonymous = ($_POST['anonymous'] == 'yes') ? $_POST['anonymous'] : 'No';
	$recurrance = ($_POST['recurring'] == 'yes') ? $_POST['recurringFrequency'] : 'No';
	$matching_company_name = ($_POST['matching'] == 'yes') ? $_POST['company_name'] : 'No';

	$invoice_num = '';
	$donation_id = '';

    $_SESSION['user']['first_name'] = $first_name;
    $_SESSION['user']['last_name'] = $last_name;
    $_SESSION['user']['address'] = $address;
    $_SESSION['user']['city'] = $city;
    $_SESSION['user']['state'] = $state;
    $_SESSION['user']['zip'] = $zip;
    $_SESSION['user']['country'] = $country;
    $_SESSION['user']['phone'] = $phone;
    $_SESSION['user']['email'] = $email;
	
    require 'vendors/authorize-net/autoload.php';
	define("AUTHORIZENET_API_LOGIN_ID", $AuthVars['AUTHORIZENET_API_LOGIN_ID']);
	define("AUTHORIZENET_TRANSACTION_KEY", $AuthVars['AUTHORIZENET_TRANSACTION_KEY']);
	define("AUTHORIZENET_SANDBOX", $AuthVars['AUTHORIZENET_SANDBOX']);
	$sale           = new AuthorizeNetAIM;
	$sale->amount   = $amount;
	$sale->card_num = $card_num;
	$sale->exp_date = $exp_date;
	$sale->first_name = $first_name;
	$sale->last_name = $last_name;
	$sale->address = $address;
	$sale->city = $city;
	$sale->state = $state;
	$sale->zip = $zip;
	$sale->email = $email;
	$sale->card_code = $code;
	$response = $sale->authorizeAndCapture();


	$sessInfo = 'APILID::' . $AuthVars['AUTHORIZENET_API_LOGIN_ID'] . '::KEY::' . $AuthVars['AUTHORIZENET_TRANSACTION_KEY'] . '::SANDBOX::' .$AuthVars['AUTHORIZENET_SANDBOX'];
	
	if(true || $response->approved) {
			
		insertDonationInfo($db);
			
		//Check to see if there is a acknowledgement to send, and if so, register it in the ecard table. 
		if ($honor == 'yes') {
			insertHonorInfo($db);
		}
		
		if($_POST['ack_type'] == 'ecard') {
			header("Location: ecard.php");
			exit ();
		} else {
			header("Location: thankyou.php");
			exit ();
		}
	
		
	} else {
		// PAYMENT FAILED - LET'S TELL THEM WHY
		
	header("Location: failed.php?sessioninfo=$sessInfo&gateway_error=".urlencode($response->error_message));
	exit ();	
	}

	
	function insertDonationInfo($db) {

		global $first_name,$last_name,$address,$city,$state,$zip,$country,$phone,$email,$ip,$amount,$instructions,$anonymous,$recurrance,$matching_company_name;
		
		$db->query("INSERT INTO lw_donation
			(first_name, 
			last_name,
			address,
			city,
			state,
			zip,
			country,
			phone,
			email,
			ip,
			amount,
			message,
			anonymous,
			recurrance,
			matching_company_name)
			VALUES 
			('".$db->real_escape_string($first_name)."',
			'".$db->real_escape_string($last_name)."',
			'".$db->real_escape_string($address)."',
			'".$db->real_escape_string($city)."',
			'".$db->real_escape_string($state)."',
			'".$db->real_escape_string($zip)."',
			'".$db->real_escape_string($country)."',
			'".$db->real_escape_string($phone)."',
			'".$db->real_escape_string($email)."',
			'".$db->real_escape_string($ip)."',
			'".$db->real_escape_string($amount)."',
			'".$db->real_escape_string($instructions)."',
			'".$db->real_escape_string($anonymous)."',
			'".$db->real_escape_string($recurrance)."',
			'".$db->real_escape_string($matching_company_name)."'
			)") or die(mysql_error());

			$_SESSION['donationID'] = $db->insert_id;

	}

	function insertHonorInfo($db){
		//Get the fields::
		$recipient_first = $db->real_escape_string($_POST['ack_first']);
		$recipient_last = $db->real_escape_string($_POST['ack_last']);
		$recipient_email = $db->real_escape_string($_POST['ack_email']);
		$honor = $db->real_escape_string($_POST['honor_verb']);
		$honor_name = $db->real_escape_string($_POST['honor_name']);
		$special_message = $db->real_escape_string($_POST['honor_message']);
		$address = $db->real_escape_string($_POST['ack_address']);
		$city = $db->real_escape_string($_POST['ack_city']);
		$state = $db->real_escape_string($_POST['ack_state']);
		$zip = $db->real_escape_string($_POST['ack_zip']);
		$country = $db->real_escape_string($_POST['ack_country']);
		$donation_id = $_SESSION['donationID'];
		$delivery = $db->real_escape_string($_POST['ack_type']);

		// CREATE AN ENTRY FOR THE DONATION
		$db->query("INSERT INTO lw_ecard
			(recipient_first, 
			recipient_last,
			recipient_email,
			honor,
			honor_name,
			special_message,
			address,
			city,
			state,
			zip,
			country,
			donation_id,
			delivery)
			VALUES 
			('".$recipient_first."',
			'".$recipient_last."',
			'".$recipient_email."',
			'".$honor."',
			'".$honor_name."',
			'".$special_message."',
			'".$address."',
			'".$city."',
			'".$state."',
			'".$zip."',
			'".$country."',
			'".$_SESSION['donationID']."',
			'".$delivery."'
			)") or die(mysql_error());
			
		$_SESSION['honorID'] 	= $db->insert_id;
		$_SESSION['honor']		= $_POST['honor'];
		$_SESSION['honor_name'] = $_POST['honor_name'];
		$_SESSION['honor_verb'] = $_POST['honor_verb'];

	}

	//} // END PAYMENT METHOD CONDITIONAL

?>